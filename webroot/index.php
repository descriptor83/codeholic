<?php
use Dotenv\Dotenv;

ini_set('display_errors',1);
error_reporting(32767);

define('ROOT', dirname(__DIR__));
require_once ROOT.'/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$app = new Application(ROOT, $config);

$app->router->get('/', [ SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [ SiteController::class, 'contact']);
$app->router->get('/login', [ AuthController::class, 'login']);
$app->router->get('/logout', [ AuthController::class, 'logout']);
$app->router->post('/login', [ AuthController::class, 'login']);
$app->router->get('/register', [ AuthController::class, 'register']);
$app->router->post('/register', [ AuthController::class, 'register']);
$app->router->get('/profile', [ AuthController::class, 'profile']);

$app->run();

