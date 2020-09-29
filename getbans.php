<?php

include "config.php";
session_start();

$sql = "SELECT id FROM `banned` ORDER BY id DESC LIMIT 1";
$query = mysqli_query($con, $sql);
$array = mysqli_fetch_assoc($query);
echo $array['id'];

?>