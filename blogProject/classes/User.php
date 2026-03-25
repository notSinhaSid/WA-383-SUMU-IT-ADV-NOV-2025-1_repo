<?php
class User {
    private $conn;
    private $tableName = 'users_tb';

    public function __construct($conn){
        $this->conn = $conn;
    }

    // first - new register (create) function

    public function create($uName, $uEmail, $uGender, $uPassword, $uProfile) {
        $sql = "INSERT INTO {$this->tableName}(uName, uEmail, uGender, uPassword, uProfile)VALUES(:uName, :uEmail, :uGender, :uPassword, :uProfile)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':uName', $uName, PDO::PARAM_STR);
        $stmt->bindParam(':uEmail', $uEmail, PDO::PARAM_STR);
        $stmt->bindParam(':uGender', $uGender, PDO::PARAM_STR);
        $stmt->bindParam(':uPassword', $uPassword, PDO::PARAM_STR);
        $stmt->bindParam(':uProfile', $uProfile);

        return $stmt->execute();
    }

    // function to getUserByEmail for logincheck
    public function getUserByEmail($uEmail) {
        $sql = "SELECT * FROM {$this->tableName} WHERE uEmail = :uEmail";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':uEmail' , $uEmail, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch();
    }

    // get total number of user for admin dahsboard
    public function getTotalUserCount() {
        $sql = "SELECT COUNT(DISTINCT(uEmail)) FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}