<?php
session_start();
include("database.php");

if (!isset($_SESSION['valid'])) {
    echo "error"; 
    exit;
}

$user_id = $_SESSION['id']; 
$lesson_id = isset($_POST['lesson_id']) ? intval($_POST['lesson_id']) : 0; 

if ($lesson_id > 0) {
    $check_query = $con->prepare("SELECT * FROM user_progress WHERE user_id = ? AND lesson_id = ?");
    $check_query->bind_param("ii", $user_id, $lesson_id);
    $check_query->execute();
    $check_result = $check_query->get_result();

    if ($check_result->num_rows === 0) {
        $insert_query = $con->prepare("INSERT INTO user_progress (user_id, lesson_id, completed) VALUES (?, ?, 1)");
        $insert_query->bind_param("ii", $user_id, $lesson_id);
        if ($insert_query->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "success"; 
    }
} else {
    echo "error"; 
}
?>
