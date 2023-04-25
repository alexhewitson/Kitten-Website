<html>
	<head>
		<title>Add Payment-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a><br><br>
		</div>
	</head>
</html>

<?php

$page_roles = array('customer');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(isset($_POST['add_pmt'])) {
	
	$username = $_POST['username'];
	$CUST_ID = $_POST['CUST_ID'];

	echo <<<_END
		<div class="container">
			<form action = "payment_add.php" method = "post" style="text-align: center;">
				<p>Add a new Payment Method</p>
				<input type='hidden' name='username' value=$username>
				<input type='hidden' name='CUST_ID' value=$CUST_ID>
				
				<label>Credit Card Number</label><br>
				<input type="text" class="box" name="credit_card" pattern="[0-9]{16}" required><br><br>
				
				<label>Expiration Date</label><br>
				<input type="text" class="box" name="exp_date" pattern="\d{2}\/\d{4}" placeholder="MM/YYYY" required><br><br>
				
				<input type="submit" class="Button" value="Create"><br>
			</form>
		</div>
	_END;
}

if(isset($_POST['CUST_ID']) &&
	isset($_POST['credit_card']) &&
	isset($_POST['exp_date'])) {
		
		$CUST_ID = mysql_entities_fix_string($conn, 'CUST_ID');
		$credit_card = mysql_entities_fix_string($conn, 'credit_card');
		$exp_date = $_POST['exp_date'];
		$username = $_POST['username'];

		// insert into payment
		$query = "INSERT INTO payment (exp_date, credit_card, CUST_ID) VALUES ".
			"('$exp_date','$credit_card','$CUST_ID')";
			
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
			
		header("Location: payment_list.php?username=$username");
}
	
$conn->close();

// sanitization functions
function mysql_entities_fix_string($conn, $string) {
	return htmlentities(mysql_fix_string($conn, $string));	
}

function mysql_fix_string($conn, $string) {
	$string = stripslashes($string);
	return $conn->real_escape_string($_POST[$string]);
}

?>