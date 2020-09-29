<?php
session_start();
include "config.php";

$username = $_POST['user'];
$sql = "SELECT * FROM `users` WHERE `username`='$username'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
if ($row['invitation'] != null) {
    $_SESSION['invite'] = true;
    $_SESSION['invite_code'] = $row['invitation'];
    echo $row['invitation'];
}
else {
    $_SESSION['invite'] = false;

}
?>