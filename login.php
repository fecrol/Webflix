<?php
session_start();
require("./functions.php");
logout();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./styles.css">
        <title>Login</title>
    </head>
    <body>
        <div class="col-lg-12 col-md-12">
            <?php include("./html/login_content.html") ?>
            <div class="login-container col-lg-6 col-md-12 center">
                <div class="row center col-lg-12">
                    <div class="login-logo col-md-8">
                        <img src="./img/logo.png" alt="Webflix logo" class="logo-lg">
                    </div>
                    <div class="login-form col-lg-8 col-md-8">
                        <h1>Login</h1>
                        <?php
                        if(isset($_SESSION["error"])) {
                            include("./html/error.html");
                        }
                        ?>
                        <form method="post" action="<?php login(); ?>">
                            <p>Email</p>
                            <input class="col-lg-12 col-md-12" type="text" name="email" placeholder="Enter Email" required>
                            <p>Password</p>
                            <input class="col-lg-12 col-md-12" type="password" name="password" placeholder="Enter Password" required>
                            <input class="col-lg-12 col-md-12 "type="submit" name="submit" value="Login">
                            <a href="#">Forgotten Password?</a>
                            <br>
                            <p class="sign-up-link">New to Webflix? <a href="./register.php">Sign up now</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
unset($_SESSION["error"]);
?>