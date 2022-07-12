<?php

$phpVersion = phpversion();
if (version_compare($phpVersion, '8.0.20', '<')) {
     die("PHP 8.0.20 or newer is required. $phpVersion does not meet this requirement. Please ask your host to upgrade PHP.");
}


if(isset($_POST['urls'])) {

     $domain = $_POST['domain'];
     $cdn_domain = $_POST['cdn_domain'];
     $discord_invite = $_POST['discord_invite'];

     $config = file_get_contents("../src/config.php");
     $config = str_replace("%domain%", $domain, $config);
     $config = str_replace("%base_domain%", $cdn_domain, $config);
     $config = str_replace("%cdn_url%", $cdn_domain, $config);
     $config = str_replace("%discord_invite%", $discord_invite, $config);
     file_put_contents("../src/config.php", $config);


     header("Location: step2.php");

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
          <h2>URLs</h2>
          <input type="text" name="domain" placeholder="Domain" required>
          <input type="text" name="cdn_domain" placeholder="CDN Domain" required>
          <input type="text" name="discord_invite" placeholder="Discord invite" required>


          <button class="submit" type="submit" name="urls">Continue</button>
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