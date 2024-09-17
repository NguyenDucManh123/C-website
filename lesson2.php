<?php
session_start();
$lesson_id = 2; 

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
            <h1>1) C++ Get Started</h1>
            <p>To start using C++, you need two things:</p>
            <ul>
                <li>A text editor, like Notepad, to write C++ code</li>
                <li>A compiler, like GCC, to translate the C++ code into a language that the computer will understand</li>
            </ul>
            <p>There are many text editors and compilers to choose from. In this tutorial, we will use an IDE (see below).</p>
            <h1>2) C++ Install IDE</h1>
            <p>An IDE (Integrated Development Environment) is used to edit AND compile the code.</p>
            <p>Popular IDEs include Code::Blocks, Eclipse, and Visual Studio.</p>
            <h1>3) C++ Quickstart</h1>
            <p>Let's create our first C++ file.</p>
            <p>Open Codeblocks and go to <strong>File > New > Empty File.</strong></p>
            <img class="img" src="images/img1.png" alt="">
            <p>Don't worry if you don't understand the code above - we will discuss it in later chapters.</p>
            <p>In Codeblocks, it should look like this:</p>
            <img class="img" src="images/img2.png" alt="">
            <p>Then, go to <strong>Build > Build and Run</strong> to run the program.</p>
            <img class="img" src="images/img3.png" alt="">
            <p><strong>Congratulations!</strong> You have now written and executed your first C++ program.</p>
            
            <div class="exercise">
                <h1>Exercise:</h1>
                <form id="quiz-form">
                    <p>What do you need to start writing and running C++ code?</p>
                    <label>
                        <input type="radio" name="answer" value="1">
                        Only a text editor
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="2">
                        Only a compiler
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="3">
                        Both a text editor and a compiler
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="4">
                        A web browser
                    </label><br>
                    <button style="background-color:chartreuse; margin:5px; width:100px; height:40px" type="button" onclick="checkAnswer()">Submit</button>
                </form>
            </div>

            <div id="completion-message" style="display:none; color:green;">
                <h3>Congratulations! You have completed this lesson!</h3>
            </div>

            <div class="button-container">
                <button class="button" onclick="location.href='lesson1.php'">Previous</button>
                <button class="button" onclick="location.href='lesson3.php'">Next</button>
            </div>
        </main>
    </div>

    <script>
        function checkAnswer() {
            const correctAnswer = 3; 
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
