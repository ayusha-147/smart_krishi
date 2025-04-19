<?php include("navbar.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>About Us - Smart Krishi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CDN (include once in your layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="styles.css?v=1">
    <style>
        .about-hero {
            background-image: url('uploads/drone.jpg'); /* Replace with your actual image */
            background-size: cover;
            background-position: center;
            height: 300px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        }
        .about-section {
            padding: 40px 0;
        }
        .about-img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .about-text h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .about-text p {
            font-size: 16px;
            line-height: 1.8;
        }
    </style>
</head>
<body>

<div class="about-hero">
    <h1>About Smart Krishi</h1>
</div>

<div class="container about-section">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="uploads/sunset_vege.jpg" alt="Farm" class="about-img">
        </div>
        <div class="col-md-6 about-text">
            <h2>Empowering Agriculture through Technology</h2>
            <p>
                Smart Krishi is a digital platform created to support farmers, gardeners, and agricultural enthusiasts by providing quality seeds, herbs, and fresh vegetables directly at their fingertips.
                <br><br>
                Our mission is to bridge the gap between traditional farming and modern solutions, helping communities grow healthier and more sustainably.
            </p>
        </div>
    </div>
</div>
<footer>
        <p>&copy; 2025 Smart Krishi | All rights reserved</p>
        <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
</footer>

</body>
</html>
