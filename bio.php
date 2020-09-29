<?php
session_start();
include "config.php";

$username = $_GET['username'];
$text = $_GET['text'];

$q = "UPDATE users SET bio='$text' WHERE `username`='$username'";
$result = mysqli_query($con, $q);

if ($result) {
    echo $text;
}
else {
    echo 'error';
}




?>

