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

$username = $password = $confirm_password = $invite_code = $email = "";
$username_err = $password_err = $confirm_password_err = $invite_code_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (strlen(trim($_POST["username"])) < 3) {
        $username_err = "Username must have atleast 4 characters.";
    } elseif (strlen(trim($_POST["username"])) > 10) {
        $username_err = "Username is too long.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);

            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }


    if (empty(trim($_POST["invite_code"]))) {
        $invite_code_err = "Please enter an invite code.";
    } else {
        $provided = $_POST["invite_code"];

        $getCode = "SELECT inviteCode FROM invites WHERE code ='{$provided}'";
        $checkCode = "SELECT * FROM invites WHERE inviteCode ='{$provided}'";
        $updateCode = "DELETE FROM invites WHERE inviteCode = '{$provided}'";

        $fetchGetCode = $db->query($getCode);
        $run_fetchGetCode = $fetchGetCode->fetch_assoc();
        $fetchCheckCode = $db->query($checkCode);
        $run_fetchCheckCode = $fetchCheckCode->fetch_assoc();

        $keyQuery = "SELECT * FROM `invites` WHERE `inviteCode`='$provided';";
        $keyResult = mysqli_query($mysqli, $keyQuery);
        $keyRow = mysqli_fetch_array($keyResult);
        $inviter = $keyRow['inviteCode'];

        if ($run_fetchGetCode) {
            if ($run_fetchCheckCode[0] == 1) {
                $invite_code_err = "The code is already used.";
            } else {
                $invite_code_err = "";
            }
        } else {
            $invite_code_err = "The code does not exists.";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($invite_code_err)) {

        $sql = "INSERT INTO users (uuid, username, password, banned, invite, secret, embedcolor, embedauthor, embedtitle, embeddesc, reg_date, use_embed, use_customdomain, self_destruct_upload, filename_type, url_type, uploads, upload_domain, discord_username, discord_id, inviter, last_uploaded, upload_limit, upload_size_limit, upload_logo, upload_logo_toggle) VALUES ('$uuid', ?, ?, 'false', '$provided', '$ranPass', '%embed_color%', '%service_name%', '%filename (%filesize)', 'Uploaded by %username at %date', '$date', 'true', 'false', 'false', 'false', 'short', 'short', 0, '%domain%', 'user#0000', '000000000000000000', '$inviter', 'Could not find Date', '500 MB', '32 MB', 'https://%domain%/assets/images/icon.png', 'false',)";

        if (!file_exists('uploads/' . $uuid)) {
            mkdir('uploads/' . $uuid, 0777, true);
        }

        mysqli_query($mysqli, $updateCode);
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $mysqli->close();
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
    <form class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" autocomplete="username" required>
        <input type="password" name="password" placeholder="Password" autocomplete="password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" autocomplete="password" required>
        <input type="text" name="invite_code" placeholder="invite" required>

        <button class="submit" type="submit">register</button>
        <div class="error">
            <h3 id="errormsg"></h3>
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