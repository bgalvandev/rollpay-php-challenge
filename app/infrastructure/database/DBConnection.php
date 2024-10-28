<?php

namespace App\Infrastructure\Database;

class DBConnection {
    private \PDO $connection;

    public function __construct() {
        $config = require __DIR__ . '/../../../config/env.php';
        $dsn = "mysql:host={$config['DB_HOST']};port={$config['DB_PORT']};dbname={$config['DB_NAME']};charset=utf8";
        $this->connection = new \PDO($dsn, $config['DB_USER'], $config['DB_PASS']);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(): \PDO {
        return $this->connection;
    }
}