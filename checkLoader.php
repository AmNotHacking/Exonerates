<?php
session_start();
$status = file_get_contents('status.txt');

if ($status == 'offline') {
    echo 'offline';
}
else {

    echo 'success';

}
?>