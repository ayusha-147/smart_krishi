<?php
session_start();
$conn = new mysqli("localhost", "root", "", "smart_krishi");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password entered by user

    // Query to check if the username exists in the database
    $result = $conn->query("SELECT * FROM admin WHERE username='$username'");

    // If the user exists, check the password
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // Verify the password using password_verify
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $username; // Set session for logged in admin
            header("Location: dashboard.php"); // Redirect to the admin dashboard
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Smart Krishi</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-5">Admin Login</h2>
    
    <!-- Display error message if login fails -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-3">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

</body>
</html>
