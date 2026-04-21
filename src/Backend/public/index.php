<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Dbconnection;
use App\Config\DatabaseSetup;
use App\Controller\UserController;

header('Content-Type: application/json');

// 1. connect to DB
$pdo = Dbconnection::connect();

// 2. AUTO CREATE TABLES (this is what you want)
DatabaseSetup::init($pdo);

// 3. routing
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/user' && $method === 'POST') {
    (new UserController())->store();
    exit;
}

http_response_code(404);

echo json_encode([
    "error" => "Route not found",
    "path" => $uri
]);