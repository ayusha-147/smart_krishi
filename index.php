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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css?v=1">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <a class="navbar-brand text-white font-weight-bold" href="#">
            <i class="fas fa-leaf"></i> Smart Krishi
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-bars text-white"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto text-white">
                <li class="nav-item"><a class="nav-link text-white" href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="shop.php"><i class="fas fa-store"></i> Shop</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="blog.php"><i class="fas fa-blog"></i> Blog</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="about.php"><i class="fas fa-users"></i> About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="account.php"><i class="fas fa-user-circle"></i> User Account</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-banner text-center">
        <div class="container">
            <h1 class="hero-heading">Welcome to Smart Krishi</h1>
            <p class="hero-subheading">Your one-stop farm-to-home store – dairy, vegetables, fruits, seeds & more.</p>
            <a href="shop.php" class="btn btn-success btn-lg"><i class="fas fa-shopping-basket"></i> Shop Now</a>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row">
            <?php
            // Query to get featured products
            $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN (27, 26, 38, 47)");
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3 mb-4"> <!-- Changed to 4 products per row (smaller) -->
                    <div class="card h-100 shadow-sm rounded">
                        <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.1rem;"><?php echo $row['product_name']; ?></h5> <!-- Slightly smaller title -->
                            <p class="card-text text-muted" style="font-size: 0.9rem;">Rs. <?php echo $row['product_price']; ?></p> <!-- Slightly smaller price font -->
                            <a href="shop.php" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <p>&copy; 2025 Smart Krishi | All rights reserved</p>
        <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
