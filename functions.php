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

        $expMonth = $_POST["exp-month"];
        $expYear = $_POST["exp-year"];
        $isExpiryDateValid = validateExpiryDate($expMonth, $expYear);

        if(!$isExpiryDateValid) {
            $formIsValid = false;
        }
    }

    return $formIsValid;
}

function validateExpiryDate($expiryMonth, $expiryYear) {
    /*
    Validates the expiry date of the card provided.
    */

    $expiryDate = $expiryMonth + $expiryYear;
    $currentDate = date("n") + date("Y");
    
    return $expiryDate > $currentDate ? true : false;
}

function addDetailsToDatabase($forename, $surname, $email, $password, $subscription, $status) {
    require("./connect_db.php");

    $q = "INSERT INTO users (firstName, lastName, email, password, premium, userStatus, dateOfReg) VALUES ('$forename', '$surname', '$email', SHA2('$password', 256), $subscription, $status, NOW())";

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
            $status = "0";

            addDetailsToDatabase($forename, $surname, $email, $password, $subscription, $status);
            mysqli_close($link);
            load();
        }
        else {
            $_SESSION["regError"] = true;
            load("./register.php");
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

function getSingleContent($tmdbId, $type) {
    /*
    Retrieves information about a single piece of content from the database.
    */

    require("./connect_db.php");

    $tmdbId = mysqli_real_escape_string($link, $tmdbId);
    $type = mysqli_real_escape_string($link, $type);

    $q = "SELECT * FROM content WHERE tmdbId=$tmdbId AND type='$type'";
    $r = mysqli_query($link, $q);

    $row = mysqli_fetch_assoc($r);

    mysqli_close($link);

    return $row;
}

function getUserDetails($userId) {
    /*
    Gets user details from database to be displayed on user account page.
    */

    require("./connect_db.php");

    $q = "SELECT firstName, lastName, email, premium, dateOfReg FROM users WHERE id=$userId";
    $r = mysqli_query($link, $q);

    $row = mysqli_fetch_assoc($r);

    mysqli_close($link);

    return $row;
}

function translateSubscription($subscription) {
    /*
    Translates subscription type from an integer into a string
    */

    return $subscription == 0 ? "Basic" : "Premium";
}

function changePassword() {
    /*
    Updates user password.
    */

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        require("./connect_db.php");

        $errors = array();
        
        if(isset($_POST["pass1"])) {
            if($_POST["pass1"] == $_POST["pass2"]) {

                $password = mysqli_real_escape_string($link, $_POST["pass1"]);
                $id = $_SESSION["user_id"];
                
                $q = "UPDATE users SET password=SHA2('$password', 256) WHERE id=$id";
                $r = mysqli_query($link, $q);

                mysqli_close($link);
                load("./user-account.php");
            }
            else {
                $errors[] = "Passwords do not match.";
            }
        }
        else {
            $errors[] = "Enter new password.";
        }
        
        $_SESSION["updatePassErr"] = $errors;
        mysqli_close($link);
        load("./change-password.php");
    }
}

function updateSubscription() {

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require("connect_db.php");

        $id = $_SESSION["user_id"];
        $subscription = mysqli_real_escape_string($link, $_POST["subscription"]);

        $q = "UPDATE users SET premium='$subscription' WHERE id=$id";
        $r = mysqli_query($link, $q);

        mysqli_close($link);
        load("./user-account.php");
    }
}
?>