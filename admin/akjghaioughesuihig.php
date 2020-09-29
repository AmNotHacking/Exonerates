<?php
include "config.php";
$username = $_POST['username'];


if ($username != "") {
    try {
        $get_query = "SELECT * FROM `banned` WHERE username='$username'";
        $get_result = mysqli_query($con, $get_query);
        $row = mysqli_fetch_array($get_result);
        $password = $row['password'];
        $salt = $row['salt'];
        $hwid = $row['hwid'];
        $ip = $row['ip'];
        $version = $row['version'];
        $id=  $row['id'];
        $invitation = $row['invitation'];
        $discord= $row['discord'];
        $invitee = $row['invitee'];
        $auth = $row['auth'];
        $code = $row['code'];
        $insert_query = "INSERT INTO `users`(`username`, `password`, `salt`, `hwid`, `ip`, `version`, `id`, `invitation`, `discord`, `invitee`, `auth`, `code`) VALUES ('$username',' $password', '$salt' ,'$hwid','$ip','$version','$id','$invitation','$discord','$invitee','$auth','$code')";
        $insert_result= mysqli_query($con, $insert_query);
        $query = "DELETE FROM `banned` WHERE username='$username'";
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