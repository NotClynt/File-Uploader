<?php

include "../../src/config.php";
include "../../src/database.php";
include "../../src/functions.php";

session_start();
if (!isset($_SESSION['username'])) {
     $_SESSION['msg'] = "You must log in first";
     header('location: ../');
}

$username = $_SESSION['username'];


$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$admin = $row['admin'];
if ($admin != 1) {
     header("location: ../");
}

if (isset($_GET['logout'])) {
     session_destroy();
     unset($_SESSION['username']);
     unset_cookie('AUTH_COOKIE');
     header("location: ../");
}

if (isset($_POST["invitewave"])) {
     $sqll = "SELECT * FROM `users`";
     $result = mysqli_query($db, $sqll);
     $rows = mysqli_num_rows($result);
     for ($i = 0; $i < $rows; $i++) {
          $row = mysqli_fetch_assoc($result);
          $inviteauthor = $row["username"];
          $invitecode = ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8);
          $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invitecode . "', '" . $inviteauthor . "');";
          mysqli_query($db, $sql);
     }
     header("location: ../admin/");
}

if (isset($_GET["ban"])) {
     $ban_id = $_GET["ban"];
     $sql = "UPDATE `users` SET `banned`='true' WHERE `id`='$ban_id'";
     if ($result = mysqli_query($db, $sql)) {
          $sql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $sql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row54 = mysqli_fetch_array($userresult)) {
                         $username = $row54["username"];
                         $uuid = $row54["uuid"];
                    }
               }
          }
          $usersql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $usersql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row = mysqli_fetch_array($userresult)) {
                         $user_name = $row["username"];
                         $_SESSION["banmsg"] = "<div class='card' <div class='card-body'><h3 class='card-text' style='color: red;'>Banned $user_name!</h3></div><br>";
                         header("location: ../admin/");
                    }
               }
          }
     } else {
          echo "Failed to Ban User $ban_id";
     }
}
if (isset($_GET["unban"])) {
     $ban_id = $_GET["unban"];
     $sql = "UPDATE `users` SET `banned`='false' WHERE `id`='$ban_id'";
     if ($result = mysqli_query($db, $sql)) {
          $sql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $sql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row54 = mysqli_fetch_array($userresult)) {
                         $username = $row54["username"];
                         $uuid = $row54["uuid"];
                    }
               }
          }
          $usersql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $usersql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row = mysqli_fetch_array($userresult)) {
                         $user_name = $row["username"];
                         $_SESSION["banmsg"] = "<div class='card' <div class='card-body'><h3 class='card-text' style='color: green;'>Unbanned $user_name!</h3></div><br>";
                         header("location: ../admin/");
                    }
               }
          }
     } else {
          die("Failed to Un-Ban User $ban_id");
     }
     header("location: ../admin/");
}

$sql1 = "SELECT * FROM toggles;";
if ($result1 = mysqli_query($db, $sql1)) {
     if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_array($result1)) {
               $maintenance = $row1["maintenance"];
               $allow_uploads = $row1["allow_uploads"];
               $announcement = $row1["announcement"];
          }
     } else {
          die("Not found!");
     }
}

if ($maintenance == "true") {
     $maintenance = "checked";
}
if ($allow_uploads == "true") {
     $allow_uploads = "checked";
}

if (isset($_GET['update-settings'])) {
     if (isset($_POST['maintenance'])) {
          $sql2 = "UPDATE toggles SET `maintenance`='true';";
          $result2 = mysqli_query($db, $sql2);
     }

     if (!isset($_POST['maintenance'])) {
          $sql2 = "UPDATE toggles SET `maintenance`='false';";
          $result2 = mysqli_query($db, $sql2);
     }

     if (isset($_POST['allow_uploads'])) {
          $sql2 = "UPDATE toggles SET `allow_uploads`='true';";
          $result2 = mysqli_query($db, $sql2);
     }

     if (!isset($_POST['allow_uploads'])) {
          $sql2 = "UPDATE toggles SET `allow_uploads`='false';";
          $result2 = mysqli_query($db, $sql2);
     }

     if (isset($_POST['announcement_text'])) {
          $sql2 = "UPDATE toggles SET `announcement`='" . $_POST['announcement_text'] . "';";
          $result2 = mysqli_query($db, $sql2);
     }

     header("location: ../admin/");
}

?>
<!DOCTYPE HTML>
<html>

<head>
     <title><?php echo SERVICE_NAME ?> | Dashboard</title>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/dash.css">
     <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/admin.css">

     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


     <!--mdbootstrap stuff-->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
     <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>

</head>

