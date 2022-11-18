<?php

namespace Petshop\Model;

use Petshop\Core\DAO;
use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;

#[Entidade(name: 'cidades')]

class Cidade extends DAO
{
    #[Campo(label:'Cód. Cidade', nn:true, pk:true, auto:true)]
    protected $idCidade;

    #[Campo(label:'UF', nn:true)]
    protected $uf;

    #[Campo(label:'IBGE', nn:true)]
    protected $ibge;

    #[Campo(label:'IBGE7', nn:true)]
    protected $ibge7;

    #[Campo(label:'Município', nn:true, order:true)]
    protected $municipio;

    #[Campo(label:'Região', nn:true)]
    protected $regiao;

    #[Campo(label:'População', nn:true)]
    protected $populacao;

    #[Campo(label:'Porte', nn:true)]
    protected $porte;

    #[Campo(label:'CAPITAL', nn:true)]
    protected $capital;

    public function getIdCidade()
    {
        return $this->idCidade;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function getIbge()
    {
        return $this->ibge;
    }

    public function getIbge7()
    {
        return $this->ibge7;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function getRegiao()
    {
        return $this->regiao;
    }

    public function getPopulacao()
    {
        return $this->populacao;
    }

    public function getPorte()
    {
        return $this->porte;
    }

    public function getCapital()
    {
        return $this->capital;
    }
}