<?php
include("db.php"); // Include the database connection file
session_start();   // Start the session if you're using sessions
?>


<?php
include("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $desc = $_POST["description"];
    $cat_id = $_POST["category_id"];

    $img = "uploads/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $img);

    $stmt = $conn->prepare("INSERT INTO products (product_name, product_price, description, category_id, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsis", $name, $price, $desc, $cat_id, $img);
    $stmt->execute();

    echo "<div class='alert alert-success'>Product added!</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include("navbar.php"); ?>
<div class="container mt-4">
    <h4>Add New Product</h4>
    <form method="POST" enctype="multipart/form-data">
        <input name="name" placeholder="Product Name" class="form-control mb-2" required>
        <input name="price" placeholder="Price (Rs.)" type="number" step="0.01" class="form-control mb-2" required>
        <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
        <input name="category_id" placeholder="Category ID" type="number" class="form-control mb-2" required>
        <input type="file" name="image" class="form-control mb-3" required>
        <button class="btn btn-success">Add Product</button>
    </form>
</div>
</body>
</html>
