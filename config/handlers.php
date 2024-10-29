<?php

use App\Infrastructure\Auth\AuthService;
use App\Infrastructure\Repositories\DBUserRepository;
use App\Domain\Models\User;

function handleIndex(AuthService $authService, string $basePath): void {
    if (isset($_SESSION['token']) && $authService->validateToken($_SESSION['token'])) {
        require __DIR__ . '/../app/view/home/index.php';
    } else {
        header('Location: ' . $basePath . '/login');
        exit;
    }
}

function handleLogin(AuthService $authService, string $basePath): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validación de campos vacíos
        if (!validateLoginFields($username, $password)) {
            header('Location: ' . $basePath . '/login?error=1');
            exit;
        }

        // Lógica de autenticación
        $token = $authService->login(trim($username), trim($password));

        if ($token) {
            $_SESSION['token'] = $token;
            $_SESSION['username'] = $username;

            header('Location: ' . $basePath . '/index');
            exit;
        } else {
            header('Location: ' . $basePath . '/login?error=1');
            exit;
        }
    } else {
        require __DIR__ . '/../app/view/login/login.php';
    }
}

function handleRegister(DBUserRepository $userRepository, string $basePath): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        
        // Validación de campos vacíos
        if (!validateRegisterFields($username, $password, $email)) {
            header('Location: ' . $basePath . '/register?error=1');
            exit;
        }
        
        // Crear el objeto usuario y guardarlo
        $user = new User($username, $password, $email);
        
        if ($userRepository->saveUser($user)) {
            header('Location: ' . $basePath . '/register?success=1');
        } else {
            header('Location: ' . $basePath . '/register?error=1');
        }
        exit;
    } else {
        require __DIR__ . '/../app/view/login/register.php';
    }
}

function handleLogout(string $basePath): void {
    unset($_SESSION['token']);
    header('Location: ' . $basePath . '/login');
    exit;
}