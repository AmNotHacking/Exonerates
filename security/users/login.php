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
 	$username = strip_tags($_REQUEST['username']);
	$password = strip_tags($_REQUEST['password']);

	$username = stripslashes($username);
	$password = stripslashes($password);

	$username = mysqli_real_escape_string($con, $username);
	$password = mysqli_real_escape_string($con, $password);

  $hwid = $_REQUEST['hwid'];
  $pass = $_REQUEST['pass'];
  $query = "SELECT * FROM `users` WHERE username = '$username' LIMIT 1";
  $epic = mysqli_query($con, $query);
  $num = mysqli_num_rows($epic);
  $row = mysqli_fetch_array($epic);
  $db_password = $row['password'];
  $salt_row = $row['salt'];
  $password = md5(md5($salt_row) . md5($password));

  if ($password == $db_password) {
      $check_blacklist = "SELECT * FROM `blacklist` WHERE `username`='$username' OR `ip`='$ip' OR `hwid`='$hwid'";
      $black_query = mysqli_query($con, $check_blacklist);
      $blacklist_count = mysqli_num_rows($black_query);
      if ($blacklist_count == 0) {
          $db_hwid = $row['hwid'];
          $db_ip = $row['ip'];
          if ($db_hwid == null || $db_ip == null) {
              echo "login";
              $insert = "UPDATE `users` SET `hwid`= '$hwid' WHERE `username` = '$username'";
              mysqli_query($con, $insert);
              $insert_ip = "UPDATE `users` SET `ip`='$ip' WHERE `username` = '$username'";
              mysqli_query($con, $insert_ip);
          } else {
              if ($db_hwid == $hwid && $db_ip == $ip) {
                  echo "login";
              }
              else {
                  echo "hwid";
              }
          }
      }
      else {
          echo "blacklisted";
      }
  }
  else {
      echo "fail";
  }




?>
