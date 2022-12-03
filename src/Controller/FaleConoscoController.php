<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\View\Render;

class FaleConoscoController extends FrontController
{
    public function faleConosco()
    {
        
        $dados = [];
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();
        $dados['formulario'] =  $this->formFaleConosco();
        
        Render::front('meus-dados', $dados);
    }

    private function formFaleConosco()
    {
        
    }
}