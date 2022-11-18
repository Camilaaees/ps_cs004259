<?php

//arquivos

class Arquivo
{
    // Cód. Arquivo, pk, nn, auto
    protected $idarquivo;

    // Nome do arquivo, nn, order:true
    protected $nome;

    // Tipo, nn
    protected $tipo;

    // Descrição
    protected $descricao;

    // Tabela
    protected $tabela;

    // ID Tabela
    protected $tabelaid;

    // Dt. Criação, nn, auto
    protected $created_at;

    // Dt. Alteração, nn, auto
    protected $updated_at;
}