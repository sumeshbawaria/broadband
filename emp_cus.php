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
        
        #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
h1{
    background-color: #c0f1ac;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
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
<body>    
<div class="admin-header">
        <h2>Your customer Panel</h2>
    </div>
    <?php
    $emp_id = $_SESSION['emp_id'];
    $query = "select * from customer where c_emp_id = '$emp_id' ";
    $result=mysqli_query($conn,$query);
    if($result){
    while($rows=mysqli_fetch_assoc($result)){
      ?> 
      <table id="customers">
        <tr>
          <th>Name</th>
          <th>Area</th>
          <th>Email</th>
          <th>mobile</th>
        </tr>
    <tr>
        <td><?php echo $rows['c_name'] ?></td>
        <td><?php echo $rows['c_area'] ?></td>
        <td><?php echo $rows['c_email'] ?></td>
        <td><?php echo $rows['c_mobile'] ?></td>
    </tr>
    <?php
        }
      }
      else{
      echo "<h2 id=\"message\">You have no customer now.</h2><?php";
      }
    ?>
</table>
</body>
</html>