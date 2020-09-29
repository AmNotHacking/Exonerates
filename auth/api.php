<?php
include "config.php";



$command = $_GET['command'];
$username = $_GET['username'];
$password = $_GET['password'];
$hwid = $_GET['hwid'];
$login_status = "";
$hwid_check = "";
$premium_check = "test";
if ($command == 'login') {
    $sql = "SELECT * FROM `users` WHERE `username`='$username'";
    $result = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $password_db = $row['password'];
        $salt_row = $row['salt'];
        $crypt_pass = md5(md5($salt_row) . md5($password));

        if ($password_db == $crypt_pass) {
            if ($row['hwid'] == '' || $row['hwid'] == null) {
                $update_hwid = "UPDATE `users` SET `hwid`='$hwid' WHERE `username`='$username'";
                mysqli_query($con, $update_hwid);
                $premium_check = $row['csgoversion'];
                $login_status = 'true';
                $hwid_check = 'true';
            }
            else {
                if ($row['hwid'] == $hwid) {
                    $premium_check = $row['csgoversion'];
                    $login_status = 'true';
                    $hwid_check = 'true';
                } else {
                    $login_status = 'true';
                    $hwid_check = 'false';
                }
            }
        } else {
            $login_status = 'password failed';
            $hwid_check = 'empty';
            $premium_check = 'empty';
        }
    } else {
        $login_status = 'username wrong';
        $hwid_check = 'empty';
        $premium_check = 'empty';
    }

    $json_data = array('Login' => $login_status, 'ID' => $hwid_check, 'Premium' => $premium_check);
    echo json_encode($json_data, JSON_PRETTY_PRINT);
}

if ($command == 'sub') {
    $sql = "SELECT * FROM `users` WHERE `username`='$username'";


    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['subscription'] == "lifetime") {
        echo "896743";
    } else {
        $now = new DateTime(date("Y-m-d"));
        $db_date = new DateTime($row['subscription']);
        $interval = $db_date->diff($now);
        echo $interval->days;
    }
}
if ($command == 'test') {
    $now = new DateTime();
    echo $now->format('Y-m-d H:i:s');
}
?>

