<?php 
$msg = "";
$css_class = "";

$conn = mysqli_connect("lrgs.ftsm.ukm.my","a167556","cutegreentiger","a167556");

if (isset($_POST['save-user'])){
	echo "<pre>", print_r($_FILES['profilepic']['name']), "</pre>";

	$userid = $_POST['id'];
	$profilepicName = $userid . '.jpg';
	
	$target = 'images/' . $profilepicName;



	if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $target)){
		$sql = "UPDATE users (fld_photo) VALUES ('$profilepicName')";
		if(mysqli_query($conn,$sql)){

			$msg = "Image uploaded";
			$css_class = "alert-success";
		} else {
			$msg = "Failed to upload to database";
			$css_class = "alert-danger";
		}

	} else{
		$msg = "Failed to upload";
		$css_class = "alert-danger";
	}
}
/*
//Your Image
$userid = $_POST['id'];
$profilepicName = $userid . '.jpg';

$imgSrc = 'images/' . $profilepicName;

//getting the image dimensions
list($width, $height) = getimagesize($imgSrc);

//saving the image into memory (for manipulation with GD Library)
$myImage = imagecreatefromjpeg($imgSrc);

// calculating the part of the image to use for thumbnail
if ($width > $height) {
	$y = 0;
	$x = ($width - $height) / 2;
	$smallestSide = $height;
} else {
	$x = 0;
	$y = ($height - $width) / 2;
	$smallestSide = $width;
}

// copying the part into thumbnail
$thumbSize = 100;
$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

//final output
header('Content-type: image/jpeg');
imagejpeg($thumb);*/