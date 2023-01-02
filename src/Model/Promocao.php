<?php

namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;
use Petshop\Core\Exception;
use Respect\Validation\Validator as v;

#[Entidade(name: 'promocoes')]

class Promocao extends DAO 
{
    #[Campo(label:'Cód. Empresa', nn:true, pk:true, auto:true)]
    protected $idPromocao;

    #[Campo(label:'Item da Promoção', nn:true, order:true)]
    protected $titulo;

    #[Campo(label:'Descrição')]
    protected $descricao;

    #[Campo(label:'Desconto', nn:true)]
    protected $desconto;
    
    #[Campo(label:'Encerra:', nn:true)]
    protected $datafinal;

    #[Campo(label:'Ativo')]
    protected $ativo;

    #[Campo(label:'Dt. Criação', nn:true, auto:true)]
    protected $created_at;

    #[Campo(label:'Dt. Alteração', nn:true, auto:true)]
    protected $updated_at;

    public function getIdPromocao()
    {
        return $this->idPromocao;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo(string $titulo): self
    {
        $titulo = trim($titulo);
        $tamanhoValido = v::stringType()->length(1, 255)->validate($titulo);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do item da Promoção é inválido');
        }

        $this->titulo = $titulo;
        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($descricao): self
    {
        $descricao = trim($descricao);

        if ($descricao == '') {
            $this->descricao = null;
        } else if (strlen($descricao) < 10) {
            throw new Exception('Descrição inválida');
        }
        $this->descricao = $descricao;
        return $this;
    }

    public function getDesconto()
    {
        return $this->desconto;
    }
    public function setDesconto($desconto): self
    {
        if (!is_numeric($desconto) || $desconto < 0){
            throw new Exception('Desconto inválido para o item');
        }
        $this->desconto = $desconto;
        return $this;
    }

    public function getDataFinal()
    {
        return $this->datafinal;
    }
    public function setDataFinal($datafinal): self
    {
        $this->datafinal = $datafinal;
        return $this;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }
    public function setAtivo(string $ativo): self
    {
        $tipoValido = in_array($ativo, ['S', 'N']);
        if (!$tipoValido) {
            throw new Exception('O Ativo deve ser Sim ou Não');
        }

        $this->ativo = $ativo;
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