<body>

     <nav class="navbar navbar-expand-lg text-light">
          <div class="container">
               <span class="navbar-brand mb-0 h1"><?php echo SERVICE_NAME ?></span>
               <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                         <a class="nav-link col-md-4 link-white" href="../">home</a>
                         <a class="nav-link col-md-4 link-white" href="?logout=%271%27">logout</a>
                    </div>
               </div>
          </div>
     </nav>


     <div class="container mt-5">


          <div class="card text-white bg-blur text-center my-3">
               <div class="card-body">
                    <h3 class="card-title">Users</h3>
                    <?php
                    echo "<div class='banmsg'>" . $_SESSION["banmsg"] . "</div>";
                    $sql = "SELECT * FROM `users`";
                    if ($result = mysqli_query($db, $sql)) {
                         if (mysqli_num_rows($result) > 0) {

                              while ($row = mysqli_fetch_array($result)) {
                                   $discord_avatar = $row["discord_avatar"];
                                   if ($row["banned"] == "true") {
                                        $banned = "Banned";
                                        if ($discord_avatar == "https://preview.redd.it/nx4jf8ry1fy51.gif?format=png8&s=a5d51e9aa6b4776ca94ebe30c9bb7a5aaaa265a6") {
                                             $bannedurl = "
                              <hr class='rounded'>
                              <div class='flex'>
                              <p class='flex-child-small'><img src='$discord_avatar' style='width: 60%;'></img></p>
                              <p class='flex-child-small'>Username:<br>" . $row["username"] . "</a></p>
                              <p class='flex-child-small'>ID:<br><a style='color: white;'>" . $row["id"] . "</a></p>
                              <p class='flex-child-small'>Uploads:<br><a style='color: white;'>" . $row["uploads"] . "</a></p>
                              <p class='flex-child-small'><br><a class='btn btn-lg btn-primary' href='?unban=" . $row["id"] . "' style='color: white;'>Unban</a></p>
                              </div>";
                                        } else {
                                             $bannedurl = "
                              <hr class='rounded'>
                              <div class='flex'>
                              <p class='flex-child-small'><img src='$discord_avatar' style='width: 60%;'></img></p>
                              <p class='flex-child-small'>Username:<br>" . $row["username"] . "</a></p>
                              <p class='flex-child-small'>ID:<br><a style='color: white;'>" . $row["id"] . "</a></p>
                              <p class='flex-child-small'>Uploads:<br><a style='color: white;'>" . $row["uploads"] . "</a></p>
                              <p class='flex-child-small'><br><a class='btn btn-lg btn-primary' href='?unban=" . $row["id"] . "' style='color: white;'>Unban</a></p>
                              </div>";
                                        }
                                   } else {
                                        $banned = "Not Banned";
                                        if ($discord_avatar == "https://preview.redd.it/nx4jf8ry1fy51.gif?format=png8&s=a5d51e9aa6b4776ca94ebe30c9bb7a5aaaa265a6") {
                                             $bannedurl = "
                              <hr class='rounded'>
                              <div class='flex'>
                              <p class='flex-child-small'><img src='$discord_avatar' style='width: 60%;'></img></p>
                              <p class='flex-child-small'>Username:<br>" . $row["username"] . "</a></p>
                              <p class='flex-child-small'>ID:<br><a style='color: white;'>" . $row["id"] . "</a></p>
                              <p class='flex-child-small'>Uploads:<br><a style='color: white;'>" . $row["uploads"] . "</a></p>
                              <p class='flex-child-small'><br><a class='btn btn-lg btn-primary' href='?ban=" . $row["id"] . "' style='color: white;'>Ban</a></p>
                              </div>";
                                        } else {
                                             $bannedurl = "
                              <hr class='rounded'>
                              <div class='flex'>
                              <p class='flex-child-small'><img src='$discord_avatar' style='width: 60%;' ></img></p>
                              <p class='flex-child-small'>Username:<br>" . $row["username"] . "</a></p>
                              <p class='flex-child-small'>ID:<br><a style='color: white;'>" . $row["id"] . "</a></p>
                              <p class='flex-child-small'>Uploads:<br><a style='color: white;'>" . $row["uploads"] . "</a></p>
                              <p class='flex-child-small'><br><a class='btn btn-lg btn-primary' href='?ban=" . $row["id"] . "' style='color: white;'>Ban</a></p>
                              </div>";
                                        }
                                   }
                                   echo $bannedurl;
                              }
                         } else {
                              die("Not found!");
                         }
                    }
                    ?>
               </div>
          </div>

          <div class="card text-white bg-blur text-center my-3">
               <div class="card-body">
                    <h3 class="card-title">Invites</h3>
                    <form method='POST' action=''><button type='submit' name='invitewave' class='btn btn-lg btn-primary'>Invitewave</button></form>
               </div>
          </div>

          <div class="card text-white bg-blur text-center my-3">
               <div class="card-body">
                    <h3 class="card-title">Settings</h3>
                    <form action='?update-settings' method='post' name='form' enctype='multipart/form-data'>
                         <div class='flex'>
                              <p class='flex-child-small'><strong>Maintenance:</strong><br><br>
                                   <label class='switch'>
                                        <input name='maintenance' type='checkbox' $maintenance>
                                        <span class='slider round'></span>
                                   </label>
                              </p>
                              <p class='flex-child-small'><strong>Allow Uploads:</strong><br><br>
                                   <label class='switch'>
                                        <input name='allow_uploads' type='checkbox' $allow_uploads>
                                        <span class='slider round'></span>
                                   </label>
                              </p>
                         </div>
                         <br>
                         <hr class='rounded'>
                         <br>
                         <p><strong>Announcement:</strong></p>
                         <div class='form-control'>
                              <center><input type='text' name='announcement_text' id='announcement_text' value='$announcement' placeholder='$announcement'></center>
                         </div>
                         <div class='form-control'>
                              <input type='submit' class='btn btn-lg btn-primary' name='button1' onclick='abfrage(this.form)' value='Save' />
                         </div>
                    </form>
               </div>
          </div>

     </div>
     <script src="https://<?php echo CDN_URL ?>/assets/js/loader.js" defer=""></script>
     <script>
          function abfrage(form) {
               if (form.confirm.checked) {

               } else {

               }
          }
     </script>
</body>

</html>