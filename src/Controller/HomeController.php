<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Model\Estado;
use Petshop\View\Render;

class HomeController extends FrontController
{
    public function index()
    {
        $estados = ( new Estado() )->find();

        $dados = [];
        $dados['titulo'] = 'Lista de Estados';
        $dados['estados'] = $estados;
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();

        Render::front('home', $dados);
    }

}