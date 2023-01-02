<?php

namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Model\Categoria;
use Petshop\Model\Produto;
use Petshop\View\Render;

class CategoriaController extends FrontController
{
    public function lista($idCategoria)
    {
        $dados = [];
        $dados['topo'] = $this->carregaHTMLTopo();
        $dados['rodape'] = $this->carregaHTMLRodape();

        $categoria = new Categoria;
        if (!$categoria->loadById($idCategoria)) {
            redireciona('/', 'warning', 'Categoria não localizada');
        }

        $dados['categoria'] = [];
        $dados['categoria']['idcategoria'] = $categoria->getIdcategoria();
        $dados['categoria']['nome'] = $categoria->getNome();
        $dados['categoria']['descricao'] = $categoria->getDescricao();

        $dados['categoria']['imagens'] = $categoria->getFiles();

        $produtos = (new Produto)->find(['idcategoria=' => $categoria->getIdcategoria()]);

        foreach($produtos as &$p) {
            $produtoAtual = new Produto;
            $produtoAtual->loadById($p['idproduto']);
            $p['imagens'] = $produtoAtual->getFiles();
        }

        $dados['produtos'] = $produtos;   
        Render::front('categorias', $dados);
    }
}