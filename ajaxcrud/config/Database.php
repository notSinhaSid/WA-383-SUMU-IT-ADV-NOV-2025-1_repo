<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Database
{
    private const DB_CONFIG = [
        'host' => 'localhost',
        'dbname' => 'ajaxcrud',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
    ];

    private const PDO_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    private ?PDO $conn = null;

    public function __construct()
    {
        $this->connnect();
    }

    public function connnect(): void
    {
        $dsn = sprintf(
            "mysql:host=%s;dbname=%s;charset=%s",
            self::DB_CONFIG['host'],
            self::DB_CONFIG['dbname'],
            self::DB_CONFIG['charset']
        );

        try {
            $this->conn = new PDO(
                $dsn,
                self::DB_CONFIG['username'],
                self::DB_CONFIG['password'],
                self::PDO_OPTIONS,
            );
        } catch (PDOException $e) {
            throw new PDOException("Connection Failed" . $e->getMessage());
        }
    }

    public function getConnection(): ?PDO
    {
        return $this->conn;
    }

    private function __clone() {}
}
