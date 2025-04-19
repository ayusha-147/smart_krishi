<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php"); // Redirect if not admin
    exit();
}

$conn = new mysqli("localhost", "root", "", "smart_krishi");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $desc = $_POST["description"];
    $cat_id = $_POST["category_id"];
    
    // Check if an image is uploaded
    if ($_FILES["image"]["name"]) {
        $img = "uploads/" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $img);
        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, description=?, category_id=?, image_url=? WHERE product_id=?");
        $stmt->bind_param("sdissi", $name, $price, $desc, $cat_id, $img, $product_id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, description=?, category_id=? WHERE product_id=?");
        $stmt->bind_param("sdssi", $name, $price, $desc, $cat_id, $product_id);
    }

    $stmt->execute();
    echo "<div class='alert alert-success'>Product updated!</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h4>Edit Product</h4>
    <form method="POST" enctype="multipart/form-data">
        <input name="name" placeholder="Product Name" value="<?= $product['product_name'] ?>" class="form-control mb-2" required>
        <input name="price" placeholder="Price (Rs.)" type="number" step="0.01" value="<?= $product['product_price'] ?>" class="form-control mb-2" required>
        <textarea name="description" placeholder="Description" class="form-control mb-2" required><?= $product['description'] ?></textarea>
        <input name="category_id" placeholder="Category ID" type="number" value="<?= $product['category_id'] ?>" class="form-control mb-2" required>
        <input type="file" name="image" class="form-control mb-3">
        <button class="btn btn-success">Update Product</button>
    </form>
</div>
</body>
</html>
