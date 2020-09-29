<?php
$salt = uniqid(mt_rand(), true);

$salt_key = $salt;
$pass = $_REQUEST['pass'];

$pass_new = md5(md5($salt_key) . md5($pass));


echo "pass: " . $pass_new;
echo "<br>";
echo "salt: " . $salt_key;
?>