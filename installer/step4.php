<?php


$phpVersion = phpversion();
if (version_compare($phpVersion, '8.0.0', '<')) {
     die("PHP 8.0.0 or newer is required. $phpVersion does not meet this requirement. Please ask your host to upgrade PHP.");
}

if (isset($_POST['db'])) {

     $host = $_POST['dbHost'];
     $user = $_POST['dbUser'];
     $pass = $_POST['dbPass'];
     $dbname = $_POST['dbName'];

     $database = file_get_contents("../src/database.php");
     $database = str_replace("%host%", $host, $database);
     $database = str_replace("%user%", $user, $database);
     $database = str_replace("%pass%", $pass, $database);
     $database = str_replace("%name%", $dbname, $database);

     $db = new mysqli($host, $user, $pass, $dbname);

     if ($db->connect_error) {
          die("Connection failed: " . $db->connect_error);
     } else {

          file_put_contents("../src/database.php", $database);

          $sql = file_get_contents("../src/database.sql");
          $db->multi_query($sql);
          $db->close();

          unlink("../src/database.sql");

          header("Location: done.php");
     }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width">

     <title>Installer</title>

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