<?php
include "config.php";
session_start();
if (!$_SESSION['user'])
{
    header("Location: https://panel.exonerate.cc/login/");
}
function secure_string($string, $connection) {
    $string = mysqli_real_escape_string($connection, $string);
    $string = strip_tags($string);
    return $string;
}
$invite = $_GET['invite'];
$invite = secure_string($invite, $con);
$username = $_SESSION['user'];
/*
if (!$invite) {
    header("Location: https://exonerate.cc");
}
else {
    $sql = "SELECT * FROM `csgoinvites` WHERE `invite`='$invite' LIMIT 1";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $sql = "UPDATE `users` SET invited='true', invitecode='$invite' WHERE `username`='$username'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $sql = "DELETE FROM `csgoinvites` WHERE `invite`='$invite'";
            mysqli_query($con, $sql);
            header("Location: https://panel.exonerate.cc/login");
        }
    } else {
        header("Location: https://exonerate.cc");
    }
}*/



?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Join Cryptic</title>
</head>

<body>
<a class="back-btn" style="text-decoration: none;" href="https://panel.exonerate.cc/">Back</a>
<?php
echo "<input type='hidden' value='" . $username. "' class='user_id'>";
echo "<input type='hidden' value='" . $invite . "' class='invite_code'>";
?>
<div class="center">
    <div class="center-content">
        <center>

            <div id="content" >
                <div id="home-page">
                    <div class="box">


                        <h1>Welcome to Cryptic</h1>
                        <div class="line"></div>
                        <div class="panel-content">


                           <div class='descriptionbox'>
                            <h1 style='color: #F09AE7;margin-top: 0px;'>Invitation Code:</h1>
                         <h2 class='unselectable' id="invite-text" style='color: white; font-size: 16px; '><?php echo $invite ?></h2>
                            </div>

                            <button class="status-btn" style="width: 300px; margin-top: 20px;" onclick="join()">Join</button>
                        </div>
                        <script>
                            function join() {


                                var invite = $('.invite_code').val();
                               var username = $('.user_id').val();

                               if (!invite) {
                                   Swal.fire({
                                       icon: 'error',
                                       text: 'Invalid invitation code',
                                       showConfirmButton: true,
                                   });
                               }
                               else {
                                   $.ajax({
                                       url: "join-check.php",
                                       type: "GET",
                                       data: "invite=" + invite + "&username=" + username,
                                       contentType: false,
                                       cache: false,
                                       processData: false,
                                       success: function (data) {
                                           if (data.includes("invite")) {
                                               Swal.fire({
                                                   icon: 'error',
                                                   text: 'Invalid invitation code',
                                                   showConfirmButton: true,
                                               });
                                           } else if (data.includes("join")) {
                                               Swal.fire({
                                                   icon: 'success',
                                                   text: 'Joined cryptic, please re login to the panel',
                                                   showConfirmButton: true,
                                               });
                                           }
                                       },
                                       error: function (e) {
                                           alert(e);
                                       }
                                   });
                               }
                            }
                        </script>
                    </div>
                </div>

        </center>
    </div>
</div>
</body>
</html>
