<?php
        session_start();
        include("partials/nav.php");
        include("partials/db_connect.php");


// Initail variables


// LOGIN USER
if (isset($_POST['login_admin'])) {
        $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      
        if (empty($admin_id)) {
              array_push($errors, "admin_id is required");
        }
        if (empty($password)) {
              array_push($errors, "Password is required");
        }
      
        if (count($errors) == 0) {
              $password = ($password);
              $query = "SELECT * FROM admin WHERE admin_id='$admin_id' AND password='$password'";
              $results = mysqli_query($conn, $query);
              if (mysqli_num_rows($results) == 1) {
                $_SESSION['admin_loggedin'] = true;
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['success'] = "You are now logged in";
                header('location: admin.php');
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
        <h2>Admin Login</h2>
  </div>
         
  <form class="form" method="post" action="admin_login.php">
  <?php include('partials\errors.php'); ?>
        <div class="input-group">
                <label>Admin ID</label>
                <input type="text" name="admin_id" placeholder="admin ID">
        </div>
        <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
        </div>
        <div class="input-group">
                <button type="submit" class="btn" name="login_admin">Login</button>
        </div>
  </form>
    </div>
    </form>
    </div>
</body>
</html>