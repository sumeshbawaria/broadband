<?php
    include "partials/db_connect.php";
   session_start();
   include "partials/nav.php";
?>

<?php

// initializing variables
$emp_id   = "";
$name    = "";
$email    = "";
$area     = "";
$mobile   = "";
$errors   = array(); 

// REGISTER USER
if (isset($_POST['reg_emp']) && isset($_FILES['image'])) {

/////////////////////////////////////////////////////////////////////

// Exit if no file uploaded
if (!isset($_FILES["image"])) {
  die('No file uploaded.');
}
// Get reference to uploaded image
if(isset($_FILES["image"])){
  $image_file = $_FILES["image"];
  $new_img_name = $image_file["name"];

// Move the temp image file to the images/ directory
move_uploaded_file(
  // Temp image location
  $image_file["tmp_name"],

  // New image location, __DIR__ is the location of the current PHP file
  __DIR__ . "/uploads/" . $image_file["name"]
);

// //////////////////////////////////////////////////////////////////

  // receive all input values from the form
  // $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $area = mysqli_real_escape_string($conn, $_POST['area']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  // if (empty($emp_id)) { array_push($errors, "emp_id is required"); }
  if (empty($name)) { array_push($errors, "name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($area)) { array_push($errors, "Area is required"); }
  if (empty($mobile)) { array_push($errors, "Mobile is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same emp_id and/or email
  $user_check_query = "SELECT * FROM employee WHERE  email='$email' OR mobile='$mobile' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user)
    if ($user['email'] == $email) {
      array_push($errors, "email already exists");
    }
    if ($user['mobile'] == $mobile) {
      array_push($errors, "mobile number already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
        // $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO `employee_request`(`name`, `area`, `email`,`mobile`, `password`,`image_url`) 
                  VALUES( '$name', '$area', '$email','$mobile','$password_1','$new_img_name')";
        mysqli_query($conn, $query);

        $last_id = mysqli_insert_id($conn);
        if($last_id){
          $user_id = "EMP_".$last_id ;
          $query1 = "update employee_request SET `emp_id` ='".$user_id."' where `sno`='" .$last_id."'";
          mysqli_query($conn,$query1);
        } ?>
        <script>
        function sent() {
        alert("<?php echo $name ; ?> Your request has been sent \n your employee ID will be sent to your email.");
        }
        </script>
        <?php
        header('location: employee.php');
  }
}
?>

<html>
   
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" href="style.css">     
      <script>
        function sent(){
          alert('Your id and password will be sent to your mail after reviewing');
        }
      </script>
   </head>
   
   <body>
	<div class="signup-header">
        <h2>Employee Register</h2>
  </div>
        
  <form class="form" method="post" action="employee-signup.php" enctype="multipart/form-data">
  <?php include('partials\errors.php'); ?>
        <div class="input-group">
         <label>Name</label>
         <input type="text"  name="name">
        </div> 
        <div class="input-group">
         <label>Area</label>
         <input type="text"  name="area">
        </div> 
        <div class="input-group">
          <label>Email</label>
          <input type="email" name="email">
         </div>
         <div class="input-group">
           <label>Mobile number</label>
           <input type="number" name="mobile">
         </div>
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password_1">
        <div class="input-group">
          <label>Confirm password</label>
          <input type="password" name="password_2">
        </div>
        <div class="input-group">
          <label>Upload your license</label>
          <input type="file" name="image" accept="image/*">
        </div>
        <div class="input-group">
          <button type="submit" class="btn" name="reg_emp">Register</button>
        </div>
        <p>
            Already a member? <a href="employee.php" onclick="sent();" class="submit">Log in</a>
        </p>
  </form>

  </body>
</html>