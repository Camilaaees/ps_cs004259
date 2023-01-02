<?php

namespace Petshop\Controller;

use Exception;
use Gumlet\ImageResize;
use Petshop\Model\Arquivo;
use Petshop\View\Render;

class AdminImagemController
{
    public function listar($model, $idModel)
    {
        $modelPath = "Petshop\\Model\\{$model}";
        if (!class_exists($modelPath)) {
            redireciona('/admin/dashboard', 'danger', 'Página não localizada/Classe de dados destino não definida');
        }

        $objetoComFiguras = new $modelPath;
        $objetoComFiguras->loadById($idModel);

        // alimentando dados para a tabela de listagem
        $dadosListagem= [];
        $dadosListagem['objeto'] = new Arquivo;
        $dadosListagem['rows'] = $objetoComFiguras->getFiles();
        $dadosListagem['remover'] = true;
        $dadosListagem['colunas'] = [
            ['campo'=>'idarquivo', 'class'=>'text-center'],
            ['campo'=>'tipo', 'class'=>'text-center'],
            ['campo'=>'nome'],
            ['campo'=>'tabela', 'class'=>'text-center'],
            ['campo'=>'tabelaid', 'class'=>'text-center'],
            ['campo'=>'created_at', 'class'=>'text-center']
        ];
        $htmlTabela = Render::block('tabela-admin', $dadosListagem);

        $dados = [];
        $dados['titulo'] = 'Imagens - Listagem';
        $campoOrdenacao = $objetoComFiguras->getOrderByField();
        $dados['registroAlvo'] = $model . ': <u>' . $objetoComFiguras->$campoOrdenacao . '</u>';
        $dados['tabela'] = $htmlTabela;

        $dados = [];
        $dados['titulo'] = 'Imagens';
        $dados['tabela'] = $htmlTabela;
        $dados['usuario'] = $_SESSION['usuario'];


        Render::back('imagens', $dados);
    }

    public function form($model, $idModel, $valor)
    {
        $modelPath = "Petshop\\Model\\{$model}";
        if (!class_exists($modelPath)) {
            redireciona('/admin/dashboard', 'danger', 'Página não localizada/Clsse de dados destino não definida');
        }

        $objetoComFiguras = new $modelPath;
        $objetoComFiguras->loadById($idModel);

        if (is_numeric($valor)) {
            $objeto = new Arquivo;
            $resultado = $objeto->find(['idarquivo ='=>$valor]);
            if (empty($resultado)) {
                redireciona("/admin/imagens/{$model}/{$idModel}", 'danger', 'Link inválido, registro não localizado');
            }
            $_POST = $resultado[0];
        }

        $dados = [];
        $dados['titulo'] = 'Imagens - Manutenção';
        $dados['formulario'] = $this->renderizaFormulario(empty($_POST));
        $campoOrdenacao = $objetoComFiguras->getOrderByField();
        $dados['registroAlvo'] = $model . ': <u>' . $objetoComFiguras->$campoOrdenacao . '</u>';
        
        Render::back('imagens', $dados);
    }

    public function postForm($model, $idModel, $valor)
    {
        $objeto = new Arquivo;

        if (is_numeric($valor)) {
            if (!$objeto->loadById($valor)) {
                redireciona("/admin/imagens/{$model}/{$idModel}", 'danger', 'Link inválido, registro não localizado');
            }
        }

        try {
            if (!empty($_FILES['arquivo']['name'])) {
                $_POST['nome'] = $_FILES['arquivo']['name'];
                $_POST['tipo'] = 'Imagem';
            }

            $modelPath = "Petshop\\Model\\{$model}";
            if (!class_exists($modelPath)) {
                redireciona('/admin/dashboard', 'danger', 'Página não localizada/Clsse de dados destino não definida');
            }

            $objetoComFiguras = new $modelPath;
            $objetoComFiguras->loadById($idModel);
            $tabela = $objetoComFiguras->getTableName();
            $tabelaChave = $objetoComFiguras->getPkName();
            $_POST['tabela'] = "{$tabela}.{$tabelaChave}";
            $_POST['tabelaid'] = $idModel;

            $campos = array_change_key_case($objeto->getFields());
            foreach($campos as $campo => $propriedades) {
                if (isset($_POST[$campo])) {
                    $objeto->$campo = $_POST[$campo];
                }
            }
            
            $objeto->save();

            // se foi enviado arquivo novo, mover para a pasta de uploads com o id do arquivo como seu nome
            if (!empty($_FILES['arquivo']['name'])) {
                $nomeChave = $objeto->getPkName();
                $valorChave = $objeto->$nomeChave;
                $NomeArquivo = $valorChave . '.' . pathinfo($objeto->nome, PATHINFO_EXTENSION);
                $pathArquivo = PATH_PROJETO . 'public/assets/img/uploads/' . $NomeArquivo;

                if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $pathArquivo)) {
                    throw new Exception('Falha ao mover o arquivo, verifique permissões');
                }

                rename($pathArquivo, $pathArquivo . '_original');
                $image = new ImageResize($pathArquivo . '_original');
                $image->crop(700,700);
                $image->save($pathArquivo);
                unlink($pathArquivo . '_original');
            }

        } catch(Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo'=>'warning',
                'texto'=>$e->getMessage()
            ];
            $this->form($model, $idModel, $valor);
            exit;
        }

        redireciona("/admin/imagens/{$model}/{$idModel}", 'success', 'Alterações realizadas com sucesso');
    }

    public function renderizaFormulario($novo)
    {
        $dados = [
            'btn_class' => 'btn btn-warning px-5 mt-4 text-light',
            'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
            'enctype' => 'multipart/form-data',
            'fields' => [
                ['type'=>'readonly', 'name'=>'idarquivo', 'class'=>'col-2', 'label'=>'ID Arquivo'],
                ['type'=>'readonly', 'name'=>'nome', 'class'=>'col-4', 'label'=>'Nome do Arquivo (automático)'],
                ['type'=>'file', 'name'=>'arquivo', 'class'=>'col-4', 'label'=>'Arquivo', 'accept'=>'image/*'],
                ['type'=>'readonly', 'name'=>'tipo', 'class'=>'col-2'],
                ['type'=>'textarea', 'name'=>'descricao', 'class'=>'col-12', 'label'=>'Descrição', 'rows'=>'5'],
                ['type'=>'readonly', 'name'=>'created_at', 'class'=>'col-3', 'label'=>'Criado em:'],
                ['type'=>'readonly', 'name'=>'updated_at', 'class'=>'col-3', 'label'=>'Atualizado em:'],
            ]
        ];
        return Render::block('form', $dados);
    }
}
