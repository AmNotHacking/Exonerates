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

if (!$username) {
    die('not allowed');
}
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

$admin = false;
$admins = array('Sly', 'Colin', 'Toxic', 'fraudster', 'dollars', 'Russ');
if (in_array($username, $admins)) {
    $admin = true;
}
else {
    $admin = false;
}
?>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Exonerate Panel</title>
    <script src="https://shoppy.gg/api/embed.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="icon" type="image/png" sizes="128x128" href="logotransparent.png">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.9.0/css/pro.min.css">
    <link rel="stylesheet" href="dist/sortable-tables.min.css">
    <script src="sort-table.js"></script>
    <script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/particles.min.js"></script>
    <script src="assets/js/main.js" type="ea6ea3b2bbdf438d2fdee388-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="ea6ea3b2bbdf438d2fdee388-|49" defer=""></script>

</head>

<body>

<img src="images/form.png" class="form">
<img src="images/form2.png" class="form2">

<div id="particles-js"></div>

<script>

    $(window).bind('beforeunload', function(){


    });
    var interval = 1000;
    function rgb(r, g, b){
        return "rgb("+r+","+g+","+b+")";
    }
    function updateStatus() {
        var username = $('.user_id').val();
        $.ajax({
            url:'getstatus.php',
            type:'get',
            data: 'username=' + username,
            success:function(response){
                document.getElementById('status').innerHTML = response;
                setTimeout(updateStatus, interval);
            }
        });

        if (document.getElementById('status').innerHTML == 'offline') {
            document.getElementById('status').style.color = rgb(130, 44, 44);
        }
        else if (document.getElementById('status').innerHTML == 'online') {
            document.getElementById('status').style.color = rgb(29, 117, 29);
        }
    }
    function sidebar() {
        document.getElementById('side-panel').classList.toggle('active');
    }
    $(document).ready(function () {
       $('.nav li').click(function(event) {
          $('.selected').removeClass('selected');
          $(this).addClass('selected');
          event.preventDefault();
       });


    });
    function getLogins() {
        $.ajax({
            url:'getlogins.php',
            type:'GET',
            success:function(response){
                document.getElementById("total-logins").innerText = response;
            }
        });
    }
    function getUsers() {
        $.ajax({
            url:'getusers.php',
            type:'GET',
            data: '',
            success:function(response){
                alert(response);
                document.getElementById("total-users").innerText = response;
            }
        });
    }
    function getBans() {
        $.ajax({
            url:'getbans.php',
            type:'GET',
            data: '',
            success:function(response){
                document.getElementById("total-bans").innerText = response;
            }
        });
    }
    getBans();
   getUsers();
    document.addEventListener('DOMContentLoaded', function() {
        getLogins();

        $('#invite-page').hide();
        $('#discord-page').hide();
        $('#users').hide();
        $('#logs').hide();
        $('#settings-page').hide();
        $('#selfbot').hide();
        $('#join').hide();
        $('#csgo-activate').hide();
        $('#client').hide();
        getBans();
        // var username = $('.user_id').val();

    }, false);
    function switchTabs(index, index2, index3, index4, index5, index6, index7, index8, index9, index10, index11) {
        $(index).show();
        $(index2).hide();
        $(index3).hide();
        $(index4).hide();
        $(index5).hide();
        $(index6).hide();
        $(index7).hide();
        $(index8).hide();
        $(index9).hide();
        $(index10).hide();
        $(index11).hide();

        // document.getElementById(index).style.visibility = "visible";
        //document.getElementById(index2).style.visibility = "none";
    }
</script>
<script>

