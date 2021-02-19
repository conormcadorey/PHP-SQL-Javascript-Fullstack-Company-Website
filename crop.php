<?php 

include ("conn.php");

if (!$conn)  {
    die("connection failed: ".mysqli_connect_error()); 
}

if(isset($_POST["image"]))   {

    $updateid = $_GET["staffid"];   
    $data = $_POST["image"];

    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    
    $imageName = time() . '.png';
    
    $fileDestination = "useruploads/".$imageName;
    
    file_put_contents($fileDestination, $data);
        //$updatequery = "UPDATE `staff` SET staffPic='".$imageName."' WHERE staffID = '$updateid'";                     
            //$result = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
    
    echo '<img src="'.$fileDestination.'" class="img-thumbnail mt-5" />';
    
} 
    
?>
