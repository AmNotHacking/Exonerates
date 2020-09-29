<?php
include 'config.php';

$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$discord = $_POST['discordid'];
$username = $_SESSION['user'];
if ($discord != "") {
    $date = date("F j, Y, g:i:s");
    $check_query = "SELECT * FROM `users` WHERE `discord`='$discord'";
    $check_result = mysqli_query($con, $check_query);
    $check_cnt = mysqli_num_rows($check_result);
    $insert = "UPDATE `users` SET `discord`='$discord' WHERE `username`='$username'";

    if ($check_cnt != 0) {
        echo 'used';

    } else {
        mysqli_query($con, $insert);
        echo 'done';

    }
}
?>