var $el = $(".table-responsive");
function anim() {
    var st = $el.scrollTop();
    var sb = $el.prop("scrollHeight")-$el.innerHeight();
    $el.animate({scrollTop: st<sb/2 ? sb : 0}, 4000, anim);
}
function stop(){
    $el.stop();
}
$('.epic-codes a').on('click',function() {
}
anim();
$el.hover(stop, anim);
</script>

<div class="dropdown">
    <?php
    $username = $_SESSION['user'];
    $q = "SELECT * FROM users WHERE `username`='$username'";
    $result = mysqli_query($con, $q);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['picture'] == "") {
            echo "<button onclick='dropDown()' class='dropbtn'><img class='profile-img' src='https://panel.exonerate.cc/logotransparent.png'>" . $username ."</button>";
        }
        else {
            echo "<button onclick='dropDown()' class='dropbtn'><img class='profile-img' src='pictures/".$row['picture'] . "'>". $username . "</button>";
        }
    }
    ?>
    <div id="dropButton" class="dropdown-content">
        <?php
        echo "<a href='profile.php?id=". $_SESSION['uid'] . "'><i class='far fa-user-circle' style='margin-right: 5px;'></i> Profile</a>";
        ?>
        <a href="userlist.php"><i class="far fa-users" style="margin-right: 5px;"></i> Userlist</a>
        <a href="settings.php"><i class="far fa-cog" style="margin-right: 5px;"></i> Settings</a>
        <a href="https://panel.exonerate.cc/logout.php"><i class="far fa-sign-out-alt" style="margin-right: 5px;"></i> Logout</a>
    </div>
</div>

<div id="side-panel" class="nav">
    <div class="toggle-btn" onclick="sidebar()">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul>
        <h1 style='margin-top: 10px; margin-bottom: 10px; text-align: center; color: #f09ae7; font-size: 20px; font-family: ' Roboto', sans-serif';'  >Exonerate Panel  </h1>
        <li class="selected" id="home" onclick="switchTabs('#home-page', '#invite-page', '#discord-page' , '#users', '#blacklist', '#logs', '#selfbot', '#settings-page', '#join', '#csgo-activate', '#client')">Home</li>
        <li id="invites" onclick="switchTabs('#invite-page', '#home-page', '#discord-page',  '#users', '#blacklist', '#logs' , '#selfbot', '#settings-page', '#join', '#csgo-activate', '#client')">Activation</li>
        <li id="discord" onclick="switchTabs('#discord-page', '#home-page', '#invite-page',  '#users', '#blacklist', '#logs' , '#selfbot', '#settings-page'), '#join', '#csgo-activate', '#client'"><a>Commands</a></li>
        <?php
          if ($_SESSION['version'] != "regular") {
              ?>
        <li id="discord" onclick="switchTabs('#selfbot', '#home-page', '#invite-page',  '#users', '#blacklist', '#logs' , '#discord-page', '#settings-page', '#join', '#csgo-activate', '#client')"><a>SelfBot</a></li>
        <li id="settings" onclick="switchTabs('#settings-page', '#home-page', '#invite-page',  '#users', '#blacklist', '#logs' , '#selfbot', '#discord-page', '#join', '#csgo-activate', '#client')"><a>Settings</a></li>
        <?php
          }
          ?>
        <?php
            ?>
            <?php
            if (($_SESSION['csgoversion'] == "" || $_SESSION['csgoversion'] == null) && $_SESSION['invited'] == 'true') {
                ?>
                <h1 style='margin-top: 20px; text-align: center; margin-bottom: 10px;color: rgba(202, 202, 202, 0.9); font-size: 20px; font-family: 'Roboto', sans-serif'>Cryptic</h1>
                <li id='cryptic-activate' onclick="switchTabs('#csgo-activate', '#blacklist', '#users' ,'#logs' ,'#home-page', '#invite-page', '#discord-page' ,'#settings-page', '#join',  '#client')">Activate</li>
                <?php
            }
                ?>
            <?php
            if (($_SESSION['invited'] == 'true' && $_SESSION['csgoversion'] == "beta") || ($_SESSION['invited'] == 'true' && $_SESSION['csgoversion'] == "premium")) {
                ?>
                <h1 style='margin-top: 20px; text-align: center; margin-bottom: 10px;color: rgba(202, 202, 202, 0.9); font-size: 20px; font-family: 'Roboto', sans-serif'>Cryptic</h1>
                <li id='cryptic-client' onclick="switchTabs('#client', '#blacklist', '#users' ,'#logs' ,'#home-page', '#invite-page', '#discord-page' ,'#settings-page', '#csgo-activate', '#join')">Client</li>

                <?php
            }
                ?>
            <?php

        ?>

        <?php
          if ($admin == true) {

              ?>
              <h1 style="margin-top: 20px; text-align: center; margin-bottom: 5px;color: rgba(202, 202, 202, 0.9); font-size: 20px;">Admin Tools </h1>
              <li id="" onclick="switchTabs('#users', '#blacklist' ,'#logs' ,'#home-page', '#invite-page', '#discord-page', '#settings-page', '#selfbot','#join', '#csgo-activate', '#client')">Users</li>
              <li id='admin-blacklist' onclick="switchTabs('#blacklist', '#users' ,'#logs' ,'#home-page', '#invite-page', '#discord-page' ,'#settings-page', '#join', '#csgo-activate', '#client')">Bans</li>
              <a href="https://panel.exonerate.cc/security/codes">Generate Codes</a>
              <?php
          }
          ?>

    </ul>
