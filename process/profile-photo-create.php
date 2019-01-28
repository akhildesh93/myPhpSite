<?php
session_start();
include '../includes/db.php';

/*START - CREATE THUMBNAIL AND SAVE TO FOLDER*/

$imgSrc = $_FILES['photo']['tmp_name'];

list($width, $height) = getimagesize($imgSrc);

$myImage = imagecreatefromjpeg($imgSrc);

if($width > $height){
    $y = 0;
    $x = ($width - $height)/2;
    $smallestSide = $height;
} else {
    $x = 0;
    $y = ($width - $height)/2;
    $smallestSide = $width;
}

$thumbSize = 300;
$thumb = imagecreatetruecolor($thumbSize, $thumbSize);

imagecopyresampled($thumb, $myImage, 0,0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

$filename = pathinfo($_FILES['photo']['name'], PATHINFO_FILENAME);

imagejpeg($thumb, '../img/' . $filename . '.jpg');

/*END - CREATE THUMBNAIL AND SAVE TO FOLDER*/






/*START - DATABASE ENTRY*/

$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO profile_photos (user_id, file_name) VALUES ('{$user_id}', '{$filename}.jpg')";

mysqli_query($conn, $sql);

mysqli_close($conn);

/*END - DATABASE ENTRY*/


header("Location: ../profile.php?id={$user_id}");

?>