<?php

namespace Petshop\Core;

use Bramus\Router\Router;

class App 
{
    /**
     * Variável estática que conterá o objeto Roter
     * responsável pelo tratamento das rotas
     *
     * @var Router
     */
    private static $router;

    /**
     * Método que será carregado quando alguma página do 
     * site for invocada, decide qual a rota deve ser
     * executada a partir da URL informada pelo usuário
     * 
     *
     * @return void
     */
    public static function start()
    {
        //associa um objeto Bramus\Router à variável $router
        self::$router = new Router();

        //registra as rotas possíveis
        self::registraRotasDoFrontEnd();
        self::registraRotasDoBackEnd();

        //analisa a requisição e escolhe a rota compatível
        self::$router->run();
    }

    /**
     * Registra as rotas possíveis que estarão associadas
     * aos controllers para o FRONT END
     *
     * @return void
     */
    private static function registraRotasDoFrontEnd()
    {
        self::$router->get('/', 'Petshop\Controller\HomeController@index');
    }

    /**
     * Registra as rotas possíveis que estarão associadas
     * aos controllers para o BACK END
     *
     * @return void
     */
    private static function registraRotasDoBackEnd()
    {

    }
}