<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Core\FrontController;
use Petshop\Model\Cliente;
use Petshop\View\Render;

class LoginController extends FrontController
{
    public function login()
    {
        $dados = [];
        $dados['titulo'] = 'Página de Login | Cadastro';
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();
        $dados['formLogin'] = $this->formLogin();

        Render::front('login', $dados);
    }

    public function postLogin() 
    {
        try {
            if (empty($_POST['email']) || empty($_POST['senha'])) {
                throw new Exception('Os campos de usuário e senha devem ser informados');
            }
    
            if (strlen($_POST['senha'])<5) {
                throw new Exception('O comprimento da senha é inválido, digite o menos cinco caracteres');
            }
    
            $dadosUsuario = (new Cliente)->find(['email='=>$_POST['email']]);
            
            if (!count($dadosUsuario)) {
                throw new Exception('Usuário ou senha inválidos');
            }
    
            $hashDaSenha = hash_hmac('md5', $_POST['senha'], SALT_SENHA);
            $senhaNoBanco = $dadosUsuario[0]['senha'];
    
            $senhaValida = password_verify($hashDaSenha, $senhaNoBanco);
    
            if (!$senhaValida) {
                throw new Exception('Usuário ou senha inválida');
            }
    
            $_SESSION['cliente'] = $dadosUsuario[0];
    
            redireciona('/meus-dados');
        } catch (Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo' => 'warning',
                'texto' => $e->getMessage()
            ];
            $_POST['senha'] = '';
            $this->login();
        }

    }

    private function formLogin()
    {
        $dados = [
            'btn_label'=>'Entrar',
            'btn_class'=>'btn btn-warning mt-4 w-75',
            'fields'=>[
                ['type'=>'email', 'name'=>'email', 'label'=>'Usuário', 'placeholder'=>'Seu e-mail cadastrado', 'required'=>true],
                ['type'=>'password', 'name'=>'senha', 'required'=>true],
            ]
        ];
        return Render::block('form', $dados);
    }
}