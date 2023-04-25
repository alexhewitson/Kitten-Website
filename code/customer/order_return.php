<html>
	<head>
		<title>Order Return-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a>
		</div>
	</head>
</html>

<?php

$page_roles = array('customer');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}

if(isset($_POST['return'])) {
	$ORD_ID = $_POST['ORD_ID'];
	
	$query = "UPDATE orders
				SET status = 'RTN Requested'
				WHERE ORD_ID = '$ORD_ID';";
	
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}
	
	echo <<<_END
		<div class="container"><br>
		<p>Your return has been requested, we will get back to you with shipping details.</p>
			<form action="../both/home_page.php" class='exempt-form'>
				<input type='submit' class='Button' value='Home'>
			</form>
			<style>
				form {
					display: flex;
					justify-content: center;
				}
			</style>
		</div>
	_END;
}

$conn->close();

?>