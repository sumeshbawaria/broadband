<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>broadband</title>
</head>
<body>
<?php
    include "db_connect.php";
    
    $sql = "select * from plans";
    
    $result = mysqli_query($conn,$sql);
    // echo "print";
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    else{
        // echo "running";
    }
    
    while($rows = $result -> fetch_assoc()){
        cards($rows['speed'],$rows['duration'],$rows['price']);
    }
    
    function cards($speed,$duration,$price){
            echo "<div class=\"card\">
                    <div class=\"card-content\">
                    <h3> price: $price</h3>
                    <p>Speed: $speed</p>
                    <p>Duration: $duration</p>
                    <button>purchase</button>
                </div>
    </div>";
}

?>

</body>
</html>