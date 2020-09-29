<?php
include "config.php";
session_start();

$find_sql = "SELECT * FROM `info` WHERE `id`='1'";
$find_result = mysqli_query($con, $find_sql);
$find_array = mysqli_fetch_assoc($find_result);

echo $find_array['logins'];


?>