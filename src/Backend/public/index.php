<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// 🚨 HANDLE PREFLIGHT FIRST
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

header('Content-Type: application/json');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Dbconnection;
use App\Config\DatabaseSetup;
use App\Controller\UserController;

// DB
$pdo = Dbconnection::connect();
DatabaseSetup::init($pdo);

// Routing
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/user' && $method === 'POST') {
    (new UserController())->store();
    exit;
}

if ($uri === '/users' && $method === 'GET') {
    (new UserController())->index();
    exit;
}

http_response_code(404);

echo json_encode([
    "error" => "Route not found",
    "path" => $uri
]);