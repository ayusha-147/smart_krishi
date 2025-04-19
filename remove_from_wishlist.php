<?php
include("db.php"); // Include the database connection file
session_start();   // Start the session if you're using sessions

// Ensure user is logged in
if (!isset($_SESSION['user']['id']) || !isset($_GET['pid'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user']['id'];
$product_id = $_GET['pid'];

// Delete the product from the wishlist
$delete_query = "DELETE FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
if ($conn->query($delete_query) === TRUE) {
    header("Location: wishlist.php");  // Redirect back to wishlist
    exit();
} else {
    echo "Error removing product from wishlist: " . $conn->error;
}
?>
