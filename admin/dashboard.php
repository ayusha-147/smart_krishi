<?php
// session_start();
// if (!isset($_SESSION['admin'])) {
//     header("Location: admin_login.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f9f4;
            font-family: 'Segoe UI', sans-serif;
        }
        .dashboard-box {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 60px;
        }
        h2 {
            color: #388e3c;
            margin-bottom: 30px;
        }
        a.btn-link {
            font-size: 18px;
            display: block;
            margin: 10px 0;
            color: #2e7d32;
            text-decoration: none;
            font-weight: 500;
        }
        a.btn-link:hover {
            text-decoration: underline;
            color: #1b5e20;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-box text-center">
            <h2>🌿 Smart Krishi Admin Panel</h2>
            <a href="manage_products.php" class="btn-link">🛒 Manage Products</a>
            <a href="manage_orders.php" class="btn-link">📦 Manage Orders</a>
            <a href="logout.php" class="btn-link text-danger">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
