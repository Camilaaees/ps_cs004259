<?php

namespace Petshop\Controller;

use Petshop\Model\Estado;
use Petshop\View\Render;

class HomeController
{
    public function index()
    {
        $objetoEstado = new Estado();
        $estados = $objetoEstado->find();

        $dados = [];
        $dados['titulo'] = 'Lista de Estados';
        $dados['estados'] = $estados;

        Render::front('home', $dados);
    }
}