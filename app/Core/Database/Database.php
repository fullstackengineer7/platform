<?php

declare(strict_types=1);

namespace App\Core\Database;

use PDO;
use Exception;

class Database
{
    private ?PDO $pdo = null;

    public function __construct(
        private string $dsn,
        private string $username,
        private string $password
    ) {}

    public function getConnection(): PDO
    {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (Exception $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }

    public function beginTransaction(): void
    {
        $this->getConnection()->beginTransaction();
    }

    public function commit(): void
    {
        $this->getConnection()->commit();
    }

    public function rollBack(): void
    {
        $this->getConnection()->rollBack();
    }
}
