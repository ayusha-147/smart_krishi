<?php
include("db.php"); // Include the database connection file
session_start();   // Start the session if you're using sessions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css?v=1">
 <!-- Custom CSS File -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <a class="navbar-brand" href="#">Smart Krishi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="wishlist.php">Wishlist</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="account.php">User Account</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <!-- Hero Section -->
    <!-- <div class="container mt-4">
        <div class="p-5 text-center hero-banner rounded-3 shadow">
            <h1 class="display-5 fw-bold">Welcome to Smart Krishi</h1>
            <p class="lead">Your one-stop farm-to-home store – dairy, vegetables, fruits, seeds & more.</p>
            <a href="shop.php" class="btn btn-success btn-lg">Shop Now</a>
        </div>
    </div> -->
    <div class="container mt-4">
    <div class="hero-banner">
        <h1>Welcome to Smart Krishi</h1>
        <p>Your one-stop farm-to-home store – dairy, vegetables, fruits, seeds & more.</p>
        <a href="shop.php" class="btn">Shop Now</a>
    </div>
</div>


    <!-- Featured Products Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row">
            <?php
            // $result = mysqli_query($conn, "SELECT * FROM products LIMIT 4");
            $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN (27, 26, 38, 47)");
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <p class="card-text text-muted">Rs. <?php echo $row['product_price']; ?></p>
                            <a href="shop.php" class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2025 Smart Krishi | All rights reserved</p>
        <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
