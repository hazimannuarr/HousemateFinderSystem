<?php
 
$dbservername = "lrgs.ftsm.ukm.my";
$dbusername = "a167556";
$dbpassword = "cutegreentiger";
$dbname = "a167556";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
	die("Connection failed:".mysqli_connect_error());
}
?>