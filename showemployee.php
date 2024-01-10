<?php
    session_start();
    include("partials/nav.php");
    include("partials/db_connect.php");

    $query = "select * from employee";
    $result=mysqli_query($conn,$query);
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
    </style>
</head>
<body>
    
<div class="admin-header">
        <h2>All employees </h2>
    </div>

<table id="customers">
  <tr>
    <th>Employee ID</th>
    <th>Name</th>
    <th>Area</th>
    <th>Email</th>
    <th>mobile</th>
  </tr>
  <?php
      while($rows=mysqli_fetch_assoc($result)){
  ?> 
    <tr>
        <td><?php echo $rows['emp_id'] ?></td>
        <td><?php echo $rows['name'] ?></td>
        <td><?php echo $rows['area'] ?></td>
        <td><?php echo $rows['email'] ?></td>
        <td><?php echo $rows['mobile'] ?></td>
    </tr>
    <?php
        }
    ?>
</table>
</body>
</html>