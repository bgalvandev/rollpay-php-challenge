<?php
namespace App\Infrastructure\Repositories;
use App\Infrastructure\Database\DBConnection;

class LoginAuditRepository {
    private \PDO $connection;
    public function __construct(DBConnection $dbConnection) {
        $this->connection = $dbConnection->getConnection();
    }
    public function recordLogin(string $username, bool $success): void {
        $stmt = $this->connection->prepare("INSERT INTO login_audit (username, success, login_time) VALUES (:username, :success, NOW())");
        $stmt->execute(['username' => $username, 'success' => $success]);
    }
}