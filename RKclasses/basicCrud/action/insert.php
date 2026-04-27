<?php
include("../config/db.php");

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$description = $_POST['description'];


$stmt = $pdo->prepare("INSERT INTO products_tb(name,price,category,description) VALUES(?,?,?,?)");

$stmt->execute([$name,$price,$category,$description]);

header("Location: ../index.php");
?>
