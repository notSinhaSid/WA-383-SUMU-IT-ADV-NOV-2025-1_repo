<?php

class User {
    private $conn;
    private $tableName = 'users_tb';

    public function __construct($dbResponse) {
        $this->conn = $dbResponse;
    }

    // this is used to create a user/ register user creation
    public function createRegisterUser($uName, $uEmail, $uPhone, $uProfile) {
        $query = "INSERT INTO {$this->tableName}(uName, uEmail, uPhone, uProfile)
        VALUES(:uName, :uEmail, :uPhone, :uProfile)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":uName", $uName, PDO::PARAM_STR_CHAR);
        $stmt->bindValue(":uEmail", $uEmail, PDO::PARAM_STR);
        $stmt->bindValue(":uPhone", $uPhone);
        $stmt->bindValue(":uProfile", $uProfile);


        return $stmt->execute();
    }

    // this is used to fetch the user. retrive

    public function retriveAll() {
        $query = "SELECT * FROM {$this->tableName} ORDER BY uId DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // get the requested user based on uId
    public function getCurrUser($uId) {
        $query = "SELECT * FROM {$this->tableName} WHERE uId = :uId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":uId", $uId);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // deletion of the requested data

    public function deleteUser($uId) {
        $query = "DELETE FROM {$this->tableName} WHERE uId = :uId";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":uId", $uId);
        return $stmt->execute();
    }

    // update the user data 

    public function updateUser($uId, $uName, $uEmail, $uPhone, $uProfile = null) {
        if ($uProfile !== null) {
            $query = "UPDATE {$this->tableName} SET uName = :uName, uEmail = :uEmail, uPhone = :uPhone, uProfile = :uProfile WHERE uId = :uId";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":uName", $uName, PDO::PARAM_STR);
            $stmt->bindValue(":uEmail", $uEmail, PDO::PARAM_STR);
            $stmt->bindValue(":uPhone", $uPhone);
            $stmt->bindValue(":uProfile", $uProfile);
            $stmt->bindValue(":uId", $uId);
        } else {
            $query = "UPDATE {$this->tableName} SET uName = :uName, uEmail = :uEmail, uPhone = :uPhone WHERE uId = :uId";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":uName", $uName, PDO::PARAM_STR);
            $stmt->bindValue(":uEmail", $uEmail, PDO::PARAM_STR);
            $stmt->bindValue(":uPhone", $uPhone);
            $stmt->bindValue(":uId", $uId);
        }

        return $stmt->execute();
    }
}