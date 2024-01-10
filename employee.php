<?php

include "partials/nav.php"

?>

<?php
    include "partials/db_connect.php";

session_start();

// LOGIN EMPLOYEE
if (isset($_POST['login_emp'])) {
        $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      
        if (empty($emp_id)) {
              array_push($errors, "employee id is required");
        }
        if (empty($password)) {
              array_push($errors, "Password is required");
        }
      
        if (count($errors) == 0) {
        //       $password = md5($password);
              $query = "SELECT * FROM employee WHERE emp_id='$emp_id' AND password='$password'";
              $results = mysqli_query($conn, $query);
              $rows = mysqli_fetch_assoc($results);
              if (mysqli_num_rows($results) == 1) {
                $_SESSION['emp_loggedin'] = true;
                $_SESSION['emp_id'] = $emp_id;
                $_SESSION['emp_area'] = $rows['area'];
                $_SESSION['success'] = "You are now logged in";
                header('location: employee_page.php');
              }else {
                      array_push($errors, "Wrong userid/password combination");
              }
        }
      }
      
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
<div class="signup-header">
        <h2>Employee-Login</h2>
  </div>
         
  <form class="form"  method="post" action="employee.php">
  <?php include('partials\errors.php'); ?>
        <div class="input-group">
                <label>Empployee ID</label>
                <input type="text" name="emp_id" placeholder="User ID">
        </div>
        <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
        </div>
        <div class="input-group">
                <button type="submit" class="btn" name="login_emp">Login</button>
        </div>
        <p>
                Not yet a member? <a href="employee-signup.php" class="submit">Sign up</a>
        </p>
  </form>
    </div>
    </form>
    </div>
</body>
</html>