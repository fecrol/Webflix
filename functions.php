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

    $q = "SELECT password FROM users WHERE email = '$email'";
    $r = mysqli_query($link, $q);
    
    if(mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

        if($password == $row["password"]) {
            return true;
        }
        else {
            return false;
        }
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

    $q = "SELECT id, firstName, lastName FROM users WHERE email='$email' AND password='$password'";
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
            session_start();
            $userInfo = getUserInfo($email, $password);

            $_SESSION["user_id"] = $userInfo["id"];
            $_SESSION["firstName"] = $userInfo["firstName"];
            $_SESSION["lastName"] = $userInfo["lastName"];
            load("home.php");
        }
        else {
            session_start();
            $_SESSION["error"] = true;
            load();
        }
    }
}
?>