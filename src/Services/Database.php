<?php

namespace App\Services;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    // Constructeur privé pour empêcher instantiation

    /**
     * @throws \Exception
     */
    private function __construct() {
        // Charger la configuration si ce n'est pas déjà fait
        Config::loadEnv(__DIR__ . '/../../.env');

        try {
            $this->connection = new PDO(
                sprintf(
                    "mysql:host=%s;dbname=%s;charset=%s",
                    Config::get('DB_HOST', 'localhost'),
                    Config::get('DB_NAME', 'cesi-books'),
                    Config::get('DB_CHARSET', 'utf8mb4')
                ),
                Config::get('DB_USER', 'root'),
                Config::get('DB_PASSWORD', ''),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }

    private function __clone() {}
    private function __wakeup() {}
}
