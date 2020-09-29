<?php
include "config.php";

$username = $_GET['username'];
$password = $_GET['password'];
if ($username) {

    $sql = "SELECT * FROM `users` WHERE `username`='$username'";
    $result = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $password_db = $row['password'];
        $salt_row = $row['salt'];
        $crypt_pass = md5(md5($salt_row) . md5($password));

        if ($password_db == $crypt_pass) {
            $q = "UPDATE `users` SET `subscription`='' WHERE `username`='$username'";
            mysqli_query($con, $q);
            $q2 = "UPDATE `users` SET `csgoversion`='' WHERE `username`='$username'";
            mysqli_query($con, $q2);
        }
        else {
            echo 'no';
        }
    }
    else {
        echo 'no';
    }
}
else {
    echo 'error';
}

?>
