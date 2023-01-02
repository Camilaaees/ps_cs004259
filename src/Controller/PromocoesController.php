<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Model\Promocao;
use Petshop\View\Render;

class PromocoesController extends FrontController
{
    public function listar()
    {
        $dados =[];
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();
        
        $promocoes = (new Promocao)->find();

        $promocaoAtual = new Promocao;
        foreach($promocoes as & $e) {
            $promocaoAtual->loadById($e['idpromocao']);
            $e['imagens'] = $promocaoAtual->getFiles();
        }

        $dados['promocoes'] = $promocoes;   
        Render::front('promocoes', $dados);
    }
}