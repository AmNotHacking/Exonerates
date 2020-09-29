<?php
function sendWebhook($title, $description, $color) {
    $webhookurl = "https://discordapp.com/api/webhooks/693139111057424415/JUdi9UJacxATWUIHO16hJMwoxqeQCDk-fPfLzYEoye9pfcnG0-vLsNiSJNEI4PBQS-YD";


    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
        "embeds" => [
            [
                // Embed Title
                "title" => $title,

                // Embed Type
                "type" => "rich",

                // Embed Description
                "description" => $description,
                "thumbnail" => [
                    "url" => "https://cdn.discordapp.com/attachments/714535962746814485/714557483611324436/exonerate_logo.png"
                      ],

                // Timestamp of embed must be formatted as ISO8601
                "timestamp" => $timestamp,

                // Embed left border color in HEX
                "color" => hexdec( $color ),

            ]
        ]

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


    $ch = curl_init( $webhookurl );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
    curl_close( $ch );
}
function secure_string($string, $connection) {
    $string = mysqli_real_escape_string($connection, $string);
    $string = strip_tags($string);
    return $string;
}
include "config.php";
session_start();
$username = $_SESSION['user'];
$username = secure_string($username, $con);
$key = $_GET['key'];
$key = secure_string($key, $con);
if (!$username || !$key) {

  die('error');
}
$check_key = "SELECT * FROM `invites` WHERE `invite`='$key'";
$result = mysqli_query($con, $check_key);
$count = mysqli_num_rows($result);
if ($count > 0) {
    $remove_key = "DELETE FROM `invites` WHERE `invite`='$key'";
    mysqli_query($con, $remove_key);
    $add_role = "UPDATE `users` SET `version`='beta' WHERE `username`='$username'";
    mysqli_query($con, $add_role);
    sendWebhook('Activation Success', $username . " activated their account", '5aba47');
    echo 'success';
}
else if ($count <= 0) {
    sendWebhook('Activation Failed', $username . " failed to activated their account", 'a32929');
    echo 'error';
}


?>