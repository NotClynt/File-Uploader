<?php

// USERS
$users = "SELECT * FROM users";
$result = mysqli_query($db, $users);
if (mysqli_num_rows($result) > 0) {
     while ($row = mysqli_fetch_assoc($result)) {
          $totalusers = mysqli_num_rows($result);
     }
}

// UPLOADS
$uploads = "SELECT id FROM uploads";
$result = mysqli_query($db, $uploads);
if (mysqli_num_rows($result) > 0) {
     while ($row = mysqli_fetch_assoc($result)) {
          $totaluploads = "" . $row["id"] . "";
     }
}

// BANNS
$bans = "SELECT `banned` FROM `users` WHERE `banned`='true'";
$result = mysqli_query($db, $bans);
if (mysqli_num_rows($result) > 0) {
     while ($row2 = mysqli_fetch_assoc($result)) {
          $totalbans = mysqli_num_rows($result);
          if (!mysqli_num_rows($result) === 1) {
               $totalbans = "0";
          } else {
               $totalbans = mysqli_num_rows($result);
          }
     }
}