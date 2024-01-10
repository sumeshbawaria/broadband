<?php
    include "partials/db_connect.php";
   session_start();
   include "partials/nav.php";

// initializing variables
$username = "";
$email    = "";
$area     = "";
$mobile     = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $area = mysqli_real_escape_string($conn, $_POST['area']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($area)) { array_push($errors, "Area is required"); }
  if (empty($mobile)) { array_push($errors, "Mobile is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM cust_req WHERE c_name='$username' OR c_email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
    if ($user['mobile'] === $mobile) {
      array_push($errors, "mobile number already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
        $password = ($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO cust_req (c_name, c_email, c_mobile, c_area,password) 
                          VALUES('$username', '$email','$mobile','$area', '$password')";
        mysqli_query($conn, $query);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: customer_login.php');
    
  }
}

?>
<html>
   
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" href="style.css">  
      
          
    <script>
        function fun() {
            alert("You will get mail after registration.");
        }
    </script>
   </head>
   
   <body>
	<div class="signup-header">
        <h2>Customer Register</h2>
  </div>
        
  <form  class="form"  method="post" action="customer-signup.php"  enctype="multipart/form-data">
 
        <div class="input-group">
          <label>User name</label>
          <input type="text" name="username" required value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
         <label>Area</label>
         <select name="area" id="area" class="select-area">
          <?php
            $sql = "select distinct area from employee";
            $result = mysqli_query($conn,$sql);
            
            while($rows = $result -> fetch_assoc()){
              drop($rows['area']);
            }
            
            function drop($area){
              echo "<option value=\"$area\">$area</option>";
          }

          ?>
         </select>
        </div> 
        <div class="input-group">
          <label>Email</label>
          <input type="email" name="email" required value="<?php echo $email; ?>">
         </div>
         <div class="input-group">
           <label>Mobile number</label>
           <input type="number" required name="mobile">
         </div>
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="password" required name="password_1">
        <div class="input-group">
          <label>Confirm password</label>
          <input type="password" required name="password_2">
        </div>
        <div class="input-group">
          <button type="submit" class="btn" onclick="fun();" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a href="customer_login.php"  class="submit">Log in</a>
        </p>
  </form>
</body>
</html>