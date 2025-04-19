<?php
include("db.php"); // Include the database connection file
session_start();   // Start the session if you're using sessions
?>


<?php
session_start();

if (!isset($_GET['pid'])) {
    header("Location: shop.php");
    exit();
}

$product_id = $_GET['pid'];

// Initialize cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add or increase quantity
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]++;
} else {
    $_SESSION['cart'][$product_id] = 1;
}

header("Location: cart.php");
exit();
?>