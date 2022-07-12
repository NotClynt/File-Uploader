<?php 

include "../src/config.php";
include "../src/database.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT * FROM users WHERE username = ?";

        if ($stmt = $db->prepare($sql)) {
            $stmt->bind_param("s", $param_username);

            $param_username = $username;

            if ($stmt->execute()) {

                $stmt->store_result();

                if ($stmt->num_rows == 1) {

                    $stmt->bind_result($id, $username, $hash_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hash_password)) {

                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: index.php");
                        } else {
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $db->close();
}

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
    <form class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" autocomplete="username" required>
        <input type="password" name="password" placeholder="Password" autocomplete="password" required>

        <button class="submit" type="submit">login</button>
        <div class="error">
            <h3 id="errormsg"><?php echo htmlspecialchars($username_err); ?> <br> <?php echo htmlspecialchars($password_err); ?></h3>
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