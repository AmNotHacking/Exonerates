<?php
session_start();
include "config.php";
const allowed = ['Colin', 'Sly', 'Toxic', 'fraudster'];



if (!in_array($_SESSION['user'], allowed)) {
    die('you are not allowed here');
}
const types = ['png', 'jpg'];
$username = $_POST['username'];
$img = $_FILES["image"];
$array = explode('.', $img['name']);
$extension = end($array);
$location = "../../pictures/";
if (in_array($extension, types)) {
    $name = $_SESSION['user'] . $img["name"] ;
    $username = $_SESSION['user'];
    move_uploaded_file($img["tmp_name"], $location . $name);
    $q = "UPDATE users SET picture='$name' WHERE `username`='$username'";
    $result = mysqli_query($con, $q);
    if ($result) {
        echo $name;
    }
    else {
        echo 'error';
    }
}
else {
    echo 'wrong file type';
}





?>

