<?php

include "partials/nav.php"

?>

<?php
    include "partials/db_connect.php";

session_start();

// LOGIN USER
if (isset($_POST['login_cus'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      
        if (empty($email)) {
              array_push($errors, "Email id is required");
        }
        if (empty($password)) {
              array_push($errors, "Password is required");
        }
      
        if (count($errors) == 0) {
        //       $password = md5($password);
              $query = "SELECT * FROM customer WHERE c_email='$email' AND password='$password'";
              $results = mysqli_query($conn, $query);
              $rows = mysqli_fetch_assoc($results);
              $_SESSION['cus_id'] = $rows['sno'];
              
              if (mysqli_num_rows($results) == 1) {
                      $_SESSION['cust_name'] = $rows['c_name'];
                      $_SESSION['cust_emp_id'] = $rows['c_emp_id'];
                $_SESSION['cus_loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are now logged in";
                header('location: customer_page.php');
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
        <h2>Customer-Login</h2>
  </div>
         
  <form  class="form"  method="post" action="customer_login.php">
  <?php include('partials\errors.php'); ?>
        <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email">
        </div>
        <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
        </div>
        <div class="input-group">
                <button type="submit" class="btn" name="login_cus">Login</button>
        </div>
        <p>
                Not yet a member? <a href="customer-signup.php" class="submit">Sign up</a>
        </p>
  </form>
    </div>
    </form>
    </div>
</body>
</html>