<?php

require_once __DIR__ . '/../app/infrastructure/auth/Jwt.php'; // Incluir las funciones JWT
require_once __DIR__ . '/../app/infrastructure/auth/AuthService.php'; // Incluir AuthService
require_once __DIR__ . '/../app/infrastructure/database/DBConnection.php'; // Incluir DBConnection
require_once __DIR__ . '/../app/domain/repositories/UserRepository.php'; // Asegurar que la interfaz se cargue antes
require_once __DIR__ . '/../app/infrastructure/repositories/DBUserRepository.php'; // Incluir UserRepository
require_once __DIR__ . '/../app/infrastructure/repositories/LoginAuditRepository.php'; // Incluir LoginAuditRepository

use App\Infrastructure\Auth\AuthService;
use App\Infrastructure\Database\DBConnection;
use App\Infrastructure\Repositories\DBUserRepository; // Usa DBUserRepository como implementación
use App\Infrastructure\Repositories\LoginAuditRepository;

$config = require __DIR__ . '/env.php'; // Corrige la ruta de env.php
$dbConnection = new DBConnection();
$userRepository = new DBUserRepository($dbConnection); // Instancia la clase concreta
$auditRepository = new LoginAuditRepository($dbConnection);
$authService = new AuthService($userRepository, $auditRepository, $config['TOKEN_SECRET']);

session_start();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
echo $path;

switch ($path) {
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $token = $authService->login($username, $password);

            if ($token) {
                $_SESSION['token'] = $token;
                header('Location: /index');
                exit;
            } else {
                header('Location: /login?error=1');
                exit;
            }
        } else {
            require 'app/view/login.php';
        }
        break;

    case '/index':
        if (isset($_SESSION['token']) && $authService->validateToken($_SESSION['token'])) {
            require 'app/view/index.php';
        } else {
            header('Location: /login');
            exit;
        }
        break;

    case '/logout':
        unset($_SESSION['token']);
        header('Location: /login');
        exit;

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
