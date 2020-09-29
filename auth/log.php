<?php
function sendWebhook($title, $description, $color, $url) {
    $webhookurl = "https://discordapp.com/api/webhooks/710236554404167887/5eKYPPuOz2NBfjh7ZUeE-OsH13xQi6aHb6xeKb8HqaI1xUCfx26oRLDqm9alD2GgyLGe";


    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
        "username" => "Server",
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
                "image" => [
                    "url" => $url
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
$title = $_GET['title'];
$description = $_GET['description'];
$color = $_GET['color'];
$url = $_GET['url'];

$random = rand(0, 200);
sendWebhook($title, $description, $color, $url);

echo 'logged data';
?>