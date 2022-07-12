<?php

$dbHost = "V_HOST";
$dbUser = "V_USER";
$dbPass = "V_PASS";
$dbName = "V_DBNAME";


$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
