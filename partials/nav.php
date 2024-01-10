<?php
if(isset($_SESSION['emp_loggedin']) && $_SESSION['emp_loggedin'] == true){
    $emp_loggedin = true;
}
else{
    $emp_loggedin = false;
}
if(isset($_SESSION['cus_loggedin']) && $_SESSION['cus_loggedin'] == true){
    $cus_loggedin = true;
}
else{
    $cus_loggedin = false;
}
if(isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true){
    $admin_loggedin = true;
}
else{
    $admin_loggedin = false;
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    
<div class="container">
            <!-- <div class="logo"><img src="image/" href="@" alt="logo"></div> -->
            
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="location.php">locations</a></li>
                    <li><a href="aboutus.php">about us</a></li>
                    <!-- <li><a href="contactus.php">contact us</a></li> -->
                    <?php
                        if($emp_loggedin){
                            echo "<li id=\"nav-button\"><a href=\"employee_page.php\">Employee page</a></li>
                            <li id=\"logout\"><a href=\"logout.php\">logout</a></li>";
                        }
                        elseif($cus_loggedin){
                            echo "<li id=\"nav-button\"><a href=\"customer_page.php\">customer page</a></li>
                            <li id=\"logout\"><a href=\"logout.php\">logout</a></li>";
                        }
                        elseif($admin_loggedin){
                            echo "<li id=\"nav-button\"><a href=\"admin.php\">admin page</a></li>
                            <li id=\"logout\"><a href=\"logout.php\">logout</a></li>";
                        }
                        else{
                            echo "<li><a href=\"customer_login.php\">customer Portal</a></li>
                                <li><a href=\"Employee.php\">Employee Portal</a></li>
                                <li><a href=\"admin_login.php\">admin panel</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
</body>
</html>