<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Model\Empresa;
use Petshop\View\Render;

class EmpresaController extends FrontController
{
    public function listar()
    {
        $dados =[];
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();
        
        $empresas = (new Empresa)->find();

        $empresaAtual = new Empresa;
        foreach($empresas as &$e) {
            $empresaAtual->loadById($e['idempresa']);
            $e['imagens'] = $empresaAtual->getFiles();
        }

        $dados['empresas'] = $empresas;   
        Render::front('nossas-lojas', $dados);
    }
}