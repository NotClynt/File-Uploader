<?php


$phpVersion = phpversion();
if (version_compare($phpVersion, '8.0.20', '<')) {
     die("PHP 8.0.20 or newer is required. $phpVersion does not meet this requirement. Please ask your host to upgrade PHP.");
}

if(isset($_POST['seo'])) {

     $embedcolor = $_POST['embedcolor'];
     $description = $_POST['description'];
     $keywords = $_POST['keywords'];

     $config = file_get_contents("../src/config.php");
     $config = str_replace("%embed_color%", $embedcolor, $config);
     $config = str_replace("%description%", $description, $config);
     $config = str_replace("%keywords%", $keywords, $config);
     file_put_contents("../src/config.php", $config);

     $dbb = file_get_contents("../src/database.php");
     $dbb = str_replace("%embed_color%", $embedcolor, $dbb);
     file_put_contents("../src/database.php", $dbb);

     $regg = file_get_contents("../register/index.php");
     $regg = str_replace("%embed_color%", $embedcolor, $regg);
     file_put_contents("../register/index.php", $regg);


     header("Location: step3.php");

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

          <h2>SEO</h2>
          <input type="text" name="embedcolor" placeholder="Embed color" required>
          <input type="text" name="description" placeholder="Description" required>
          <input type="text" name="keywords" placeholder="Keywords" required>


          <button class="submit" type="submit" name="seo">Continue</button>
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