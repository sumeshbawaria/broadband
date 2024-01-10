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
table{
    margin: .1em ;
    border: 1px solid black;
    width: 90%;
    border-collapse: collapse;
}
table th{
    min-width: 250px;
    text-align: center;
    border: 1px solid black;
}
th img{
    width: 250px;
    height: 250px;
}
li{
  list-style: none;
}
li button{
    text-align: center;
    padding: .4em 1.5em;
    background-color: rgb(228, 91, 22);
    border: none;
    border-radius: 1em;
    cursor: pointer;
}
li button:hover{
    box-shadow: 1px 1px 20px rgb(28, 28, 28);
}

#message{
  background-color: rgb(236, 91, 91);
  text-align: center;
}
</style>


</head>
<body>
    <div class="admin-header">
        <h2>Employee Requests</h2>
    </div>
    <?php
        
        
        $emp_id = "";
        $name = "";
        $area = "";  
        $email = "";  
        $mobile = "";  
        $password = "";  
        $image_url = "";  


//--------------------For registration------------------------------------

        if(isset($_POST['register'])){
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $area = mysqli_real_escape_string($conn, $_POST['area']);  
    $email = mysqli_real_escape_string($conn, $_POST['email']);  
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);  
    $password = mysqli_real_escape_string($conn, $_POST['password']);  
    $image_url = mysqli_real_escape_string($conn, $_POST['image']);  

// --------------------------for insertion----------------------------------------
    $insert_emp_details = "INSERT INTO `employee`(`emp_id`, `name`, `area`, `email`,`mobile`,  `password` ,`image_url`)
    VALUES('$emp_id', '$name', '$area', '$email',  '$mobile','$password', '$image_url')";

    mysqli_query($conn, $insert_emp_details);

//-----------------------------for deletion---------------------------------------
    $delete_query = "DELETE FROM employee_request WHERE `emp_id` = '$emp_id' ";
    mysqli_query($conn, $delete_query);

// ----------------------------for mail----------------------------------------
    include('smtp/PHPMailerAutoload.php');

//     $mail_content = 'Employee_ID: '. $emp_id ."\n".'Password: '. $password." ";
// echo smtp_mailer($email,'Your Credentials',$mail_content);

function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = ("broadbandservice09@gmail.com");
	$mail->Password = "qdeakyxfrvwwvdww";
	$mail->SetFrom("broadbandservice09@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}

}
$mail_content = "<h3> Thankyou for sign up.</h3> <br>". 'Employee_ID: '. $emp_id . "<br>" .'Password: '. $password." ";
echo smtp_mailer($email,'Your Credentials',$mail_content);

        }
    ?>
    
    <div class="show-requests">       
    <?php
        $sql = "select * from employee_request";
        $results = mysqli_query($conn,$sql);
        if(!$results){
            echo "<h2 id=\"message\">No request is there now.</h2>";
        }
        else{
            while($rows = $results -> fetch_assoc()){
            $row_count = mysqli_num_rows($results);
                show($rows['image_url'],$rows['emp_id'],$rows['name'],$rows['area'],$rows['email'],$rows['mobile'],$rows['password']);
            }    
        }
        function show($image,$emp_id,$name,$area,$email,$mobile,$password){ 
    ?> 
    <script>
        function fun() {
            alert("<?php echo $name ; ?> has been registered as an employee.");
        }
    </script>
        <table>
        <ul>
        <tr>
        <th><li><img class="imgs" src="uploads/<?php echo $image?>" alt="">
        </li></th>
        <th><li><?php echo $emp_id; ?></li></th>
        <th><li><?php echo $name; ?></li></th>
        <th><li><?php echo $area; ?></li></th>
        <th><li><?php echo $email; ?></li></th>
        <th><li><?php echo $mobile; ?></li></th>
        <th>
        <li>
        <form action="emp_req.php" method="post">
            <input type="hidden" name="image" value="<?php echo $image ; ?>">
            <input type="hidden" name="emp_id" value="<?php echo $emp_id ; ?>">
            <input type="hidden" name="name" value="<?php echo $name ; ?>">
            <input type="hidden" name="area" value="<?php echo $area ; ?>">
            <input type="hidden" name="email" value="<?php echo $email ; ?>">
            <input type="hidden" name="mobile" value="<?php echo $mobile ; ?>">
            <input type="hidden" name="password" value="<?php echo $password ; ?>">
            <button class="button" type="submit" class="btn" name="register" onclick="fun();">Register</button>
        </form>
        </li>
        </tr>
        </ul>
        </table>
        
        <?php
        }
        ?>
    </div>
</body>
</html>