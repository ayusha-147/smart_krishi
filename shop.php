<?php
include("db.php");
session_start();

$conn = new mysqli("localhost", "root", "", "smart_krishi");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category_filter = isset($_GET['category']) ? $_GET['category'] : null;
$subcategory_filter = isset($_GET['subcategory']) ? $_GET['subcategory'] : null;
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

$category_sql = "SELECT * FROM categories WHERE parent_id IS NULL";
$category_result = $conn->query($category_sql);

$product_sql = "SELECT * FROM products WHERE product_name LIKE '%$search_query%'";
if ($category_filter) {
    $product_sql .= " AND category_id = $category_filter";
} elseif ($subcategory_filter) {
    $product_sql .= " AND category_id = $subcategory_filter";
}
$product_result = $conn->query($product_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop - Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Font Awesome CDN (include once in your layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="styles.css?v=2">
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container">
        <h2 class="mt-4 mb-4">Shop Products</h2>
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 shop-sidebar">
                <!-- Search Form -->
                <h5>Search Products</h5>
                <form method="get" action="shop.php" class="form-inline mb-4">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search_query) ?>">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Category List -->
                <h5>Categories</h5>
                <ul class="list-group">
                    <?php while ($cat = $category_result->fetch_assoc()): ?>
                        <li class="list-group-item <?= ($category_filter == $cat['id']) ? 'bg-light' : '' ?>">
                            <a href="shop.php?category=<?= $cat['id'] ?>" class="text-decoration-none"><?= $cat['name'] ?></a>
                            <?php
                            $sub_sql = "SELECT * FROM categories WHERE parent_id = " . $cat['id'];
                            $sub_result = $conn->query($sub_sql);
                            if ($sub_result->num_rows > 0):
                            ?>
                                <ul class="pl-3">
                                    <?php while ($sub = $sub_result->fetch_assoc()): ?>
                                        <li><a href="shop.php?subcategory=<?= $sub['id'] ?>" class="text-decoration-none"><?= $sub['name'] ?></a></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <!-- Product Grid -->
            <div class="col-md-9">
                <div class="row">
                    <?php while ($product = $product_result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="<?= $product['image_url'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['product_name'] ?></h5>
                                    <p class="card-text">Rs. <?= $product['product_price'] ?></p>
                                    <a href="add_to_cart.php?pid=<?= $product['product_id'] ?>" class="btn btn-success">Add to Cart</a>
                                    <a href="add_to_wishlist.php?pid=<?= $product['product_id'] ?>" class="btn btn-outline-secondary">♡ Wishlist</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Smart Krishi. All rights reserved.</p>
        <p><a href="contact.php">Contact Us</a> | <a href="about.php">About Us</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
