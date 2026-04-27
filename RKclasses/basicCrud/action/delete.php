<?php
include "../config/db.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE products_tb SET status = :status WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':status', 'inactive', PDO::PARAM_STR);
$stmt->execute();

header("Location: ../index.php");
?>