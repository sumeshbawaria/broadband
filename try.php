<?php
    include "partials/db_connect.php";

// Get reference to uploaded image
if(isset($_FILES["image"])){
    $image_file = $_FILES["image"];
    $new_img_name = $image_file["name"];

    $query = "INSERT INTO try(image_url) 
                  VALUES('$new_img_name')";
    $result=mysqli_query($conn, $query);

    // Image not defined, let's exit
    // if (!isset($image_file)) {
        //     die('No file uploaded.');
// }
// Move the temp image file to the images/ directory
move_uploaded_file(
    // Temp image location
    $image_file["tmp_name"],
    
    // New image location, __DIR__ is the location of the current PHP file
    __DIR__ . "/try/" . $image_file["name"]
);
echo $new_img_name;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>try</title>
    <style>
        .imgs{
            width: 100px;
        }
    </style>
</head>
<body>
    <form action="try.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" />
    <button type="submit">Upload</button>
    <?php
        $query = "select * from try";
        $res = mysqli_query($conn, $query);
        
    while($rows = $res ->  fetch_assoc()){
        $img_name = $rows['image_url'];
    ?>
    <p><?php $img_name?></p>
        <img class="imgs" src="try/<?php echo $img_name?>" alt="">
    <?php
    }
    ?>
</form>
</body>
</html>
