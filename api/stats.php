<?php

require "../src/database.php";

$sql = "SELECT * FROM users";
$result = $db->query($sql);
$user_count = $result->num_rows;

$sql = "SELECT `banned` FROM `users` WHERE `banned`='true'";
$result = $db->query($sql);
$banned_count = $result->num_rows;

$sql = "SELECT id FROM uploads";
$result = $db->query($sql);
$upload_count = $result->num_rows;

$print = array(
    "user_count" => $user_count,
    "banned_count" => $banned_count,
    "upload_count" => $upload_count
);

echo json_encode($print);
