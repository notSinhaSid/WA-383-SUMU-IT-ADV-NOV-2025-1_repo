<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Database {
    private const HOSTNAME = 'localhost';
    private const USERNAME = 'root';
    private const PASSWRORD = '';
    private const DBNAME = 'pdoDB';
    private const CHARSET = 'utf8mb4';


    public $conn;

    public function dbConnectionGenerator() {
        $this->conn = 'null';

        $dsn = "mysql:host=".self::HOSTNAME.";dbname=".self::DBNAME.";charset=".self::CHARSET;
        /* $options = [

        ] */

        try {
            $this->conn = new PDO( $dsn, self::USERNAME, self::PASSWRORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo `Connection Success ✔`;
        } catch (PDOException $exception) {
            die("Error connecting: ". $exception->getMessage());
        }

        return $this->conn;
    }
}