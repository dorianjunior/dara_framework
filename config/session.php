<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Driver de Sessão
    |--------------------------------------------------------------------------
    |
    | Este valor define o "driver" de armazenamento padrão que será usado para
    | armazenar sessões. Por padrão, será usado o armazenamento nativo do PHP (files).
    |
    | Valores suportados: "file", "cookie", "database", "memcached", "redis"
    |
    */
    'driver' => $_ENV['SESSION_DRIVER'] ?? 'file',
    
    /*
    |--------------------------------------------------------------------------
    | Tempo de Vida da Sessão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o número de minutos que deseja que a sessão
    | possa permanecer inativa antes de expirar. Se você quiser que expire
    | ao fechar o navegador, defina esse valor como zero.
    |
    */
    'lifetime' => $_ENV['SESSION_LIFETIME'] ?? 120,
    
    /*
    |--------------------------------------------------------------------------
    | Expirar Ao Fechar o Navegador
    |--------------------------------------------------------------------------
    |
    | Se esta opção estiver definida como true, a sessão expirará imediatamente
    | quando o usuário fechar o navegador. Isso é uma boa opção para aumentar
    | a segurança, mas pode afetar a experiência do usuário.
    |
    */
    'expire_on_close' => false,
    
    /*
    |--------------------------------------------------------------------------
    | Criptografia de Sessão
    |--------------------------------------------------------------------------
    |
    | Esta opção permite especificar que todos os dados de sessão devem ser
    | criptografados antes de serem armazenados. Isso aumentará a segurança
    | dos seus dados de sessão, mas também pode afetar o desempenho.
    |
    */
    'encrypt' => false,
    
    /*
    |--------------------------------------------------------------------------
    | Caminho de Armazenamento de Sessão
    |--------------------------------------------------------------------------
    |
    | Quando usar o driver de sessão "file", precisamos de um local para
    | armazenar os arquivos de sessão. Um valor padrão foi definido, 
    | mas um caminho diferente pode ser especificado.
    |
    */
    'files' => __DIR__ . '/../storage/sessions',
    
    /*
    |--------------------------------------------------------------------------
    | Configurações de Cookie da Sessão
    |--------------------------------------------------------------------------
    |
    | Configurações usadas ao criar cookies de sessão.
    |
    */
    'cookie' => [
        'name' => $_ENV['SESSION_COOKIE'] ?? 'phpsessid',
        'path' => '/',
        'domain' => $_ENV['SESSION_DOMAIN'] ?? null,
        'secure' => $_ENV['SESSION_SECURE_COOKIE'] ?? false,
        'http_only' => true,
        'same_site' => 'lax',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Regeneração de ID de Sessão
    |--------------------------------------------------------------------------
    |
    | Define se o ID da sessão deve ser regenerado após um número específico
    | de solicitações. Isso pode ajudar a prevenir ataques de fixação de sessão.
    |
    */
    'regenerate' => true,
    
    /*
    |--------------------------------------------------------------------------
    | Tabela do Banco de Dados de Sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar o driver "database" para sessões, você pode especificar o nome
    | da tabela que deve ser usada para armazenar suas sessões.
    |
    */
    'table' => 'sessions',
];
