<?php
session_start();
include("db.php");

// Check login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Get cart
$cart = $_SESSION['cart'] ?? [];
$product_details = [];

// Fetch product details
if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN ($ids)");
    while ($row = mysqli_fetch_assoc($result)) {
        $product_details[$row['product_id']] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];

    // Total cost
    $total_cost = 0;
    foreach ($cart as $pid => $qty) {
        $product = $product_details[$pid];
        $total_cost += $product['product_price'] * $qty;
    }

    $user_id = $_SESSION['user']['id'];

    // Insert order
    $query = "INSERT INTO orders (user_id, name, address, phone, email, total_cost, payment_method) 
              VALUES ('$user_id', '$name', '$address', '$phone', '$email', '$total_cost', '$payment_method')";
    
    if (mysqli_query($conn, $query)) {
        unset($_SESSION['cart']); // Clear cart
        header("Location: thankyou.php");
    exit();
    } else {
        echo "<div class='alert alert-danger'>Error placing order: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Smart Krishi</title>
    <link rel="stylesheet" href="styles.css?v=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CDN (include once in your layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<?php include("navbar.php"); ?>
<div class="container mt-4">
        <h3>Checkout</h3>
        <?php if (empty($cart)): ?>
            <p>Your cart is empty. <a href="shop.php">Shop Now</a></p>
        <?php else: ?>
        <form method="POST">
        <div class="row">
            <div class="col-md-6">
                    <h4>Shipping Details</h4>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input name="name" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input name="address" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                            <option value="Online">Online (Coming Soon)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Order Summary</h4>
                    <table class="table">
                        <thead>
                            <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
                        </thead>
                        <tbody>
                            <?php $grand_total = 0; ?>
                            <?php foreach ($cart as $pid => $qty): 
                                $product = $product_details[$pid];
                                $total = $product['product_price'] * $qty;
                                $grand_total += $total;
                            ?>
                            <tr>
                                <td><?= $product['product_name'] ?></td>
                                <td><?= $qty ?></td>
                                <td>Rs. <?= $product['product_price'] ?></td>
                                <td>Rs. <?= $total ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3"><strong>Total</strong></td>
                                <td><strong>Rs. <?= $grand_total ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-success"><small>Estimated delivery in 3–5 days</small></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button class="btn btn-success btn-lg mt-2">Place Order</button>
        </form>
        <?php endif; ?>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
