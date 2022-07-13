<?php

include "../src/config.php";
include "../src/database.php";

function generateRandomInt($length)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function uuid()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
}

$ranPass = generateRandomInt(16);
$uuid = uuid();
$tag = generateRandomInt(4);
date_default_timezone_set('Europe/Amsterdam');
$date = date("F d, Y h:i:s A");

$username = "";
$errors = array();
$succeded = array();

if (isset($_POST['reg'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $c_password = mysqli_real_escape_string($db, $_POST['c_password']);
    $key = mysqli_real_escape_string($db, $_POST['key']);
    if (empty($username)) {
        $error = "Username is required";
    }
    if (empty($password)) {
        $error = "Password is required";
    }
    if (empty($key)) {
        $error = "Invite code is requires";
    }
    if ($password != $c_password) {
        $error = "Password do not match";
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] == $username) {
            $error = "Username already exists.";
        } else {
            $error = "Already registered.";
        }
    } else {
    }
    $query = "SELECT * FROM users WHERE invite='$key'";
    $exquery = mysqli_query($db, $query);

    if (mysqli_num_rows($exquery) > 0) {

        $error = "Invite is already assigned to another Account.";
    } else {
        $regQuery = "SELECT * FROM `invites` WHERE `inviteCode`='$key';";
        $regReq = mysqli_query($db, $regQuery);
        $regResult = mysqli_fetch_assoc($regReq);
        $inviter = $regResult['inviteAuthor'];
        if ($regResult['inviteCode'] == $key) {
            $delquery = "DELETE FROM `invites` WHERE `inviteCode` = '$key';";
            mysqli_query($db, $delquery);
            $ranPass = generateRandomInt(16);
            date_default_timezone_set('Europe/Amsterdam');
            $date = date("F d, Y h:i:s A");
            if (count($errors) == 0) {
                if (!file_exists('../uploads/' . $uuid)) {
                    mkdir('../uploads/' . $uuid, 0777, true);
                }
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (id, uuid, username, password, banned, invite, secret, embedcolor, embedauthor, embedtitle, embeddesc, reg_date, use_embed, use_customdomain, self_destruct_upload, filename_type, url_type, uploads, upload_domain, discord_username, discord_id, inviter, last_uploaded, upload_limit, upload_size_limit, upload_logo, upload_logo_toggle) VALUES (NULL, '$uuid', '$username', '$hashed_password', 'false', '$invite', '$ranPass', '%embed_color%', '%service_name%', '%filename (%filesize)', 'Uploaded by %username at %date', '$date', 'true', 'false', 'false', 'false', 'short', 'short', 0, '%domain%', 'user#0000', '$inviter', '$date', '500 MB', '32 MB', 'https://%domain%/assets/images/icon.png', 'false');";
                mysqli_query($db, $query);
                $_SESSION['username'] = $username;
                $_SESSION['key'] = $key;
                $ip = $_SERVER['REMOTE_ADDR'];
                $_SESSION['success'] = "You are now logged in";
                header('location: ../dashboard/discord/');
            }
        } else {
            $error = "Invite is not valid.";
        }
    }
}




?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title><?php echo SERVICE_NAME ?> | register</title>

    <link href="https://<?php echo CDN_URL ?>/assets/images/icon.png" rel="shortcut icon" />
    <link href="https://<?php echo CDN_URL ?>/assets/css/register.css" rel="stylesheet" type="text/css" />

    <meta name="keywords" content="<?php echo KEYWORDS ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo DESCRIPTION ?>">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&amp;display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>

    <img class="logo" src="https://<?php echo CDN_URL ?>/assets/images/icon.png">
</head>

<body>
    <p><br></p>
    <form class="box" method="post">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" autocomplete="username" required>
        <input type="password" name="password" placeholder="Password" autocomplete="password" required>
        <input type="password" name="c_password" placeholder="Confirm Password" autocomplete="password" required>
        <input type="text" name="key" placeholder="Invite" required>

        <button class="submit" type="submit" name="reg">register</button>
        <div class="error">
            <h3 id="errormsg"><?php echo $error ?></h3>
        </div>
    </form>


    <script type="061475e7a149ead4adfff902-text/javascript">
        var element = document.body;
        if (localStorage.getItem("darkmodeprefsenabled") == null) {
            localStorage.setItem("darkmodeprefsenabled", false);
        }
        if (localStorage.getItem("darkmodeprefsenabled") == "true") {
            element.classList.toggle("darkmode");
        }
    </script>
    </div>
    <script src="https://<?php echo CDN_URL ?>/assets/js/loader.js" data-cf-settings="061475e7a149ead4adfff902-|49" defer=""></script>
</body>

</html>