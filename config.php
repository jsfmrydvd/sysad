<?php
$db_username = 'root';
$db_password = 'jsfmrydvd';
$db_name = 'sysad';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($mysqli->connect_error) {
   die("Connection failed: " . $mysqli->connect_error);
}
?>
