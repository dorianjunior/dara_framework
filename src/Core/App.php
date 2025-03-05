<?php

namespace App\Core;

/**
 * Classe principal da aplicação
 */
class App
{
    protected $config;
    
    /**
     * Construtor privado para padrão Singleton
     */
    public function __construct()
    {
        $this->loadConfig();
        $this->loadRoutes();
        $this->bootstrap();
    }
    
    /**
     * Carrega as configurações da aplicação
     */
    protected function loadConfig()
    {
        $this->config = require __DIR__ . '/../../config/app.php';
    }
    
    /**
     * Inicializa componentes básicos da aplicação
     */
    protected function bootstrap()
    {
        error_reporting($this->config['debug'] ? E_ALL : 0);
        ini_set('display_errors', $this->config['debug'] ? 1 : 0);
        
        date_default_timezone_set($this->config['timezone'] );
        mb_internal_encoding('UTF-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, PACTH, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        
        if ($this->config['session']) {
            Session::start();
        }
    }
     
    /**
     * Carrega as rotas da aplicação dos arquivos api.php e web.php
     * 
     * @return void
     */
    protected function loadRoutes()
    {
        // Carrega as rotas da web
        $webRoutesPath = __DIR__ . '/../../routes/web.php';
        if (file_exists($webRoutesPath)) {
            require $webRoutesPath;
        }
        
        // Carrega as rotas da API
        $apiRoutesPath = __DIR__ . '/../../routes/api.php';
        if (file_exists($apiRoutesPath)) {
            require $apiRoutesPath;
        }
    }
    
    /**
     * Executa a aplicação
     */
    public function run()
    {
        $router = new Router();
        $router->dispatch();
    }
}
