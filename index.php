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
      <meta name='theme-color' content='". EMBED_COLOR ."'>
      <meta name='og:site_name' content='https://". BASE_DOMAIN ."/'>
      <meta property='og:title' content='". SERVICE_NAME ." | Invite Code' />
      <meta property=og:url content='https://". BASE_DOMAIN ."/invite/$invitecode' />
      <meta property='og:type' content='website' />
      <meta property='og:description' content='$giftAuthor invited you to ". SERVICE_NAME ."!'/>
      <meta property='og:locale' content='en_GB'/>
      <meta content='https://". CDN_URL ."/images/invite.png' property='og:image'>
      </head>";
          header("Location: https://". BASE_DOMAIN ."/");
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
          header("Location: https://". BASE_DOMAIN ."/$filename");
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
                    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
                    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="apple-mobile-web-app-capable" content="yes" />

                    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
                    <link rel="stylesheet" type="text/css" href="./assets/css/util.css">
                    <link rel="stylesheet" type="text/css" href="./assets//css/main.css">
                    <script src="./assets/js/main.js"></script>
                    <title><?php echo $_GET["f"]; ?></title>
                    <meta property="og:type" content="website">
                    <meta name='og:site_name' content='<?php echo $author; ?>'>
                    <meta name='twitter:title' content='<?php echo $title; ?>'>
                    <?php if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:image' content='<?php echo "/uploads/$useridentification/$username/" . $filename; ?>'>
                    <?php
                    elseif ($type == "mp4" || $type == "webm") : ?>
                         <meta name='twitter:card' content='player'>
                         <meta name="twitter:description" content="<?php echo $description; ?>">
                         <meta name='twitter:player' content='<?php echo "https://". BASE_DOMAIN ."/uploads/$useridentification/$username/" . $_GET["f"]; ?>'>
                         <meta name='twitter:player:width' content='1920'>
                         <meta name='twitter:player:height' content='1080'>
                    <?php
                    elseif ($type == "zip") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://2.bp.blogspot.com/-y7kOjodOxZ4/WwN4y6vH1KI/AAAAAAAABc0/svTSsHj8DIgIcg0Iz3FZrxlTB_WI5tnBACLcBGAs/s1600/Filetype%2B-%2BZIP.png'>
                    <?php
                    elseif ($type == "rar") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://cdn.iconscout.com/icon/free/png-512/winrar-3-569260.png'>
                    <?php
                    elseif ($type == "torrent") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://storage.googleapis.com/multi-static-content/previews/artage-io-thumb-85273b178575b7f4a314356a42d61a1f.png'>
                    <?php
                    elseif ($type == "exe") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://aux2.iconspalace.com/uploads/448592549.png'>
                    <?php
                    elseif ($type == "wav") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://icons-for-free.com/iconfiles/png/512/file+format+wav+icon-1320184498602933828.png'>
                    <?php
                    elseif ($type == "mp3") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://cdn.discordapp.com/attachments/811038560240795678/833604882702663720/HF_9d-G7DKJl1cVG5DZM-ZOV6KlrJzMhIWC7R9-wwRtyQdlcrOm0zhyXFmRHm0PUKayJbzKXNCo1NyQvV2nXyOLTBKbzsXAnJ_B4.png'>
                    <?php
                    elseif ($type == "js") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://raw.githubusercontent.com/voodootikigod/logo.js/master/js.png'>
                    <?php
                    elseif ($type == "py") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://stickler.de/images/2000px-Python-logo-notext.png'>
                    <?php
                    elseif ($type == "css") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://cdn.iconscout.com/icon/free/png-256/css-118-569410.png'>
                    <?php
                    elseif ($type == "html") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://images.vexels.com/media/users/3/166383/isolated/preview/6024bc5746d7436c727825dc4fc23c22-html-programmiersprachen-symbol-by-vexels.png'>
                    <?php
                    elseif ($type == "cs") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://sharobella.at/images/icons/15935290281.png'>

                    <?php
                    else : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                    <?php
                    endif; ?>
                    <meta name='theme-color' content='<?php echo $color; ?>'>
                    <meta name='og:description' content='<?php echo $description; ?>'>
               </head>

               <body>
                    <div class="loader-wrapper">
                         <span class="loader"><span class="loader-inner"></span></span>
                    </div>

                    <div id='body_div'>
                         <style>
                              .hljs {
                                   display: block;
                                   overflow-x: auto;
                                   padding: .5em;
                                   background: #131313;
                                   border-radius: 15px;
                                   text-align: left;
                                   color: #fff;
                              }

                              /* Style buttons */
                              .g-recaptcha {
                                   padding: 12px 30%;
                              }

                              /* Darker background on mouse-over */
                              .btn32143:hover {
                                   background-color: grey;
                              }
                         </style>
                         <?php
                         if ($upload_background_toggle == "true") {
                              echo "<div class='bg-image'></div><div class='container-login100' style='background: 0;z-index: 2;position: absolute;  top: 0%;
            left: 0%;'>";
                         } else {
                              echo "<div class='container-login100'>";
                         }
                         ?>
                         <style>
                              .bg-image {
                                   /* The image used */
                                   background-image: url(<?php echo $upload_background ?>);

                                   /* Add the blur effect */
                                   filter: blur(6px);
                                   -webkit-filter: blur(6px);

                                   /* Full height */
                                   height: 100%;

                                   /* Center and scale the image nicely */
                                   background-position: center;
                                   background-repeat: no-repeat;
                                   background-size: cover;
                              }

                              .flex {
                                   display: -webkit-box;
                                   display: -moz-box;
                                   display: -ms-flexbox;
                                   display: -webkit-flex;
                                   display: flex;
                              }

                              .flex-child-small {
                                   -webkit-box-flex: 1 1 auto;
                                   -moz-box-flex: 1 1 auto;
                                   -webkit-flex: 1 1 auto;
                                   -ms-flex: 1 1 auto;
                                   flex: 1 1 auto;
                                   margin: 10px;
                                   font-size: 20px;
                                   border-radius: 15px;
                                   width: 100px;
                                   height: auto;
                                   font-family: Arial, sans-serif;
                                   font-size: 14px;
                                   line-height: 1.7;
                                   color: #666666;
                                   text-align: center;
                              }

                              p {
                                   font-family: Arial, sans-serif;
                                   font-size: 14px;
                                   line-height: 1.7;
                                   color: #666666;
                                   margin: 10px 50px 0px 10px;

                              }

                              .wrap-login100 {
                                   width: 700px;
                                   background: #1b1b1b;
                                   border-radius: 20px;
                                   overflow: hidden;
                                   padding: 33px 33px 33px 33px;
                                   box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                              }

                              .btn32143 {
                                   background-color: #131313;
                                   padding: 12px 50px;
                                   cursor: pointer;
                                   font-size: 20px;
                                   border-radius: 15px;
                                   color: white;
                                   width: 300px;
                                   position: relative;
                                   align-self: center;
                                   margin: 30px;
                                   box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                              }

                              .card {
                                   position: relative;
                                   display: -ms-flexbox;
                                   display: flex;
                                   -ms-flex-direction: column;
                                   flex-direction: column;
                                   word-wrap: break-word;
                                   background-color: #131313;
                                   background-clip: border-box;
                                   border: 1px solid rgba(0, 0, 0, .125);
                                   border-radius: 15px;
                              }

                              .card {
                                   position: relative;
                                   display: -ms-flexbox;
                                   display: flex;
                                   -ms-flex-direction: column;
                                   flex-direction: column;
                                   min-width: 0px;
                                   width: auto;
                                   height: auto;
                                   word-wrap: break-word;
                                   background-color: #131313;
                                   background-clip: border-box;
                                   border: 2px solid rgba(0, 0, 0, .125);
                                   border-radius: 15px;
                                   padding: 15px;
                                   margin: 10px 10px 10px 10px;
                                   box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                              }

                              .wrap-login100 {
                                   width: auto;
                                   background: #1b1b1b;
                                   border-radius: 20px;
                                   overflow: hidden;
                                   padding: 33px 33px 33px 33px;
                                   box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                              }

                              .swal2-popup {
                                   display: none;
                                   position: relative;
                                   box-sizing: border-box;
                                   flex-direction: column;
                                   justify-content: center;
                                   width: 45em;
                                   max-width: 100%;
                                   padding: 1.25em;
                                   border: none;
                                   border-radius: 15px;
                                   background: #232323;
                                   font-family: inherit;
                                   font-size: 1rem;
                                   box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                              }

                              .swal2-styled.swal2-confirm {
                                   border: 0;
                                   border-radius: 10px;
                                   background: initial;
                                   background-color: #191919;
                                   color: #fff;
                                   font-size: 1.0625em;
                                   box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                              }

                              .swal2-popup.swal2-toast {
                                   flex-direction: row;
                                   align-items: center;
                                   width: auto;
                                   padding: 0.625em;
                                   overflow-y: hidden;
                                   background: #19191a;
                                   box-shadow: 0 0 0.625em black;
                              }

                              .row-card {
                                   display: inline-block;
                                   vertical-align: middle;
                              }

                              .wrap-login100 {
                                   width: 560px;
                                   background: #1b1b1b;
                                   border-radius: 20px;
                                   overflow: hidden;
                                   padding: 5px 5px 25px 5px;
                                   box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
                                   -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
                                   -webkit-box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
                                   -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
                                   -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
                              }

                              .p-b-26 {
                                   padding-bottom: 0px;
                              }

                              .flex {
                                   display: -webkit-box;
                                   display: -moz-box;
                                   display: -ms-flexbox;
                                   display: -webkit-flex;
                                   display: flex;
                              }

                              .flex-child-small {
                                   -webkit-box-flex: 1 1 auto;
                                   -moz-box-flex: 1 1 auto;
                                   -webkit-flex: 1 1 auto;
                                   -ms-flex: 1 1 auto;
                                   flex: 1 1 auto;
                                   margin: 10px;
                                   font-size: 20px;
                                   border-radius: 15px;
                                   width: 100px;
                                   height: auto;
                                   font-family: Arial, sans-serif;
                                   font-size: 14px;
                                   line-height: 1.7;
                                   color: #666666;
                                   text-align: center;
                              }

                              .btn32143 {
                                   background-color: #131313;
                                   color: white;
                                   padding: 12px 50px;
                                   cursor: pointer;
                                   font-size: 20px;
                                   border-radius: 15px;
                              }

                              hr.rounded {
                                   border-top: 2px solid #1b1b1b;
                                   border-radius: 5px;
                              }
                         </style>

                         <div class="wrap-login100" style="filter: opacity(0.98); box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);">
                              <!-- notification message -->
                              <span class="login100-form-title p-b-26">
                                   <div class="card">
                                        <?php
                                        if ($self_destruct_upload == "true") {
                                             echo "
                  <div class='card' <div class='card-body'><h3 class='card-text' style='color: red;'>This upload self destructs if you leave this site</h3></div><br>
                  <hr class='rounded'>
                  <br>";
                                        }
                                        if ($banned == "true") {
                                             echo "<div class='flex'>
                     <p class='flex-child-small' style='color: white'>This user is banned from ". SERVICE_NAME .".</p>
                  </div>";
                                             die();
                                        } else if ($banned == "false") {
                                             echo "<div class='flex'>
                     <p class='flex-child-small' style='color: white'><strong>Uploader:</strong><br>$username ($role)</p>
                     <p class='flex-child-small' style='color: white'><strong>File Name:</strong><br>" . $_GET['f'] . "</p>
                  </div>
                  <div class='flex'>
                        <p class='flex-child-small'><a style='color: white; font-family: Arial, sans-serif;'><strong>File Size:</strong><br>$filesize</a></p>
                        <p class='flex-child-small' style='color: white; font-family: Arial, sans-serif;'><strong>Original File Name:</strong><br>" . $original_filename . "</p>
                  </div>
                  <div class='flex'>
                        <p class='flex-child-small' ><a style='color: white; font-family: Arial, sans-serif;'><strong>Uploaded at:</strong><br>$uploaded_at</a></p>
                        <p class='flex-child-small' ><a style='color: white; font-family: Arial, sans-serif;'><strong>Views:</strong><br>$views</a></p>
                  </div>
                  
                  <br><hr class='rounded'><br>
                  ";
                                             if ($type == 'png' || $type == 'gif' || $type == 'jpeg' || $type == 'jpg') {
                                                  $path = 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'];
                                                  echo "<div class='img-container'>
                        <a href='https://". BASE_DOMAIN ."/" . 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'] . "'> <img src='https://". BASE_DOMAIN ."/" . 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'] . "'></img></a>
                     </div>";
                                             } else if ($type == "mp4") {
                                                  echo "<style>
                        .wrap-login100 {
                           width: auto;
                           background: #1b1b1b;
                           border-radius: 20px;
                           overflow: hidden;
                           padding: 33px 33px 33px 33px;
                           box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
                           -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
                           -webkit-box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
                           -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
                           -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
                        }
                     </style>
                  <div class='video-container'>
                     <video width='640' height='480' controls>
                        <source src='/uploads/$uuid/$username/" . $_GET['f'] . "' type='video/mp4'>
                     </video>
                  </div>";
                                             }
                                        }

                                        ?>
                                        <?php if ($type == 'png' || $type == 'gif' || $type == 'jpeg' || $type == 'jpg') : ?>
                                             <span>

                                             <?php
                                        elseif ($type == "mov" || $type == "MOV" && $banned == "false") : ?>
                                                  <style>
                                                       .wrap-login100 {
                                                            width: auto;
                                                            background: #1b1b1b;
                                                            border-radius: 20px;
                                                            overflow: hidden;
                                                            padding: 33px 33px 33px 33px;
                                                            box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                                                       }
                                                  </style>
                                                  <div class="video-container">
                                                       <video width="640" height="480" controls>
                                                            <source src="<?php echo '/' . 'uploads/' . $uuid . '/' . $username . '/' . $_GET['f'] ?>" type="video/mov">
                                                       </video>
                                                  </div>

                                             <?php
                                        elseif ($type == "webm" && $banned == "false") : ?>
                                                  <style>
                                                       .wrap-login100 {
                                                            width: auto;
                                                            background: #1b1b1b;
                                                            border-radius: 20px;
                                                            overflow: hidden;
                                                            padding: 33px 33px 33px 33px;
                                                            box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                                                       }
                                                  </style>
                                                  <div class="video-container">
                                                       <video width="640" height="480" controls>
                                                            <source src="<?php echo "/" . 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'] ?>" type="video/webm">
                                                       </video>
                                                  </div>
                                             <?php
                                        elseif ($type == "mp3" && $banned == "false") : ?>
                                                  <style>
                                                       .wrap-login100 {
                                                            width: auto;
                                                            background: #1b1b1b;
                                                            border-radius: 20px;
                                                            overflow: hidden;
                                                            padding: 33px 33px 33px 33px;
                                                            box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                                                       }
                                                  </style>
                                                  <div class="audio-container">
                                                       <br>
                                                       <audio controls>
                                                            <source src="<?php echo "/" . 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'] ?>" type="audio/mp3">
                                                       </audio>
                                                  </div>
                                             <?php
                                        elseif ($type == "ogg" && $banned == "false") : ?>
                                                  <style>
                                                       .wrap-login100 {
                                                            width: auto;
                                                            background: #1b1b1b;
                                                            border-radius: 20px;
                                                            overflow: hidden;
                                                            padding: 33px 33px 33px 33px;
                                                            box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                                                       }
                                                  </style>
                                                  <div class="audio-container">
                                                       <br>
                                                       <audio controls>
                                                            <source src="<?php echo "/" . 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'] ?>" type="audio/ogg">
                                                       </audio>
                                                  </div>
                                             <?php
                                        elseif ($type == "wav" && $banned == "false") : ?>
                                                  <style>
                                                       .wrap-login100 {
                                                            width: auto;
                                                            background: #1b1b1b;
                                                            border-radius: 20px;
                                                            overflow: hidden;
                                                            padding: 33px 33px 33px 33px;
                                                            box-shadow: 0 1px 100px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
                                                       }
                                                  </style>
                                                  <div class="audio-container">
                                                       <br>
                                                       <audio controls>
                                                            <source src="<?php echo "/" . 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'] ?>" type="audio/wav">
                                                       </audio>
                                                  </div>
                                             <?php
                                        endif; ?>
                                             </span>
                                             <!-- Block parent element -->
                                   </div>
                                   <br>
                                   <a class='btn32143' style='font-family: Arial, sans-serif;' href='/<?php echo 'uploads/' . $uuid . '/' . $username . "/" . $_GET['f'] ?>' download><strong>Download</strong></a>
                         </div>
                         </span>
                    </div>
                    </div>

                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
                    <script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>
               </body>
     <?php
          }
     }
} else { ?>

     <head>
          <?php
          if (!isset($_GET["invite"])) {
               echo "<meta name='theme-color' content='". EMBED_COLOR ."'>
            <meta name='og:site_name' content='https://". BASE_DOMAIN ."/'>
            <meta property='og:title' content='C-Cloud File Uploader' />
            <meta property='og:url' content='https://". BASE_DOMAIN ."/' />
            <meta property='og:type' content='website' />
            <meta property='og:description' content='A Free File Uploader for all of your Files.' />
            <meta property='og:locale' content='en_GB' />
            <meta content='https://". CDN_URL ."/images/invite.png' property='og:image'>";
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