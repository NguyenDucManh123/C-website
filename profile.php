<?php
session_start();
include("database.php");

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['valid'];

if (!$con) {
    die("Database connection failed");
}

$query = "SELECT username, email, password FROM account_info WHERE email = '$email'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
} else {
    echo "Error retrieving user data.";
    exit();
}

$update_message = "";

if (isset($_POST['update'])) {
    $new_username = mysqli_real_escape_string($con, $_POST['username']);
    $new_email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['password']);

    $update_query = "UPDATE account_info SET username='$new_username', email='$new_email', password='$new_password' WHERE email='$email'";
    if (mysqli_query($con, $update_query)) {
        $_SESSION['valid'] = $new_email;
        $update_message = "Your data has been changed.";
    } else {
        $update_message = "Error updating data.";
    }
}

if (isset($_SESSION['start_time'])) {
    $start_time = $_SESSION['start_time'];
    $current_time = time();
    $time_spent = $current_time - $start_time;
    $hours = floor($time_spent / 3600);
    $minutes = floor(($time_spent % 3600) / 60);
    $seconds = $time_spent % 60;
    $time_display = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
} else {
    $time_display = "00:00:00";
}

if (!isset($_SESSION['today_start_time'])) {
    $_SESSION['today_start_time'] = strtotime("today");
}

$today_time_spent = $current_time - $_SESSION['today_start_time'];
$today_hours = floor($today_time_spent / 3600);
$today_minutes = floor(($today_time_spent % 3600) / 60);
$today_seconds = $today_time_spent % 60;
$today_time_display = sprintf("%02d:%02d:%02d", $today_hours, $today_minutes, $today_seconds);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
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
                    <li><a href="lesson.php"><span class="icon">📘</span> Lesson</a></li>
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

    <main class="profile-content">
        <h1>Profile Information</h1>
        
        <?php if (!empty($update_message)) { ?>
            <div class="update-message"><?php echo htmlspecialchars($update_message); ?></div>
        <?php } ?>

        <form action="" method="post">
            <div class="profile-info">
                <p><strong>Username:</strong> 
                    <input type="text" name="username" value="<?php echo htmlspecialchars($user); ?>" required>
                </p>
                <p><strong>Email:</strong> 
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </p>
                <p><strong>Password:</strong> 
                    <div class="input-group">
                        <input type="password" id="passwordField" class="password-field" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                        <button class="toggle-password-btn" type="button" onclick="togglePassword()">Show</button>
                    </div>
                </p>

                <input type="hidden" name="today_time_spent" value="<?php echo htmlspecialchars($today_time_display); ?>">

                <input type="submit" name="update" class="submit-btn" value="Update">
            </div>
        </form>

        <div class="time-spent">
            <p>Total Time Spent on Website: <?php echo $time_display; ?></p>
        </div>
    </main>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("passwordField");
            var toggleButton = document.querySelector(".toggle-password-btn");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleButton.textContent = "Show";
            }
        }
    </script>
</body>
</html>
