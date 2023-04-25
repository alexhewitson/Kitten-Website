<?php

$page_roles = array('customer', 'employee');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}

if(isset($_POST['delete'])) {
	$USER_ID = $_POST['USER_ID'];
	$role = $_POST['role'];
	
	if ($role == 'employee') {
		$query = "DELETE users, employee
				FROM users
				INNER JOIN employee ON users.USER_ID = employee.USER_ID
				WHERE users.USER_ID = '$USER_ID';
				";
	} else {
		$query = "DELETE users, customer
				FROM users
				INNER JOIN customer ON users.USER_ID = customer.USER_ID
				WHERE users.USER_ID = '$USER_ID';
				";
	}
	
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}
	
	header("Location: logout.php");
}

$conn->close();

?>