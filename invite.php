<?php
session_start();

$con = mysqli_connect('localhost', 'toxic', 'vmHWxjA35n');
if (!$con) {
    die("Database connection failure" . mysqli_error($con));
}
$select_db = mysqli_select_db($con, 'toxic_exonerate');
if (!$select_db) {
    die("Database selection failure" . mysqli_error($con));

}
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$username = $_REQUEST['user'];
$invite = $_REQUEST['invite'];
$pass = "1989Jeepjeeps1";
$req_pass = $_REQUEST['pass'];
if ($req_pass != $pass)
{
    echo "pass wrong";
}
else {
    $add_user_invite = "UPDATE `users` SET `invitation`='true' WHERE `username`='$username'";
    $add_invite = "INSERT INTO `invites` (invite, username) VALUES ('$invite$', '')";

    mysqli_query($con, $add_user_invite);
    mysqli_query($con, $add_invite);

    echo "added";



}

?>
