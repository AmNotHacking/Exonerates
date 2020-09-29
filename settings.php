<?php
include "config.php";
session_start();
error_reporting(0);
ini_set('display_errors', 0);

if (!$_SESSION['user'])
{
    header("Location: https://panel.exonerate.cc/login/");
}
if (isset($_POST['invite_discord']))
{
    header("Location: https://discord.gg/eXj5D9s");

}
if ($_POST['startup']) {

}
$username = $_SESSION['user'];
$sql = "SELECT * FROM `users` WHERE `username`='$username'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
if ($row['version'] == "regular") {
    $_SESSION['version'] = "regular";
} else {
    $_SESSION['version'] = "beta";
}
if ($row['invitation'] != null) {
    $_SESSION['invite'] = true;
}
else {
    $_SESSION['invite'] = false;

}



?>

<html>
<head>

    <title>Exonerate Panel</title>
    <script src="https://shoppy.gg/api/embed.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="icon" type="image/png" sizes="128x128" href="logotransparent.png">
    <link rel="stylesheet" href="dist/sortable-tables.min.css">
    <script src="sort-table.js"></script>
    <script src="assets/js/particles.min.js"></script>
    <script src="assets/js/main.js" type="ea6ea3b2bbdf438d2fdee388-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="ea6ea3b2bbdf438d2fdee388-|49" defer=""></script>

</head>


<body>

<img src="images/form.png" class="form">
<img src="images/form2.png" class="form2">

<div id="particles-js"></div>


<a class="back-btn" href="https://panel.exonerate.cc/">Back</a>
<?php
echo "<input type='hidden' value='" . $_SESSION['user'] . "' class='user_id'>";

?>

<div class="center">
<div class="center-content">
<center>

<div id="content" >
    <div id="home-page">
        <div class="box">
            <h1>Update Settings</h1>
            <div class="line"></div>
            <div class="panel-content" style="text-align: center;">


                <?php
                $username = $_SESSION['user'];
                $q = "SELECT * FROM users WHERE `username`='$username'";
                $result = mysqli_query($con, $q);
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['picture'] == "") {
                        echo '<img style="width: 250px; height: 250px; opacity: 50%; margin-bottom: 50px;"src="pictures/default.png" class="epic-picture">';
                    }
                    else {
                        echo "<img class='epic-picture' style='max-width: 250px; max-height: 250px: opacity: 50%; margin-bottom: 25px;' src='pictures/".$row['picture']."'>";
                    }

                }
                ?>
                <form id="form" action="upload.php" method="post" accept="image/*" name="image" style="text-align: center;">
                    <form class="test" style="text-align: center;">
                        <input id="uploadImage" type="file" accept="image/*" name="image" style="margin-left: auto; margin-right: auto; margin-bottom: auto; text-align: center;" />
                        <input class="btn btn-success" type="submit" value="Change picture" style="cursor: pointer; margin-top: 10px; margin-left: auto; margin-right: auto; margin-bottom: auto; text-align: center;">
                    </form>
                    <div id="err"></div>
                </form>
                <br>
                <br>
                <div class="line"></div>
                <br>
                <?php
                $username = $_SESSION['user'];
                $q = "SELECT * FROM users WHERE `username`='$username'";
                $result = mysqli_query($con, $q);
                while ($row = mysqli_fetch_assoc($result)) {
                    $text = $row['bio'];
                    echo "<textarea id='description-text' rows='4' cols='50' style='width: 450px; height: 75px; color: white;'>" . $text . "</textarea>";
                }
                ?>
                <br>
                <button class="status-btn" style="width: 300px;" onclick="updateBio()">Update Description</button>

                <script>
                    function updateBio() {
                        var val = $("#description-text").val();
                        var username = $('.user_id').val();
                        $.ajax({
                            url: "bio.php",
                            type: "get",
                            data:  "text=" + val + "&username=" + username,
                            contentType: false,
                            cache: false,
                            processData:false,
                            success: function(data)
                            {
                                if (data.includes("error")) {
                                    Swal.fire({
                                        icon: 'error',
                                        text: "Unexpected error occured when updating database",
                                        showConfirmButton: true,
                                    });
                                }
                                else {
                                    var myTextArea = document.getElementById('description-text');
                                    myTextArea.innerHTML = data;
                                    myTextArea.innerText =data;
                                    Swal.fire({
                                        icon: 'success',
                                        text: 'Updated Description',
                                        showConfirmButton: true,
                                    });
                                }
                            },
                            error: function(e)
                            {
                                $("#err").html(e).fadeIn();
                            }
                        });
                    }
                    $(document).ready(function (e) {
                        $("#form").on('submit',(function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: "upload.php",
                                type: "POST",
                                data:  new FormData(this),
                                contentType: false,
                                cache: false,
                                processData:false,
                                success: function(data)
                                {
                                    if (data.includes("type")) {
                                        Swal.fire({
                                            icon: 'error',
                                            text: "Wrong file type",
                                            showConfirmButton: true,
                                        });
                                    }
                                    else if (data.includes("error")) {
                                        Swal.fire({
                                            icon: 'error',
                                            text: "Unexpected error occured uploading file to server",
                                            showConfirmButton: true,
                                        });
                                    }
                                    else {
                                        $(".epic-picture").attr("src", "pictures/" + data);
                                        Swal.fire({
                                            icon: 'success',
                                            text: 'Updated Profile picture',
                                            showConfirmButton: true,
                                        });

                                    }
                                },
                                error: function(e)
                                {
                                    $("#err").html(e).fadeIn();
                                }
                            });
                        }));
                    });
                </script>
            </div>
    </div>
</div>
                </center>
                </div>
                </div>

</body>
</html>
