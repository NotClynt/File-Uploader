<?php 

include "../src/config.php";
include "../src/database.php";

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title><?php echo SERVICE_NAME ?> | login</title>

    <link href="https://<?php echo CDN_URL ?>/assets/images/icon.png" rel="shortcut icon" />
    <link href="https://<?php echo CDN_URL ?>/assets/css/login.css" rel="stylesheet" type="text/css" />

    <meta name="keywords" content="<?php echo KEYWORDS ?>">
    <meta name="author" content="the sexy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo DESCRIPTION ?>">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&amp;display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>

    <img class="logo" src="https://<?php echo CDN_URL ?>/assets/images/icon.png">
</head>

<body>
    <p><br></p>
    <form class="box" method="post" enctype="">
        <h2>welcome!</h2>
        <input type="text" name="username" placeholder="Username" autocomplete="username" required>
        <input type="password" name="password" placeholder="Password" autocomplete="password" required>

        <button class="submit" type="submit">login</button>
        <div class="error">
            <h3 id="errormsg"></h3>
        </div>
    </form>
    <script type="62ed7cfc56cbe71c210c285b-text/javascript">
        var element = document.body;
        if (localStorage.getItem("darkmodeprefsenabled") == null) {localStorage.setItem("darkmodeprefsenabled", false);}
        if (localStorage.getItem("darkmodeprefsenabled") == "true") {
            element.classList.toggle("darkmode");
        }
    </script>
    <div class="copyright" style="text-align: center; color: white;">
        <p><i><?php echo SERVICE_NAME ?></i></p>
    </div>
    </div>
    <script src="https://<?php echo CDN_URL ?>/assets/js/loader.js" data-cf-settings="62ed7cfc56cbe71c210c285b-|49" defer=""></script>
</body>

</html>