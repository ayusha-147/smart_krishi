<?php
include("db.php"); // Include the database connection file
session_start();   // Start the session if you're using sessions
?>


<?php
session_start();
if (isset($_GET['pid'])) {
    unset($_SESSION['cart'][$_GET['pid']]);
}
header("Location: cart.php");
exit();
?>
