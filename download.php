
<?php
session_start();
if (!$_SESSION['user'] || $_SESSION['auth'] == "false")
{
    header("Location: https://dissident.world/panel/login");
}
else {

    $size = filesize("lwkvgwyg/loader.rar");
    header("Content-Type: application/x-rar-compressed");
    header("Content-Disposition: attachment; filename='$final_filename'");
    header("Content-Length: $size");
    header("Cache-control: private");


    header("Location: loader.rar");
    exit;
}
?>