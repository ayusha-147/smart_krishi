<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php"); // Redirect to login if not admin
    exit();
}

$conn = new mysqli("localhost", "root", "", "smart_krishi");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h3>Admin Dashboard</h3>
    <a href="add_product.php" class="btn btn-success">Add Product</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>

    <h4 class="mt-4">Products List</h4>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM products");
            while ($product = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $product['product_id'] ?></td>
                    <td><?= $product['product_name'] ?></td>
                    <td>Rs. <?= $product['product_price'] ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $product['product_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_product.php?id=<?= $product['product_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

