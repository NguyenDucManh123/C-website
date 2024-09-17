<?php
session_start();
include("database.php"); 

if (isset($_SESSION['valid'])) {
    if (isset($_SESSION['login_time'])) {
        $time_spent = time() - $_SESSION['login_time'];

        $email = $_SESSION['valid'];

        $query = "SELECT total_time_spent FROM account_info WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $total_time_spent = $row['total_time_spent'];

            $new_total_time_spent = $total_time_spent + $time_spent;

            $update_query = "UPDATE account_info SET total_time_spent = '$new_total_time_spent' WHERE email = '$email'";
            mysqli_query($con, $update_query);
        }
    }

    session_destroy();
    header("Location: index.php");
    exit();
}
