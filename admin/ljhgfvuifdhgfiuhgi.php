<?php

include "config.php";

$username = $_POST['username'];

if ($username != "") {

    try {
        $query = "UPDATE users SET `hwid`='', `ip`='' WHERE `username`='$username'";
        $result = mysqli_query($con, $query);
        echo '1';
    }
    catch (Exception $e) {
        echo  '2';
    }
}

?>