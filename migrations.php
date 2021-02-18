<?php
use Dotenv\Dotenv;

ini_set('display_errors',1);
error_reporting(32767);

require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use app\core\Application;
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$app = new Application(__DIR__, $config);

$app->db->applayMigrations();

