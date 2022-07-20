<?php

include "../src/config.php";
include "../src/database.php";
include "../src/functions.php";

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
     header("location: ../");
     exit;
}

$username = $_SESSION['username'];

if (isset($_GET['update-settings'])) {
     if (isset($_POST['use_customdomain'])) {
          $sql3 = "UPDATE users SET use_customdomain='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (!isset($_POST['use_customdomain'])) {
          $sql3 = "UPDATE users SET use_customdomain='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }


     if (isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     header("location: /");
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
if ($embed["use_customdomain"] == "true") {

     $usecustomdomain = "checked";
} else {

     $usecustomdomain = "false";
}

if ($embed["use_invisible_url"] == "true") {

     $invisible_url = "checked";
} else {

     $invisible_url = "false";
}
if ($embed["filename_type"] == "long") {

     $uselongfilename = "checked";
} else {

     $uselongfilename = "false";
}

if ($embed["url_type"] == "long") {

     $uselongurl = "checked";
} else {

     $uselongurl = "false";
}
if ($embed["self_destruct_upload"] == "true") {

     $self_destruct_upload = "checked";
} else {

     $self_destruct_upload = "false";
}

if ($embed["use_emoji_url"] == "true") {

     $emoji_url = "checked";
} else {

     $emoji_url = "false";
}

if ($embed["use_sus_url"] == "true") {

     $use_sus_url = "checked";
} else {

     $use_sus_url = "false";
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
if ($row["use_embed"] == "true") {

     $useembed = "checked";
} else {

     $useembed = "false";
}

if (isset($_POST['getNewKey'])) {

     $newSecret = generateRandomInt(16);
     $sql = "UPDATE `users` SET `secret` = '$newSecret' WHERE `username` = '" . $_SESSION['username'] . "'";
     $result = mysqli_query($db, $sql);
     header("location: /");
}

if (isset($_POST['enable-embed'])) {
     $sql = "UPDATE users SET use_embed='true' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);

     header("location: /");
}

if (isset($_POST['disable-embed'])) {
     $sql = "UPDATE users SET use_embed='false' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);

     header("location: /");
}



if (isset($_GET['update-embed'])) {
     if (isset($_POST['embedtitle']) && isset($_POST['embeddesc']) && isset($_POST['embedauthor']) && isset($_POST['colorpicker'])) {
          $sql = "UPDATE `users` SET `embedtitle` = '" . $_POST['embedtitle'] . "', `embeddesc` = '" . $_POST['embeddesc'] . "', `embedauthor` = '" . $_POST['embedauthor'] . "', `embedcolor` = '" . $_POST['colorpicker'] . "' WHERE `username` = '" . $_SESSION['username'] . "'";
          $result = mysqli_query($db, $sql);
     }
     header("location: /");
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);

$sql = "SELECT secret FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$secret = $row['secret'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$rows = mysqli_fetch_assoc($result);
$subdomain = $rows['subdomain'];
$selecteddomain = $rows['domain'];

if (isset($_POST['update-domain'])) {
     $sql = "UPDATE users SET subdomain='" . $_POST['subdomain'] . "' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);
     $sql = "UPDATE users SET domain='" . $_POST['selecteddomain'] . "' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);
     $sql = "UPDATE users SET upload_domain='" . $_POST['subdomain'] . "." . $_POST['selecteddomain'] . "' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);
     header("location: /");
}

?>
<!DOCTYPE HTML>
<html>

<head>
     <title><?php echo SERVICE_NAME ?> | Dashboard</title>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/dash.css">

     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


     <!--mdbootstrap stuff-->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
     <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

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
                         <a class="nav-link col-md-4 link-white" onclick="showinvites()">invites</a>
                         <a class="nav-link col-md-4 link-white" href="images">images</a>
                         <!-- TODO: Do pastes -->
                         <!-- <a class="nav-link col-md-4 link-white" href="pastes">paste</a> -->
                         <a class="nav-link col-md-4 link-white" href="logout">logout</a>
                    </div>
               </div>
          </div>
     </nav>


     <div class="container mt-5">

          <div class="card text-white bg-blur my-3">
               <div class="card-header">Upload settings</div>
               <div class="card-body">
                    <form class="text-center" method="POST">

                         <div class="form-outline form-white mb-2">
                              <label class="label">Subdomain</label>
                              <input type="text" name="subdomain" class="form-control" value="<?php echo $subdomain ?>" />
                         </div>

                         <label class="label">Domain</label>
                         <select name="selecteddomain" class="form-select text-white bg-blur mb-4" aria-label="Default select example">
                              <option class="bg-dark" value="<?php echo $selecteddomain ?>" selected><?php echo $selecteddomain ?></option>
                              <?php
                              $sql = "SELECT name FROM domains";
                              $result = mysqli_query($db, $sql);
                              while ($row = mysqli_fetch_assoc($result)) {
                                   echo "<option class='bg-dark'>" . $row['name'] . "</option>";
                              }
                              ?>
                         </select>

                         <button name="update-domain" type="submit" class="btn btn-lg btn-primary">save</button>

                    </form>
               </div>


          </div>


          <div class="card text-white bg-blur my-3">
               <div class="card-header">Embed settings</div>
               <div class="card-body">
                    <form class="text-center" action="" method="post">

                         <?php
                         $sql = "SELECT * FROM users WHERE username='$username';";
                         $result = mysqli_query($db, $sql);
                         $roww = mysqli_fetch_assoc($result);
                         if ($roww["use_embed"] == "true") { ?>
                              <button type="button" class="btn btn-lg btn-primary" data-mdb-toggle="modal" data-mdb-target="#embeds">Configure</button>
                              <button class="btn btn-lg btn-primary" type="submit" name="disable-embed">Disable Embeds</button>
                         <?php } else { ?>
                              <button class="btn btn-lg btn-primary" type="submit" name="enable-embed">Enable Embeds</button>
                         <?php } ?>

                    </form>
               </div>
          </div>

          <div class="card text-white bg-blur my-3">
               <div class="card-header">Settings</div>
               <div class="card-body">
                    <form action="?update-settings" method="post" name="form" enctype="multipart/form-data">

                         <!-- CUSTOM DOMAIN -->
                         <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" <?php echo $usecustomdomain ?> name="use_customdomain">
                              <label class="custom-control-label" for="customCheck1">Custom Domain</label>
                         </div>

                         <!-- INVISIBLE URL -->
                         <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="use_invisible_url" <?php echo $invisible_url ?>>
                              <label class="custom-control-label" for="customCheck2">Invisible URL</label>
                         </div>

                         <!-- EMOJI URL -->
                         <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="use_emoji_url" <?php echo $emoji_url ?>>
                              <label class="custom-control-label" for="customCheck3">Emoji URL</label>
                         </div>

                         <!-- AMONGUS URL -->
                         <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="use_sus_url" <?php echo $use_sus_url ?>>
                              <label class="custom-control-label" for="customCheck3">AmongUs URL</label>
                         </div>

                         <!-- LONG FILENAME -->
                         <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="filename_type" <?php echo $uselongfilename ?>>
                              <label class="custom-control-label" for="customCheck3">Long filename</label>
                         </div>

                         <!-- RAW URL -->
                         <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="url_type" <?php echo $uselongurl ?>>
                              <label class="custom-control-label" for="customCheck3">Raw URL</label>
                         </div>

                         <!-- SELF DESTRUCT UPLOAD -->
                         <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="self_destruct_upload" <?php echo $self_destruct_upload ?>>
                              <label class="custom-control-label" for="customCheck3">Self destruct upload</label>
                         </div>

                         <input type="submit" class="btn btn-lg btn-primary" name="button1" onclick="abfrage(this.form)" value="Save" />

                    </form>
               </div>


          </div>


          <div class="card text-white bg-blur text-center my-3">
               <div class="card-body">
                    <h3 class="card-title">ShareX Key</h3>
                    <h3 id="keyTitle" class="card-title blurredtext"><?php echo $secret ?></h3>
                    <button onclick="generateConfig()" class="btn btn-lg btn-primary" type="button" data-cf-modified-0031b96d8dcda876e9f76fb2-="">Download Config</button><br><br>
                    <form method="POST" action="">
                         <button type="submit" name="getNewKey" class="btn btn-lg btn-primary" type="button" data-cf-modified-0031b96d8dcda876e9f76fb2-="">Reset Key</button>
                    </form>
               </div>
          </div>

          <div class="modal fade" id="embeds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                    <form action="?update-embed" method="post" name="form" enctype="multipart/form-data">
                         <div class="modal-content text-white bg-dark">
                              <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Embed Settings</h5>
                                   <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                              </div><br>
                              <div class="form-outline form-white mb-2">
                                   <input type="text" name="embedtitle" id="embedtitle" value="<?php echo $embed['embedtitle']; ?>" class="form-control" />
                                   <label class="form-label" for="embedtitle"><?php echo $embed['embedtitle']; ?></label>
                              </div>

                              <div class="form-outline form-white mb-2">
                                   <input type="text" name="embeddesc" id="embeddescription" value="<?php echo $embed['embeddesc']; ?>" class="form-control" />
                                   <label class="form-label" for="embeddesc"><?php echo $embed['embeddesc']; ?></label>
                              </div>

                              <div class="form-outline form-white mb-2">
                                   <input type="text" name="embedauthor" id="embedauthor" value="<?php echo $embed['embedauthor']; ?>" class="form-control" />
                                   <label class="form-label" for="embedauthor"><?php echo $embed['embedauthor']; ?>.</label>
                              </div>

                              <div class="form-outline form-white mb-2">
                                   <p1 class="form-control">color</p1>
                                   <input type="color" value="<?php echo $embed['embedcolor']; ?>" id="colorpicker" name="colorpicker" class="form-control" style="height: 3em" />
                              </div>

                              <input type="submit" class="btn btn-lg btn-primary"" name=" button1" onclick="abfrage(this.form)" value="Save" />
                              <!-- <button class="btn btn-lg btn-primary" type="button" data-mdb-dismiss="modal">Save</button> -->

                              <!-- TODO: Add dropdown -->
                              <div class="card-body px-3 py-4-5">
                                   <a style="color: white;">%username</a><a style="color: grey;"> - Displays your Username</a><br>
                                   <a style="color: white;">%filename</a><a style="color: grey;"> - Displays the Name of the uploaded File</a><br>
                                   <a style="color: white;">%filesize</a><a style="color: grey;"> - Displays the Size of the uploaded File<< /a><br>
                                             <a style="color: white;">%id</a><a style="color: grey;"> - Displays your User ID</a><br>
                                             <a style="color: white;">%date</a><a style="color: grey;"> - Displays the time when the File was uploaded</a><br>
                                             <a style="color: white;">%uploads</a><a style="color: grey;"> - Displays the amount of uploads you have</a>
                              </div>
                         </div>
                    </form>
               </div>
          </div>


     </div>
     <script src="https://<?php echo CDN_URL ?>/assets/js/loader.js" defer=""></script>
     <script>
          function download(filename, text) {
               var element = document.createElement('a');
               element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
               element.setAttribute('download', filename);

               element.style.display = 'none';
               document.body.appendChild(element);

               element.click();

               document.body.removeChild(element);
          }

          function generateConfig() {
               var text = `{
  "Version": "<?php echo SERVICE_VERSION ?>",
  "Name": "<?php echo SERVICE_NAME ?> - <?php echo $_SESSION['username']; ?>",
  "DestinationType": "ImageUploader, FileUploader",
  "RequestMethod": "POST",
  "RequestURL": "https://c-cloud.rocks/api/upload",
  "Parameters": {
    "secret": "<?php echo $secret ?>",
    "use_sharex": "true"
  },
  "Body": "MultipartFormData",
  "FileFormName": "file"
}`;

               var filename = "<?php echo SERVICE_NAME ?>-<?php echo $_SESSION['username']; ?>.sxcu";
               setTimeout(() => {
                    download(filename, text);
               }, 1000)
          }
     </script>

     <script>
          function abfrage(form) {
               if (form.confirm.checked) {

               } else {

               }
          }
     </script>



     <script>
          function showinvites() {
               <?php
               $sql = "SELECT * FROM invites WHERE inviteAuthor = '$username'";
               $result = mysqli_query($db, $sql);
               $inviteCode = $row["inviteCode"];
               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         $inviteCode = $row["inviteCode"];

               ?>
                         Swal.fire({
                              title: '<span style="color: white">Invites<span>',
                              background: 'blue',
                              html: '<span style="color: white"> <?php echo $inviteCode . "<br>"; ?> <span>',
                         })
               <?php }
               } ?>
          }
     </script>
</body>

</html>