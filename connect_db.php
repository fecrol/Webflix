<?php
/*
Establishes connection to MySQL db
*/

$link = mysqli_connect("localhost", "root", "", "webflix");

if(!$link) {
    die("Could not connect to databse: " . mysqli_error());
}
?>