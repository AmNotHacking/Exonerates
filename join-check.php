<?php
include "config.php";
function secure_string($string, $connection) {
    $string = mysqli_real_escape_string($connection, $string);
    $string = strip_tags($string);
    return $string;
}

$invite = $_GET['invite'];
$invite = secure_string($invite, $con);

$username = $_GET['username'];
$username = secure_string($username, $con);

$sql = "SELECT * FROM `csgoinvites` WHERE `invite`='$invite' LIMIT 1";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
    $sql = "UPDATE `users` SET invited='true', invitecode='$invite' WHERE `username`='$username'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $sql = "DELETE FROM `csgoinvites` WHERE `invite`='$invite'";
        mysqli_query($con, $sql);
        echo 'join';
    }
}
else {
    echo 'invite 1';
}

?>