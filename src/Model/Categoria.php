<?php

namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;
use Petshop\Core\Exception;

#[Entidade(name: 'categorias')]
class Categoria extends DAO
{
    #[Campo(label:'Cód. Categoria', nn:true, pk:true, auto:true)]
    protected $idcategoria;

    #[Campo(label:'Categoria', nn:true, order:true)]
    protected $nome; 

    #[Campo(label:'Descrição')]
    protected $descricao; 

    #[Campo(label:'Dt. Criação', nn:true, auto:true)]
    protected $created_at; 

    #[Campo(label:'Dt. Alteração', nn:true, auto:true)]
    protected $updated_at;

    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): self
    {
        $marca = trim($nome);
        if (strlen($nome) < 3) {
            throw new Exception('Nome inválido para categoria');
        }
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): self
    {
        $descricao = trim($descricao);
        if (strlen($descricao) < 15) {
            throw new Exception('Descrição inválida para categoria');
        }

        $this->descricao = $descricao;

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