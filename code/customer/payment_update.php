<html>
	<head>
		<title>Update Payment Method-KFS</title>
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


if(isset($_GET['PMT_ID'])) {
	
	$PMT_ID = $_GET['PMT_ID'];
	$username = $_GET['username'];
	
	$query = "SELECT * FROM payment WHERE PMT_ID = '$PMT_ID'";

	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}

	$rows = $result->num_rows;

	for($j = 0; $j < $rows; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC); 

		echo <<<_END
			<div class="container">
				<p>Update Payment Details</p>
				<form action="payment_update.php" method="post">
					<input type='hidden' name='PMT_ID' value='$row[PMT_ID]'>
					<input type='hidden' name='username' value='$username'>
				
					<label>Credit Card Number</label><br>
					<input type="text" class="box" name="credit_card" pattern="[0-9]{16}" value='$row[credit_card]'required><br><br>
					
					<label>Expiration Date</label><br>
					<input type="text" class="box" name="exp_date" pattern="\d{2}\/\d{4}" value='$row[exp_date]' required><br><br>

					<input type='hidden' name='update' value='yes'>
					<input type='submit' class='Button' value='Update'>
				</form>
			</div>
		_END;
	}
	
}

if(isset($_POST['update'])) {
		
	$PMT_ID = $_POST['PMT_ID'];	
	
	$username = $_POST['username'];
	$credit_card = $_POST['credit_card'];
	$exp_date = $_POST['exp_date'];
	
	$query = "UPDATE payment 
				SET exp_date = '$exp_date', credit_card = '$credit_card'
				WHERE PMT_ID = $PMT_ID;
				";
		
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}

	header("Location: payment_list.php?username=$username");
}

$conn->close();

?>