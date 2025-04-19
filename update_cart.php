<?php
session_start();

if (isset($_GET['pid']) && isset($_GET['qty'])) {
    $pid = $_GET['pid'];
    $qty = (int) $_GET['qty'];

    if ($qty > 0) {
        $_SESSION['cart'][$pid] = $qty;
    } else {
        unset($_SESSION['cart'][$pid]); // Remove if qty is 0
    }
}

header("Location: cart.php");
exit;
