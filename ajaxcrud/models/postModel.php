<?php
class User {
    /*
    this class is the user class that creates the user and handles all the backend logic that the said user might perform 
    */

    // $pdo accepts the pdo connection var, which means if the connection is  failed no further task is done
    private $pdo;
    private $tableName = 'users_tb';
    // this constructor uses the pdo variable to store that locally
    private function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // creating the entry of user
    public function create($userName, $userEmail, $userPic = null) {
        $query = "INSERT INTO {$this->tableName}(userName, userEmail, userPic)VALUES(:userName, :userEmail, :userPic)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":userName", $userName);
        $stmt->bindParam(":userEmail", $userEmail);
        $stmt->bindParam(":userPic", $userPic);
        return $stmt->execute();
    }

}