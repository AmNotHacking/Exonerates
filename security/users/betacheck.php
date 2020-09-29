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
	$username = stripslashes($username);
	$username = mysqli_real_escape_string($con, $username);
	$pass = $_REQUEST['pass'];
  $query = "SELECT * FROM `users` WHERE username = '$username' LIMIT 1";
  $epic = mysqli_query($con, $query);
  $num = mysqli_num_rows($epic);
  $row = mysqli_fetch_array($epic);
  $version = $row['version'];
  //if ($pass == "tYnmUsK3pmcgx478FZynEAeENfaJG9uwtSVr2sMJL2SLMeMQ5LQggjPdARPebVdNTAmDT49Q3EzH2NzECH6MQZ79uUV8brU7CDAzQJm5HtJFhFR8qM8cZB5Whj54KM9d") {
  if ($version == 'beta')
  {
  	echo "beta";
  }
  if ($version == 'alpha')
  {
      echo "alpha";
  }
  else if ($version != 'alpha' && $version != 'beta')
  {
  	echo "regular";
  } 
//}
//else {
	//echo "wrong pass";
//}
 ?>
