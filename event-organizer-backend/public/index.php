<?php
declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

set_exception_handler(function ($e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
});

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "$errstr in $errfile on line $errline"
    ]);
    return true;
});


require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Config;
use App\Core\Router;
use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;

// Handle CORS for every request
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Content-Type: application/json; charset=utf-8');

// Handle preflight (OPTIONS) before router
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No Content
    exit;
}

Config::load(__DIR__ . '/..');

$router = new Router();
$authController = new AuthController();
$authMw = new AuthMiddleware();

// Routes
$router->add('POST', '/api/register', [$authController, 'register']);
$router->add('POST', '/api/login', [$authController, 'login']);
$router->add('GET', '/api/me', [$authController, 'me'], [$authMw]);

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Dispatch only GET/POST etc. — OPTIONS is already handled above
$router->dispatch($method, $path);

?>