</div>

<div class="center">
<div class="center-content">
<center>

<div id="content">

    <div id="home-page">
        <div class="box">
        <img style="width: 250px; height: 250px; opacity: 50%;" src="logotransparent.png">
<br><br>
            <h1>Exonerate</h1>
            <div class="line"></div>
            <div class="panel-content" style="text-align: center;">
                <?php echo "<h1 style='text-align: center;'>Welcome back, " . $_SESSION['user'] . " | UID: " . $_SESSION['uid'] .  "</h1>"?>

                <?php
                if ($_SESSION['version'] == 'regular') {


                    ?>
                    <div class="user-status">
                        <a href='https://hexpay.gg/u/Nunca/products/5e8967a15cac3'>
                            <button class='status-btn'>Upgrade Account</button>
                        </a>

                    </div>
                    <?php

                }
                ?>
            </div>

<br><br>

            <div class="descriptionbox">
            <div class="button-wrapper">
                <p style="color: white;">Total Users: </p>
                <button id="total-users" type="button" style="width: 100px;">2</button>
            </div>
            <div class="button-wrapper">
                <p style="color: white;">Total Logins: </p>
                <button id="total-logins" type="button" style="width: 100px;">2</button>
            </div>
            <div class="button-wrapper">
                <p style="color: white;">Total Bans: </p>
                <button id="total-bans" type="button" style="width: 100px;">2</button>
            </div>
            </div>


        </div>
    </div>

    <div id="invite-page">
        <div class="box">
            <h1>Activation</h1>
            <div class="line"></div>

            <div class="panel-content">
                <h1>Enter your code to from HexPay to activate your account</h1>
                <br>
                <input type="text" id="activate-code" placeholder="Activation Key" />
             <br>
                <button type='submit' onclick="activateKey()">Activate</button>
            </div>

            <script>

                function activateKey() {
                    var username = $('.user_id').val();
                    var key = $('#activate-code').val();
                    $.ajax({
                        url:'activation.php',
                        type:'get',
                        data: 'key=' + key,
                        success:function(response){
                            if (response != 'error')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Activated Your Account, please refresh the page',
                                    showConfirmButton: true,
                                });
                            }
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Invalid Code',
                                    showConfirmButton: true,
                                })
                            }
                        }
                    });
                }

            </script>
        </div>
    </div>

    <div id="join">
        <div class="box">
            <h1>Join</h1>
            <div class="line"></div>

            <div class="panel-content" style="text-align: center;">
                <p style="text-align: center">Enter your invitation code to gain access to the cs:go client</p>
                <input type="text" id="invitation-code" placeholder="Invitation Code" />

                <button type='submit' onclick="join()">Join</button>
            </div>

            <script>

                function join() {
                    var username = $('.user_id').val();
                    var key = $('#invitation-code').val();
                    $.ajax({
                        url:'join.php',
                        type:'get',
                        data: 'username=' + username + "&invite=" + key,
                        success:function(response){

                            if (response != 'error')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Activated Your Account, please logout and log back in',
                                    showConfirmButton: true,
                                })
                            }
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Invalid Invitation',
                                    showConfirmButton: true,
                                })
                            }
                        }
                    });
                }

            </script>
        </div>
    </div>

    <div id="csgo-activate">
        <div class="box">
            <h1>Activate</h1>
            <div class="line"></div>

            <div class="panel-content" style="text-align: center;">
                <p style="text-align: center">Enter your activation key from hexpay you receieved in your email to gain access to the cs:go client</p>
                <input type="text" id="activate-key" placeholder="Hexpay Key" />
