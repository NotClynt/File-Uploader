<?php

include "../src/require.php";

$phpVersion = phpversion();
if (version_compare($phpVersion, '8.0.20', '<')) {
     die("PHP 8.0.20 or newer is required. $phpVersion does not meet this requirement. Please ask your host to upgrade PHP.");
}

session_start();

if (!isset($_SESSION['step1_done'])) {
     header("Location: step1.php");
} else if (!isset($_SESSION['step2_done'])) {
     header("Location: step2.php");
} else if (!isset($_SESSION['step3_done'])) {
     header("Location: step3.php");
}

if (isset($_POST['db'])) {

     $db = $_POST['db'];
     $host = $db['dbHost'];
     $user = $db['dbUser'];
     $pass = $db['dbPass'];
     $dbname = $db['dbName'];

     $database = file_get_contents("../src/database.php");
     $database = str_replace("V_HOST", $host, $database);
     $database = str_replace("V_USER", $user, $database);
     $database = str_replace("V_PASS", $pass, $database);
     $database = str_replace("V_DBNAME", $dbname, $database);

     $db = new mysqli($host, $user, $pass, $dbname);



     // if database connection success
     if ($db->connect_error) {
          die("Connection failed: " . $db->connect_error);
     } else {

          file_put_contents("../src/database.php", $database);

          $sql = file_get_contents("../src/database.sql");
          $db->multi_query($sql);
          $db->close();

          $_SESSION['step3_done'] = true;

          header("Location: done.php");
     }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width">

     <title>Istaller</title>

     <link href="../assets/images/icon.png" rel="shortcut icon" />
     <link href="../assets/css/register.css" rel="stylesheet" type="text/css" />


     <link rel="preconnect" href="https://fonts.gstatic.com/">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&amp;display=swap" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.gstatic.com/">
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&amp;display=swap" rel="stylesheet">

     <style>
          body {
               font-family: 'Roboto', sans-serif;
          }
     </style>

     <img class="logo" src="../assets/images/icon.png">
</head>

<body>
     <p><br></p>
     <form class="box" method="post" action="">

          <h2>Database</h2>
          <input type="text" name="dbHost" placeholder="Database Host" required>
          <input type="text" name="dbUser" placeholder="Database User" required>
          <input type="password" name="dbPass" placeholder="Database Password" required>
          <input type="text" name="dbName" placeholder="Database Name" required>

          <button class="submit" type="submit" name="db">Continue</button>
          <div class="error">
               <h3 id="errormsg"><?php if ($db->connect_error) { echo "Error: " . $db->connect_error; } ?></h3>
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
     <script src="../assets/js/loader.js" data-cf-settings="061475e7a149ead4adfff902-|49" defer=""></script>
</body>

</html>