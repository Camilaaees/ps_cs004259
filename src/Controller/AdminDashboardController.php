<?php

namespace Petshop\Controller;

use Petshop\View\Render;

class AdminDashboardController
{
    public function index()
    {
        $dados = [];
        $dados['titulo'] = 'Dashboard';

        Render::back('dashboard', $dados);
    }
}