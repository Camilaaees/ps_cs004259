<?php

namespace Petshop\Controller;

use Petshop\View\Render;

class AdminDashboardController
{
    public function index()
    {
        $dados = [];
        $dados['titulo'] = 'Dashboard';
        $dados['usuario'] = $_SESSION['usuario'];

        Render::back('dashboard', $dados);
    }
}