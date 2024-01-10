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
    <style>
        
        .heading{
            text-align: center;
            background-color: #c0f1ac;
            padding: .5em;
            font-size: 2rem;
            text-transform: uppercase;
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
#message{
  background-color: rgb(236, 91, 91);
  text-align: center;
}
    </style>
</head>
<body><h2 class="heading">complains</h2>
    <?php
    $id = $_SESSION['emp_id'];
    $sql = "SELECT customer.c_name,complain.complain,customer.c_mobile,customer.c_area
            from complain
            INNER JOIN customer
            ON customer.sno = complain.cust_id and complain.emp_id = '$id'";

        $result = mysqli_query($conn,$sql);
        if($result){
            ?>
            <hr><div class="plans">
            <table id="customers">
            <tr>
                <th>Complain</th>
                <th>Name</th>
                <th>Mobile no.</th>
                <th>Address</th>
            </tr>
            
            <?php
                while($rows = mysqli_fetch_assoc($result)){
            ?>
        <tr>
            <td><?php echo $rows['complain'] ?></td>
            <td><?php echo $rows['c_name'] ?></td>
            <td><?php echo $rows['c_mobile'] ?></td>
            <td><?php echo $rows['c_area'] ?></td>
            <?php
            }
        }
        else{
        echo "<h2 id=\"message\">No complain is there now.</h2><?php";
        }
        ?>
</body>
</html>