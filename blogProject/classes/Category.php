<?php
class Category {
    private $conn;
    private $tableName = 'categories_tb';

    public function __construct($conn){
        $this->conn = $conn;
    }

    // creating categories
    public function createCategory($catName) {
    // call checkCategoryExists from within createCategory
    if($this->checkCategoryExists($catName)) {
        return 'exists'; // ← return a string so controller knows why it failed
    }

    $sql = "INSERT INTO {$this->tableName}(catName) VALUES(:catName)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':catName', $catName, PDO::PARAM_STR);
    return $stmt->execute();
}

private function checkCategoryExists($catName) {
    $sql = "SELECT catId FROM {$this->tableName} WHERE catName = :catName";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':catName', $catName, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch();
}

    // fetching the categories that are available to the user when post creation
    public function getCategoryAll() {
        $sql = "SELECT * FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get count of category for the admin dashboard
    public function getCategoryCount(){
        $sql = "SELECT COUNT(catName) FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // get category for pagination
    public function getCategoryForPagination($limit = 5, $offset = 0) {
        $sqql = "SELECT * FROM {$this->tableName} LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sqql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}