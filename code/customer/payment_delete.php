<?php

$page_roles = array('customer');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}

if(isset($_GET['PMT_ID'])) {
	$PMT_ID = $_GET['PMT_ID'];
	$username = $_GET['username'];
	
	$query = "DELETE FROM payment WHERE PMT_ID = $PMT_ID;";
	
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}
	header("Location: payment_list.php?username=$username");
}

$conn->close();

?>