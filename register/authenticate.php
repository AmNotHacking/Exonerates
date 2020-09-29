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
include "../config.php";
function secure_string($string, $connection) {
    $string = mysqli_real_escape_string($connection, $string);
    $string = strip_tags($string);
    return $string;
}
die('closed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$salt = uniqid(mt_rand(), true);
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$username = $_POST['username'];
$username = secure_string($username, $con);
$password = $_POST['password'];
$password = secure_string($password, $con);
$captcha = "";
if (isset($_POST["g-recaptcha-response"]))
    $captcha = $_POST["g-recaptcha-response"];

if (!$captcha) {
    sendWebHook('Register failed', $username . " failed to make an account, captcha failed", 'a32929');
    die('5');
}
// handling the captcha and checking if it's ok
$secret = "6Lfdb-oUAAAAAO6bHcMzvShZLdLLqHEDttRjyhL-";
$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha."&remoteip=".$_SERVER["REMOTE_ADDR"]), true);
if ($response['success'] != false) {
    if ($username != "" && $password != "") {
        $date = date("F j, Y, g:i:s");
        $query = "SELECT * FROM `users` WHERE username = '$username' LIMIT 1";
        $epic = mysqli_query($con, $query);
        $num = mysqli_num_rows($epic);
        $row = mysqli_fetch_array($epic);
        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            $salt_key = $salt;
            $password = md5(md5($salt_key) . md5($password));
            if ($num == 0) {
                $registered = "SELECT * FROM `registered` WHERE username='$username' OR ip='$ip'";
                $query = mysqli_query($con, $registered);
                $register_count = mysqli_num_rows($query);
                if ($register_count == 0) {
                    $add_register = "INSERT INTO `registered`(username, ip, registration) VALUES ('$username', '$ip', '$date')";
                    $insert = "INSERT INTO `users`(username, password, salt, hwid, ip, version, discord, auth, code, status) VALUES ('$username','$password', '$salt_key', '','$ip', 'regular', '', 'false', '', 'offline')";
                    mysqli_query($con, $insert);
                    mysqli_query($con, $add_register);
                    sendWebHook('User Registered', $username . " made an account!", '5aba47');
                    die('1');
                } else {
                    sendWebHook('Register failed', $username . " failed to make an account, already registered", 'a32929');
                    die('2');
                }
            } else {
                sendWebHook('Register failed', $username . " failed to make an account, username taken", 'a32929');
                die('3');
            }
        } else {
            sendWebHook('Register failed', $username . " failed to make an account, password contains special characaters", 'a32929');
            die('4');
        }

    }
}
else {
    sendWebHook('Register failed', $username . " failed to make an account, captcha failed", 'a32929');
    die('5');
}
?>

