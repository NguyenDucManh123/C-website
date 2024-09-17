<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerstyles.css">
    <title>Register</title>
</head>
<body>
    <div class="login-form">
        <div class="container">
            <div class="main">
                <div class="content">
                    <?php 
                    include("database.php");

                    if (isset($_POST['submit'])) {
                        $username = mysqli_real_escape_string($con, $_POST['username']);
                        $email = mysqli_real_escape_string($con, $_POST['email']);
                        $password = mysqli_real_escape_string($con, $_POST['password']);

                        $verify_query = $con->prepare("SELECT Email FROM account_info WHERE Email = ?");
                        $verify_query->bind_param("s", $email);
                        $verify_query->execute();
                        $verify_result = $verify_query->get_result();

                        if ($verify_result->num_rows != 0) {
                            echo "<div class='message'>
                                    <p>This email is already in use. Try another one!</p>
                                  </div> <br>";
                            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                        } else {
                            $stmt = $con->prepare("INSERT INTO account_info (Username, Email, Password, total_time_spent) VALUES (?, ?, ?, 0)");
                            $stmt->bind_param("sss", $username, $email, $password);
                            
                            if ($stmt->execute()) {
                                echo "<div class='message'>
                                        <p>Registration successful!</p>
                                      </div> <br>";
                                echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
                            } else {
                                echo "<div class='message'>
                                        <p>There was an error with the registration. Please try again.</p>
                                      </div> <br>";
                                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                            }
                        }
                    } else {
                    ?>

                    <header>Sign Up</header>
                    <form action="" method="post">
                        <div class="field input">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" autocomplete="off" required>
                        </div>

                        <div class="field input">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" autocomplete="off" required>
                        </div>

                        <div class="field input">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" autocomplete="off" required>
                        </div>

                        <div class="field">
                            <input type="submit" class="btn purple-btn" name="submit" value="Register">
                        </div>

                        <div class="links">
                            Already a member? <a href="login.php">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>
