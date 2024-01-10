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
    <title>location</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .location{
            background: #dff0d8;
            width: fit-content;
            margin: 3em auto;
            border-radius: 10px;
        }
        .location h2{
            text-align: center;
            text-transform: uppercase;
            background: black;
            color: white;
            padding: 1em 3em;
            font-size: 2rem;
            border-radius: 10px;
        }  
        .location ul{
            height: fit-content;
            display: flex;
            /* flex-direction: column; */
            justify-content: center;
            align-content: center;
            flex-wrap: wrap;
            list-style: none;
        }

        .location ul li{
            text-transform: uppercase;
            width: 20em;
            margin: .6em;
            padding: .5em;
            color: white;
            border-radius: 10px;
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body><div class="location">
        <h2>our presence in indore</h2>
        <ul>
    <?php

        $sql = "select distinct area from employee";
        $result = mysqli_query($conn,$sql); 

        while($rows = $result -> fetch_assoc()){
            location($rows['area']);
        }
    function location($area){
        echo "
                <li>$area</li>
            ";}
    ?>
    </ul>
        </div>
</body>
</html>