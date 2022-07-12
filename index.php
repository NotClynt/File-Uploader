<?php

include 'src/require.php';

session_start();
if (isset($_SESSION["username"]) && !isset($_GET["f"])) {
     header("location: ./dashboard");
}
?>
<html>
<?php

if (isset($_GET["invite"])) {
     $invitecode = $_GET["invite"];
     $invite = "SELECT * FROM `invites` WHERE `inviteCode`='$invitecode'";
     $result = mysqli_query($db, $invite);
     $row = mysqli_fetch_assoc($result);
     if (mysqli_num_rows($result) > 0) {
          $_SESSION["inviteCode"] = $invitecode;
          $giftAuthor = $row["inviteAuthor"];
          echo "<head>
      <meta name='theme-color' content='" . EMBED_COLOR . "'>
      <meta name='og:site_name' content='https://" . BASE_DOMAIN . "/'>
      <meta property='og:title' content='" . SERVICE_NAME . " | Invite Code' />
      <meta property=og:url content='https://" . BASE_DOMAIN . "/invite/$invitecode' />
      <meta property='og:type' content='website' />
      <meta property='og:description' content='$giftAuthor invited you to " . SERVICE_NAME . "!'/>
      <meta property='og:locale' content='en_GB'/>
      <meta content='https://" . CDN_URL . "/images/invite.png' property='og:image'>
      </head>";
          header("Location: https://" . BASE_DOMAIN . "/");
     } else {
          die("This invite does not exist!");
     }
}


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http" . "://";
function human_filesize($bytes, $decimals)
{
     $size = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
     $factor = floor((strlen($bytes) - 1) / 3);
     return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
}
if (isset($_GET["f"])) {
     $string = $_GET["f"];
     if (strlen($string) > 20) {
          $string = urlencode($string);
          $sql = "SELECT * FROM `uploads` WHERE `hash_filename`='$string'";
          $result = mysqli_query($db, $sql);
          $upload = mysqli_fetch_assoc($result);
          $filename = $upload["filename"];
          $type = strrchr($filename, '.');
          $type = str_replace(".", "", $type);
          $title = $upload['embed_title'];
          $description = $upload['embed_desc'];
          $author = $upload['embed_author'];
          $color = $upload['embed_color'];
          $username = $upload['username'];
          $self_destruct_upload = $upload['self_destruct_upload'];
          $uploaded_at = $upload['uploaded_at'];
          $role = $upload['role'];
          $delete_secret = $upload['delete_secret'];
          $original_filename = $upload['original_filename'];
          $show_filesize = 0;
          $userquery = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $userresult = mysqli_query($db, $userquery);
          $upload432423423 = mysqli_fetch_assoc($userresult);
          $uuid = $upload432423423["uuid"];
          $files = scandir('uploads/' . $uuid . '/' . $username);
          $sql213 = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $views = $upload['views'];
          $result123 = mysqli_query($db, $sql213);
          $result1234 = mysqli_fetch_assoc($result123);
          $banned = $result1234["banned"];
          $upload_background = $result1234["upload_background"];
          $upload_background_toggle = $result1234["upload_background_toggle"];
          $useridentification = $result1234["uuid"];
          header("Location: https://" . BASE_DOMAIN . "/$filename");
          exit;
     } else {
          $type = strrchr($string, '.');
          $type = str_replace(".", "", $type);
          $sql = "SELECT * FROM `uploads` WHERE `filename`='" . $string . "';";
          $result = mysqli_query($db, $sql);
          $upload = mysqli_fetch_assoc($result);
          $filename = $upload["filename"];
          $title = $upload['embed_title'];
          $description = $upload['embed_desc'];
          $author = $upload['embed_author'];
          $color = $upload['embed_color'];
          $username = $upload['username'];
          $self_destruct_upload = $upload['self_destruct_upload'];
          $uploaded_at = $upload['uploaded_at'];
          $role = $upload['role'];
          $delete_secret = $upload['delete_secret'];
          $original_filename = $upload['original_filename'];
          $show_filesize = 0;
          $userquery = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $userresult = mysqli_query($db, $userquery);
          $upload432423423 = mysqli_fetch_assoc($userresult);
          $uuid = $upload432423423["uuid"];
          $files = scandir('uploads/' . $uuid . '/' . $username);
          $sql213 = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $views = $upload['views'];
          $result123 = mysqli_query($db, $sql213);
          $result1234 = mysqli_fetch_assoc($result123);
          $banned = $result1234["banned"];
          $upload_background = $result1234["upload_background"];
          $upload_background_toggle = $result1234["upload_background_toggle"];
          $useridentification = $result1234["uuid"];
     }
     $user_agent = $_SERVER['HTTP_USER_AGENT'];
     if (strpos($user_agent, "Discordbot") && $self_destruct_upload == "true") {
          die("fuck off discord");
     } else {
          $sql = "UPDATE `uploads` SET views = views+1 WHERE filename='" . $_GET['f'] . "';";
          $result = mysqli_query($db, $sql);
     }
     if ($self_destruct_upload == "true" && $views >= 2) {
          if (strpos($user_agent, "Discordbot")) {
               die("fuck off discord");
          } else {
               unlink("/var/www/html/uploads/$uuid/$username/" . $filename);
               $query = "SELECT * FROM users WHERE username='$username'";
               $result = mysqli_query($db, $query);
               if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                         $uploads = "" . $row["uploads"] . "" - 1;
                    }
               } else {
                    echo "0 results";
               }
               $query2 = "UPDATE users SET uploads=$uploads WHERE username='" . $username . "';";
               $results2 = mysqli_query($db, $query2);
               $query43 = "DELETE FROM `uploads` WHERE `delete_secret`='" . $delete_secret . "';";
               $results434343 = mysqli_query($db, $query43);
               die();
          }
     }
     foreach ($files as $file) {
          if ($file == $_GET["f"]) {
               $filesize = human_filesize(filesize('uploads/' . $uuid . '/' . $username . "/" . $upload["filename"]), 2);

?>

               <head>

                    <title><?php SERVICE_NAME; ?>|<?php echo $_GET["f"]; ?></title>
                    <link rel="stylesheet" href="hhttps://<?php CDN_URL ?>/assets/css/cdn.css">
                    <meta charset="UTF-8">
                    <style>
                         .logoname {
                              color: white;
                              text-decoration: none;
                              transition: 1s;
                         }

                         .logoname:hover {
                              text-shadow: 1px 1px 5px #E9897E;
                              transition: 1s;
                         }

                         .main {
                              transition: 1s;
                         }

                         .main:hover {
                              transition: 1s;
                              text-shadow: 1px 1px 5px #E9897E;
                         }
                    </style>
                    <meta name="viewport" content="width=device-width, minimum-scale=0.1">


                    <meta property="og:site_name" content="<?php echo $author; ?>">
                    <meta property="og:title" content="<?php echo $title; ?>">

                    <!-- PNG -->
                    <?php if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg") : ?>
                         <meta name="twitter:card" content="summary_large_image">
                         <meta property="og:description" content="<?php echo $description; ?>">
                         <meta property="twitter:image" content="<?php echo "/uploads/$useridentification/$username/" . $filename; ?>">

                         <!-- WEBM -->
                    <?php elseif ($type == "mp4" || $type == "webm") : ?>
                         <meta name='twitter:card' content='player'>
                         <meta name="twitter:description" content="<?php echo $description; ?>">
                         <meta name='twitter:player' content='<?php echo "/uploads/$useridentification/$username/" . $_GET["f"]; ?>'>
                         <meta name='twitter:player:width' content='1920'>
                         <meta name='twitter:player:height' content='1080'>

                         <!-- ZIP -->
                    <?php elseif ($type == "zip") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - ZIP.png'>

                         <!-- RAR -->
                    <?php elseif ($type == "rar") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - RAR.png'>

                         <!-- TORRENT -->
                    <?php elseif ($type == "torrent") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - U.png'>

                         <!-- EXE -->
                    <?php elseif ($type == "exe") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - EXE.png'>

                         <!-- WAV -->
                    <?php elseif ($type == "wav") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - WAV.png'>

                         <!-- MP3 -->
                    <?php elseif ($type == "mp3") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - MP3.png'>

                         <!-- JS -->
                    <?php elseif ($type == "js") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - JS.png'>

                         <!-- PYTHON -->
                    <?php elseif ($type == "py") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - PYTHON.png'>

                         <!-- CSS -->
                    <?php elseif ($type == "css") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - CSS.png'>

                         <!-- HTML -->
                    <?php elseif ($type == "html") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - HTML.png'>

                         <!-- C# -->
                    <?php elseif ($type == "cs") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php CDN_URL ?>/assets/images/icons/Filetype - C#.png'>


                    <?php else : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>

                    <?php endif; ?>
                    <meta name="theme-color" content="<?php echo $color; ?>">
                    <meta name='og:description' content='<?php echo $description; ?>'>



               </head>

               <?php

               if ($self_destruct_upload == "true") {
                    echo "  <div class='card' <div class='card-body'><h3 class='card-text' style='color: red;'>This upload self destructs if you leave this site</h3></div><br>";
               }
               if ($banned == "true") {
                    echo "
                    <div id='watermark'>
                    <p1><img class='logo' src='https://" . CDN_URL . "/assets/images/icon.png'> <a href='https://" . BASE_DOMAIN . "/' class='logoname'>" . SERVICE_NAME . "</a></p1>
               </div>
               <div class='main'>
                    <div class='upload'>
                         <a href='https://" . BASE_DOMAIN . "/'><img class='image' src='https://" . CDN_URL . "/assets/images/banned.png'></a><br>
                         <p1 class='uploadedby' style='color: white;'>Uploaded by: $username at $uploaded_at </p1>
                    </div>
               </div>";
               } else if ($banned == "false") {
                    echo "
               <div id='watermark'>
                    <p1><img class='logo' src='https://" . CDN_URL . "/assets/images/icon.png'> <a href='" . BASE_DOMAIN . "/' class='logoname'>" . SERVICE_NAME . "</a></p1>
               </div>
               <div class='main'>
                    <div class='upload'>
                         <a href='<?php echo '/uploads/$useridentification/$username/' . $filename; ?>'><img class='image' src='<?php echo '/uploads/$useridentification/$username/' . $filename; ?>'></a><br>
                         <p1 class='uploadedby' style='color: white;'>Uploaded by: $username at $uploaded_at</p1>
                    </div>
               </div>";
               } else if ($upload_logo_toggle == "true") {
                    echo "
                    <div id='watermark'>
                    <p1><img class='logo' src='$upload_logo'> <a href='" . BASE_DOMAIN . "/' class='logoname'>" . SERVICE_NAME . "</a></p1>
               </div>
               <div class='main'>
                    <div class='upload'>
                         <a href='<?php echo '/uploads/$useridentification/$username/' . $filename; ?>'><img class='image' src='<?php echo '/uploads/$useridentification/$username/' . $filename; ?>'></a><br>
                         <p1 class='uploadedby' style='color: white;'>Uploaded by: $username at $uploaded_at</p1>
                    </div>
               </div>";
               }
               ?>
               </body>

     <?php
          }
     }
} else { ?>

     <head>
          <?php
          if (!isset($_GET["invite"])) {
               echo "<meta name='theme-color' content='" . EMBED_COLOR . "'>
            <meta name='og:site_name' content='https://" . BASE_DOMAIN . "/'>
            <meta property='og:title' content='C-Cloud File Uploader' />
            <meta property='og:url' content='https://" . BASE_DOMAIN . "/' />
            <meta property='og:type' content='website' />
            <meta property='og:description' content='" . DESCRIPTION . "' />
            <meta content='https://" . CDN_URL . "/images/invite.png' property='og:image'>";
          }
          ?>
          <!DOCTYPE html>
          <html lang="en">

          <head>
               <meta charset="UTF-8">
               <link rel="icon" href="https://<?php CDN_URL ?>/assets/images/icon.png">
               <title><?php SERVICE_NAME ?></title>
               <meta name="keywords" content="<?php KEYWORDS ?>">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta name="description" content="<?php DESCRIPTION ?>">
               <link rel="stylesheet" href="https://<?php CDN_URL ?>/assets/css/styles.css">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>

     <body>
          <div id="cover-i"></div>

          <div class="image">
               <img src="https://<?php CDN_URL ?>/assets/images/icon.png" alt="" id="logo">
               <br><br>
               <div id="links">
                    <a href="./login/">login</a>
                    <span>/</span>
                    <a href="./register/">register</a>
                    <span>/</span>
                    <a href="<?php DISCORD_INVITE ?>" target="_BLANK">discord</a>
                    <span>/</span>
                    <a id="darkmodeswitch">dark</button>
               </div>
          </div>

          <script src="https://<?php CDN_URL ?>/assets/js/intro.js" type="8ce47bb622587b8a3d5e1594-text/javascript"></script>
          <script type="8ce47bb622587b8a3d5e1594-text/javascript">
               var element = document.body;
               if (localStorage.getItem("darkmodeprefsenabled") == null) {
                    localStorage.setItem("darkmodeprefsenabled", false);
               }
               if (localStorage.getItem("darkmodeprefsenabled") == "true") {
                    var button = document.getElementById("darkmodeswitch");
                    element.classList.toggle("darkmode");
                    button.innerHTML = "light";
               }
               var button = document.getElementById("darkmodeswitch");
               button.onclick = function() {
                    var element = document.body;
                    if (localStorage.getItem("darkmodeprefsenabled") == "true") {
                         button.innerHTML = "dark";
                         element.classList.toggle("darkmode");
                         localStorage.setItem("darkmodeprefsenabled", false);
                    } else if (localStorage.getItem("darkmodeprefsenabled") == "false") {
                         button.innerHTML = "light";
                         element.classList.toggle("darkmode");
                         localStorage.setItem("darkmodeprefsenabled", true);
                    }
               };
          </script>
          <script src="https://<?php CDN_URL ?>/assets/js/loader.js" data-cf-settings="8ce47bb622587b8a3d5e1594-|49" defer=""></script>
     </body>

</html>
<?php
}
?>

</html>