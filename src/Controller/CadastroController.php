<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
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