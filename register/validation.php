<?php
session_start();

$con = mysqli_connect('localhost', 'dissedent', 'zLevsk9DG2');
if (!$con) {
    die("Database connection failure" . mysqli_error($con));
}
$select_db = mysqli_select_db($con, 'dissedent_server');
if (!$select_db) {
    die("Database selection failure" . mysqli_error($con));

}
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$username = strip_tags($_POST['user']);
$password = strip_tags($_POST['password']);

$username = stripslashes($username);
$password = stripslashes($password);

$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

$password = md5($password);

$hwid = $_REQUEST['hwid'];

$invite = $_POST['invite'];
$date = date("F j, Y, g:i:s");
$query = "SELECT * FROM `users` WHERE username = '$username' LIMIT 1";
$epic = mysqli_query($con, $query);
$num = mysqli_num_rows($epic);
$row = mysqli_fetch_array($epic);
$pass = $_GET['pass'];
if ($num == 0) {
    $registered = "SELECT * FROM `registered` WHERE username='$username' OR ip='$ip'";
    $query = mysqli_query($con, $registered);
    $register_count = mysqli_num_rows($query);
    if ($register_count == 0) {
        $check_invite = "SELECT * FROM `invites` WHERE invite='$invite' LIMIT 1";
        $invite_query = mysqli_query($con, $check_invite);
        $invite_rows = mysqli_num_rows($invite_query);
        if ($invite_rows != 0) {
            $delete_invite = "DELETE FROM `invites` WHERE invite='$invite'";
            $add_register = "INSERT INTO `registered`(username, hwid, ip, registration) VALUES ('$username','$hwid','$ip', '$date')";
            $insert = "INSERT INTO `users`(username, password, hwid, ip, version, discord) VALUES ('$username','$password','$hwid','$ip', 'regular', '')";
            $delete_user_invite = "UPDATE `users` SET `invitation`='' WHERE `invitation`='$invite'";
            mysqli_query($con, $insert);
            mysqli_query($con, $add_register);
            mysqli_query($con, $delete_invite);
            mysqli_query($con, $delete_user_invite);
            header("location: https://dissident.world/panel/login");
        }
        else{
            echo "invitation code is wrong";
        }
    }
    else {
        echo "you have already registered";
    }
}
else {
    echo "username is taken";
}



?>
