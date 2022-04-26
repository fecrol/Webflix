<?php

function validateEmail($email) {
    /*
    Validates email to make sure it exists in the database.
    */

    require("./connect_db.php");

    $q = "SELECT email FROM users WHERE email = '$email'";
    $r = mysqli_query($link, $q);
    
    if(mysqli_num_rows($r) == 1) {
        return true;
    }
    else {
        return false;
    }

    mysqli_close($link);
}

function validatePassword($email, $password) {
    /*
    Validates the password to check if the inputted password matches with the password associated with the inputted email. 
    */

    require("./connect_db.php");

    $q = "SELECT password FROM users WHERE email = '$email' AND password = SHA2('$password', 256)";
    $r = mysqli_query($link, $q);
    
    if(mysqli_num_rows($r) == 1) {
        return true;
    }
    else {
        return false;
    }

    mysqli_close($link);
}

function getUserInfo($email, $password) {
    /*
    Gets the user info from the databse to be used within the session.
    */

    require("connect_db.php");

    $q = "SELECT id, firstName, lastName FROM users WHERE email='$email' AND password=SHA2('$password', 256)";
    $r = mysqli_query($link, $q);

    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    mysqli_close($link);
    
    return $row;
}

function load($page = "login.php") {
    /*
    Loads the specified page to redirect the user.
    */

    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]);

    $url = rtrim($url, "/\\");
    $url .= "/" . $page;

    header("Location: $url");
    exit();
}

function login() {

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require("./connect_db.php");

        $email = $_POST["email"];
        $password = $_POST["password"];

        $email = mysqli_real_escape_string($link, $email);
        $password = mysqli_real_escape_string($link, $password);
        
        mysqli_close($link);

        $emailVal = validateEmail($email);
        $passwordVal = validatePassword($email, $password);

        if($emailVal && $passwordVal) {
            $userInfo = getUserInfo($email, $password);

            $_SESSION["user_id"] = $userInfo["id"];
            $_SESSION["firstName"] = $userInfo["firstName"];
            $_SESSION["lastName"] = $userInfo["lastName"];
            load("home.php");
        }
        else {
            $_SESSION["error"] = true;
            load();
        }
    }
}

function checkIfEmailRegistered($email) {
    require("./connect_db.php");
    $q = "SELECT email FROM users WHERE email='$email'";
    $r = mysqli_query($link, $q);

    if(mysqli_num_rows($r) == 1) {
        return true;
    }

    return false;
}

function validateRegisterForm() {
    $formIsValid = true;

    if(empty($_POST["forename"])) {
        $formIsValid = false;
    }
    if(empty($_POST["surname"])) {
        $formIsValid = false;
    }
    if(empty($_POST["email"])) {
        $formIsValid = false;
    }
    if(checkIfEmailRegistered($_POST["email"])) {
        $formIsValid = false;
    }
    if(empty($_POST["password"])) {
        $formIsValid = false;
    }

    if(empty($_POST["password2"])) {
        $formIsValid = false;
    }

    if(!empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] != $_POST["password2"]) {
        $formIsValid = false;
    }

    if($_POST["subscription"] == 1) {
        if(empty($_POST["card_no"])) {
            $formIsValid = false;
        }
        if(empty($_POST["cvv"])) {
            $formIsValid = false;
        }
    }

    return $formIsValid;
}

function addDetailsToDatabase($forename, $surname, $email, $password, $subscription, $cardNum, $expMonth, $expYear, $cvv) {
    require("./connect_db.php");

    $q = "INSERT INTO users (firstName, lastName, email, password, premium, cardNumber, expMonth, expYear, cvv, dateOfReg) VALUES ('$forename', '$surname', '$email', SHA2('$password', 256), $subscription, '$cardNum', $expMonth, $expYear, $cvv, NOW())";

    $r = mysqli_query($link, $q);

    mysqli_close($link);
}

function register() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formIsValid = validateRegisterForm();
        
        if($formIsValid) {
            require("./connect_db.php");

            $forename = mysqli_real_escape_string($link, $_POST["forename"]);
            $surname = mysqli_real_escape_string($link, $_POST["surname"]);
            $email = mysqli_real_escape_string($link, $_POST["email"]);
            $password = mysqli_real_escape_string($link, $_POST["password"]);
            $subscription = mysqli_real_escape_string($link, $_POST["subscription"]);
            $cardNum = 0;
            $expMonth = 0;
            $expYear = 0;
            $cvv = 0;

            if($_POST["subscription"] == 1) {
                $cardNum = mysqli_real_escape_string($link, $_POST["card_no"]);
                $expMonth = mysqli_real_escape_string($link, $_POST["exp-month"]);
                $expYear = mysqli_real_escape_string($link, $_POST["exp-year"]);
                $cvv = mysqli_real_escape_string($link, $_POST["cvv"]);
            }

            addDetailsToDatabase($forename, $surname, $email, $password, $subscription, $cardNum, $expMonth, $expYear, $cvv);
            mysqli_close($link);
            load();
        }
    }
}

function redirect() {
    /*
    Redirects user to login page if not logged in.
    */

    if(!isset($_SESSION["user_id"])) {
        load();
    }
}

function logout() {
    if(isset($_SESSION["user_id"])) {
        session_destroy();
        session_unset();
    }
}

function getMovies() {
    /*
    Gets the id and type of movies saved in the databse.
    */

    require("./connect_db.php");

    $data = array();

    $q = "SELECT tmdbId, type FROM content WHERE type LIKE 'movie'";
    $r = mysqli_query($link, $q);

    
    while($row = mysqli_fetch_assoc($r)) {
        array_push($data, $row);
    }

    mysqli_close($link);

    return $data;
}

function getTvShows() {
    /*
    Gets the id and type of tv shows saved in the databse.
    */

    require("./connect_db.php");

    $data = array();

    $q = "SELECT tmdbId, type FROM content WHERE type LIKE 'tv'";
    $r = mysqli_query($link, $q);

    
    while($row = mysqli_fetch_assoc($r)) {
        array_push($data, $row);
    }

    mysqli_close($link);

    return $data;
}

function getComingSoon() {
    /*
    Gets the id and type of coming soon content saved in the databse.
    */

    require("./connect_db.php");

    $data = array();

    $q = "SELECT tmdbId, type FROM coming_soon";
    $r = mysqli_query($link, $q);

    
    while($row = mysqli_fetch_assoc($r)) {
        array_push($data, $row);
    }

    mysqli_close($link);

    return $data;
}

function getContentDetails() {
    /*
    Retrieves the content details stored in the url.
    */

    $contentDetails = array();

    if(isset($_GET["type"])) {
        $contentDetails["type"] = htmlspecialchars($_GET["type"]);
    }

    if(isset($_GET["id"])) {
        $contentDetails["id"] = htmlspecialchars($_GET["id"]);
    }

    return $contentDetails;
}
?>