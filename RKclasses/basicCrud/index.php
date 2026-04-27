<?php 
require("config/db.php");
include("include/header.php");

$stmt = $pdo->prepare("SELECT * FROM products_tb WHERE status = :status");
$stmt->bindValue(':status', 'active', PDO::PARAM_STR);
$stmt->execute();
$products = $stmt->fetchAll();

?>

<h3>All product</h3>

<a href="create.php" class="btn btn-primary mb-2">Add product</a>

<table class="table table-bordered">
<tr>
    <th>Sl.No</th><th>Name</th><th>Price</th><th>category</th><th>Description</th><th>Action</th>
</tr>


<?php foreach($products as $index =>$product): ?>
<tr>
    <td><?= $index +1; ?></td>
    <td><?= $product['name'] ?></td>
    <td><?= $product['price'] ?></td>
    <td><?= $product['category'] ?></td>
    <td><?= $product['description'] ?></td>
    <td>
        <a href="" class="btn btn-warning btn-sm">Edit</a>
        <a href="action/delete.php?id=<?= $product['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
        <a href="" class="btn btn-info btn-sm">View</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?php include "include/footer.php"; ?>