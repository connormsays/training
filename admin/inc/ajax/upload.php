<?php
require('../site.php');
require('../db.php');

$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/training/training/admin/dist/img/";
$file = "image_".uniqid() . basename($_FILES["file"]["name"]);
$target_file = $target_dir . $file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    	$_SESSION['staffPic'] = "./dist/img/$file";
    	$sql = "UPDATE staff SET profilePictureLocation='./dist/img/$file' WHERE id ='{$_SESSION['staffID']}'";
    	$res = $mysqli->query($sql);
    	if(!$res)
    	{
    		echo $mysqli->error;
    	}
       
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}