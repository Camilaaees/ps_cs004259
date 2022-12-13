<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Model\Empresa;
use Petshop\View\Render;

class NossasLojas extends FrontController
{
    public function nossasLojas($idEmpresa)
    {
        $dados = [];
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();

        $empresa = new Empresa;
        if ( !$empresa->loadById($idEmpresa)) {
            redireciona('/', 'warning', 'Categoria não localizada');
        }

        $empresasLocalizadas = $empresa->find(['idempresa='=>$idEmpresa]);
        $dados['empresa'] = $empresasLocalizadas[0];
        
        Render::front('nossas-lojas', $dados);
    }
}