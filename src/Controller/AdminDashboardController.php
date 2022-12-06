<?php

namespace Petshop\Controller;

use Petshop\View\Render;

class AdminDashboardController
{
    public function index()
    {
        $dados = [];
        $dados['titulo'] = 'Início';

        Render::back('dashboard', $dados);
    }
}