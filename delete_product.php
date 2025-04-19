<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php"); // Redirect if not admin
    exit();
}

$conn = new mysqli("localhost", "root", "", "smart_krishi");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    header("Location: admin_dashboard.php"); // Redirect to dashboard after deletion
    exit();
}
?>
