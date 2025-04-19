<?php
session_start();
session_destroy(); // Destroy session to log out
header("Location: admin_login.php"); // Redirect to login page after logout
exit();
