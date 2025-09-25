<?php

require_once __DIR__ . "/../apps/core/config.php";

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',

        'development' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'portfolio_db',
            'user' => 'root',
            'pass' => 'password',
            'port' => 3306,
            'charset' => 'utf8mb4',
        ],

        'production' => [
            'adapter' => 'mysql',
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASS,
            'port' => DB_PORT,
            'charset' => 'utf8mb4',
        ]
    ],
    'version_order' => 'creation'
];
