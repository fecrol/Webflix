<?php
session_start();
require("./functions.php");
redirect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/48b1b4cd52.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles.css">
    <script src="./js/script.js"></script>
    <title>Change Password</title>
</head>
<body>
    <?php require("./navbar.php"); ?>

    <div id="flex-container-centre" class="flex-container">
        <div class="login-form col-lg-5 col-md-8">
            <h1>Change Password</h1>
                <form method="post" action="<?php changePassword(); ?>">
                    <p>New Password</p>
                    <input class="col-lg-12 col-md-12" type="password" name="pass1" placeholder="New Password" required>
                    <p>Confirm Password</p>
                    <input class="col-lg-12 col-md-12" type="password" name="pass2" placeholder="Confirm Password" required>
                    <input class="col-lg-12 col-md-12 "type="submit" name="submit" value="Submit">
                    <br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>