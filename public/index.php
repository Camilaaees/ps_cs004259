<?php

use Petshop\Model\Dica;

require_once __DIR__ . '/../vendor/autoload.php';

$dica = new Dica();
$dica->titulo = 'Título da nova dica';
$dica->save();
