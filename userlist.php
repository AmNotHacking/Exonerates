<?php
include "config.php";
session_start();
error_reporting(0);
ini_set('display_errors', 0);
$id = $_GET['id'];

$username = $_SESSION['user'];


?>

<html>
<head>

    <title>Exonerate Panel</title>
    <meta content="Exonerate Userlist" property="og:description">
    <meta content="Exonerate.cc" property="og:site_name">
    <script src="https://shoppy.gg/api/embed.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css?v=300">
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
<style>
    .panel-content a {
        cursor: default;
        transition: all .3s;
        -wenkit-transition: all .3s;
        -moz-transition: all .3s;
        -o-transition: all .3s;
        -ms-transition: all .3s;
    }
    .panel-content a:hover {
        cursor: pointer;
        color: white;
        margin-left: 7px;
        transition: all .3s;
        -wenkit-transition: all .3s;
        -moz-transition: all .3s;
        -o-transition: all .3s;
        -ms-transition: all .3s;
    }

    .panel-content td {
        cursor: default;
    }
</style>
<div id="content" >
    <div id="home-page">
        <div class="box">


<h1>Users</h1>
            <div class="line"></div>
            <div class="panel-content">
            <div style='height: 650px; overflow:auto;'>
        <table style="background:#181A1B; color: white;">
            <thead>
            <tr>
                <th style="col">UID</th>
                <th scope="col">Username</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM users ORDER BY id";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $username = $row['username'];
                ?>
                <tr>
                    <td class="unselectable"><?php echo $id?></td>
                    <td class="unselectable"><a href="https://panel.exonerate.cc/profile.php?id=<?php echo $id?>" target="_blank"><?php echo $username ?></a></td>
                </tr>

                <?php

            }
                 ?>
            </tbody>
        </table>
        </div>

            </div>
        </div>
    </div>

</center>
</div>
</div>

</body>
</html>
