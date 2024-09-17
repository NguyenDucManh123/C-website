<?php
session_start();
include("database.php");

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

$completedQuery = "
    SELECT l.lesson_id, l.lesson_name, l.lesson_description 
    FROM lessons l
    JOIN user_progress up ON l.lesson_id = up.lesson_id
    WHERE up.user_id = ? AND up.completed = 1
";
$stmt = $con->prepare($completedQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$completedResult = $stmt->get_result();

$completedLessons = [];
while ($row = $completedResult->fetch_assoc()) {
    $completedLessons[] = $row;
}

$uncompletedQuery = "
    SELECT l.lesson_id, l.lesson_name, l.lesson_description
    FROM lessons l
    LEFT JOIN user_progress up ON l.lesson_id = up.lesson_id AND up.user_id = ?
    WHERE up.lesson_id IS NULL
";
$stmt = $con->prepare($uncompletedQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$uncompletedResult = $stmt->get_result();

$uncompletedLessons = [];
while ($row = $uncompletedResult->fetch_assoc()) {
    $uncompletedLessons[] = $row; 
}
?>

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
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homestyles.css">
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

    <main class="dashboard-content">

        <section class="announcement-board">
            <div class="announcement-content">
                <h2>Announcement</h2>
                <p><?php echo htmlspecialchars($current_announcement); ?></p>
            </div>
        </section>

        <div class="welcome-board">
            <h1>Welcome to your Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        </div>

        <section class="lessons-not-completed">
            <h2>Unfinished Lessons</h2>
            <p>Complete these lessons to continue progressing!</p>
            <ul>
                <?php
                if (!empty($uncompletedLessons)) {
                    foreach ($uncompletedLessons as $lesson) {
                        echo "<li><a href='lesson{$lesson['lesson_id']}.php'>{$lesson['lesson_name']}</a></li>";
                    }
                } else {
                    echo "<li>All lessons are completed!</li>";
                }
                ?>
            </ul>
        </section>

        <section class="finished-lessons">
            <h2>Finished Lessons</h2>
            <p>You've completed the following lessons:</p>
            <ul>
                <?php
                if (!empty($completedLessons)) {
                    foreach ($completedLessons as $lesson) {
                        echo "<li><a href='lesson{$lesson['lesson_id']}.php'>{$lesson['lesson_name']}</a></li>";
                    }
                } else {
                    echo "<li>No finished lessons yet.</li>";
                }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>
