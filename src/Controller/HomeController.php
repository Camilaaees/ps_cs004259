<?php

namespace Petshop\Controller;

use Petshop\Model\Estado;
use Petshop\View\Render;

class HomeController
{
    public function index()
    {
        $estados = ( new Estado() )->find();

        $dados = [];
        $dados['titulo'] = 'Lista de Estados';
        $dados['estados'] = $estados;
        $dados['topo'] = Render::block('topo');

        Render::front('home', $dados);
    }

}