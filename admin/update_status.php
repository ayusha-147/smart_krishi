<?php
include("../db.php");
$order_id = $_GET['order_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $conn->query("UPDATE orders SET status='$status' WHERE order_id=$order_id");
    header("Location: manage_orders.php");
    exit();
}

$order = $conn->query("SELECT * FROM orders WHERE order_id=$order_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Order Status - Admin Panel | Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Update Status for Order #<?= $order_id ?></h2>

    <form method="POST">
        <div class="form-group">
            <label>Current Status:</label>
            <input type="text" class="form-control" value="<?= $order['status'] ?>" disabled>
        </div>

        <div class="form-group">
            <label>Update Status:</label>
            <select name="status" class="form-control">
                <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Processing" <?= $order['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                <option value="Delivered" <?= $order['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                <option value="Canceled" <?= $order['status'] == 'Canceled' ? 'selected' : '' ?>>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
</body>
</html>
