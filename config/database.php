<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Conexão Padrão do Banco de Dados
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar qual das conexões de banco de dados abaixo
    | deseja usar como sua conexão padrão para todo o trabalho do banco de dados.
    |
    */
    'default' => $_ENV['DB_DRIVER'] ?? 'mysql',
    
    /*
    |--------------------------------------------------------------------------
    | Conexões do Banco de Dados
    |--------------------------------------------------------------------------
    |
    | Aqui estão as configurações de conexão do banco de dados para sua aplicação.
    | As configurações para cada tipo de banco de dados suportado.
    |
    */
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'port' => $_ENV['DB_PORT'] ?? '3306',
            'database' => $_ENV['DB_NAME'] ?? 'mysql',
            'username' => $_ENV['DB_USERNAME'] ?? 'root',
            'password' => $_ENV['DB_PASSWORD'] ?? 'password',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => $_ENV['DB_DATABASE'] ?? __DIR__ . '/../database/database.sqlite',
            'prefix' => '',
            'foreign_key_constraints' => $_ENV['DB_FOREIGN_KEYS'] ?? true,
        ],
        
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'port' => $_ENV['DB_PORT'] ?? '5432',
            'database' => $_ENV['DB_DATABASE'] ?? 'postgres',
            'username' => $_ENV['DB_USERNAME'] ?? 'postgres',
            'password' => $_ENV['DB_PASSWORD'] ?? 'password',
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
    ],
];
