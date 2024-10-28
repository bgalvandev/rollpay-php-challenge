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
        $user = $this->userRepository->findUserByUsername($username);

        if ($user && password_verify($password, $user->getPassword())) {
            $this->auditRepository->recordLogin($username, true);
            
            // Generación del JWT
            $header = ['alg' => 'HS256', 'typ' => 'JWT'];
            $payload = [
                'sub' => $user->getId(),
                'iat' => time(),
                'exp' => time() + 3600 // Expira en 1 hora
            ];
            
            return generateJwt($header, $payload, $this->secret);
        } else {
            $this->auditRepository->recordLogin($username, false);
            return null;
        }
    }

    public function validateToken(string $token): ?array {
        return verifyJwt($token, $this->secret);
    }
}