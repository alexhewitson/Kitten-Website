<?php

$page_roles = array('employee');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}

if(isset($_GET['PROD_ID'])) {
	$PROD_ID = $_GET['PROD_ID'];
	
	$query = "DELETE FROM product WHERE PROD_ID = $PROD_ID;";
	
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}
	header("Location: product_inventory.php");
}

$conn->close();

?>