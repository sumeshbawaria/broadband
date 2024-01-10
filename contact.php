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
        table,td,th{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 1em;

        }
        .center{
            height: inherit;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 3em;
        }
        table{
            background-color: #c2d6d6;
        }
    </style>
</head>
<body>
    <?php 
        $id = $_SESSION['cust_emp_id'];
        $sql = "select * from employee where emp_id = '$id'";
        $result = mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);

        ?>
        <div class="center">
        <table>
            <tr>
                <th>Name</th>
                <th>Email ID</th>
                <th>Mobile no.</th>
            </tr>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['mobile'] ?></td>
            </tr>
        </table>

        </div>
    
</body>
</html>