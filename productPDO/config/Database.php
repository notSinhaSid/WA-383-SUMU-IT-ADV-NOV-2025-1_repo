<?php
class Database {
    private const DB_CONFIG = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'productpdo',
        'charset' => 'utf8mb4',
    ];

    private const PDO_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
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
            self::DB_CONFIG['charset']
        );

        try {
            $this->conn = new PDO(
                $dsn, self::DB_CONFIG['username'], self::DB_CONFIG['password'], self::PDO_OPTIONS,
            );
            
        }catch(PDOException $e) {
            throw new RuntimeException("Connection failed :" . $e->getMessage(), 0, $e);
        }
    }

    public function getConnection(): PDO {
        if($this->conn === null){
            throw new RuntimeException("No active DB connection");
        }
        return $this->conn;
    }
}