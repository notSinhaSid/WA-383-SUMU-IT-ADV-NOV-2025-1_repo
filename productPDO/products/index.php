<?php
require_once(__DIR__ . '/../config/Database.php');
$dbObj = new Database();
$conn = $dbObj->getConnection();

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <form action="" method="post"></form>
    <div class="container">
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Product Image</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $index => $product): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td>₹ <?php echo $product['price']; ?></td>
                            <td><?php echo $product['size']; ?></td>
                            <td><?php echo $product['color']; ?></td>
                            <td><?php echo $product['category']; ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>
                                <?php if (!empty($product['image'])) : ?>
                                    <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="product image" width="60" height="60" style="object-fit:cover; border-radius:6px;">
                                <?php else: ?>
                                    <span class="text-muted">No image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="editupdate.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-danger">Edit</a>
                                <a href="delete.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-primary">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h3>No data currently</h3>
                <?php endif; ?>
            </tbody>
        </table>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>