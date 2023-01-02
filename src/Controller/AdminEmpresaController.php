<?php

namespace Petshop\Controller;

use Exception;
use Petshop\Model\Empresa;
use Petshop\View\Render;

class AdminEmpresaController
{
    public function listar()
    {
        // alimentando dados para a tabela de listagem
        $dadosListagem= [];
        $dadosListagem['objeto'] = new Empresa;
        $dadosListagem['imagens'] = true;
        $dadosListagem['colunas'] = [
            ['campo'=>'idempresa', 'class'=>'text-center'],
            ['campo'=>'nomefantasia', 'class'=>'text-center'],
            ['campo'=>'razaosocial'],
            ['campo'=>'created_at', 'class'=>'text-center']
        ];
        $htmlTabela = Render::block('tabela-admin', $dadosListagem);

        // alimentando dados para a página de empresas
        $dados = [];
        $dados['titulo'] = 'Empresas - Listagem';
        $dados['tabela'] = $htmlTabela;

        Render::back('empresas', $dados);
    }

    public function form($valor)
    {
        // verificar se o parâmetro tem um número e, se for número, é um ID válido
        if (is_numeric($valor)) {
            $objeto = new Empresa;
            $resultado = $objeto->find(['idempresa ='=>$valor]);
            if (empty($resultado)) {
                redireciona('/admin/empresas', 'danger', 'Link inválido, registro não localizado');
            }
            $_POST = $resultado[0];
        }

        $dados = [];
        $dados['titulo'] = 'Empresas - Manutenção';
        $dados['formulario'] = $this->renderizaFormulario(empty($_POST));

        Render::back('empresas', $dados);
    }

    public function postForm($valor)
    {
        $objeto = new Empresa;

        // se um $valor tem um número, carrega os dados do registro informado nele
        if (is_numeric($valor)) {
            if (!$objeto->loadById($valor)) {
                redireciona('/admin/empresas', 'danger', 'Link inválido, registro não localizado');
            }
        }

        try {
            $campos = array_change_key_case($objeto->getFields());
            foreach($campos as $campo => $propriedades) {
                if (isset($_POST[$campo])) {
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

        redireciona('/admin/empresas', 'success', 'Alterações realizadas com sucesso');
    }

    public function renderizaFormulario($novo)
    {
        $dados = [
            'btn_class' => 'btn btn-warning px-5 mt-4 text-light',
            'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
            'fields' => [
                ['type'=>'readonly', 'name'=>'idempresa', 'class'=>'col-2', 'label'=>'ID Empresa'],
                ['type'=>'text', 'name'=>'nomefantasia', 'class'=>'col-10', 'label'=>'Nome', 'required'=>true],
                ['type'=>'text', 'name'=>'razaosocial', 'class'=>'col-8', 'label'=>'Razão Social', 'required'=>true],
                ['type'=>'radio-inline', 'name'=>'tipo', 'class'=>'col-4', 'label'=>'Tipo', 'required'=>true,
                    'options'=>[
                        ['value'=>'Matriz', 'label'=>'Matriz'],
                        ['value'=>'Filial', 'label'=>'Filial']
                    ]
                ],
                ['type'=>'text', 'name'=>'cep', 'class'=>'col-4', 'label'=>'CEP', 'required'=>true],
                ['type'=>'text', 'name'=>'cidade', 'class'=>'col-4', 'label'=>'Cidade', 'required'=>true],
                ['type'=>'text', 'name'=>'estado', 'class'=>'col-4', 'label'=>'Estado', 'required'=>true],

                ['type'=>'text', 'name'=>'rua', 'class'=>'col-5'],
                ['type'=>'text', 'name'=>'bairro', 'class'=>'col-5'],
                ['type'=>'text', 'name'=>'numero', 'label'=>'Número', 'class'=>'col-2'],

                ['type'=>'text', 'name'=>'telefone1', 'class'=>'col-3', 'label'=>'Telefone 01', 'required'=>true],
                ['type'=>'text', 'name'=>'telefone2', 'class'=>'col-3', 'label'=>'Telefone 02',],
                ['type'=>'text', 'name'=>'site', 'class'=>'col-2'],
                ['type'=>'text', 'name'=>'email', 'class'=>'col-2', 'label'=>'Email', 'required'=>true],
                ['type'=>'text', 'name'=>'cnpj', 'class'=>'col-2', 'label'=>'CNPJ', 'required'=>true],

                ['type'=>'readonly', 'name'=>'created_at', 'class'=>'col-6', 'label'=>'Criado em:'],
                ['type'=>'readonly', 'name'=>'updated_at', 'class'=>'col-6', 'label'=>'Atualizado em:'],
            ]
        ];
        return Render::block('form', $dados);
    }
}