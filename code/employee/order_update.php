<html>
	<head>
		<title>Update Status-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a>
		</div>
	</head>
</html>

<?php

$page_roles = array('employee');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}


if(isset($_GET['ORD_ID'])) {
	
	$ORD_ID = $_GET['ORD_ID'];
	
	$query = "SELECT status FROM orders WHERE ORD_ID = '$ORD_ID'";

	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}

	$rows = $result->num_rows;

	for($j = 0; $j < $rows; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC); 

		echo <<<_END
			<div class="container">
				<p>Update Order Status</p>
				
				<form action = "order_update.php" method = "post" style="text-align: center;">
				<input type='hidden' name='ORD_ID' value='$ORD_ID'>
				
				<label>Status</label><br>
				<input type="text" class="box" name="status" value='$row[status]' required><br><br>
				
				<input type='hidden' name='update' value='yes'>
				<input type="submit" class="Button" value="Update"><br>
			</form>
			</div>
		_END;
	}
	
}

if(isset($_POST['update'])) {
		
	$ORD_ID = $_POST['ORD_ID'];	
	
	$status = $_POST['status'];
	
	$query = "UPDATE orders 
				SET status='$status'
				WHERE ORD_ID='$ORD_ID'";
		
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}

	header("Location: ../both/home_page.php");
}

$conn->close();

?>