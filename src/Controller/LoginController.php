<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
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