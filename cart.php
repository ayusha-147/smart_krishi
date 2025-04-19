<?php
session_start();  //  Only keep this one
include("db.php");

$conn = new mysqli("localhost", "root", "", "smart_krishi");

$cart = $_SESSION['cart'] ?? [];
$product_details = [];

if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $result = $conn->query("SELECT * FROM products WHERE product_id IN ($ids)");
    while ($row = $result->fetch_assoc()) {
        $product_details[$row['product_id']] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart - Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CDN (include once in your layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<?php include("navbar.php"); ?>
<div class="container mt-4">
    <h3>Your Shopping Cart</h3>
    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table">
            <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th>Action</th></tr></thead>
            <tbody>
                <?php
                $grand_total = 0;
                foreach ($cart as $pid => $qty):
                    $product = $product_details[$pid];
                    $total = $product['product_price'] * $qty;
                    $grand_total += $total;
                ?>
                <tr>
                    <td><?= $product['product_name'] ?></td>
                    <td>
                        <form action="update_cart.php" method="get" class="form-inline">
                            <input type="hidden" name="pid" value="<?= $pid ?>">
                            <input type="number" name="qty" value="<?= $qty ?>" min="1" class="form-control form-control-sm mr-1" style="width: 70px;">
                            <button type="submit" class="btn btn-sm btn-outline-success">Update</button>
                        </form>
                    </td>

                    <td>Rs. <?= $product['product_price'] ?></td>
                    <td>Rs. <?= $total ?></td>
                    <td><a href="remove_from_cart.php?pid=<?= $pid ?>" class="btn btn-danger btn-sm">Remove</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td><strong>Rs. <?= $grand_total ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
    <?php if (!empty($cart)): ?>
    <a href="checkout.php" class="btn btn-success btn-lg">Proceed to Checkout</a>
<?php endif; ?>

</div>
</body>
</html>
