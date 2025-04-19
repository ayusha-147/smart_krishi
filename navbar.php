<!-- navbar.php -->
<!-- Add Font Awesome CDN in your layout if not already included -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> -->

<nav class="navbar navbar-expand-lg custom-navbar navbar-light">
    <a class="navbar-brand text-white font-weight-bold" href="index.php">
        <i class="fas fa-leaf"></i> Smart Krishi
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span><i class="fas fa-bars text-white"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link text-white" href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="shop.php"><i class="fas fa-store"></i> Shop</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="checkout.php"><i class="fas fa-credit-card"></i> Checkout</a></li>
        </ul>

        <ul class="navbar-nav">
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="fas fa-user-circle"></i> <?= $_SESSION['user']['name'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="register.php"><i class="fas fa-user-plus"></i> Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
