<?php


$phpVersion = phpversion();
if (version_compare($phpVersion, '8.0.0', '<')) {
     die("PHP 8.0.0 or newer is required. $phpVersion does not meet this requirement. Please ask your host to upgrade PHP.");
}


if(isset($_POST['css'])) {

     $firstcolor = $_POST['firstcolor'];
     $secondcolor = $_POST['secondcolor'];

     $style = file_get_contents("../assets/css/styles.css");
     $style = str_replace("%firstcolor%", $service_name, $style);
     $style = str_replace("%secondcolor%", $service_description, $style);
     file_put_contents("../assets/css/styles.css", $style);

     $style = file_get_contents("../assets/css/register.css");
     $style = str_replace("%firstcolor%", $service_name, $style);
     $style = str_replace("%secondcolor%", $service_description, $style);
     file_put_contents("../assets/css/register.css", $style);

     $style = file_get_contents("../assets/css/login.css");
     $style = str_replace("%firstcolor%", $service_name, $style);
     $style = str_replace("%secondcolor%", $service_description, $style);
     file_put_contents("../assets/css/login.css", $style);

     $style = file_get_contents("../assets/css/dash.css");
     $style = str_replace("%firstcolor%", $service_name, $style);
     $style = str_replace("%secondcolor%", $service_description, $style);
     file_put_contents("../assets/css/dash.css", $style);

     $style = file_get_contents("../assets/css/cdn.css");
     $style = str_replace("%firstcolor%", $service_name, $style);
     $style = str_replace("%secondcolor%", $service_description, $style);
     file_put_contents("../assets/css/cdn.css", $style);


     header("Location: step4.php");

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

          <h2>Style</h2>
          <input type="text" name="firstcolor" placeholder="First Color" required>
          <input type="text" name="secondcolor" placeholder="Second Color" required>

          <button class="submit" type="submit" name="css">Continue</button>
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
     <script src="../assets/js/loader.js" data-cf-settings="061475e7a149ead4adfff902-|49" defer=""></script>
</body>

</html>