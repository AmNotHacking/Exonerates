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
$pass = $_REQUEST['pass'];
$username = $_REQUEST['username'];
$version = $_REQUEST['version'];
$query = "UPDATE `users` SET `version`='$version' WHERE `username`='$username'";
if ($pass == "C8x3uhXNfO5aZHL3r1eiSxGGoZKehCEsotH7WMqqbVQK05PDRPmwc4g3VOIY98ENoaZ2sJ6rNNLgxXTWbV1l3njjZ2opjJgmiYJFXcEZOScmaSgffnc71kFU2dyZXSoP") {	
	mysqli_query($con, $query);
}
else {
	echo "wrong pass";
}

  
 



?>
