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
        <h2>Customer Request Panel</h2>
    </div>
        
        <?php
    $area = $_SESSION['emp_area'];
    $emp_id = $_SESSION['emp_id'];
    $query = "SELECT  * FROM cust_req where c_area = '$area'";
    $result=mysqli_query($conn,$query);
    if($result){
      while($rows=mysqli_fetch_assoc($result)){
        
        ?> 
    <table id="customers">
      <tr>
        <th>Name</th>
        <th>Area</th>
        <th>Email ID</th>
        <th>Mobile no.</th>
        <th>Action</th>
      </tr>
    <tr>
        <td><?php echo $rows['c_name'] ?></td>
        <td><?php echo $rows['c_area'] ?></td>
        <td><?php echo $rows['c_email'] ?></td>
        <td><?php echo $rows['c_mobile'] ?></td>
        <td><form action="emp_cus_req.php" method="post">
                <input type="hidden" name="c_sno" value="<?php echo $rows['sno'] ;?>" >
                <input type="hidden" name="c_name" value="<?php echo $rows['c_name'] ;?>" >
                <input type="hidden" name="c_area" value="<?php echo $rows['c_area'] ;?>" >
                <input type="hidden" name="c_email" value="<?php echo $rows['c_email'] ;?>" >
                <input type="hidden" name="c_mobile" value="<?php echo $rows['c_mobile'] ;?>" >
                <input type="hidden" name="c_password" value="<?php echo $rows['password'] ;?>" >
                <input type="hidden" name="c_emp_id" value="<?php echo $emp_id ;?>" >
                <input type="submit" value="connection" name="connection">
            </form>
        </td>
    </tr>
    <?php
    }
        }
        else{
        echo "<h2 id=\"message\">No request is there now.</h2><?php";
        }
        
        if(isset($_POST['connection'])){
        $sno = $_POST['c_sno'];
        $name = $_POST['c_name'];
        $area = $_POST['c_area'];
        $email = $_POST['c_email'];
        $mobile = $_POST['c_mobile'];
        $password = $_POST['c_password'];
        $c_emp_id = $_POST['c_emp_id'];
        // --------------------------for insertion----------------------------------------
            $insert_emp_details = "INSERT INTO `customer`( `c_name`, `c_area`, `c_email`,`c_mobile`,  `password` ,`c_emp_id`)
            VALUES('$name', '$area', '$email',  '$mobile','$password', '$c_emp_id')";
        
            mysqli_query($conn, $insert_emp_details);
        
        //-----------------------------for deletion---------------------------------------
            $delete_query = "DELETE FROM cust_req WHERE `sno` = '$sno' ";
            mysqli_query($conn, $delete_query);

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
	$mail->Password = "ugnuyfcomsqmoumo";
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
$mail_content = "Your are registered as a customer. <br> now you can login as a customer.";
echo smtp_mailer($email,'Customer registered',$mail_content);
}
    ?>
</table>
</body>
</html>