<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/infrastructure/auth/Jwt.php';
require_once __DIR__ . '/../app/infrastructure/auth/AuthService.php';
require_once __DIR__ . '/../app/infrastructure/database/DBConnection.php';
require_once __DIR__ . '/../app/domain/repositories/UserRepository.php';
require_once __DIR__ . '/../app/infrastructure/repositories/DBUserRepository.php';
require_once __DIR__ . '/../app/infrastructure/repositories/LoginAuditRepository.php';
require_once __DIR__ . '/../app/domain/models/User.php';
require_once __DIR__ . '/validators.php';
require_once __DIR__ . '/handlers.php';

use App\Infrastructure\Auth\AuthService;
use App\Infrastructure\Database\DBConnection;
use App\Infrastructure\Repositories\DBUserRepository;
use App\Infrastructure\Repositories\LoginAuditRepository;

$config = require __DIR__ . '/env.php';
$dbConnection = new DBConnection();
$userRepository = new DBUserRepository($dbConnection);
$auditRepository = new LoginAuditRepository($dbConnection);
$authService = new AuthService($userRepository, $auditRepository, $config['TOKEN_SECRET']);

$basePath = str_replace('/config', '', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
$path = str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

switch ($path) {
    case '/':
    case '/index':
        handleIndex($authService, $basePath);
        break;

    case '/login':
        handleLogin($authService, $basePath);
        break;

    case '/register':
        handleRegister($userRepository, $basePath);
        break;

    case '/logout':
        handleLogout($basePath);
        break;

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}