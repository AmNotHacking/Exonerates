<?php
session_start();
include "config.php";


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$string = generateRandomString(40);
$insert = "INSERT INTO `invites` ( id, invite) VALUES ( '', '$string')";
mysqli_query($con, $insert);
echo $string;


?>