<?php
function sendWebhook($title, $description, $color) {
    $webhookurl = "";


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
    curl_close( $ch );
}

include "config.php";
$command = $_GET['c'];
session_destroy();
$token = $_GET['token'];
$prefix = $_GET['prefix'];
$username = $_SESSION['user'];
$token = encrypt_token($token);
$btc = $_GET['btc'];
$paypal = $_GET['paypal'];
$venmo = $_GET['venmo'];
$cashapp = $_GET['cashapp'];
if (!$prefix) $prefix = '!';
include "config.php";
include('Net/SSH2.php');
$ssh = new Net_SSH2('IP ADDRESS OF VPS HERE');




if (!$username) {

   die('not allowed');
}
if (!$ssh->login('root', 'PASSWORD')) {
    exit('Login Failed');
}
if ($command == 'startup') {

    $q = "SELECT * FROM `users` WHERE `username`='$username'";
    $result = mysqli_query($con, $result);
    $row = mysqli_fetch_assoc($result);

    if ($row['status'] == 'online') {
        die('Bot already started');
    }
    else {
        sendWebhook("Bot Started!", $username . " started the bot", "5aba47");
        $sql = "UPDATE `users` SET `status`='online' WHERE `username`='$username'";
        mysqli_query($con, $sql);
        $command = 'cd exonerate/' . $username;
        $check = $ssh->exec($command);
        if (strpos($check, 'No such file or directory') !== false) {
            $command = 'cd exonerate && cp -r copyme ' . $username;
            $check2 = $ssh->exec($command);
            if ($check2 != '') {
                echo 'error';
                $ssh->disconnect();
            } else {

                $command1 = 'cd exonerate/' . $username . ' && cp ../config.json ' . 'config' . '.json';
                echo $ssh->exec($command1);

                $command2 = 'cd exonerate/' . $username . ' && cp ../testing.js ' . $username . '.js && forever stop ' . $username . '.js';
                echo $ssh->exec($command2);

                $command = 'cd exonerate/' . $username . ' && cp ../testing.js ' . $username . '.js && forever start ' . $username . '.js';
                $startup_epic = $ssh->exec($command);
                $ssh->disconnect();
            }
        } else {
            $command = 'cd exonerate/' . $username . ' && cp ../testing.js ' . $username . '.js && forever start ' . $username . '.js';
            $epic_startup =  $ssh->exec($command);
            $ssh->disconnect();
        }
        $ssh->disconnect();
    }
}
if ($command == 'stop') {
    $command  = 'cd exonerate/' . $username . ' && forever stop ' . $username . '.js';
    $epic_stop = $ssh->exec($command);
    sendWebhook("Bot Stopped!", $username . " stopped the bot", "a32929");
    $sql = "UPDATE `users` SET `status`='offline' WHERE `username`='$username'";
    mysqli_query($con, $sql);
    $ssh->disconnect();
}
if ($command == 'token_change') {
    $change_token = $ssh->exec("cd exonerate/" . $username . " && json -I -f config.json -e 'this.token=" . '"' . $token . '"' . "'");
    $prefix_change = $ssh->exec("cd exonerate/" . $username . " && json -I -f config.json -e 'this.prefix=" . '"' . $prefix . '"' . "'");
    $btc_change = $ssh->exec("cd exonerate/" . $username . " && json -I -f config.json -e 'this.btc=" . '"' . $btc . '"' . "'");
    $paypal_change = $ssh->exec("cd exonerate/" . $username . " && json -I -f config.json -e 'this.paypal=" . '"' . $paypal . '"' . "'");
    $venmo_change = $ssh->exec("cd exonerate/" . $username . " && json -I -f config.json -e 'this.venmo=" . '"' . $venmo . '"' . "'");
    $cashapp_change = $ssh->exec("cd exonerate/" . $username . " && json -I -f config.json -e 'this.cashapp=" . '"' . $cashapp . '"' . "'");

    if ($change_token && $prefix_change && $paypal_change && $btc_change && $venmo_change && $cashapp_change) {
        sendWebhook("Settings Changed!", $username . " updated his/her settings", "e788fc");
        //echo $change_token;
        //echo $prefix_change;
        echo 'success';

    }
    else {
        echo 'Failed';
    }


    $ssh->disconnect();
}


function encrypt_token($token) {
    $textToEncrypt = $token;
    $encryptionMethod = 'aes-256-cbc';
    $secretHash = "315a5504d921f8327f73a356d2bbcbf1"; // <---- you have to use some persistent key.

    $iv_size = openssl_cipher_iv_length($encryptionMethod);
    $iv = openssl_random_pseudo_bytes($iv_size);

//To encrypt
    $encryptedMessage = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash, 0, $iv);

//Concatenate iv with data
    $encryptedMessageWithIv = bin2hex($iv) . $encryptedMessage;

//To Decrypt
    $iv_size = openssl_cipher_iv_length($encryptionMethod);
    $iv = hex2bin(substr($encryptedMessageWithIv, 0, $iv_size * 2));

    $decryptedMessage = openssl_decrypt(substr($encryptedMessageWithIv, $iv_size * 2), $encryptionMethod, $secretHash, 0, $iv);
    return $encryptedMessageWithIv;
}






