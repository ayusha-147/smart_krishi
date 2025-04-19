<?php
include("db.php"); // Include the database connection file
session_start();   // Start the session if you're using sessions

// Ensure user is logged in
if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user']['id'];  // Get the logged-in user's ID
$product_details = [];

// Fetch the products in the user's wishlist from the database
$query = "SELECT p.* FROM wishlist w 
          JOIN products p ON w.product_id = p.product_id 
          WHERE w.user_id = $user_id";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $product_details[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Wishlist - Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CDN (include once in your layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="styles.css"> <!-- Or navbar.css -->
</head>
<body>
<?php include("navbar.php"); ?>
<div class="container mt-4">
    <h3>Your Wishlist</h3>
    <?php if (empty($product_details)): ?>
        <p>Your wishlist is empty.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($product_details as $product): ?>
                <div class="col-md-3 mb-4"> <!-- Adjusted to col-md-3 for smaller cards -->
                    <div class="card">
                        <img src="<?= $product['image_url'] ?>" class="card-img-top" style="height:140px; object-fit:cover;"> <!-- Reduced image height -->
                        <div class="card-body">
                            <h5><?= $product['product_name'] ?></h5>
                            <p>Rs. <?= $product['product_price'] ?></p>
                            <a href="add_to_cart.php?pid=<?= $product['product_id'] ?>" class="btn btn-success">Add to Cart</a>
                            <a href="remove_from_wishlist.php?pid=<?= $product['product_id'] ?>" class="btn btn-outline-danger">Remove</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<!-- Footer -->
<footer class="text-center mt-5">
        <p>&copy; 2025 Smart Krishi | All rights reserved</p>
        <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
    </footer>
</body>
</html>
