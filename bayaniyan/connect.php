<?php
$server = 'localhost';
$user = 'root';
$db = 'tracking';
$pass = '';
$coni = mysqli_connect($server, $user, $pass, $db);

if (!$coni) {
    die(mysqli_error($coni));
}
?>