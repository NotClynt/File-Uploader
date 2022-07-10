<?php require "../src/config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="https://<?php CDN_URL; ?>/assets/img/icon.png">
    <title><?php SERVICE_NAME; ?></title>
    <meta name="keywords" content="<?php KEYWORDS; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php DESCRIPTION; ?>">
    <link rel="stylesheet" href="https://<?php CDN_URL; ?>/assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="cover-i"></div>

    <div class="image">
        <img src="https://<?php CDN_URL; ?>/assets/img/icon.png" alt="Tesla.Sexy" id="logo">
        <br><br>
        <div id="links">
            <a href="login/index.html">login</a>
            <span>/</span>
            <a href="register/index.html">register</a>
            <span>/</span>
            <a href="https://<?php DISCORD_INVITE; ?>" target="_BLANK">discord</a>
            <span>/</span>
            <a id="darkmodeswitch">dark</button>
        </div>
    </div>

    <script src="https://<?php CDN_URL; ?>/assets/js/intro.js" type="8ce47bb622587b8a3d5e1594-text/javascript"></script>
    <script type="8ce47bb622587b8a3d5e1594-text/javascript">
        var element = document.body;
        if (localStorage.getItem("darkmodeprefsenabled") == null) {
            localStorage.setItem("darkmodeprefsenabled", false);
        }
        if (localStorage.getItem("darkmodeprefsenabled") == "true") {
            var button = document.getElementById("darkmodeswitch");
            element.classList.toggle("darkmode");
            button.innerHTML = "light";
        }
        var button = document.getElementById("darkmodeswitch");
        button.onclick = function() {
            var element = document.body;
            if (localStorage.getItem("darkmodeprefsenabled") == "true") {
                button.innerHTML = "dark";
                element.classList.toggle("darkmode");
                localStorage.setItem("darkmodeprefsenabled", false);
            } else if (localStorage.getItem("darkmodeprefsenabled") == "false") {
                button.innerHTML = "light";
                element.classList.toggle("darkmode");
                localStorage.setItem("darkmodeprefsenabled", true);
            }
        };
    </script>
    <script src="https://<?php CDN_URL; ?>/assets/js/rocket-loader.min.js" data-cf-settings="8ce47bb622587b8a3d5e1594-|49" defer=""></script>
</body>

</html>