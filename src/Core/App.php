<?php

namespace Petshop\Core;

use Bramus\Router\Router;
use Petshop\Controller\ErrorController;

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
        //carrega um sessão ou inicia uma nova em caso de novo acesso
        self::carregaSessao();
        
        //associa um objeto Bramus\Router à variável $router
        self::$router = new Router();

        //registra as rotas possíveis
        self::registraRotasDoFrontEnd();
        self::registraRotasDoBackEnd();
        self::registra404Generico();

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
        self::$router->get('/login', 'Petshop\Controller\LoginController@login');
        self::$router->post('/login', 'Petshop\Controller\LoginController@postLogin');
        self::$router->get('/cadastro', 'Petshop\Controller\CadastroController@cadastro');
        self::$router->post('/cadastro', 'Petshop\Controller\CadastroController@postCadastro');
        self::$router->get('/meus-dados', 'Petshop\Controller\MeusDadosController@meusDados');
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

    /**
     * Registra rota genérica para erro de URL digitada
     *
     * @return void
     */
    private static function registra404Generico()
    {
        self::$router->set404(function() {
            header('HTTP/1.1 404 Not Found');
            $objErro = new ErrorController();
            $objErro->erro404();
        });
    }

    /**
     * Função que inicia uma nova função e, posteriormente,
     * carrega o ID da sessão grava no dispositivo do unuário
     *
     * @return void
     */
    private static function carregaSessao()
    {
        session_start();
    }
}