<?php

$dbHost = "%host%";
$dbUser = "%user%";
$dbPass = "%pass%";
$dbName = "%name%";


$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
