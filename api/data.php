<?php
/**
 * filename: data.php
 * description: this will return the score of the teams.
 */

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'lrgs.ftsm.ukm.my');
define('DB_USERNAME', 'a167556');
define('DB_PASSWORD', 'cutegreentiger');
define('DB_NAME', 'a167556');
include_once 'session.php';
//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT fld_room_name, visit_male, visit_female, visit_anon FROM dev_room WHERE fld_landlord='$uid' GROUP BY fld_room_name");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result


//close connection
$mysqli->close();

//now print the data
print json_encode($data);