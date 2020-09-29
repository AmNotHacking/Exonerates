<?php

include "../config.php";



$username = $_POST['username'];
$password = $_POST['password'];

if ($username != "" && $password != "") {
    $password = stripslashes($password);
    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $query = "SELECT * FROM  `admin` WHERE `username`='$username'";
    $result = mysqli_query($con, $query);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($num_rows != 0) {

        $password_db = $row['password'];
        $salt_row = $row['salt'];
        $crypt_pass = md5(md5($salt_row) . md5($password));

        if ($crypt_pass == $password_db) {
            if ($row['version'] == "regular") {
                $_SESSION['version'] = "regular";
            }
            if ($row['invitation'] != null) {
                $_SESSION['invite'] = true;
            } else {
                $_SESSION['invite'] = false;
            }
            $_SESSION['expires'] = time() + 3600;
            $_SESSION['timeout'] = time();
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $username;
            $_SESSION['adminlog'] = true;
            $_SESSION['discord'] = $row['discord'];
            $_SESSION['auth'] = "false";
            echo 'login';
        } else {
            echo 'pass';
        }
    }
    else {
        echo 'failed';
    }
}






?>