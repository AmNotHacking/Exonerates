<?php
$cheat = $_GET['cheat'];
date_default_timezone_set('America/New_York');
include('Net/SSH2.php');

    $server = "157.245.212.195";
    $username = "root";
    $password = "1989Jeepjeeps1";
    if ($cheat == 'alpha') {
        $command = 'date -r ../home/client/alpha.txt  +"%A,%B %e %I:%M%P"';
    } else if ($cheat == 'regular') {
        $command = 'date -r ../home/client/data.txt  +"%A,%B %e %I:%M%P"';
    }

    $ssh = new Net_SSH2($server);
    if (!$ssh->login($username, $password)) {
        exit('connection error');
    }

    $update_time =  $ssh->exec($command);
    echo $update_time;
?>