<?php
// Start the session
session_start();
include("database.php");

// Check if the user is logged in
if (!isset($_SESSION['valid'])) {
    // Display an error message if not logged in
    header("Location : login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="conline.css">
</head>
<body>
<header class="dashboard-header">
        <div class="logo-header">
            <div class="logo">My Logo</div>
        </div>
        <div class="nav-header">
            <nav class="dashboard-nav">
                <ul>
                    <li><a href="home.php"><span class="icon">🏠</span> Home</a></li>
                    <li><a href="lesson1.php"><span class="icon">📘</span> Lesson</a></li>
                    <li><a href="conline.php"><span class="icon">💻</span> Code Online</a></li>
                    <li><a href="about.php"><span class="icon">ℹ️</span> About Us</a></li>
                </ul>
            </nav>
            <div class="header-buttons">
                <img src="images/451-4517876_default-profile-hd-png-download.png" alt="Button" class="dropdown-btn">
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </header>
    <div data-pym-src="https://www.jdoodle.com/embed/v0/2IhG?stdin=1&arg=0"></div>
    <script src="https://www.jdoodle.com/assets/jdoodle-pym.min.js" type="text/javascript"></script>
</body>
</html>
