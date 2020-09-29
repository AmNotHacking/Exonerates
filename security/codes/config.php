<?php
session_set_cookie_params(0);

session_start();
error_reporting(0);
ini_set('display_errors', 0);
$host = "localhost";
$user = "admin_exonerate";
$password = "EZn7aHZwK3";
$db = "admin_exonerate";

$con = mysqli_connect($host, $user, $password, $db);

if (!$con) {
    die("connection failed: " . mysqli_connect_error());
}

?>