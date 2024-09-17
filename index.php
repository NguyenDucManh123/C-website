<?php
include("database.php");

$announcement_query = "SELECT content FROM announcements WHERE id = 1";
$announcement_result = mysqli_query($con, $announcement_query);
$current_announcement = "";
if ($announcement_result && mysqli_num_rows($announcement_result) > 0) {
    $announcement_data = mysqli_fetch_assoc($announcement_result);
    $current_announcement = $announcement_data['content'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to C++ Learners</title>
    <link rel="stylesheet" href="dashboardstyless.css">
</head>
<body>
    <header class="dashboard-header">
        <div class="logo-header">
            <div class="logo">My Logo</div>
        </div>
        <div class="nav-header">
            <nav class="dashboard-nav">
                <ul>
                    <li><a href="index.php"><span class="icon">🏠</span> Home</a></li>
                    <li><a href="lesson1.html"><span class="icon">📘</span> Lesson</a></li>
                    <li><a href="conline.html"><span class="icon">💻</span> Code Online</a></li>
                    <li><a href="about.html"><span class="icon">ℹ️</span> About Us</a></li>
                </ul>
            </nav>
            <div class="header-buttons">
                <a href="login.php" class="sign-in-button">Sign In</a>
            </div>            
        </div>
    </header>


<section class="announcement-board">
    <div class="announcement-content">
        <h2>Announcement</h2>
        <p><?php echo htmlspecialchars($current_announcement); ?></p>
    </div>
</section>


<div class="welcome-board">
    <h2>Welcome to Our Website!</h2>
    <p>
        We are thrilled to have you here. Explore our site to learn more about what we do, dive into our lessons, and discover a world of possibilities.
    </p>
    <a href="lesson1.html" class="cta-button">Start Learning</a>
</div>

        <section class="dashboard-content board">
            <div class="content-box">
                <h2>What is C++</h2>
                <p>C++ is a cross-platform language that can be used to create high-performance applications.</p>
                <p>C++ was developed by Bjarne Stroustrup, as an extension to the C language.</p>
                <p>C++ gives programmers a high level of control over system resources and memory.</p>
                <p>The language was updated 4 major times in 2011, 2014, 2017, and 2020 to C++11, C++14, C++17, and C++20.</p>
            </div>
            <div class="blackboard">
                <img src="images/bigstock-School-Children-Learning-Codin-344363629-1024x645.jpg" alt="C++ Visual">
            </div>
        </section>

        <section class="dashboard-content board">
            <div class="content-box">
                <h2>Why use C++</h2>
                <p>C++ is one of the world's most popular programming languages.</p>
                <p>C++ can be found in today's operating systems, Graphical User Interfaces, and embedded systems.</p>
                <p>C++ is an object-oriented programming language, which gives a clear structure to programs and allows code to be reused, lowering development costs.</p>
                <p>C++ is portable and can be used to develop applications that can be adapted to multiple platforms.</p>
            </div>
            <div class="blackboard">
                <img src="images/Computer Science -Sep-28-2022-03-37-10-41-PM.webp" alt="C++ Platform">
            </div>
        </section>

        <section class="getting-started-board board">
            <h1>Get Started</h1>
            <h3>This tutorial will teach you the basics of C++.</h3>
            <h3>When you are finished with this tutorial, you will be able to write C++ programs and create real-life examples.</h3>
            <h3>It is not necessary to have any prior programming experience.</h3>
        </section>
        
        <div class="lesson-button">
            <a href="lesson1.html">Go to Lesson</a>
        </div>
    </main>

    <script src="dashboard.js"></script>
</body>
</html>