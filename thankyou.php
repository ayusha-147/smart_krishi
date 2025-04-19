<?php
session_start();
include("navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Successful - Smart Krishi</title>
    <link rel="stylesheet" href="styles.css?v=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CDN (include once in your layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="container mt-5 text-center">
    <h2 class="text-success">🎉 Thank you for your order!</h2>
    <p>We've received your order and will contact you soon for delivery.</p>
    <a href="shop.php" class="btn btn-primary mt-3">Continue Shopping</a>
</div>
</body>
</html>
