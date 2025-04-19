<?php
session_start();
$conn = new mysqli("localhost", "root", "", "smart_krishi");
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $hashed = password_hash($pass, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
        $error = "Email already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed);
        if ($stmt->execute()) {
            $success = "Registered successfully. You can now log in.";
        } else {
            $error = "Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - Smart Krishi</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome CDN (include once in your layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="styles.css">
  <style>
    /* Register Page Specific Styles */
    body {
        background-color: #fffde6; /* Set yellow background for the entire page */
        font-family: Arial, sans-serif;
        height: 100%; /* Make sure body takes full height */
        margin: 0;
    }

    .register-container {
    max-width: 550px; /* Ideal width for desktop */
    width: 90%; /* For responsiveness */
    margin: 50px auto;
    padding: 30px;
    background: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


    .register-container h3 {
        text-align: center;
        color: #28a745;
        margin-bottom: 25px;
    }

    /* Ensures full height page with footer at the bottom */
    .content-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Ensures full height */
        justify-content: space-between; /* Ensures footer sticks at bottom */
    }

    footer {
        padding: 20px;
        background-color: #343a40;
        color: white;
        text-align: center;
    }

    footer a {
        color: #9cba7b;
        text-decoration: none;
    }

    footer a:hover {
        color: white;
    }
  </style>
</head>
<body>
<div class="content-wrapper">
    <?php include("navbar.php"); ?>

    <div class="register-container">
        <h3>Register</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input name="name" type="text" required class="form-control" placeholder="Your name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" required class="form-control" placeholder="Your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" required class="form-control" placeholder="Choose a password">
            </div>
            <button class="btn btn-success btn-block">Register</button>
        </form>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; 2025 Smart Krishi | All rights reserved</p>
    </footer>
</div>
</body>
</html>
