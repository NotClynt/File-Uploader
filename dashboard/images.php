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

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$uuid = $row['uuid'];

if (isset($_GET['delete'])) {
     $delfilename = $_GET['delete'];
     if (isset($_GET['secret'])) {
          $query645 = "SELECT delete_secret FROM uploads WHERE filename='$delfilename'";
          $result645 = mysqli_query($db, $query645);
          if (mysqli_num_rows($result645) > 0) {
               while ($row645 = mysqli_fetch_assoc($result645)) {
                    $delete_secret = "" . $row645["delete_secret"] . "";
               }
          } else {
               echo "0 results";
          }
          if ($delete_secret == $_GET['secret']) {
               $sql = "DELETE FROM uploads WHERE filename='" . $_GET['delete'] . "';";
               $result = mysqli_query($db, $sql);
               unlink("../uploads/$uuid/$username/" . $_GET['delete']);
               $sql = "UPDATE users SET uploads=$uploads WHERE username='" . $username . "';";
               $result = mysqli_query($db, $sql);

               header("location: https://". DOMAIN ."/dashboard/images");
          } else {
               die("Wrong Secret!");
          }
     }
}

?>
<!DOCTYPE HTML>
<html>

<head>
     <title><?php echo SERVICE_NAME ?> | Dashboard</title>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/dash.css">
     <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/gallery.css">

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
                         <a class="nav-link col-md-4 link-white" href="#">images</a>
                         <!-- TODO: Do pastes -->
                         <!-- <a class="nav-link col-md-4 link-white" href="pastes">paste</a> -->
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
               // select * from uploads where username = $username
               $sql = "SELECT * FROM uploads WHERE username = '$username'";
               $result = mysqli_query($db, $sql);
               while ($row = mysqli_fetch_array($result)) {
               ?>

                    <div style="text-align: center;" class='card'>
                         <div class='card-body'">
                              <h5 class='card-title'></h5>
                              <img src=" <?php echo "https://" . DOMAIN . "/uploads/$uuid/$username/" . $row['filename'] ?>" alt="<?php echo $row['filename'] ?>" class='card-img-top'>
                              <p style="color: #000000;" class='card-text'>Url:<br><a href="<?php echo 'https://' . DOMAIN . '/' . $row['filename'] ?>" style="color: #000000;"><?php echo 'https://' . DOMAIN . '/<br>' . $row['filename'] ?></a></p>
                              <br>
                              <a class="btn btn-lg btn-dark" href='<?php echo "https://" . DOMAIN . "/uploads/$uuid/$username/" . $row['filename'] ?>' download type='button'>Download</a>
                              <a class="btn btn-lg btn-dark" href='<?php echo "?delete=" . $row['filename'] . "&secret=" . $row['delete_secret'] ?>' type='button'>Delete</a>
                         </div>
                    </div>

               <?php
               }
               ?>

          </div>
          <script src="https://<?php echo CDN_URL ?>/assets/js/loader.js" defer=""></script>
</body>

</html>