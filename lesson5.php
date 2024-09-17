<?php
session_start();
$lesson_id = 5; 

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
    <title>Lesson 2 - C++ Get Started</title>
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
            <h1>1) C++ Comments</h1>
            <p>Comments can be used to explain C++ code, and to make it more readable. It can also be used to prevent execution when testing alternative code. Comments can be singled-lined or multi-lined.</p>
            <h1>2) Single-line Comments</h1>
            <p>Single-line comments start with two forward slashes (<span style="color:red">//</span>).</p>
            <p>Any text between <span style="color:red">//</span> and the end of the line is ignored by the compiler (will not be executed).</p>
            <p>This example uses a single-line comment before a line of code:</p>
            <img class="img" src="image/img7.png" alt="">
            <p>This example uses a single-line comment at the end of a line of code:</p>
            <img class="img" src="image/img8.png" alt="">
            <h1>3) C++ Multi-line Comments</h1>
            <p>Multi-line comments start with <span style="color:red">/*</span> and ends with <span style="color:red">*/</span>.</p>
            <p>Any text between <span style="color:red">/*</span> and <span style="color:red">*/</span> will be ignored by the compiler:</p>
            <img class="img" src="image/img9.png" alt="">
            <div class="text-box">
                <p>Single or multi-line comments?</p>
                <p>It is up to you which you want to use. Normally, we use <span style="color:red">//</span> for short comments, and <span style="color:red">/* */</span> for longer.</p>
            </div>

            <div class="exercise">
                <h1>Exercise:</h1>
                <form id="quiz-form">
                    <p>What is the purpose of comments in C++?</p>
                <label>
                    <input type="radio" name="answer" value="1">
                    To explain the code to other developers
                </label><br>
                <label>
                    <input type="radio" name="answer" value="2">
                    To execute additional lines of code
                </label><br>
                <label>
                    <input type="radio" name="answer" value="3">
                    To define variables
                </label><br>
                <label>
                    <input type="radio" name="answer" value="4">
                    To display output on the screen
                </label><br>
                    <button style="background-color:chartreuse; margin:5px; width:100px; height:40px" type="button" onclick="checkAnswer()">Submit</button>
                </form>            
            </div>

            <div id="completion-message" style="display:none; color:green;">
                <h3>Congratulations! You have completed this lesson!</h3>
            </div>


            <div class="button-container">
                <button class="button" onclick="location.href='lesson4.php'">Previous</button>
                <button class="button" onclick="location.href='lesson6.php'">Next</button>
            </div>
        </main>
    </div>

    <script>
        function checkAnswer() {
            const correctAnswer = 1; 
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
    </script>
</body>
</html>
