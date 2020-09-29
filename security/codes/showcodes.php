<?php
session_start();
include "config.php";
const allowed = ['Colin', 'Sly', 'fraudster'];
if (!in_array($_SESSION['user'], allowed)) {
    die('you are not allowed here');
}
$sql = "SELECT * FROM `invites`";
$result = mysqli_query($con, $sql);
while ($array = mysqli_fetch_assoc($result)) {
    echo "<br>";
    echo $array['invite'];
}
?>