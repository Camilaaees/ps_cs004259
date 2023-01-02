<?php

namespace Petshop\Controller;

use Exception;
use Petshop\Core\FrontController;
use Petshop\Core\SendMail;
use Petshop\View\Render;
use Respect\Validation\Validator as v;

class FaleConoscoController extends FrontController
{
    public function faleConosco()
    {
        $dados = [];
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();
        $dados['formulario'] = $this->FormFaleConosco();

        Render::front('fale-conosco', $dados);
    }

    public function postFaleConosco()
    {
        try {
            if (empty($_POST['nome']) ||
                empty($_POST['email']) ||
                empty($_POST['mensagem'])) {
                throw new Exception('Todos os campos devem ser preenchidos');
            }
            
            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $mensagem = trim($_POST['mensagem']);
            if (strlen($nome) < 6) {
                throw new Exception('O nome precisa ser completo');
            }

            $emailValido = v::email()->validate($email);
            if (!$emailValido) {
                throw new Exception('Email inválido');
            }

            if (strlen($mensagem) < 6) {
                throw new Exception('Por favor, seja mais descritivo na mensagem');
            }

            $assunto = 'Contato via site - ' . date('d/m/Y H:i:s');
            $mensagemFull = <<<HTML
                Olá, chegou um novo contato <br>
                - <strong>Nome:</strong> {$nome} <br>
                - <strong>Email:</strong> {$email} <br>
                - <strong>Mensagem:</strong> <br>{$mensagem} <br>
            HTML;

            SendMail::enviar(MAIL_CONTACTNAME, MAIL_CONTACTMAIL, $assunto, $mensagemFull, $nome, $email);

        } catch(Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo' => 'warning',
                'texto' => $e->getMessage()
            ];
            $this->faleConosco();
            exit;
        }
        redireciona('/fale-conosco', 'success', 'Mensagem enviada com sucesso');
    }

    public function FormFaleConosco()
    {
        $dados = [
            'btn_label'=>'Enviar mensagem',
            'btn_class'=>'btn btn-warning w-50 text-light',
            'fields' => [
                ['type' => 'text', 'name' => 'nome', 'label' => 'Nome Completo', 'required' => true],
                ['type' => 'email', 'name' => 'email', 'label' => 'E-mail', 'required' => true],
                ['type' => 'textarea', 'name' => 'mensagem', 'label' => 'Mensagem', 'rows' => 5, 'required' => true]
            ]
        ];

        return Render::block('form', $dados);
    }
}