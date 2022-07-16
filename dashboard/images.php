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
                         <a class="nav-link col-md-4 link-white" href="?logout=%271%27">logout</a>
                    </div>
               </div>
          </div>
     </nav>


     <div class="container mt-5">
          <div class="row-new">

               <?php
               // select uploads from users where username = $username
               $sql = "SELECT uploads FROM users WHERE username = '$username'";
               $result = mysqli_query($db, $sql);
               $row = mysqli_fetch_assoc($result);
               $uploads = $row['uploads'];
               if ($uploads == "0") {
                    echo "<div class='card' <div class='card-body'> <br> <p class='card-text'>This is looking pretty empty...</a></p> <br> </div>";
                    die();
               }

               ?>
               <?php
               while ($row = mysqli_fetch_array($result)) {
               ?>
                    <div style="text-align: center;" class='card' <div class='card-body'>
                         <h5 class='card-title' href='<?php echo "https://" . DOMAIN . "/" . $row['filename'] . "'>" . $row['filename'] . " (<a href='?delete=" . $row['filename'] . "&secret=" . $row['delete_secret'] ?>'><svg class="bi" width="1em" height="1em" fill="currentColor">
                              </svg></a>)</h5>
                         <p style="color: grey;" class='card-text'>Original Filename:<br><a style='color: white;'><?php echo $row['original_filename'] ?></a></p>
                         <p style="color: grey;" class='card-text'>Size: <a style='color: white;'><?php echo $row['filesize'] ?></a></p>
                         <p style="color: grey;" class='card-text'>Uploaded at:<br><a style='color: white;'><?php echo $row['uploaded_at']; ?></a></p>
                         <p style="color: grey;" class='card-text'>Url:<br><a href="<?php echo 'https://' . DOMAIN . '/' . $row['filename'] ?>" style="color: white;"><?php echo 'https://' . DOMAIN . '/<br>' . $row['filename'] ?></a></p>
                         <br>
                         <a class="btn btn-lg btn-dark" href='<?php echo "https://" . DOMAIN . "/uploads/$uuid/$username/" . $row['filename'] ?>' download type='button'>Download</a>
                         <a class="btn btn-lg btn-dark" href='<?php echo "?delete=" . $row['filename'] . "&secret=" . $row['delete_secret'] ?>' type='button'>Delete</a>
                    </div>
                    </p>
               <?php
               }
               ?>

          </div>
          <script src="https://<?php echo CDN_URL ?>/assets/js/loader.js" defer=""></script>
</body>

</html>