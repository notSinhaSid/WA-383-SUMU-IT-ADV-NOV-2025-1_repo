<?php
ob_start(); 
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Category.php');
session_start();

$dbObj = new Database();
$conn = $dbObj->getConnection();
$catObj = new Category($conn);

 if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch($action) {
        case 'createCategory':
            $catName = $_POST['catName']; 
            if(empty($catName)) {
                ob_clean();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Category name required',
                ]);
                exit();
            }
            // to check if the category exists
            $createCategory = $catObj->createCategory($catName);
            if($createCategory === 'exists') {
                ob_clean();
                echo json_encode([
                    'status' => 'warning',
                    'message' => 'Already exists in database, try another',
                ]);
                exit();
            }else {
                ob_clean();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'New Category added',
                ]);
                exit();
            }
            break;
    }
 }