<?php
namespace App\Core;
use PDO;
class Database {
    private static ?PDO $conn = null;
    public static function getConnection(): PDO {
        $root = dirname(__DIR__, 2);
        if (file_exists($root.'/.env')) {
            $lines = file($root.'/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                $parts = explode('=', $line, 2);
                if (count($parts) == 2) {
                    $_ENV[trim($parts[0])] = trim($parts[1]);
                }
            }
        }
        $driver = $_ENV['DB_DRIVER'] ?? 'mysql';
        $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $port = $_ENV['DB_PORT'] ?? '3306';
        $dbname = $_ENV['DB_NAME'] ?? 'sistemalogin';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? '';
        if (self::$conn === null) {
            $dsn = sprintf("%s:host=%s;port=%s;dbname=%s;charset=utf8mb4", $driver, $host, $port, $dbname);
            self::$conn = new PDO($dsn, $user, $pass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$conn;
    }
}
