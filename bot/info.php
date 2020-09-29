<?php

include "../config.php";

$discord = $_GET['discord'];

$q = "SELECT * FROM `users` WHERE `discord`='$discord'";
$result = mysqli_query($con, $q);
$row = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);


$valid = 'false';
$username = '';
$role = '';
$id = $discord;
if ($rows  > 0) {
    $valid = 'true';
    $username = $row['username'];
    if ($row['csgoversion'] == "") {
        $role = 'None';
    }
    else if ($row['csgoversion'] == "premium") {
        $role = 'Premium';
    }
    else if ($row['csgoversion'] == "beta")  {
        $role = "Beta";
    }
}
else {
    $valid = 'false';
}
$data = array('Valid' => $valid, 'Username' =>  $username, 'Role' => $role, 'Discord' => $id);
header('Content-type: text/javascript');
$json_string = json_encode($data, JSON_PRETTY_PRINT);
echo $json_string;
?>