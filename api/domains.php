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
echo json_encode($domains);
