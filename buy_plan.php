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
    <style>
    .plans h2{
        width: 100%;
        height: 2em;
        background-color: #c0f1ac;
        text-align: center;
    }

    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th{
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: grey;
    color: white;
    }
    #style-heading{
    border: 1px solid #ddd;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: grey;
    color: white;
    }
    </style>
</head>
<body>
    <?php

if(isset($_POST['payment'])){
    header('location: payment.php');
    exit();
}
    ?>
<hr><div class="plans"><h2>purchase plans</h2>
        <table id="customers">
        <tr>
            <th>Speed</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        
        <?php
    $sql2 = "select * from plans";
    $result = mysqli_query($conn,$sql2);
            while($rows = mysqli_fetch_assoc($result)){
                $speed = $rows['speed'];
                $duration = $rows['duration'];
                $price = $rows['price'];
                $id = $rows['plan_id'];
        ?>
    <tr>
        <td><?php echo $speed ?></td>
        <td><?php echo $duration ?></td>
        <td><?php echo $price ?></td>
        <td>
            <form action="buy_plan.php" method="post">
                <input type="hidden" name="cus_id" value="<?php echo $_SESSION['cus_id'] ;?>" >
                <input type="submit" value="Purchase" name="payment">
            </form>
         </td>
    </tr>    
    <?php
    }
    ?>
    </table></div>
</body>
</html>