<?php
    include "partials/db_connect.php";
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Broadband</title>
    <style>
    .card-heading{
        text-align: center;
        font-size: 2em;
        text-transform:uppercase;
        margin: 2em 0 0em;
    }
    </style>
</head>
<body>
    <header>
        <?php include 'partials/nav.php' ?>
    </header>
    <h2 class="card-heading">plans</h2>
    <section class="card-container">
        <?php include 'partials/cards.php'; ?>
        </section>
    </body>
</html>