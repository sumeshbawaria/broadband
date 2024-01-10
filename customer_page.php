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
    
<div class="admin-req">
        <ul>
            <li><a href="feedback.php">give complain</a></li>
            <li><a href="buy_plan.php">Get your plan</a></li>
            <li><a href="contact.php">service provider contact details</a></li>
        </ul>
    </div>

</body>
</html>