<br>
                <button type='submit' onclick="activatecsgoKey()" >Activate</button>
            </div>

            <script>

                function activatecsgoKey() {
                    var username = $('.user_id').val();
                    var key = $('#activate-key').val();
                    $.ajax({
                        url:'csgoactivation.php',
                        type:'get',
                        data: 'username=' + username + "&key=" + key,
                        success:function(response){

                            if (response != 'error')
                            {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Activated Your Account, please logout and log back in',
                                    showConfirmButton: true,
                                })
                            }
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Invalid Code',
                                    showConfirmButton: true,
                                })
                            }
                        }
                    });
                }

            </script>
        </div>
    </div>

    <div id="client">
        <div class="box">
            <h1>Client</h1>
            <div class="line"></div>

            <div class="panel-content" style="text-align: center;">
                <p style="text-align: center">To use the client disable any anti-virus and or firewall software on your computer. <br> Next download the loader run it and login with your panel credentials. <br> Any issues feel free to open a ticket in the discord</p>
                <button type='submit' onclick="downloadLoader()" >Download</button>
            </div>

            <script>

                function downloadLoader() {
    var name  = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
    $.ajax({
        url: 'checkLoader.php',
        type: 'post',
        data: '',
        success: function (response) {
            if (response == 'offline') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    text: 'loader is offline',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                })
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: 'Requesting client from server...',
                    showConfirmButton: true,
                    timer: 1500,
                    timerProgressBar: true,
                }).then((result) => {
                    $.ajax({
                        url: "client/client.exe",
                        method: 'GET',
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function (data) {
                            var a = document.createElement('a');
                            var url = window.URL.createObjectURL(data);
                            a.href = url;
                            a.download = name + '.exe';
                            document.body.append(a);
                            a.click();
                            a.remove();
                            window.URL.revokeObjectURL(url);
                            Swal.fire({
                                icon: 'success',
                                title: 'Client downloaded',
                                showConfirmButton: true,
                                timer: 1500,
                                timerProgressBar: true,
                            })
                        }
                    });
                });
            }
        }
    });
}

            </script>
        </div>
    </div>


<center>

    <div id="discord-page" style="margin-left: 15px; margin-right: 15px;">
            <h1 style="color: white; margin-bottom: 10px;" >Command List</h1>
            <br>
