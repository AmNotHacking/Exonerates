<?php
include "config.php";
session_start();
error_reporting(0);
ini_set('display_errors', 0);
$id = $_GET['id'];

$username = $_SESSION['user'];


$q = "SELECT * FROM `users` WHERE `id`='$id'";
$uid = "";
$username = "";
$bio = "";
$picture = "";
$result = mysqli_query($con, $q);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $uid = $row['uid'];
        $picture = $row['picture'];
        $bio = $row['bio'];
    }
}
else {
    die('No user found');
}
?>

<html>
<head>

    <title>Exonerate Panel</title>
    <?php
    echo "<meta content='" . $username . "' property='og:title'>";
    ?>
    <meta content="Come see my profile on Exonerate" property="og:description">
    <meta content="Exonerate.cc" property="og:site_name">

    <?php
         echo "<meta content='pictures/" . $picture . "' property='og:image'>";
    ?>
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

</head>

<body>

<a class="back-btn" style="text-decoration: none;" href="https://panel.exonerate.cc/">Back</a>

<div class="center">
<div class="center-content">
<center>

<div id="content" >
    <div id="home-page">
        <div class="box">


            <?php
            echo "<h1>" . $username . "</h1>";
            
            ?>
            <div class="line"></div>
            <div class="panel-content">

                <?php
                echo "<img class='epic-picture' style='max-width: 250px; max-height: 250px: opacity: 50%; margin-bottom: 25px;' src='pictures/".$picture."'>";
                echo "<div class='descriptionbox'>";
                echo "<h1 style='color: #F09AE7;margin-top: 0px;'>Description:</h1>";
                echo "<h2 class='unselectable' style='color: white; font-size: 16px; '>" . $bio . "</h2>";
                echo "</div>"
                ?>
            </div>
        </div>
    </div>

</center>
</div>
</div>

</body>
</html>
