<?php
// session_start();
// if (!isset($_SESSION['admin'])) {
//     header("Location: admin_login.php");
//     exit();
// }

include("../db.php"); // your DB connection file
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders - Admin Panel | Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Manage Orders</h2>
    
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Total (Rs)</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $orders = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
        $i = 1;
        while ($row = $orders->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['name'] ?> (<?= $row['email'] ?>)</td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['total_cost'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= date("d M, Y h:i A", strtotime($row['order_date'])) ?></td>
                <td>
                    <a href="view_order.php?order_id=<?= $row['order_id'] ?>" class="btn btn-sm btn-info">View</a>
                    <a href="update_status.php?order_id=<?= $row['order_id'] ?>" class="btn btn-sm btn-warning">Update</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
