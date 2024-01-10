<?php
    $servername = "localhost";
    $user_name = "root";
    $db_password = "";
    $database = "broadband";

    $conn = new mysqli($servername,$user_name,$db_password,$database);
?>

<?php
// session_start();

// initializing variables
$username = "";
$email    = "";
$area     = "";
$mobile     = "";
$errors = array(); 