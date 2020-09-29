


<html>
<head>

    <title>exonerate - Admin Login</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../images/icon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body style="background-color: rgb(13,13,13);">
<div class="login-clean" style="background-color: rgb(13,13,13);">
    <form>

        <h2 class="sr-only">Login Form</h2>
        <input class="form-control" type="text" name="username" id="username" placeholder="username" required>
        <input class="form-control" type="password" name="password" id="password" placeholder="password" required>
        <button class="btn btn-primary btn-block" type="button" name="login" id="login" style="background-color: rgb(105,70,145)">login</button>
        <div class="form-group"><a href="https://panel.exonerate.cc/register">register</a></div>

        <script>
            $(document).ready(function(){
                $("#login").click(function(){
                    var username = $("#username").val();
                    var password = $("#password").val();
                    var data = 'username=' + username + '&password=' +password;
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
                                        text: 'redirecting to panel',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    }).then(function () {
                                        window.location.href = "../";
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
                                else if (response == 'pass') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Password incorrect',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
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
<!-- register -->

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>