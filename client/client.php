<?php
session_start();
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$original_filename = 'client.exe';
$new_filename = generateRandomString(25) . '.exe';

// headers to send your file
header("Content-Type: application/exe");
header("Content-Length: " . filesize($original_filename));
header('Content-Disposition: attachment; filename="' . $new_filename . '"');

// upload the file to the user and quit
readfile($original_filename);
exit;

?>