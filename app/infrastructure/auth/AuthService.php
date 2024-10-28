<?php

namespace App\Infrastructure\Auth;

use App\Domain\Repositories\UserRepository;
use App\Infrastructure\Repositories\LoginAuditRepository;

class AuthService {
    private UserRepository $userRepository;
    private LoginAuditRepository $auditRepository;
    private string $secret;

    public function __construct(UserRepository $userRepository, LoginAuditRepository $auditRepository, string $secret) {
        $this->userRepository = $userRepository;
        $this->auditRepository = $auditRepository;
        $this->secret = $secret;
    }

    public function login(string $username, string $password): ?string {
        // Verificar usuario y contraseña
        $user = $this->userRepository->findUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Si el login es exitoso, registrar la auditoría
            $this->auditRepository->recordLogin($username, true);

            // Generar el JWT
            $header = ['alg' => 'HS256', 'typ' => 'JWT'];
            $payload = [
                'sub' => $user['id'],
                'iat' => time(),
                'exp' => time() + 3600 // 1 hora de expiración
            ];
            return \App\Infrastructure\Auth\generateJwt($header, $payload, $this->secret);
        } else {
            // Si el login falla, registrar la auditoría
            $this->auditRepository->recordLogin($username, false);
            return null;
        }
    }

    public function validateToken(string $token): ?array {
        return \App\Infrastructure\Auth\verifyJwt($token, $this->secret);
    }
}