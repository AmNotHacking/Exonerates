<?php
$command = $_GET['c'];

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
include "../config.php";
if ($command == 'generate') {
    $invite = generateRandomString(40);
    $sql = "INSERT INTO `csgoinvites` (id, invite) VALUES ('', '$invite')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo $invite;
    } else {
        echo 'error';
    }
}

if ($command == 'grab') {
    $amount = intval($_GET['amount']);
    $sql = "SELECT * FROM `csgoinvites` LIMIT $amount";
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['invite'];
            echo "~";
        }
    }
    else {
        echo 'error';
    }
}