<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepository;
use App\Infrastructure\Database\DBConnection;

class DBUserRepository implements UserRepository {
    private \PDO $connection;

    public function __construct(DBConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }

    public function findUserByUsername(string $username): ?User {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $data ? new User($data['username'], $data['password'], $data['email'], (int)$data['id']) : null;
    }

    public function saveUser(User $user): bool {
        $stmt = $this->connection->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        return $stmt->execute([
            'username' => $user->getUsername(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
            'email' => $user->getEmail()
        ]);
    }
}