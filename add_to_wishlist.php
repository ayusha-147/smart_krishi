<?php
include("db.php");  // Include the database connection file
session_start();    // Start the session if you're using sessions

// Check if the user is logged in
if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");  // Redirect to login page if user is not logged in
    exit();
}

// Check if product ID is provided
if (!isset($_GET['pid'])) {
    header("Location: shop.php");  // Redirect if product ID is not provided
    exit();
}

$product_id = $_GET['pid'];
$user_id = $_SESSION['user']['id'];  // Get the logged-in user's ID

// Check if the product is already in the wishlist
$query = "SELECT * FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    // If the product is not in the wishlist, insert it into the wishlist table
    $insert_query = "INSERT INTO wishlist (user_id, product_id) VALUES ($user_id, $product_id)";
    if ($conn->query($insert_query) === TRUE) {
        echo "Product added to wishlist!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Product is already in your wishlist.";
}

// Redirect to wishlist page
header("Location: wishlist.php");
exit();
?>
