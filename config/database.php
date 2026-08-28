<?php
/**
 * The Hide Out Cafe — Website Database Connection
 * Connects to the same cafe_pos_db used by the POS system.
 * Uses PDO singleton pattern.
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'cafe_pos_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Timezone
date_default_timezone_set('Asia/Colombo');

class Database {
    private static ?Database $instance = null;
    private ?PDO $conn = null;

    private function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
        ];

        try {
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            if ($e->getCode() == 1049) {
                die("<h3>Database Error:</h3><p>Database <code>" . DB_NAME . "</code> does not exist. Please run the POS database setup first, then import <code>database/website_tables.sql</code>.</p>");
            }
            die("<h3>Database Connection Failed:</h3><p>" . htmlspecialchars($e->getMessage()) . "</p>");
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->conn;
    }

    public function fetchAll(string $sql, array $params = []): array {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function fetchOne(string $sql, array $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function query(string $sql, array $params = []): PDOStatement {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function lastInsertId(): string {
        return $this->conn->lastInsertId();
    }
}

// Global shortcut helpers
function db(): Database {
    return Database::getInstance();
}

function pdo(): PDO {
    return Database::getInstance()->getConnection();
}
