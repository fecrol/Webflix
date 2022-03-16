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
    <link rel="stylesheet" href="./styles.css">
    <script src="./js/script.js"></script>
    <title>Home</title>
</head>
<body>
    <?php
    require("./navbar.php")
    ?>
    <div class="col-lg-12 col-md-12 center">
        <div id="movieCarouselControls" class="carousel slide col-lg-10 col-md-11 center" data-bs-ride="carousel" data-bs-interval="false">
            <div id="movie-carousel" class="carousel-inner col-lg-9 col-md-9">
                <div class="card-header">
                    <h2>Top 10 Movies</h1>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#movieCarouselControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#movieCarouselControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 center">
        <div id="tvCarouselControls" class="carousel slide col-lg-10 col-md-11 center" data-bs-ride="carousel" data-bs-interval="false">
            <div id="tv-carousel" class="carousel-inner col-lg-9 col-md-9">
                <div class="card-header">
                    <h2>Top 10 TV Shows</h1>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#tvCarouselControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#tvCarouselControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <script src="./js/tmdb-script.js"></script>
    <script>
    </script>
</body>
</html>