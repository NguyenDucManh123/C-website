<?php
session_start();
include("database.php");

if (!isset($_SESSION['valid'])) {
    header("Location : login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu Về Tôi</title>
    <link rel="stylesheet" href="about1.css">
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

    <div class="container">
        <div class="side-buttons">
            <a href="#" class="side-button" id="intro-button">Giới thiệu về bản thân</a>
        </div>

        <div class="intro-education-wrapper" id="intro-education-wrapper">
            <div class="intro-education-image">
                <img src="images.jpg" alt="" id="profile-image">
            </div>
            <section id="intro-education">
                <div class="intro-education-content">
                    <h2>Self Introduction</h2>
                    <p><strong>Name :</strong> Nguyen Duc Manh</p>
                    <p><strong>Gender :</strong> Male</p>
                    <p><strong>Date Of Birth :</strong> 2004-03-25</p>
                    <p><strong>Hobby :</strong> Listen to music </p>
                    
                    <h2>Education</h2>
                    <p><strong>School :</strong> Nguyen Tat Thanh</p>
                    <p><strong>Class :</strong> 22BITV05</p>
                    <p><strong>Subject:</strong> Create and develop Website</p>
                </div>
            </section>
        </div>
    </div>

    <footer>
        <div class="footer-title">
            <legend>Contact info</legend>
        </div>
        <div class="footer-content">
            <div class="footer-section">
                <p>Email: 2200010420@nttu.edu.vn</p>
            </div>
            <div class="footer-section">
                <p>Number: 0389709051</p>
            </div>
            <div class="footer-section social-media">
                <a href="https://facebook.com" target="_blank" class="social-icon">
                    <img src="images/fb.png" alt="Facebook">
                </a>
                <a href="https://twitter.com" target="_blank" class="social-icon">
                    <img src="images/f1x5vdqx0aa9sgt-16901896163331463104829.webp" alt="Twitter">
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
