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
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC)

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
?>