<div style="min-height: 600px; max-height: 600px; overflow-y: auto;">
            <table class="table mb-0 " style="background:#181A1B; color: white; display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; overflow-y: auto;">
                <thead>
                <tr>
                    <th scope="col">Command</th>
                    <th scope="col">Usage</th>
                    <th scope="col">Description</th>

                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="unselectable">animate</td>
                        <td class="unselectable">animate [text u want to animate]</td>
                        <td class="unselectable">Animates a provided text</td>
                    </tr>
                    <tr>
                        <td class="unselectable">ascii</td>
                        <td class="unselectable">ascii [text u want to convert to ascii]</td>
                        <td class="unselectable">Converts provided text to ascii</td>
                    </tr>
                    <tr>
                        <td class="unselectable">btc</td>
                        <td class="unselectable">btc [amount] (default amount is 5)</td>
                        <td class="unselectable">Creates an embedded bitcoin invoice</td>
                    </tr>
                    <tr>
                        <td class="unselectable">btc-convert</td>
                        <td class="unselectable">btc [currency (USD, RUB)] [amount]</td>
                        <td class="unselectable">Converts provided currency amount to amount in BTC</td>
                    </tr>
                    <tr>
                        <td class="unselectable">cashapp</td>
                        <td class="unselectable">cashapp [amount] (default amount is 5)</td>
                        <td class="unselectable">Create an embedded cashapp invoice</td>
                    </tr>
                    <tr>
                        <td class="unselectable">cat</td>
                        <td class="unselectable">cat</td>
                        <td class="unselectable">Sends a random picture of a cat</td>
                    </tr>
                    <tr>
                        <td class="unselectable">hex</td>
                        <td class="unselectable">hex [color in hex without #]</td>
                        <td class="unselectable">Converts provided hex color to decimal for use in embeds</td>
                    </tr>
                    <tr>
                        <td class="unselectable">dmall</td>
                        <td class="unselectable">dmall [message] </td>
                        <td class="unselectable">DM's everyone in a server a provided message (WARNING: using this may get you banned)</td>
                    </tr>

                    <tr>
                        <td class="unselectable">dns</td>
                        <td class="unselectable">dns [domain without http://]</td>
                        <td class="unselectable">Retrieves DNS records from   a domain</td>
                    </tr>
                    <tr>
                        <td class="unselectable">dog</td>
                        <td class="unselectable">dog</td>
                        <td class="unselectable">Sends a random picture of a dog</td>
                    </tr>
                    <tr>
                        <td class="unselectable">domaininfo</td>
                        <td class="unselectable">domaininfo [domain without http://]</td>
                        <td class="unselectable">Retrieves information about a domain</td>
                    </tr>
                    <tr>
                        <td class="unselectable">embed</td>
                        <td class="unselectable">embed [title] / [description] / [color]</td>
                        <td class="unselectable">Sends an embedded message</td>
                    </tr>
                    <tr>
                        <td class="unselectable">everyone</td>
                        <td class="unselectable">everyone</td>
                        <td class="unselectable">Mentions everyone individually in a server</td>
                    </tr>
                    <tr>
                        <td class="unselectable">emoji</td>
                        <td class="unselectable">emoji [text]</td>
                        <td class="unselectable">Converts provided text to emojis</td>
                    </tr>
                    <tr>
                        <td class="unselectable">fake</td>
                        <td class="unselectable">fake</td>
                        <td class="unselectable">Generates a fake person</td>
                    </tr>
                    <tr>
                        <td class="unselectable">ghostping</td>
                        <td class="unselectable">ghostping [mention user]</td>
                        <td class="unselectable">Quickly ping a user then delete the message</td>
                    </tr>
                    <tr>
                        <td class="unselectable">gif</td>
                        <td class="unselectable">gif [key word]</td>
                        <td class="unselectable">Sends a random gif based on a key word</td>
                    </tr>
                    <tr>
                        <td class="unselectable">hastebin</td>
                        <td class="unselectable">hastebin [text]</td>
                        <td class="unselectable">Uploads text to hastebin url</td>
                    </tr>
                    <tr>
                        <td class="unselectable">instagram</td>
                        <td class="unselectable">instagram [username]</td>
                        <td class="unselectable">Find infromation about a provided instagram username</td>
                    </tr>
                    <tr>
                        <td class="unselectable">ipinfo</td>
                        <td class="unselectable">ipinfo [ipv4 address]</td>
                        <td class="unselectable">Displays ip information</td>
                    </tr>
                    <tr>
                        <td class="unselectable">password</td>
                        <td class="unselectable">password [length]</td>
                        <td class="unselectable">Generates a strong password with a specified length</td>
                    </tr>
                    <tr>
                        <td class="unselectable">paypal</td>
                        <td class="unselectable">paypal [amount] (default amount is 5)</td>
                        <td class="unselectable">Create an embedded paypal invoice</td>
                    </tr>
                     <tr>
                        <td class="unselectable">phone</td>
                        <td class="unselectable">phone [phone number in international format]</td>
                        <td class="unselectable">Gets information about a provided phone number</td>
                    </tr>

                    <tr>
                        <td class="unselectable">ping</td>
                        <td class="unselectable">ping [ipv4 or domain]</td>
                        <td class="unselectable">Pings an ip or domain</td>
                    </tr>
                    <tr>
                        <td class="unselectable">playing</td>
                        <td class="unselectable">playing [status]</td>
                        <td class="unselectable">Sets users playing status</td>
                    </tr>
                    <tr>
                        <td class="unselectable">poll</td>
                        <td class="unselectable">poll [question]</td>
                        <td class="unselectable">Automatically makes an embedded poll</td>
                    </tr>
                    <tr>
                        <td class="unselectable">portscan</td>
                        <td class="unselectable">portscan [ipv4 or domain]</td>
                        <td class="unselectable">Scans ip or domain for open ports</td>
                    </tr>
                    <tr>
                        <td class="unselectable">purge</td>
                        <td class="unselectable">purge [amount of messages]</td>
                        <td class="unselectable">Deletes a provided amount of messages</td>
                    </tr>
                    <tr>
                        <td class="unselectable">quote</td>
                        <td class="unselectable">quote [message id]</td>
                        <td class="unselectable">Quotes a message in an embed with a random color</td>
                    </tr>
                    <tr>
                        <td class="unselectable">reverse</td>
                        <td class="unselectable">reverses [text]</td>
                        <td class="unselectable">Sends back provided text but reversed</td>
                    </tr>
                    <tr>
                        <td class="unselectable">screenshot</td>
                        <td class="unselectable">screenshot [domain]</td>
                        <td class="unselectable">Takes a screenshot of the provided website</td>
                    </tr>
                    <tr>
                        <td class="unselectable">streaming</td>
                        <td class="unselectable">streaming [status]</td>
                        <td class="unselectable">Sets user streaming status</td>
                    </tr>
                    <tr>
                        <td class="unselectable">space</td>
                        <td class="unselectable">space [amount] [text]</td>
                        <td class="unselectable">Spaces out provided text with a provided amount</td>
                    </tr>
                    <tr>
                        <td class="unselectable">destroy (not finished)</td>
                        <td class="unselectable">destroy</td>
                        <td class="unselectable">Deletes all channels in a server (admin perm required)</td>
                    </tr>
                    <tr>
                        <td class="unselectable">status</td>
                        <td class="unselectable">status [text]</td>
                        <td class="unselectable">Change status to provided status</td>
                    </tr>
                    <tr>
                        <td class="unselectable">whois</td>
                        <td class="unselectable">whois [mentioned user]</td>
                        <td class="unselectable">Gets information about a mentioned user</td>
                    </tr>
                    <tr>
                        <td class="unselectable">venmo</td>
                        <td class="unselectable">venmo [amount] (default amount is 5)</td>
                        <td class="unselectable">Create an embedded venmo invoice</td>
                    </tr>
                </tbody>
            </table>
            </div>
    </div>
    </center>

    <div id="selfbot">
    <div class="box">
        <p id="status" style="text-align: left; font-size: 15px;"></p>
        <h1 id="" style="text-align: center;">SelfBot</h1>
        <div class="line"></div>
        <div class="panel-content" style="text-align: center;">
            <h1 style="text-align: center;">Warning, using this may result in a ban please use it wisely</h1>
<br>

            <button name='discord' onclick="startSelfbot()" id='discord' type='submit'>Start Bot</button>
            <br><br>
            <button name='discord' onclick="stopSelfbot()" id='discord' type='submit'>Stop Bot</button>
            <?php

            echo "<input type='hidden' value='" . $_SESSION['user'] . "' class='user_id'>";
            ?>
            <script>
                function startSelfbot() {
                    var username = $('.user_id').val();
                    var status = document.getElementById('status').innerText;
                    if (status == "online") {
                        Swal.fire({
                            icon: 'error',
                            title: "Bot already started",
                            showConfirmButton: true,
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'information',
                            title: 'Starting bot please wait',
                            showConfirmButton: false,
                        });
                        $.ajax({
                            url: 'security/logging/connection.php',
                            type: 'get',
                            data: 'c=startup&username=' + username,
                            success: function (response) {

                                if (response != 'error') {
                                    Swal.fire({
                                        icon: 'success',
                                        text: 'Started Bot!',
                                        showConfirmButton: true,
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: "An error occured",
                                        showConfirmButton: true,
                                    })
                                }
                            }
                        });
                    }
                }
                function stopSelfbot() {

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'information',
                        title: 'Stopping bot please wait',
                        showConfirmButton: false,
                    });
                    var username = $('.user_id').val();
                    $.ajax({
                        url: 'security/logging/connection.php',
                        type: 'get',
                        data: 'c=stop&username=' + username,
                        success: function (response) {
                            if (response != 'error') {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Stopped bot!',
                                    showConfirmButton: true,
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error occured',
                                    showConfirmButton: true,
                                })
                            }
                        }
                    });
                }

            </script>
        </div>
    </div>
