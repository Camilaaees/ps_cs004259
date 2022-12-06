<?php

namespace Petshop\Controller;

use Petshop\View\Render;

class AdminClienteController
{
    public function listar()
    {
        $dados = [];
        $dados['titulo'] = 'Clientes';

        Render::back('clientes', $dados);
    }
}