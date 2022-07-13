<?php

include "../src/config.php";
include "../src/database.php";
include "../src/functions.php";

session_start();
if (!isset($_SESSION['username'])) {
     $_SESSION['msg'] = "You must log in first";
     header('location: ../');
}

if (isset($_GET['logout'])) {
     session_destroy();
     unset($_SESSION['username']);
     unset_cookie('AUTH_COOKIE');
     header("location: ../");
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row["use_embed"] == "true") {

     $useembed = "checked";
} else {

     $useembed = "false";
}

if (isset($_POST['getNewKey'])) {

     $newSecret = generateRandomInt(16);
     $sql = "UPDATE `users` SET `secret` = '$newSecret' WHERE `username` = '" . $_SESSION['username'] . "'";
     $result = mysqli_query($conn, $sql);
     header("location: /");
}

if (isset($_POST['update'])) {
     if (isset($_POST['use_embeds'])) {
          $sql3 = "UPDATE users SET use_embed='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_embeds'])) {
          $sql3 = "UPDATE users SET use_embed='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }


     header("location: /");
}

if (isset($_GET['update-embed']))
{
    if (isset($_POST['embedtitle']) && isset($_POST['embeddesc']) && isset($_POST['embedauthor']) && isset($_POST['colorpicker']))
    {
        $sql = "UPDATE `users` SET `embedtitle` = '" . $_POST['embedtitle'] . "', `embeddesc` = '" . $_POST['embeddesc'] . "', `embedauthor` = '" . $_POST['embedauthor'] . "', `embedcolor` = '" . $_POST['colorpicker'] . "' WHERE `username` = '" . $_SESSION['username'] . "'";
        $result = mysqli_query($db, $sql);
    }
    header("location: /");
}


$sql = "SELECT secret FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$secret = $row['secret'];

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

     <script>
          window.onload = async () => {
               const resp = await axios.get('https://<?php echo API_URL ?>/domains/list')
               this.domains = resp.data.domains

               const listElement = document.getElementById('selectionBox')

               domains.forEach(domain => {
                    const newElement = document.createElement('option')
                    newElement.id = domain.name
                    newElement.innerHTML = domain.name
                    newElement.className = "bg-dark"
                    newElement.value = domains.indexOf(domain)

                    listElement.appendChild(newElement)
               })
          }
     </script>

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
                         <a class="nav-link col-md-4 link-white" href="">profile</a>
                         <a class="nav-link col-md-4 link-white" href="">images</a>
                         <a class="nav-link col-md-4 link-white" href="">paste</a>
                         <a class="nav-link col-md-4 link-white" href="">logout</a>
                    </div>
               </div>
          </div>
     </nav>


     <div class="container mt-5">

          <div class="card text-white bg-blur my-3">
               <div class="card-header">Upload settings</div>
               <div class="card-body">
                    <form class="text-center">

                         <div class="form-outline form-white mb-2">
                              <input type="text" id="subdomainText" class="form-control" />
                              <label class="form-label" for="form1Text1">Subdomain</label>
                         </div>

                         <select id="selectionBox" class="form-select text-white bg-blur mb-4" aria-label="Default select example">
                              <option class="bg-dark" selected>Choose a domain</option>
                         </select>

                         <button onclick="if (!window.__cfRLUnblockHandlers) return false; handleSave()" id="saveButton" type="button" class="btn btn-lg btn-primary" data-cf-modified-0031b96d8dcda876e9f76fb2-="">save</button>

                    </form>
               </div>


          </div>


          <div class="card text-white bg-blur my-3">
               <div class="card-header">Embed settings</div>
               <div class="card-body">
                    <form class="text-center">

                         <div class="d-flex justify-content-center mb-4">
                              <div class="d-flex gap-3 ">

                                   <div class="form-check form-switch">
                                        <form action="?update" method="post" name="form" enctype="multipart/form-data">
                                             <input class="form-check-input" name="use_embeds" type="checkbox" id="embedEnabledTickbox" <?php echo $useembed ?> data-cf-modified-0031b96d8dcda876e9f76fb2-="" />
                                             <label class="form-check-label" for="embedEnabledTickbox">Enable Embeds</label>
                                        </form>
                                   </div>

                              </div>
                         </div>

                         <button type="button" class="btn btn-lg btn-primary" data-mdb-toggle="modal" data-mdb-target="#embeds">Configure</button>

                    </form>
               </div>


          </div>


          <div class="card text-white bg-blur text-center my-3">
               <div class="card-body">
                    <h3 class="card-title">ShareX Key</h3>
                    <h3 id="keyTitle" class="card-title blurredtext"><?php echo $secret ?></h3>
                    <button onclick="generateConfig()" class="btn btn-lg btn-primary" type="button" data-cf-modified-0031b96d8dcda876e9f76fb2-="">Download Config</button>
                    <form method="POST" action="">
                         <button type="submit" name="getNewKey" class="btn btn-lg btn-primary" type="button" data-cf-modified-0031b96d8dcda876e9f76fb2-="">Reset Key</button>
                    </form>
               </div>
          </div>

          <div class="modal fade" id="embeds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                    <div class="card-body px-3 py-4-5">
                         <a style="color: white;">%username</a><a style="color: grey;"> - Displays your Username</a><br>
                         <a style="color: white;">%filename</a><a style="color: grey;"> - Displays the Name of the uploaded File</a><br>
                         <a style="color: white;">%filesize</a><a style="color: grey;"> - Displays the Size of the uploaded File<< /a><br>
                         <a style="color: white;">%id</a><a style="color: grey;"> - Displays your User ID</a><br>
                         <a style="color: white;">%date</a><a style="color: grey;"> - Displays the time when the File was uploaded</a><br>
                         <a style="color: white;">%uploads</a><a style="color: grey;"> - Displays the amount of uploads you have</a>
                    </div>
                    <form action="?update-embed" method="post" name="form" enctype="multipart/form-data">
                         <div class="modal-content text-white bg-dark">
                              <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Embed Settings</h5>
                                   <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                              </div><br>
                              <div class="form-outline form-white mb-2">
                                   <input type="text" name="embedtitle" id="embedtitle" placeholder="<?php echo $row['embedtitle']; ?>" value="<?php echo $row['embedtitle']; ?>" class="form-control" />
                                   <label class="form-label" for="embedTitleField"><?php echo $row['embedtitle']; ?></label>
                              </div>

                              <div class="form-outline form-white mb-2">
                                   <input type="text" name="embeddesc" id="embeddescription" placeholder="<?php echo $row['embeddesc']; ?>" value="<?php echo $row['embeddesc']; ?>" class="form-control" />
                                   <label class="form-label" for="embedDescriptionField"><?php echo $row['embeddesc']; ?></label>
                              </div>

                              <div class="form-outline form-white mb-2">
                                   <input type="text" id="embedAuthorField" name="embedauthor" id="embedauthor" placeholder="<?php echo $row['embedauthor']; ?>" value="<?php echo $row['embedauthor']; ?>" class="form-control" />
                                   <label class="form-label" for="embedAuthorField"><?php echo $row['embedauthor']; ?></label>
                              </div>

                              <div class="form-outline form-white mb-2">
                                   <p1 class="form-control">color</p1>
                                   <input type="color" id="colorpicker" name="colorpicker" value="<?php echo $row['embedcolor']; ?>" class="form-control" style="height: 3em" />
                              </div>

                              <button type="button" data-mdb-dismiss="modal" onclick="abfrage(this.form)" value="Save" data-cf-modified-0031b96d8dcda876e9f76fb2-="">Save</button>
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
  "RequestURL": "https://<?php echo BASE_DOMAIN ?>/api/upload",
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
</body>

</html>