</div>

<div id="settings-page">
<center>

    <div class="box">
        <h1>Settings</h1>
        <div class="line"></div>
        <div class="panel-content" style="overflow-y: auto;">
            <h1>Update settings for the selfbot</h1>

            <input type="text" id="discordToken" placeholder="Discord Token" />
            <input type="text" id="discordPrefix" placeholder="Discord Prefix" />
            <input type="text" id="btc" placeholder="Bitcoin Address for Invoice" />
            <input type="text" id="paypal" placeholder="Paypal Email for Invoice" />
            <input type="text" id="venmo" placeholder="Venmo Email for Invoice" />
            <input type="text" id="cashapp" placeholder="Cashapp Email for Invoice" />
            <button name='discord' id='discord' type='submit' onclick="saveSettings()">Save</button>
            <script>
                function saveSettings() {

                    var discordToken = document.getElementById("discordToken").value;
                    var discordPrefix = document.getElementById("discordPrefix").value;
                    var btcAddress = document.getElementById("btc").value;
                    var paypalEmail = document.getElementById("paypal").value;
                    var venmoEmail = document.getElementById("venmo").value;
                    var cashappEmail = document.getElementById("cashapp").value;
                    if (!discordToken || !discordPrefix) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Please fill in all inputs',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'information',
                            title: 'Updating settings, please wait',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                        });
                        $.ajax({
                            url: 'security/logging/connection.php',
                            type: 'get',
                            data: 'c=token_change&prefix=' + discordPrefix + '&token=' + discordToken + "&btc=" + btcAddress + "&paypal=" + paypalEmail + "&venmo=" + venmoEmail + "&cashapp=" + cashappEmail,
                            success: function (response) {


                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    text: 'Succesfully updated selfbot settings',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                })

                            }
                        });
                    }
                }
            </script>
        </div>
    </div>
