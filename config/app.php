<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Ambiente da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor determina o "ambiente" em que sua aplicação está rodando.
    | Isso pode determinar como você configura vários serviços da aplicação.
    | Valores aceitáveis: "production", "development", "testing"
    |
    */
    'env' => $_ENV['APP_ENV'],
    
    /*
    |--------------------------------------------------------------------------
    | Modo de Depuração
    |--------------------------------------------------------------------------
    |
    | Quando o modo de depuração está ativado, mensagens de erro detalhadas com
    | rastreamento de pilha serão mostradas em cada erro que ocorrer na aplicação.
    | Se desativado, uma página de erro simples será mostrada.
    |
    */
    'debug' => $_ENV['APP_DEBUG'],
    
    /*
    |--------------------------------------------------------------------------
    | URL da Aplicação
    |--------------------------------------------------------------------------
    |
    | Esta URL é usada pelo console para gerar links corretamente quando usar
    | o comando Artisan. Você deve definir isso para a raiz da sua aplicação.
    |
    */
    'url' => $_ENV['APP_URL'],
    
    /*
    |--------------------------------------------------------------------------
    | Fuso Horário da Aplicação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão para sua aplicação,
    | que será utilizado pelas funções de data e hora do PHP.
    |
    */
    'timezone' => $_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo',
    
    /*
    |--------------------------------------------------------------------------
    | Configuração de Sessão
    |--------------------------------------------------------------------------
    |
    | Ativa ou desativa o uso de sessões na aplicação
    |
    */
    'session' => true,
];
