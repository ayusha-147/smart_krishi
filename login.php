<?php
session_start();
$conn = new mysqli("localhost", "root", "", "smart_krishi");

// Initialize $error to avoid undefined variable warning
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $role = $_POST["role"]; // Get role from dropdown

    if ($role === "admin") {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($pass, $user['password'])) {
            if ($role === "admin") {
                $_SESSION['admin'] = $user;
                header("Location: admin_dashboard.php");
            } else {
                $_SESSION['user'] = $user;
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Krishi</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- For eye icon -->
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="content-wrapper">
        <div class="register-container">
            <h3>Login</h3>
            
            <!-- Display error message if there's an error -->
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Enter your password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="show-hide-password" style="cursor: pointer;">
                                <i class="fas fa-eye" id="eye-icon"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Login as:</label>
                    <select name="role" class="form-control" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <p>&copy; 2025 Smart Krishi | All rights reserved</p>
        <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
        
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Password toggle script -->
    <script>
        const eyeIcon = document.getElementById('eye-icon');
        const passwordInput = document.getElementById('password');
        const showHidePassword = document.getElementById('show-hide-password');

        showHidePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
