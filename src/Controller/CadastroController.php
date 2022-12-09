<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Core\FrontController;
use Petshop\Model\Cliente;
use Petshop\View\Render;

class CadastroController extends FrontController
{
    public function cadastro()
    {
        $dados = [];
        $dados['titulo'] = 'Faça seu Cadastro';
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();
        $dados['formCadastro'] = $this->formCadastro();

        Render::front('cadastro', $dados);
    }

    public function postCadastro()
    {
        try {
            $cliente = new Cliente;
            $cliente->tipo = $_POST['tipo'] ?? null;
            $cliente->cpfcnpj = $_POST['cpfcnpj'] ?? null;
            $cliente->nome = $_POST['nome'] ?? null;
            $cliente->email = $_POST['email'] ?? null;
            $cliente->senha = $_POST['senha'] ?? null;
            if ($_POST['senha'] != $_POST['senha2']) {
                throw new Exception('O campo de senha e de confirmação de senha devem ter o mesmo valor');
            }

            $resultado = $cliente->find(['email=' => $cliente->email]);
            if(!empty($resultado)) {
                throw new Exception('Endereço de e-mail já cadastrado, selecione a opção de recuperar senha caso necessário');
            }
            $cliente->save();
        } catch(Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo'=>'warning',
                'texto'=> $e->getMessage()
            ];
            $this->cadastro();
            exit;
        }

        redireciona('/login', 'info', 'Cadastro realizado com sucesso, faça login para continuar');
    }

    private function formCadastro()
    {
        $dados = [
            'btn_label'=>'Criar minha Conta',
            'btn_class'=>'btn btn-success mt-5',
            'fields'=> [
                ['type'=>'radio-inline', 'class'=>'col-6', 'label'=>'Você é pessoa...', 'name'=>'tipo', 
                    'options'=>[
                        ['label'=>'Física', 'value'=>'F'],
                        ['label'=>'Jurídica', 'value'=>'J']
                    ],
                    'required'=>true, 
                ],
                ['type'=>'text', 'class'=>'col-6', 'label'=>'Documento', 'name'=>'cpfcnpj', 'required'=>true],
                ['type'=>'text', 'name'=>'nome', 'label'=>'Seu Nome Completo', 'required'=>true],
                ['type'=>'email', 'name'=>'email', 'label'=>'Seu melhor E-mail', 'required'=>true],
                ['type'=>'password', 'class'=>'col-6', 'name'=>'senha', 'label'=>'Crie uma Senha', 'required'=>true],
                ['type'=>'password', 'class'=>'col-6', 'name'=>'senha2', 'label'=>'Confirme a Senha', 'required'=>true],
            ]
        ];

        return Render::block('form', $dados);
    }
}