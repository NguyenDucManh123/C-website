<?php
session_start();
$lesson_id = 1; 

if (!isset($_SESSION['valid'])) {
    header("Location: login.php"); 
    exit;
}

include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson 1</title>
    <link rel="stylesheet" href="lessonstyless.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
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
    <aside>
        <ul>
            <li><a href="lesson1.php">C++ Intro</a></li>
            <li><a href="lesson2.php">C++ Get Started</a></li>
            <li><a href="lesson3.php">C++ Syntax</a></li>
            <li><a href="lesson4.php">C++ Output</a></li>
            <li><a href="lesson5.php">C++ Comments</a></li>
            <li><a href="lesson6.php">C++ Variables</a></li>
        </ul>
    </aside>

    <main>
        <h1>1) What is C++?</h1>
        <p>C++ is a cross-platform language that can be used to create high-performance applications.</p>
        <p>C++ was developed by Bjarne Stroustrup, as an extension to the C language.</p>
        <p>C++ gives programmers a high level of control over system resources and memory.</p>
        <p>The language was updated 4 major times in 2011, 2014, 2017, and 2020 to C++11, C++14, C++17, and C++20.</p>

        <h1>2) Why Use C++?</h1>
        <p>C++ is one of the world's most popular programming languages.</p>
        <p>C++ can be found in today's operating systems, Graphical User Interfaces, and embedded systems.</p>
        <p>C++ is portable and can be used to develop applications that can be adapted to multiple platforms.</p>
        <p>C++ is fun and easy to learn!</p>
        <p>C++ is close to C, C#, and Java, which makes it easy for programmers to switch to C++ or vice versa.</p>

        <h1>3) Difference between C and C++</h1>
        <p>C++ was developed as an extension of C, and both languages have almost the same syntax.</p>
        <p>The main difference between C and C++ is that C++ supports classes and objects, while C does not.</p>

        <div class="exercise">
            <h1>Exercise:</h1>
            <form id="quiz-form">
                <p>What is C++?</p>
                <label>
                    <input type="radio" name="answer" value="1">
                    C++ is a scripting language used for web development.
                </label><br>
                <label>
                    <input type="radio" name="answer" value="2">
                    C++ was developed by Bjarne Stroustrup, as an extension to the C language.
                </label><br>
                <label>
                    <input type="radio" name="answer" value="3">
                    C++ is a database management system.
                </label><br>
                <label>
                    <input type="radio" name="answer" value="4">
                    C++ is a type of operating system.
                </label><br>
                <button style="background-color:chartreuse; margin:5px; width:100px; height:40px" type="button" onclick="checkAnswer()">Submit</button>
            </form>            
        </div>

        <div id="completion-message" style="display:none; color:green;">
            <h3>Congratulations! You have completed this lesson!</h3>
        </div>

        <div class="button-container">
            <button class="button" onclick="location.href='index.html'">Home</button>
            <button class="button" onclick="location.href='lesson2.php'">Next</button>
        </div>
    </main>
</div>

<script>
    function checkAnswer() {
        const correctAnswer = 2; 
        const answers = document.getElementsByName('answer');
        let selectedAnswer;
        
        for (const answer of answers) {
            if (answer.checked) {
                selectedAnswer = parseInt(answer.value);
                break;
            }
        }

        if (selectedAnswer === correctAnswer) {
            $.ajax({
                url: "update_progress.php",
                method: "POST",
                data: { lesson_id: <?= $lesson_id; ?> }, 
                success: function(response) {
                    if (response === "success") {
                        document.getElementById("completion-message").style.display = "block";
                    }
                }
            });
        } else {
            alert("Wrong answer. Please try again!");
        }
    }

    function highlightActiveLink() {
        const links = document.querySelectorAll('aside a');
        const currentURL = window.location.href;

        links.forEach(link => {
            if (currentURL.includes(link.getAttribute('href'))) {
                link.classList.add('active');
            }
        });
    }
    highlightActiveLink();
</script>

</body>
</html>
