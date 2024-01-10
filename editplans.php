<?php
    session_start();
    include("partials/nav.php");
    include("partials/db_connect.php");

    $query = "select * from plans";
    $result=mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit plans</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .new-plans{
        display: flex;
        flex-wrap: wrap;
    }
    .edit-container{
        display: flex;
        /* text-transform: uppercase; */
    }
    .edit-container hr{
        color: black;
    }
    .edit-container h2{
        width: 100%;
        height: 2em;
        background-color: #c0f1ac;
        text-align: center;
        text-transform: uppercase;
    }
    .edit-plans{
        width:40%;
        display: flex;
        flex-direction: column;

    }
    .edit-plans form {
        width: 100%;
        margin: 1em ;
        display: flex;
    }
    form button{
        border:none;
        width: 2em;
        margin: 0 1em;
    }
    #form-style label{
        margin: 1em;
        width: 10px;
    }
    #form-style {
        margin: .4em ;
    }
    .plans{
        width: 60%;
        display: flex;
        flex-direction: column;
    }
    #submit{
        margin: 0 1em;
        padding: .1em 1em;
        background-color: rgb(228, 91, 22);
        border: none;
        border-radius: 1em;
    }
    #submit:hover{
        background-color: black;
        color: white;
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
    .green{
        background-color: #99ff99;
    }
    </style>
</head>
<body>
    <div class="edit-container">
        <div class="edit-plans"><h2>edit plans</h2>
        <!-- code for new plans -->
            <p id="style-heading">New plans Details</p>       
                <form action="editplans.php" class="new-plans" method="post">
                    <div id="form-style"><label for="speed">Speed</label>
                    <input required type="text" name="speed"></div>
                    <div id="form-style"><label for="duration">duration</label>
                    <input required type="text" name="duration"></div>
                    <div id="form-style"><label for="price">price</label>
                    <input required type="text" name="price"></div>
                    <div id="form-style">
                    <input id="submit" type="submit" value="SUBMIT" name="new_plan">
                    </div>
                </form>
        
            <?php
            if(isset($_POST['new_plan'])){
                $speed = $_POST['speed'];
                $duration = $_POST['duration'];
                $price = $_POST['price'];
                $sql = "INSERT INTO `plans`(speed,duration,price)
                VALUES('$speed','$duration','$price')"; 
                if(mysqli_query($conn,$sql)){
                    ?>
                    <p class="green">
                        <?php echo "New plan added." ?>
                    </p>
                    <?php ;
                }

            }?>
<!-- ----------------------edit plans-------------- -->
            <?php
            if(isset($_POST['edit'])){
                $id = $_POST['edit_id'];
                $edit_sql = "select * from plans where plan_id = '$id'";
                $results = mysqli_query($conn,$edit_sql);
                while($rows = mysqli_fetch_assoc($results)){
                ?>
            <p id="style-heading">edit plans Details</p>    
                <form action="editplans.php" class="new-plans" method="post">
                    <div id="form-style"><label for="speed">Speed</label>
                    <input required type="text" name="edit_speed" value= "<?php echo $rows['speed']; ?>"></div>
                    <div id="form-style"><label for="duration">duration</label>
                    <input required type="text" name="edit_duration" value= "<?php echo $rows['duration']; ?>"></div>
                    <div id="form-style"><label for="price">price</label>
                    <input required type="text" name="edit_price" value= "<?php echo $rows['price']; ?>"></div>
                    <input type="hidden" name="id" value="<?php echo $id ;?>">
                    <div id="form-style">
                    <input id="submit" type="submit" value="SUBMIT" name="edit_plan">
                    </div>
                </form>
                <?php
                }}

            if(isset($_POST['edit_plan'])){
                
                $id = $_POST['id'];

                $speed = $_POST['edit_speed'];
                $duration = $_POST['edit_duration'];
                $price = $_POST['edit_price'];
                // UPDATE `plans` SET `duration` = '4 months', `price` = '3000' WHERE `plans`.`plan_id` = 33;
                $up_sql = "UPDATE `plans` SET `speed` = '$speed' ,`duration` = '$duration' ,`price` = '$price' WHERE `plan_id` = '$id' ";
                // echo mysqli_query($conn,$up_sql);
                if(mysqli_query($conn,$up_sql)){
                    ?>
                    <p class="green">
                        <?php echo "Plan Edited." ?>
                    </p>
                    <?php ;

            }
        }
    ?>

        </div>
    <?php
    $sql2 = "select * from plans";
    $result = mysqli_query($conn,$sql2);
    ?>
        <hr><div class="plans"><h2>existing plans</h2>
        <table id="customers">
        <tr>
            <th>Speed</th>
            <th>Duration</th>
            <th>Price</th>
            <th>delete</th>
            <th>edit</th>
        </tr>
        
        <?php
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
        <td id="actions">
            <form action="editplans.php" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $id ;?>" >
                <!-- <input type="submit" value="DELETE" name="delete"> -->
                <button name="delete"><img src="images/icons8-delete (1).svg" alt=""></button>
            </form>
            </td>
        <td id="actions">
            <form action="editplans.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $id ;?>" >
                <!-- <input type="hidden" value="EDIT" name="edit"> -->
                <button name="edit" value="EDIT"><img src="images/icons8-edit.svg" alt=""></button>
            </form>
         </td>
    </tr>
    
    <?php
    }

    if(isset($_POST['delete'])){
        $del_val = $_POST['delete_id'];
        $delete= "DELETE FROM `plans` where `plan_id` = '$del_val'";
        mysqli_query($conn,$delete);
    }
    ?>
    </table></div>

  
</div>
</body>
</html>