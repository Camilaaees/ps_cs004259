<?php

namespace Petshop\Controller;

use Exception;
use Petshop\Model\Promocao;
use Petshop\View\Render;

class AdminPromocoesController
{
    public function listar()
    {
        // alimentando dados para a tabela de listagem
        $dadosListagem= [];
        $dadosListagem['objeto'] = new Promocao;
        $dadosListagem['imagens'] = true;
        $dadosListagem['colunas'] = [
            ['campo'=>'idpromocao', 'class'=>'text-center'],
            ['campo'=>'titulo', 'class'=>'text-center'],
            ['campo'=>'desconto'],
            ['campo'=>'created_at', 'class'=>'text-center']
        ];
        $htmlTabela = Render::block('tabela-admin', $dadosListagem);

        // alimentando dados para a página de Promoções
        $dados = [];
        $dados['titulo'] = 'Promoções';
        $dados['tabela'] = $htmlTabela;

        $dados = [];
        $dados['titulo'] = 'Promoções';
        $dados['tabela'] = $htmlTabela;
        $dados['usuario'] = $_SESSION['usuario'];


        Render::back('promocoes', $dados);
    }

    public function form($valor)
    {
        // verificar se o parâmetro tem um número e, se for número, é um ID válido
        if (is_numeric($valor)) {
            $objeto = new Promocao;
            $resultado = $objeto->find(['idpromocao ='=>$valor]);
            if (empty($resultado)) {
                redireciona('/admin/promocoes', 'danger', 'Link inválido, registro não localizado');
            }
            $_POST = $resultado[0];
        }

        $dados = [];
        $dados['titulo'] = 'Promoções - Manutenção';
        $dados['formulario'] = $this->renderizaFormulario(empty($_POST));

        Render::back('promocoes', $dados);
    }

    public function postForm($valor)
    {
        $objeto = new Promocao;

        // se um $valor tem um número, carrega os dados do registro informado nele
        if (is_numeric($valor)) {
            if (!$objeto->loadById($valor)) {
                redireciona('/admin/promocoes', 'danger', 'Link inválido, registro não localizado');
            }
        }

        try {
            $campoDecimal = ['desconto'];

            $campos = array_change_key_case($objeto->getFields());
            foreach($campos as $campo => $propriedades) {
                if (isset($_POST[$campo])) {
                    if (in_array($campo, $campoDecimal)) {
                        $_POST[$campo] = str_replace(',', '.', $_POST[$campo]);
                    }
                    $objeto->$campo = $_POST[$campo];
                }
            }
            
            $objeto->save();

        } catch(Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo'=>'warning',
                'texto'=>$e->getMessage()
            ];
            $this->form($valor);
            exit;
        }

        redireciona('/admin/promocoes', 'success', 'Alterações realizadas com sucesso');
    }

    public function renderizaFormulario($novo)
    {
        $dados = [
            'btn_class' => 'btn btn-warning px-5 mt-4 text-light',
            'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
            'fields' => [
                ['type'=>'readonly', 'name'=>'idpromocao', 'class'=>'col-2', 'label'=>'ID Promoção'],
                ['type'=>'text', 'name'=>'titulo', 'class'=>'col-10', 'label'=>'Item da Promoção', 'required'=>true],
                ['type'=>'textarea', 'name'=>'descricao', 'class'=>'col-12', 'label'=>'Descricao', 'rows'=>5],
                ['type'=>'text', 'name'=>'desconto', 'class'=>'col-4', 'label'=>'Desconto', 'required'=>true],
                ['type'=>'date', 'name'=>'datafinal', 'class'=>'col-4', 'label'=>'Encerra:', 'required'=>true],
                ['type'=>'radio-inline', 'name'=>'ativo', 'class'=>'col-4', 'label'=>'Ativo', 'required'=>true,
                    'options'=>[
                        ['value'=>'S', 'label'=>'Sim'],
                        ['value'=>'N', 'label'=>'Não']
                    ]
                ],
                ['type'=>'readonly', 'name'=>'created_at', 'class'=>'col-6', 'label'=>'Criado em:'],
                ['type'=>'readonly', 'name'=>'updated_at', 'class'=>'col-6', 'label'=>'Atualizado em:'],
            ]
        ];
        return Render::block('form', $dados);
    }
}