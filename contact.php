<?php
// contact.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
        .contact-container {
            max-width: 700px;
            margin: 30px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .contact-container h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: bold;
            color: #2e4d1c;
        }

        .contact-container .form-group {
            margin-bottom: 15px;
        }

        .contact-container .form-control {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }

        .contact-container button {
            width: 100%;
            padding: 10px;
            background-color: #2e40e1;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .contact-container button:hover {
            background-color: #2220bc;
        }

        footer {
            margin-top: auto;
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
    <?php include("navbar.php"); ?>

    <div class="contact-container">
        <h3>Contact Us</h3>
        <form action="process_contact.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input name="name" type="text" required class="form-control" placeholder="Your name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" required class="form-control" placeholder="Your email">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" rows="4" required class="form-control" placeholder="Your message"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Send Message</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Smart Krishi | All rights reserved</p>
        <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
    </footer>
</body>
</html>
