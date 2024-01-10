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
        h3{
            text-align: center;
            background-color: #c0f1ac;
            padding: 1em;
            font-size: 2rem;
        }
        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        form textarea{
            padding: 1em;
            margin: 2em;
        }
        form input[type=submit]{
            padding: .5em 3em;
            border: none;
            border-radius: 10px;
            background-color: grey;
        }
        form input[type=submit]:hover{
            background-color: rgb(247, 137, 82);
            color: white;
        }
    </style>
</head>

<body>
    
<script> 
        function fun_alert(){
            alert("your complain has been sent.")
        }
    </script>

    <!-- <h3>Hello!!! 
    <?php 
    // echo $_SESSION['cust_name'] 

    if(isset($_POST['complain_form'])){
        $complain = $_POST['complain'];
        $name = $_SESSION['cust_name'];
        $id = $_SESSION['cus_id'];
        $c_emp_id = $_SESSION['cust_emp_id'];

        $sql = "INSERT INTO `complain` (`cust_id`, `complain`, `emp_id`) 
        VALUES ('$id', '$complain', '$c_emp_id');";
        mysqli_query($conn, $sql);
    }
    ?>
    
</h3> -->
    <h3>Enter your complain here.</h3>
    <form action="feedback.php" method="post">
        <textarea name="complain" cols="70" rows="10" placeholder="Enter your complain....."></textarea>
        <br>
        <input type="submit" name="complain_form" value="SUBMIT" onclick="fun_alert()">
    </form>
    <?php
    
    // echo '<script> 
    // alert("your complain has been sent.")
    // </script>';
    ?>
</body>
</html>