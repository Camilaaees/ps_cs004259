<?php

use Petshop\Model\Dica;

require_once __DIR__ . '/../vendor/autoload.php';

$dica = new Dica();
$dica->loadById(1);
echo $dica->iddica . PHP_EOL;
echo $dica->titulo . PHP_EOL;
echo $dica->descricao . PHP_EOL;
echo $dica->created_at . PHP_EOL;