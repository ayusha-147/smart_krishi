<?php
// session_start();
// if (!isset($_SESSION['admin'])) {
//     header("Location: admin_login.php");
//     exit();
// }

include("../db.php"); // Path to your db connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products - Admin Panel | Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Manage Products</h2>
    <a href="add_product.php" class="btn btn-primary mb-3">+ Add New Product</a>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price (Rs)</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM products");
        $i = 1;
        while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><img src="<?= $row['image_url'] ?>" style="height:60px;"></td>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['product_price'] ?></td>
                <td><?= $row['category_id'] ?></td>
                <td>
                    <a href="edit_product.php?pid=<?= $row['product_id'] ?>" class="btn btn-sm btn-info">Edit</a>
                    <a href="delete_product.php?pid=<?= $row['product_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
