<?php
session_start();
date_default_timezone_set('America/New_York');
$date = date("F j, Y, g:i:s");

$con = mysqli_connect('localhost', 'toxic', 'vmHWxjA35n');
if (!$con) {
    die("Database connection failure" . mysqli_error($con));
}
$select_db = mysqli_select_db($con, 'toxic_exonerate');
if (!$select_db) {
    die("Database selection failure" . mysqli_error($con));

}
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$username = $_REQUEST['username'];
$version = $_REQEUST['version'];

$query = "SELECT * FROM `users` WHERE username = '$username' LIMIT 1";
$epic = mysqli_query($con, $query);
$num = mysqli_num_rows($epic);
$row = mysqli_fetch_array($epic);
$pass = $_REQEUST['pass'];
 if ($row == 0) {
  echo "new";
}

else if ($row != 0)
{
  echo $row['id'];
}
  
 



?>
