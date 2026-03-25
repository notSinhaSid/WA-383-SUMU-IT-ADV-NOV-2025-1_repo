<?php
class Database {
    private const DB_CONFIG = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'dbname' => 'blogpostwebskitters',
        'charset' => 'utf8mb4',
    ];

    private const PDO_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
    ];

    private ?PDO $conn = null;

    public function __construct() {
        $this->connect();
    }

    private function connect(): void {
        $dsn = sprintf(
            "mysql:host=%s;dbname=%s;charset=%s",
            self::DB_CONFIG['host'],
            self::DB_CONFIG['dbname'],
            self::DB_CONFIG['charset'],
        );

        try{
            $this->conn = new PDO(
                $dsn,
                self::DB_CONFIG['user'],
                self::DB_CONFIG['password'],
                self::PDO_OPTIONS,
            );
        }
        catch(PDOException $e){
            throw new PDOException("Connection Failed : " . $e->getMessage());
        }
    }
    public function getConnection(): ?PDO {
        return $this->conn;
    }

    private function __clone() {}
}

$siteURL = 'http://localhost/WA-383-SUMU-IT-ADV-NOV-2025-1_repo/blogProject';