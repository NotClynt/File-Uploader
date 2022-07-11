<?php

$db = new mysqli("localhost", "root", "", "c-cloud");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