</center>
</div>


    <div id="users" style="min-height: 600px; max-height: 600px; overflow-y: auto;" >
        <h1 style="color: white; margin-bottom: 10px;" >Users</h1>
        <table class="table mb-0 " style="background:#181A1B; color: white; display: block; width: 100%">
            <thead>
            <tr>
                <th style="margin-bottom: 10px;" scope="col">id</th>
                <th scope="col">username</th>
                <th scope="col">premium</th>
                <th scope="col">ip</th>
                <th scope="col">actions</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM users ORDER BY id";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result)) {
                $username = $row['username'];
                $hwid = $row['version'];
                $ip = $row['ip'];
                $id = $row['id'];
                ?>
                <tr>
                    <td class="unselectable"><?php echo $id ?></td>
                    <td class="unselectable"><?php echo $username ?></td>
                    <td class="unselectable"><?php echo $hwid ?></td>
                    <td  bgcolor="#1F2029" class="unselectable"><?php echo $ip ?></td>
                    <td ><button class='status-btn ban-user' type="button">Ban User</button></td>
                </tr>

                <?php

            }
                 ?>
            </tbody>
        </table>
        <script>
            $('.view-user').on('click', function() {
                var uid = $(this).closest("tr").find("td:eq(0)").text();
                var username = $(this).closest("tr").find("td:eq(1)").text();
                var hwid = $(this).closest("tr").find("td:eq(2)").text();
                var ip = $(this).closest("tr").find("td:eq(3)").text();


                Swal.fire({
                    title: 'User Information: ' + username,
                    html:
                        '<ul style="text-align: center;">' +
                        '<h4>uid: ' + uid + '</h4>' +
                        '<h4>username: ' + username + '</h4>' +
                        '<h4>hwid: ' + hwid + '</h4>' +
                        '<h4>ip: ' + ip + '</h4>' +
                        '</ul>',


                })
            });
            $(".ban-user").on('click', function() {
                var username = $(this).closest("tr").find("td:eq(1)").text();
                Swal.fire({
                    title: "Enter a Ban Reason",
                    icon: 'warning',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ban user',
                    preConfirm: (login) => {
                        var reason = login;
                        var data = 'username=' + username + "&reason=" + reason;
                        $.ajax({
                            url:'admin/piausgwpgwe9uphh.php',
                            type:'post',
                            data: data,
                            success:function(response) {
                                if (response == '1' ) {
                                    Swal.fire({
                                        position: 'top-end',
                                        toast: true,
                                        icon: 'success',
                                        title: 'user banned',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    }).then((result) => {
                                        window.location.reload();
                                    });

                                }
                                else if (response == '2') {
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'an error occured',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    })
                                }
                            }

                        });
                    },
                }).then((result) => {
                });
            });
            $(".hwid-reset").on("click", function() {
                var username = $(this).closest("tr").find("td:eq(1)").text();
                var data = 'username=' + username;
                $.ajax({
                    url:'admin/ljhgfvuifdhgfiuhgi.php',
                    type:'post',
                    data: data,
                    success:function(response) {
                        if (response == '1' ) {
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                icon: 'success',
                                title: 'hwid reset for: ' + username,
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            }).then((result) => {
                                window.location.reload();
                            });

                        }
                        else if (response == '2') {
                            Swal.fire({
                                icon: 'error',
                                text: 'an error occured',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            })
                        }
                    }

                });
            })
        </script>
    </div>

    <div id="logs" style="min-height: 600px; max-height: 600px; overflow-y: auto; width: 100%;" >
        <table class="table mb-0 js-sort-table " style="background:#1F2029; color: white; display: block; width: 100%; overflow-x: auto; background: #1F2029; -webkit-overflow-scrolling: touch; overflow-y: auto;">
            <thead>
            <tr>
                <th scope="col" class="js-sort-number">id</th>
                <th scope="col">username</th>
                <th scope="col">ip</th>
                <th scope="col">log</th>
                <th scope="col">computer name</th>
                <th scope="col">hwid</th>
                <th scope="col">location</th>
                <th scope="col">date</th>
                <th scope="col">action</th>
            </tr>
            </thead>

            <?php
            $query = "SELECT * FROM logs";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result)) {
                $username = $row['username'];
                $hwid = $row['hwid'];
                $date = $row['datetime'];
                $log = $row['log'];
                $id = $row['id'];
                $ip = $row['ip'];
                $computername = $row['computername'];
                $location = $row['location'];

                ?>
                <tr>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $id ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $username ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $ip ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $log ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $computername ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $hwid ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $location ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><?php echo $date ?></td>
                    <td style="background: #1F2029; margin-top: 20px;" class="unselectable numeric-sort"><button class='status-btn delete-log' type="button">Delete Log</button></td>
                </tr>

                <?php

            }
            ?>
            <tbody>
            </tbody>
        </table>
        <script>
            $(".delete-log").on('click', function() {
                var id = $(this).closest("tr").find("td:eq(0)").text();
                $.ajax({
                    url:'admin/bpuidbvdiuwpshv.php',
                    type:'post',
                    data: "id=" + id,
                    success:function(response) {
                        if (response == '1' ) {
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                icon: 'success',
                                title: 'log deleted',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            }).then((result) => {
                                window.location.reload();
                            });

                        }
                        else if (response == '2') {
                            Swal.fire({
                                icon: 'error',
                                text: 'an error occured',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            })
                        }
                    }

                });
            })
        </script>
    </div>
</div>
</center>
</div>
</div>

<script>
    function dropDown() {
        document.getElementById("dropButton").classList.toggle("show");
    }
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

</body>
</html>
