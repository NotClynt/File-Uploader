<?php

require "../src/database.php";

$sql = "SELECT * FROM domains";
$result = $db->query($sql);
$domains = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $domains[] = $row;
    }
}

$print = array(
    "domains" => $domains
);

echo json_encode($print);