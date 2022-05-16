<?php
session_start();
require("./functions.php");
redirect();
logoutIfBlocked($_SESSION["user_id"]);
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
    <script src="./js/script.js"></script>
    <title>Home</title>
</head>
<body>
    <?php
        require("./navbar.php")
    ?>
    <div class="cont col-lg-12 center vertical-center">
        <div class="row col-lg-10 center">
            <a href="movies.php" class="col-lg-6 center">
                <div id="hc-movie" class="home-content col-lg-12 center">
                    <h1>Movies</h1>
                </div>
            </a>    
            <a href="tv-shows.php" class="col-lg-6 center">
                <div id="hc-tv" class="home-content col-lg-12 center">
                    <h1>TV Shows</h1>
                </div>
            </a>
        </div>
    </div>
</body>
</html>