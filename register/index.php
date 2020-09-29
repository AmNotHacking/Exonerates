<?php

die('closed');
?>

<html>
<head>

    <title>Exonerate - Register</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="32x32" href="../logotransparent.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div id="particles-js"></div>

<script src="../login/particles.js"></script>
<script src="../login/js/app.js"></script>

<style>
    .back-txt a{
        text-decoration: none;
        cursor: default;
        transition: all .3s;
        -wenkit-transition: all .3s;
        -moz-transition: all .3s;
        -o-transition: all .3s;
        -ms-transition: all .3s;
    }
    .back-txt a:hover {
        cursor: pointer;
        color: white;
        margin-left: 7px;
        transition: all .3s;
        -wenkit-transition: all .3s;
        -moz-transition: all .3s;
        -o-transition: all .3s;
        -ms-transition: all .3s;
    }
    .g-recaptcha {
        display: inline-block;
    }
</style>
<div class="center">
<div class="center-content">
<center>

<div id="content">

<div id="content">
    <div class="box" style="text-align: center;">
        <form>
            <h1>Register</h1>
            <br>
            <input type="text" name="username"  id="username" placeholder="Username" required>
            <input  type="password" name="password" id="password" placeholder="Password" required>
            <div class="g-recaptcha" data-theme="dark" data-sitekey="6Lfdb-oUAAAAAGgJaKlh94dfrMOEavrMd6Bh-GQG"></div>
            <br>
            <br>

            <button class="" type="button" name="register" id="register">Register</button>
            <br><br>
            <div class="back-txt">
                <p><a href="https://panel.exonerate.cc/login">login</a></p>
            </div>
            <script>
                $(document).ready(function(){
                    $("#register").click(function(){
                        var username = $("#username").val();
                        username.replace(/[^\w\s]/g,'');
                        var password = $("#password").val();
                        var captcha = grecaptcha.getResponse();
                        var data = 'username=' + username + '&password=' +password + "&g-recaptcha-response=" + grecaptcha.getResponse();
                        if( username != "" && password != "" && captcha != "") {
                            $.ajax({
                                url:'authenticate.php',
                                type:'post',
                                data: data,
                                success:function(response) {

                                    if (response === '5') {
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Captcha failed',
                                            showConfirmButton: true,
                                        })
                                    }
                                    if (response === '4') {
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'You cannot have any special characters in your password',
                                            showConfirmButton: true,
                                        })
                                    }
                                    if (response === '3') {
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Username already taken',
                                            showConfirmButton: true,
                                        })
                                    }
                                    if (response === '2') {
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'You cannot register twice',
                                            showConfirmButton: true,
                                        })
                                    }
                                    if (response === '1') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Registered, you may login now',
                                            showConfirmButton: true,
                                        })
                                    }

                                }

                            });
                        }
                    });
                });
           </script>
        </form>
    </div>
            </center>
            </div>
            </div>

        <!-- register -->

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</div>
</body>
</html>