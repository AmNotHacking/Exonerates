<?php

include "config.php";
$username = $_GET['username'];

$query = "SELECT * FROM `users` WHERE `username`='$username'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
echo $row['status'];

?>