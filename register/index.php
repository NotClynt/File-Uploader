<?php require "../src/config.php"; ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title><?php SERVICE_NAME; ?> | register</title>

    <link href="https://<?php CDN_URL; ?>/assets/img/icon.png" rel="shortcut icon" />
    <link href="https://<?php CDN_URL; ?>/assets/css/register.css" rel="stylesheet" type="text/css" />

    <meta name="keywords" content="<?php KEYWORDS; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php DESCRIPTION; ?>">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&amp;display=swap" rel="stylesheet">

    <script src="https://<?php CDN_URL; ?>/assets/js/axios.min.js"
        type="061475e7a149ead4adfff902-text/javascript"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>

    <img class="logo" src="https://<?php CDN_URL; ?>/assets/img/icon.png">
</head>

<body>
    <p><br></p>
    <form class="box" method="post" enctype="">
        <h2>register</h2>
        <input type="text" name="username" placeholder="Username" autocomplete="username" required>
        <input type="password" name="password" placeholder="Password" autocomplete="password" required>
        <input type="text" name="invite" placeholder="invite" required>

        <button class="submit" type="submit">register</button>
        <div class="error">
            <h3 id="errormsg"></h3>
        </div>
    </form>

    <script type="061475e7a149ead4adfff902-text/javascript">
        var element = document.body;
        if (localStorage.getItem("darkmodeprefsenabled") == null) {localStorage.setItem("darkmodeprefsenabled", false);}
        if (localStorage.getItem("darkmodeprefsenabled") == "true") {
            element.classList.toggle("darkmode");
        }
    </script>
    </div>
    <script src="https://<?php CDN_URL; ?>/assets/rocket-loader.min.js" data-cf-settings="061475e7a149ead4adfff902-|49" defer=""></script>
</body>

</html>