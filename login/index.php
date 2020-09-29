<?php
$siteKey = '6LenGtUUAAAAAHTjtyzsUk0VhF_VApWCo5oHTbgy';
$secretKey = '6LenGtUUAAAAAA1yKGpCfRHdzIix3ntKpaNVGRm3';
?>


<html>
<head>

    <title>Exonerate - Login</title>
    <link rel="icon" type="image/png" sizes="128x128" href="../logotransparent.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
</head>
<style>
    .register-btn a {
        text-decoration: none;
        color: white;
        cursor: default;
        transition: all .3s;
        -wenkit-transition: all .3s;
        -moz-transition: all .3s;
        -o-transition: all .3s;
        -ms-transition: all .3s;
    }
    .register-btn a:hover {
        cursor: pointer;
        color: #ff86db;
        margin-left: 7px;
        transition: all .3s;
        -wenkit-transition: all .3s;
        -moz-transition: all .3s;
        -o-transition: all .3s;
        -ms-transition: all .3s;
    }
</style>
<body>
<div id="particles-js"></div>

<script src="particles.js"></script>
<script src="js/app.js"></script>

<div class="center">
<div class="center-content">

<center>

<div id="content">
<div class="box">

<img style="width: 150px; height: 150px; opacity: 50%;" src="../logotransparent.png">
<br>

    <form>
        <h1>Login</h1>
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input style="margin-top: 5px"; type="password" name="password" id="password" placeholder="Password" required>
        <br>
        <button class="status-btn" type="button" name="login" id="login-cool">Login</button>
        <br><br>
        <div class="register-btn">
        <div class="form-group"><a href="https://panel.exonerate.cc/register">Register</a></div>
        </div>
        <script>
            $(document).ready(function(){
                $("#login-cool").click(function(){
                    var username = $("#username").val();
                    var password = $("#password").val();
                    var recaptcha = $("#g-recaptcha").val();
                    var data = 'username=' + username + '&password=' +password + '&recaptcha=' + recaptcha;
                    if( username != "" && password != "" ){
                        $.ajax({
                            url:'checkUser.php',
                            type:'post',
                            data: data,
                            success:function(response){
                                $("#gamer").html(response);
                                if (response == 'login')
                                {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Logged in',
                                        text: 'redirecting to authentication',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    }).then(function () {
                                        window.location.href = "auth/";
                                    });
                                }
                                else if (response == 'failed') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Username or password is incorrect',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    })
                                }
                                else if (response == 'denied') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Access denied',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    })
                                }
                                else if (response == 'pass') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Password incorrect',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    })
                                }
                                else if (response == 'discord') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Logged in',
                                        text: 'authentication disabled, going to panel',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    }).then(function () {
                                        window.location.href = "../";
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>

    </form>
</div>
</div>
</center>
</div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>