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
        
        h1{
            text-align: center;
            background-color: #c0f1ac;
            padding: 1em;
            font-size: 2rem;
        }
        .pay{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: none;
        }
        form{
            background-color: grey;
            padding: 2em;
            margin: 2em ;
            border-radius: 1em;            
        }
        form p{
            margin: 1em;
        }
        form input[type=submit]{
            margin-left: 1em;
            padding: .5em 3em;
            border: none;
            border-radius: 10px;
            background-color: white;
        }
        form input[type=submit]:hover{
            background-color: rgb(247, 137, 82);
            color: white;
        }
    </style>
</head>
<body>
    <script>
        function fun_pay(){
            alert("payment has been done.");
        }
    </script>
<h1>Payment page</h1>

<div class="pay">
    
<form action="payment.php" method="POST">
    <p>
        <label>Name</label>
        <input type="text" name="name" size="50" />
    </p>
    <p>
        <label>Email</label>
        <input type="text" name="email" size="50" />
    </p>
    <p>
        <label>Card Number</label>
        <input type="text" name="card_num" size="20" autocomplete="off" 
class="card-number" />
    </p>
    <p>
        <label>CVC</label>
        <input type="text" name="cvc" size="4" autocomplete="off" class="card-cvc" />
    </p>
    <p>
        <label>Expiration (MM/YYYY)</label>
        <input type="text" name="exp_month" size="2" class="card-expiry-month"/>
        <span> / </span>
        <input type="text" name="exp_year" size="4" class="card-expiry-year"/>
    </p>
    <input type="submit" value="SUBMIT" onclick=fun_pay()>
</form>
</div>

<?php 

?>

</body>
</html>