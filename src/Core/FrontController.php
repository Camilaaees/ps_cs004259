<?php

namespace Petshop\Core;

use Petshop\Model\Empresa;
use Petshop\View\Render;

abstract class FrontController 
{
    /**
     * Alimenta com dados e renderiza o Topo do Site
     * para o cliente (front-end)
     *
     * @return void
     */
    public function carregaHTMLTopo()
    {
        $empresa = new Empresa;
        $dados = $empresa->find(['tipo ='=>'Matriz']);

        if ( !empty($_SESSION['cliente'])) {
            $dados[0]['cliente'] = $_SESSION['cliente'];
        }

        $dados[0]['empresas'] = (new Empresa)->find();

        return Render::block('topo', $dados[0]);
    }

    /**
     * Alimenta com dados e renderiza o Rodapé do Site
     * para o cliente (front-end)
     *
     * @return void
     */
    public function carregaHTMLRodape()
    {
        $empresa = new Empresa;
        $dados = $empresa->find(['tipo ='=>'Matriz']);
        return Render::block('rodape', $dados[0]);
    }
}