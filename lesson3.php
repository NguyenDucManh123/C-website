<?php
session_start();
$lesson_id = 3;

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
            <h1>1) C++ Syntax</h1>
            <p>Let's break up the following code to understand it better:</p>
            <img class="img" src="images/img4.png" alt="">
            <h1>2) Example explained</h1>
            <p><strong>Line 1:</strong> <span style="color: red">#include &lt;iostream&gt;</span> is a <strong>header file library</strong> that lets us work with input and output objects, such as <span style="color:red">cout</span> (used in line 5). Header files add functionality to C++ programs.</p>
            <p><strong>Line 2:</strong> <span style="color:red">using namespace std</span> means that we can use names for objects and variables from the standard library.</p>
            <div class="text-box">
                <p>Don't worry if you don't understand how <code>#include &lt;iostream&gt;</code> and <code>using namespace std</code> works. Just think of it as something that (almost) always appears in your program.</p>
            </div>
            <p><strong>Line 1: </strong> A blank line. C++ ignores white space. But we use it to make the code more readable.</p>
            <p><strong>Line 4: </strong> Another thing that always appear in a C++ program is <span style="color:red">int main().</span> This is called a function. Any code inside its curly brackets <span style="color:red">{}</span> will be executed.</p>
            <p><strong>Line 5: </strong><span style="color:red">cout</span> (pronounced "see-out") is an object used together with the insertion operator (<span style="color:red"><<</span>) to output/print text. In our example, it will output "Hello World!".</p>
            <p><span>Note: </span> Every C++ statement ends with a semicolon <span style="color:red">;</span>.</p>
            <p><span>Note: </span> The body of <span style="color:red">int main()</span> could also been written as:<span style="color:red">int main () { cout << "Hello World! "; return 0; }</span></p>
            <p><span>Remember: </span> The compiler ignores white spaces. However, multiple lines makes the code more readable.</p>
            <p><span>Line 6: </span> <span style="color:red">return 0;</span> ends the main function.</p>
            <p><span>Line 7: </span> Do not forget to add the closing curly bracket <span style="color:red"> } </span> to actually end the main function.</p>
            <div class="exercise">
                <h1>Exercise:</h1>
                <form id="quiz-form">
                    <p>Choose the right answer</p>
                    <pre>
                        #include &lt;iostream&gt;
                        using namespace std;
                        int main() {
                            cout &lt;&lt; "Hello World!";
                            return 0;
                        }
                    </pre>
                    <label>
                        <input type="radio" name="answer" value="1">
                        Hello World!
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="2">
                        Hello, World!
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="3">
                        HelloWorld!
                    </label><br>
                    <label>
                        <input type="radio" name="answer" value="4">
                        Hello world!
                    </label><br>
                    <button style="background-color:chartreuse; margin:5px; width:100px; height:40px" type="button" onclick="checkAnswer()">Submit</button>
                </form>            
            </div>

            <div id="completion-message" style="display:none; color:green;">
                <h3>Congratulations! You have completed this lesson!</h3>
            </div>

            <div class="button-container">
                <button class="button" onclick="location.href='lession2.php'">Previous</button>
                <button class="button" onclick="location.href='lession4.php'">Next</button>
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
