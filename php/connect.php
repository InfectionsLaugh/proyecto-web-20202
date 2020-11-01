<?php

$ini = parse_ini_file("config.ini", true);
$credentials = $ini["host_credentials"];

$db = $credentials["mysql_db"];
$db_host = $credentials["mysql_host"];
$db_user = $credentials["mysql_user"];
$db_pass = $credentials["mysql_pass"];

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
