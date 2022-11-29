<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\View\Render;

class HomeController extends FrontController
{
    public function index()
    {

        $dados = [];
        $dados['titulo'] = 'Página Inicial';
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();

        Render::front('home', $dados);
    }

}