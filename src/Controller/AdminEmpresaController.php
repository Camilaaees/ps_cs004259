<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Model\Empresa;
use Petshop\View\Render;

class AdminEmpresaController 
{
    public function listar()
    {
        $lista = [];
        $lista['objeto'] = new Empresa;
        $lista['colunas'] = [
            ['campo'=>'idempresa', 'class'=>'text-center'],
            ['campo'=>'nomefantasia', 'class'=>'text-center'],
            ['campo'=>'telefone1', 'class'=>'text-center'],
            ['campo'=>'email', 'class'=>'text-center'],
            ['campo'=>'cnpj', 'class'=>'text-center'],
            ['campo'=>'created_at', 'class'=>'text-center'],
        ];
        $htmlTabela = Render::block('tabela-admin', $lista);

        $dados = [];
        $dados['titulo'] = 'Empresas';
        $dados['tabela'] = $htmlTabela;

        Render::back('empresas', $dados);
    }

    public function form($valor)
    {
        if(is_numeric($valor)) {
            $objeto = new Empresa;
            $resultado = $objeto->find(['idempresa= ' => $valor]);
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

       if(is_numeric($valor)) {
            if (!$objeto->loadById($valor)) {
                redireciona('/admin/empresas', 'danger', 'Link inválido, registro não localizado');
            }
        }

        try {
            $campos = array_change_key_case($objeto->getFields());
            foreach($campos as $campo => $propriedades) {
                if(isset($_POST[$campo]) && $_POST[$campo]) {
                    $objeto->$campo = $_POST[$campo];
                }
            }

            $objeto->save();

        } catch (Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo'=>'warning',
                'texto'=> $e->getMessage()
            ];
            $this->form($valor);
            exit;
        }

        redireciona('/admin/empresas', 'success', 'Alterações realizadas com sucesso');

    }

    public function renderizaFormulario($novo)
    {
        $dados = [
            'btn_class' => 'btn btn-warning px-5 mt-5',
            'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
            'fields' => [
                ['type'=>'readonly', 'name'=>'idempresa', 'class'=>'col-1', 'label'=>'Id. Empresa'],
                ['type'=>'text', 'name'=>'nomefantasia', 'class'=>'col-4', 'label'=>'Nome Fantasia'],
                ['type'=>'text', 'name'=>'razaosocial', 'class'=>'col-4', 'label'=>'Razão Social'],
                ['type'=>'radio-inline', 'name'=>'tipo', 'class'=>'col-3', 'label'=>'Tipo...',
                    'options'=>[
                        ['value'=>'Matriz', 'label'=>'Matriz'],
                        ['value'=>'Filial', 'label'=>'Filial'],
                    ]
                ],
                ['type'=>'text', 'name'=>'cep', 'class'=>'col-4', 'label'=>'CEP'],
                ['type'=>'text', 'name'=>'cidade', 'class'=>'col-4', 'label'=>'Cidade'],
                ['type'=>'text', 'name'=>'estado', 'class'=>'col-4', 'label'=>'Estado'],
                ['type'=>'text', 'name'=>'rua', 'class'=>'col-4', 'label'=>'Rua'],
                ['type'=>'text', 'name'=>'bairro', 'class'=>'col-4', 'label'=>'Bairro'],
                ['type'=>'text', 'name'=>'numero', 'class'=>'col-4', 'label'=>'Número'],
                ['type'=>'text', 'name'=>'telefone1', 'class'=>'col-3', 'label'=>'Telefone 1'],
                ['type'=>'text', 'name'=>'telefone2', 'class'=>'col-3', 'label'=>'Telefone 2'],
                ['type'=>'text', 'name'=>'site', 'class'=>'col-3', 'label'=>'Site'],
                ['type'=>'email', 'name'=>'email', 'class'=>'col-3', 'label'=>'E-mail'],
                ['type'=>'text', 'name'=>'cnpj', 'class'=>'col-3', 'label'=>'CNPJ'],
                ['type'=>'readonly', 'name'=>'created_at', 'class'=>'col-3', 'label'=>'Criado em:'],
                ['type'=>'readonly', 'name'=>'updated_at', 'class'=>'col-3', 'label'=>'Atualizado em:']
            ] 
        ];

        return Render::block('form', $dados);
    }
}