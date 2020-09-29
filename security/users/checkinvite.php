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


$invite = $_REQUEST['invite'];



$query = "SELECT * FROM `invites` WHERE invite = '$invite' LIMIT 1";
$epic = mysqli_query($con, $query);
$num = mysqli_num_rows($epic);

if ($num != 0)
{
    echo "valid";
}
else {
    echo "invalid";
}
?>
