<?php

namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;
use Petshop\Core\Exception;

#[Entidade(name: 'produtos')]
class Produto extends DAO 
{
    #[Campo(label:'Cód. Produto', nn:true, pk:true, auto:true)]
    protected $idProduto;

    #[Campo(label:'Cód. Marca', nn:true, fk:true)]
    protected $idMarca;

    #[Campo(label:'Produto', nn:true, order:true)]
    protected $nome;

    #[Campo(label:'Tipo/grupo', nn:true)]
    protected $tipo;

    #[Campo(label:'Preço', nn:true)]
    protected $preco;

    #[Campo(label:'Quantidade', nn:true)]
    protected $quantidade;

    #[Campo(label:'Largura')]
    protected $largura;

    #[Campo(label:'Altura')]
    protected $altura;

    #[Campo(label:'Profundidade')]
    protected $profundidade;

    #[Campo(label:'Peso')]
    protected $peso;

    #[Campo(label:'Descrição')]
    protected $descricao;

    #[Campo(label:'Especificações')]
    protected $especificacoes;

    #[Campo(label:'Dt. Criação', nn:true, auto:true)]
    protected $created_at;

    #[Campo(label:'Dt. Alteração', nn:true, auto:true)]
    protected $updated_at;

    public function getIdProduto()
    {
        return $this->idProduto;
    }

    public function getIdMarca()
    {
        return $this->idMarca;
    }

    public function setIdMarca($idMarca): self
    {
        $objMarca = new Marca;
        if (!$objMarca->loadById($idMarca)) {
            throw new Exception('A marca informada é inválida');
        }

        $this->idMarca = $idMarca;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): self
    {
        $nome = trim($nome);
        if (strlen($nome) < 3) {
            throw new Exception('Nome inválido para o Produto');
        }

        $this->nome = $nome;
        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo): self
    {
        $tiposPermitidos = ['Ração','Brinquedo','Medicamento','Higiene & Beleza'];
        if(!in_array($tipo, $tiposPermitidos)) {
            throw new Exception('Tipo inválido para o produto');
        }

        $this->tipo = $tipo;
        return $this;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco): self
    {
        if(!is_numeric($preco) || $preco<0) {
            throw new Exception('Valor inválido para o produto');
        }

        $this->preco = $preco;
        return $this;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade): self
    {
        if(!is_numeric($quantidade) || $quantidade<0) {
            throw new Exception('Quantidade inválida para o produto');
        }

        $this->quantidade = $quantidade;
        return $this;
    }

    public function getLargura()
    {
        return $this->largura;
    }

    public function setLargura($largura): self
    {
        if(!is_numeric($largura) || $largura<0) {
            throw new Exception('Largura inválida para o produto');
        }

        $this->largura = $largura;
        return $this;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura): self
    {
        if(!is_numeric($altura) || $altura<0) {
            throw new Exception('Altura inválida para o produto');
        }

        $this->altura = $altura;
        return $this;
    }

    public function getProfundidade()
    {
        return $this->profundidade;
    }

    public function setProfundidade($profundidade): self
    {
        if(!is_numeric($profundidade) || $profundidade<0) {
            throw new Exception('Profundidade inválida para o produto');
        }

        $this->profundidade = $profundidade;
        return $this;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso): self
    {
        if(!is_numeric($peso) || $peso<0) {
            throw new Exception('Peso inválido para o produto');
        }

        $this->peso = $peso;
        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): self
    {
        $nome = trim($descricao);
        if (!$descricao) {
            return $this;
        }

        if (strlen($descricao) < 10) {
            throw new Exception('Descrição inválido para o Produto');
        }

        $this->descricao = $descricao;
        return $this;
    }

    public function getEspecificacoes()
    {
        return $this->especificacoes;
    }

    public function setEspecificacoes($especificacoes): self
    {
        $nome = trim($especificacoes);
        if (!$especificacoes) {
            return $this;
        }

        if (strlen($especificacoes) < 10) {
            throw new Exception('Especificações inválidas para o Produto');
        }

        $this->especificacoes = $especificacoes;
        return $this;
    }

    public function getCreated_At()
    {
        return $this->created_at;
    }

    public function getUpdated_At()
    {
        return $this->updated_at;
    }
}