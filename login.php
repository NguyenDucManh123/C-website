<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login For Html Css</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="login-form">
        <h1>Login Page</h1>
        <div class="container">
            <div class="main">
                <div class="content">
                    <?php 
                        include("database.php");

                        if (isset($_POST['submit'])) {
                            $email = mysqli_real_escape_string($con, $_POST['email']);
                            $password = mysqli_real_escape_string($con, $_POST['password']);

                            echo "Entered Email: $email <br>";
                            echo "Entered Password: $password <br>";

                            $stmt = $con->prepare("SELECT * FROM account_info WHERE email = ?");
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();

                                echo "Stored Email: " . $row['email'] . "<br>";
                                echo "Stored Password: " . $row['password'] . "<br>";

                                if ($password === $row['password']) {
                                    $_SESSION['valid'] = $row['email'];
                                    $_SESSION['username'] = $row['username'];
                                    $_SESSION['id'] = $row['id'];
                                    $_SESSION['roles'] = $row['roles'];

                                    $_SESSION['login_time'] = time();

                                    if ($row['roles'] == 'admin') {  
                                        header('Location: admin.php');
                                        exit();
                                    } else {
                                        header('Location: home.php');
                                        exit();
                                    }
                                } else {
                                    echo "<div class='message'>
                                            <p>Wrong Email or Password</p>
                                          </div><br>";
                                    echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
                                }
                            } else {
                                echo "<div class='message'>
                                        <p>Wrong Email or Password</p>
                                      </div><br>";
                                echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
                            }
                        } else {
                    ?>

                    <h2>Login</h2>
                    <form action="" method="post">
                        <input type="text" name="email" placeholder="Email" required autofocus="">
                        <input type="password" name="password" placeholder="Password" required autofocus="">
                        <button class="btn" type="submit" name="submit">Login</button>
                    </form>
                    <p class="account">Don't Have An Account? 
                        <a href="register.php">Register</a>
                    </p>
                    <?php } ?>
                </div>
                <div class="form-img">
                    <img src="images/reset-password.jpg" alt="Form Image">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
