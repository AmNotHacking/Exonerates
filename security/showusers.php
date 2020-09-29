<?php
session_start();
date_default_timezone_set('America/New_York');
$date = date("F j, Y, g:i:s");
$con = mysqli_connect('localhost', 'dissedent', 'zLevsk9DG2');
if (!$con) {
  die("Database connection failure" . mysqli_error($con));
}
$select_db = mysqli_select_db($con, 'dissedent_server');
if (!$select_db) {
    die("Database selection failure" . mysqli_error($con));

}
$pass = $_REQUEST['pass'];
$query = "SELECT * FROM `users`";
$epic = mysqli_query($con, $query);
if ($pass == "C8x3uhXNfO5aZHL3r1eiSxGGoZKehCEsotH7WMqqbVQK05PDRPmwc4g3VOIY98ENoaZ2sJ6rNNLgxXTWbV1l3njjZ2opjJgmiYJFXcEZOScmaSgffnc71kFU2dyZXSoP") {
	while ($row = mysqli_fetch_array($epic)) {
		echo $row['id'] .  "  " . "/" . $row['username'] .  "  " . "/" . $row['password'] .  "  " . "/" . $row['ip'] .  "  " . "/" . $row['version'];
		echo "<br />";
	}

}
else {
	echo "wrong pass";
}

  
 



?>
