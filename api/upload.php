<?php
define('DIRECTORY', "");
define('PASSWORD', "juliusgraturinas54");
define('DOMAIN', "c-cloud.rocks");
define('SHOW_IP', "false");


define('EMBED', true, true);
define('EMBED_TITLE', "c-cloud.rocks", true);
define('EMBED_DESCRIPTION', "This image was uploaded to c-cloud.rocks", true);
define('EMBED_COLOUR', "#0303fc", true);

require "../src/functions.php";
require "../src/database.php";

$protocol = "https";
try {
     $type = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
} catch (Exception $e) {
     echo $e;
}

$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_POST["sharex"])) {
     if ($_POST["harex"] == "true") {
          $key = $_POST['key'];
     } else {
          $key = $_GET['key'];
     }
} else if (isset($_GET["sharex"])) {
     $key = $_GET['key'];
} else {
     $key = $_POST['key'];
}

$sql = "SELECT * FROM users WHERE `secret`='" . $key . "'";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();
$userid = $user['id'];
$username = $user['username'];
$emcolor = $user['embedcolor'];
$emdesc = $user['embeddesc'];
$emauthor = $user['embedauthor'];
$emtitle = $user['embedtitle'];
$role = $user['role'];
$use_embed = $user['use_embed'];
$use_customdomain = $user['use_customdomain'];
$use_subdomain = $user['use_subdomain'];
$invisible_url = $user['use_invisible_url'];
$emoji_url = $user['use_emoji_url'];
$uuid = $user['uuid'];
$uploadToDomain = $user['upload_domain'];
$subdomain = $user['subdomain'];
$uploads = intval($user['uploads']) + 1;
$filename_type = $user['filename_type'];
$url_type = $user['url_type'];
$last_uploaded = $user['last_uploaded'];
$banned = $user['banned'];
$upload_limit = $user['upload_limit'];
$upload_size_limit = $user['upload_size_limit'];
$self_destruct_upload = $user["self_destruct_upload"];

$toggles = "SELECT * FROM toggles";
$result = $mysqli->query($toggles);
$toggles = $result->fetch_assoc();
$maintenance = $user1['maintenance'];
$allow_uploads = $user1['allow_uploads'];
$announcement = $user1['announcement'];


if ($maintenance == "true") {
     die("Currently under maintenance!");
} else {
     if ($allow_uploads == "true") {
          if ($user['id']) {
               if (!empty($_FILES['file'])) {
                    if ($banned == "true") {
                         die("You are banned!");
                    } else if ($banned = "false") {
                         if (!file_exists("uploads/$uuid")) {
                              mkdir('uploads/' . $uuid, 0777);
                         }
                         if (!file_exists("uploads/$uuid/$username")) {
                              mkdir('uploads/' . $uuid . '/' . $username, 0777);
                         }

                         $invite = ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8);
                         if ($uploads == 500) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         } else if ($uploads == 1000) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         } else if ($uploads == 1500) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         } else if ($uploads == 2000) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         } else if ($uploads == 2500) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         } else if ($uploads == 3000) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         } else if ($uploads == 3500) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         } else if ($uploads == 4000) {
                              $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invite . "', '" . $username . "');";
                              $mysqli->query($sql);
                         }
                         $rnd = rndFileName(8);
                         if ($filename_type == "short") {
                              $rnd = rndFileName(8);
                              $hash = $rnd . "." . $type;
                              $smallHash = $rnd;
                         } else if ($filename_type == "long") {
                              $rnd = rndFileName(16);
                              $hash = $rnd . "." . $type;
                              $smallHash = $rnd;
                         }

                         // FILECHECK 

                    }
               }
          }
     }
}
