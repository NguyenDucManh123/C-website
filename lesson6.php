<?php
session_start();
$lesson_id = 6; 

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
            <h1>1) C++ Variables:</h1>
            <p>Variables are containers for storing data values.</p>
            <p>In C++, there are different types of variables (defined with different keywords), for example:</p>
            <ul>
                <li><span style="color:red">int -</span> stores integers (whole numbers), without decimals, such as 123 or -123</li>
                <li><span style="color:red">double -</span> stores floating point numbers, with decimals, such as 19.99 or -19.99</li>
                <li><span style="color:red">char -</span> stores single characters, such as 'a' or 'B'. Char values are surrounded by single quotes</li>
                <li><span style="color:red">string -</span> stores text, such as "Hello World". String values are surrounded by double quotes stores text, such as "Hello World". String values are surrounded by double quotes</li>
                <li><span style="color:red">bool -</span> stores values with two states: true or false</li>
            </ul>
            <h1>2) Declaring (Creating) Variables:</h1>
            <p>To create a variable, specify the type and assign it a value:</p>
            <img class="img" src="images/img10.png" alt="">
            <p>Where type is one of C++ types (such as <span style="color:red">int</span>), and variableName is the name of the variable (such as x or myName). The equal sign is used to assign values to the variable.</p>
            <p>To create a variable that should store a number, look at the following example:</p>
            <img class="img" src="images/img11.png" alt="">
            <p>You can also declare a variable without assigning the value, and assign the value later:</p>
            <img class="img" src="images/img12.png" alt="">
            <p>Note that if you assign a new value to an existing variable, it will overwrite the previous value:</p>
            <img class="img" src="images/img13.png" alt="">
            <h1>3) Other Types:</h1>
            <p>A demonstration of other data types:</p>
            <img class="img" src="images/img14.png" alt="">
            <div class="text-box">
                <p>You will learn more about the individual types in the Data Types chapter.</p>
            </div>
            <h1>4) Display Variables:</h1>
            <p>The <span style="color:red">cout</span> object is used together with the <span style="color:red"><<</span> operator to display variables.</p>
            <p>To combine both text and a variable, separate them with the <span style="color:red"><<</span> operator:</p>
            <img class="img" src="images/img15.png" alt="">
            <h1>4) Add Variables Together:</h1>
            <p>To add a variable to another variable, you can use the <span style="color:red">+</span> operator:</p>
            <img calss="img" src="images/img16.png" alt="">
            <div class="exercise">
                <h1>Exercise:</h1>
                <form id="quiz-form">
                    <p>Choose the right answer</p>
                    <pre>
                        #include &lt;iostream&gt;
                        using namespace std;
                        int main() {
                            int a = 2;
                            int b = 3;
                            int sum = a + b;
                            cout << sum;
                            return 0;
                        }
                    </pre>
                    <label>
                        <input type="radio" name="answer" value="1">
                        5
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="2">
                        23
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="3">
                        2
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="4">
                        3
                    </label><br>
                    <button style="background-color:chartreuse; margin:5px; width:100px; height:40px" type="button" onclick="checkAnswer()">Submit</button>
                </form>            
            </div>
            
            <div id="completion-message" style="display:none; color:green;">
                <h3>Congratulations! You have completed this lesson!</h3>
            </div>

            <div class="button-container">
                <button class="button" onclick="location.href='lesson5.php'">Previous</button>
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
