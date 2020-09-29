<?php
include "config.php";
$username = $_POST['username'];
$reason = $_POST['reason'];

if ($username != "" && $reason != "") {
    try {
        $get_query = "SELECT * FROM `users` WHERE username='$username'";
        $get_result = mysqli_query($con, $get_query);
        $row = mysqli_fetch_array($get_result);
        $password = $row['password'];
        $salt = $row['salt'];
        $hwid = $row['hwid'];
        $ip = $row['ip'];
        $version = $row['version'];
        $invitation = $row['invitation'];
        $discord= $row['discord'];
        $invitee = $row['invitee'];
        $auth = $row['auth'];
        $code = $row['code'];
        $insert_query = "INSERT INTO `banned`(username, password, salt, ip, version, id, reason) VALUES ('$username',' $password', '$salt' ,'$ip','$version','', '$reason')";
        $insert_result= mysqli_query($con, $insert_query);
        $query = "DELETE FROM `users` WHERE username='$username'";
        $result = mysqli_query($con, $query);
        echo '1';
    }
    catch (Exception $e) {
        echo '2';
    }
}
else {
    header('Location: http://exonerate.cc');
}

?>