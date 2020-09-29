<?php

include "../config.php";
function secure_string($string, $connection) {
    $string = mysqli_real_escape_string($connection, $string);
    $string = strip_tags($string);
    return $string;
}

$siteKey = '6LenGtUUAAAAAHTjtyzsUk0VhF_VApWCo5oHTbgy';
$secretKey = '6LenGtUUAAAAAA1yKGpCfRHdzIix3ntKpaNVGRm3';
$username = $_POST['username'];
$username = secure_string($username, $con);
$password = $_POST['password'];
$password = secure_string($password, $con);
if ($username != "" && $password != "") {
    $password = stripslashes($password);
    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $backlist_sql = "SELECT * FROM `blacklist` WHERE `username=`'$username' OR `ip`='$ip'";
    $blacklist_result = mysqli_query($con, $backlist_sql);

    $black_nim = mysqli_num_rows($blacklist_result);
    $query = "SELECT * FROM  `users` WHERE `username`='$username'";
    $result = mysqli_query($con, $query);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($black_nim <= 0) {
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
                $_SESSION['invited'] = $row['invited'];
                $_SESSION['csgoversion'] = $row['csgoversion'];
                $_SESSION['expires'] = time() + 3600;
                $_SESSION['timeout'] = time();
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $username;
                $_SESSION['uid'] = $row['id'];
                $_SESSION['discord'] = $row['discord'];
                if ($_SESSION['discord'] == "" || $_SESSION['discord'] == null) {
                    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time
                    $_SESSION['auth'] = "true";
                    // $auth_query = "UPDATE `users` SET `auth`='true' WHERE `username`='$username'";
                    // $randomNum=substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 11);
                    // $insert_code = "UPDATE `users` SET `code`='$randomNum' WHERE `username`='$username'";
                    // mysqli_query($con, $auth_query);
                    // mysqli_query($con, $insert_code);

                    $find_sql = "SELECT * FROM `info` WHERE `id`='1'";
                    $find_result = mysqli_query($con, $find_sql);
                    $find_array = mysqli_fetch_assoc($find_result);

                    $start_login_count = intval($find_array['logins']);
                    $start_login_count = $start_login_count + 1;
                    $start_login_count = strval($start_login_count);
                    $update_sql = "UPDATE `info` SET logins='$start_login_count'";
                    mysqli_query($con, $update_sql);
                    echo 'discord';
                    //echo $check_row['username'];
                } else {
                    $_SESSION['auth'] = "false";
                    $find_sql = "SELECT * FROM `info` WHERE `id`='1'";
                    $find_result = mysqli_query($con, $find_sql);
                    $find_array = mysqli_fetch_assoc($find_result);

                    $start_login_count = intval($find_array['logins']);
                    $start_login_count = $start_login_count + 1;
                    $start_login_count = strval($start_login_count);
                    $update_sql = "UPDATE `info` SET logins='$start_login_count'";
                    mysqli_query($con, $update_sql);
                    $auth_query = "UPDATE `users` SET `auth`='true' WHERE `username`='$username'";
                    $randomNum = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 11);
                    $insert_code = "UPDATE `users` SET `code`='$randomNum' WHERE `username`='$username'";
                    mysqli_query($con, $auth_query);
                    mysqli_query($con, $insert_code);
                    echo 'discord';
                }
            } else {
                echo 'pass';
            }
        } else {
            echo 'failed';
        }
    } else {
        echo 'denied';
    }
}


?>