<?php
        session_start();
        include("partials/nav.php");
        include("partials/db_connect.php");
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
        <h2>Admin Panel</h2>
    </div>
    <div class="admin-req">
        <ul>
            <li><a href="emp_req.php">Employee request</a></li>
            <li><a href="editplans.php">Edit Plans</a></li>
            <li><a href="showemployee.php">employees</a></li>
            <!-- <li><a href="showcustomer.php">Customer</a></li> -->
            <form action="" method="post"></form>
            <li><a href="showcustomer.php">Customer</a></li>
        </ul>
    </div>
</body>
</html>