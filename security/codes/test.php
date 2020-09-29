<?php
session_start();
include "config.php";
const allowed = ['Colin', 'Sly', 'Toxic', 'fraudster'];
if (!in_array($_SESSION['user'], allowed)) {
    die('you are not allowed here');
}
?>

<html>
<head>
    <title>Testing</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<form id="form" action="upload.php" method="post" enctype="multipart/form-data">

    <input id="uploadImage" type="file" accept="image/*" name="image" />
    <br>
    <br>
    <br>

    <input class="btn btn-success" type="submit" value="Upload">
    <br>
    <br>

    <br>
    <?php
    $q = "SELECT * FROM users";
    $result = mysqli_query($con, $q);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['picture'] == "") {

        }
        else {
            echo "<image width='100' height='100' src='../../pictures/".$row['picture'] . "'";
        }
    }
    ?>

</form>
<div id="err"></div>
<h1 id="code"></h1>
<script>
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
                    alert(data);
                },
                error: function(e)
                {
                    $("#err").html(e).fadeIn();
                }
            });
        }));
    });
</script>
</body>
</html>
