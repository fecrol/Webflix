<?php
$link = mysqli_connect("localhost", "root", "", "graded_unit");

if(!$link) {
    die("Could not connect to databse: " . mysqli_error());
}
?>