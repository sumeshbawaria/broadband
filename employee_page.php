<?php
    include "partials/db_connect.php";
    session_start();
    include "partials/nav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="admin-header">
        <h2>Employee Panel</h2>
    </div>
<div class="admin-req">
        <ul>
            <li><a href="emp_cus_req.php">Customer connetion request</a></li>
            <li><a href="emp_cus.php">Your customers</a></li>
            <li><a href="complain.php">complains</a></li>
        </ul>
    </div>
</body>
</html>