<?php
error_reporting(0);
ini_set('display_errors', 0);
ini_set('session.gc_maxlifetime', 0);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(0);
session_start();

if (isset($_POST['auth']))
{
    session_start();
    $con = mysqli_connect('localhost', 'toxic', 'vmHWxjA35n');
    if (!$con) {
        die("Database connection failure" . mysqli_error($con));
    }
    $select_db = mysqli_select_db($con, 'toxic_exonerate');
    if (!$select_db) {
        die("Database selection failure" . mysqli_error($con));

    }


    $username = $_SESSION['user'];
    $auth_code =$_POST['code'];


    $query = "SELECT * FROM  `users` WHERE `username`='$username'";
    $result = mysqli_query($con, $query);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($row['code'] == $auth_code)
    {
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time
        $_SESSION['auth'] = "true";
       // $auth_query = "UPDATE `users` SET `auth`='true' WHERE `username`='$username'";
       // $randomNum=substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 11);
       // $insert_code = "UPDATE `users` SET `code`='$randomNum' WHERE `username`='$username'";
       // mysqli_query($con, $auth_query);
       // mysqli_query($con, $insert_code);
        header('location: ../../');

    }
    else{
        $_SESSION['auth'] = "false";
        $result = '<div class="alert alert-danger alert-dismissible fade show">authentication failed <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    }

}

?>


<html>
<head>
    <meta charset="utf-8">
    <title>exonerate - 2 Factor Authentication</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #15161B">
<div id="particles-js"></div>
<style>
  #content {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 1020px;
}
#content .box {
    background: #202029;
    box-shadow: 0 10px 4px 0 rgba(0, 0, 0, 0.61);
    -webkit-box-shadow: 0 1px 4px 0 #0a0f1b9c;
    border-radius: 6px;
    display: inline-block;
    flex-direction: column;
    box-sizing: border-box;
    min-width: 600px;
    width: 1000px;
    min-height: 300px;
    max-height: 600px;
    font-family: 'Roboto', sans-serif;
    z-index: 9999;
    text-align: center;
}
input {
    font-family: inherit;
    font-size: 100%;
    vertical-align: baseline;
    border: 0;
    outline: 0;
    color: white;
}
input::-moz-focus-inner {
    border: 0;
    padding: 0;

}
[placeholder]::-webkit-input-placeholder { color: rgba(255,255,255,.8); }
[placeholder]:hover::-webkit-input-placeholder { color: rgba(255,255,255,.4); }
[placeholder]:focus::-webkit-input-placeholder { color: transparent; }

[placeholder]::-moz-placeholder { color: rgba(255,255,255,.8); }
[placeholder]:hover::-moz-placeholder { color: rgba(255,255,255,.4); }
[placeholder]:focus::-moz-placeholder { color: transparent; }

[placeholder]:-ms-input-placeholder { color: rgba(255,255,255,.8); }
[placeholder]:hover:-ms-input-placeholder { color: rgba(255,255,255,.4); }
[placeholder]:focus:-ms-input-placeholder { color: transparent; }
button:hover {
    background: rgba(16, 16, 16, 0.25);
}
button {
    border: 1px solid rgba(0,0,0,.5);
    background: rgba(0,0,0,.25);
    margin: 0 0 20px;
    padding: 8px 0 10px 0;
    text-align: center;
    color: #cccccc;
    width: 400px;
}
input[type="text"] {
    width: 400px;
    margin: 0 0 20px;
    padding: 8px 12px 10px 12px;
    border: 1px solid rgba(0,0,0,.5);
    background: rgba(0,0,0,.25);
}
input[type="password"] {
    width: 400px;
    margin: 0 0 20px;
    padding: 8px 12px 10px 12px;
    border: 1px solid rgba(0,0,0,.5);
    background: rgba(0,0,0,.25);
}

textarea {
    display: block;
    width: 400px;
    height: 150px;
    margin: 0 0 20px;
    padding: 8px 12px 10px 12px;
    border: 1px solid rgba(0,0,0,.5);
    background: rgba(0,0,0,.25);
}
#content .box h1{
    text-align: center;
    color: white;
    padding-top: 20px;
    padding-bottom: 10px;
}
#content .box .line {
    background: linear-gradient(270deg, #f3a5f0, #7b56b7);
    -webkit-animation: gradient 2s ease infinite;
    -moz-animation: gradient 2s ease infinite;
    animation: gradient 2s ease infinite;
    width: auto;
    height: 3px;
    border-radius: 5px;
    padding-top: 5px;
}
#content .box a{
    color: #bbbbbb;
    font-size: 12px;
    text-decoration: none;
    padding-top: 10px;
}
</style>
<!-- scripts -->
<script src="../particles.js"></script>
<script src="../js/app.js"></script>
<div id="content">
    <div class="box" style="width: 600px; text-align: center;">
        <form method="post">
        <div class="line"></div>
            <h1>2 Factor Authentication</h1>
            <div class="illustration">
            <input type="text" name="code" placeholder="Authentication Code" required>
            <button class="" type="submit" name= "auth">Authenticate</button>
            <br>
            <p>code sent to discord pm's</p>

            <?php echo $result ?>

        </form>
    </div>
        <!-- register -->

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</div>
</body>
</html>