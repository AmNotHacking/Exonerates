<?php
session_start();
include "config.php";
const allowed = ['Colin', 'Sly', 'Toxic', 'fraudster', 'Russ'];
if (!in_array($_SESSION['user'], allowed)) {
    die('you are not allowed here');
}
?>

<html>
<head>
    <title>Activate Codes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<button type="submit" onclick="generate()">Add Codes</button>
<h1 id="code"></h1>
<script>
    function generate() {
        $.ajax({
            url:'gen.php',
            type:'post',
            data: '',
            success:function(response){
                $("#code").html(response);
            }
        });
    }
</script>
</body>
</html>
