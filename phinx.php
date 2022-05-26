<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->safeLoad();

return [
    'paths'         => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
        'seeds'      => '%%PHINX_CONFIG_DIR%%/seeds',
    ],
    'environments'  => [
        'default_migration_table' => 'migration',
        'default_database'        => 'local',
        'local'                   => [
            'adapter' => 'mysql',
            'host'    => getenv('LOCAL_HOST'),
            'port'    => getenv('LOCAL_PORT'),
            'name'    => getenv('LOCAL_DATABASE'),
            'user'    => getenv('LOCAL_USERNAME'),
            'pass'    => getenv('LOCAL_PASSWORD'),
            'charset' => 'utf8mb4',
        ],
        'develop'                 => [
            'adapter' => 'mysql',
            'host'    => getenv('DEVELOP_HOST'),
            'port'    => getenv('DEVELOP_PORT'),
            'name'    => getenv('DEVELOP_DATABASE'),
            'user'    => getenv('DEVELOP_USERNAME'),
            'pass'    => getenv('DEVELOP_PASSWORD'),
            'charset' => 'utf8mb4',
        ],
        'staging'                 => [
            'adapter' => 'mysql',
            'host'    => getenv('STAGING_HOST'),
            'port'    => getenv('STAGING_PORT'),
            'name'    => getenv('STAGING_DATABASE'),
            'user'    => getenv('STAGING_USERNAME'),
            'pass'    => getenv('STAGING_PASSWORD'),
            'charset' => 'utf8mb4',
        ],
        'production'              => [
            'adapter' => 'mysql',
            'host'    => getenv('PRODUCTION_HOST'),
            'port'    => getenv('PRODUCTION_PORT'),
            'name'    => getenv('PRODUCTION_DATABASE'),
            'user'    => getenv('PRODUCTION_USERNAME'),
            'pass'    => getenv('PRODUCTION_PASSWORD'),
            'charset' => 'utf8mb4',
        ],
    ],
    'version_order' => 'creation',
];
