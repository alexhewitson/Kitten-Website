<html>
	<head>
		<title>Account Details-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a>
		</div>
	</head>
</html>

<?php

$page_roles = array('customer', 'employee');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}

if(isset($_GET['username'])){
	
	$username = $_GET['username'];

	$query = "SELECT * FROM users WHERE username = '$username';";

	$result = $conn->query($query);
	if(!$result) {
		die($conn->error);
	}

	$rows = $result->num_rows;

	for($j = 0; $j < $rows; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC); 
		
		// display employee details
		if ($row['role'] == 'employee') {
			$query = "SELECT * FROM employee
					INNER JOIN users ON employee.USER_ID = users.USER_ID
					WHERE employee.USER_ID = '$row[USER_ID]';
					";

			$result = $conn->query($query); 
			if(!$result) {
				die($conn->error);
			}

			$rows = $result->num_rows;

			for($j = 0; $j < $rows; $j++) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				
				echo <<<_END
					<body>
						<div class="container">
							<p>Account Details for $row[username] - employee</p><br>
							
							<p>Username: $row[username]<br>
							   First Name: $row[first_name]<br>
							   Last Name: $row[last_name]<br>
							   Position: $row[position]<br>
							   Employee ID: $row[EMP_ID]<br>
							</p>
						</div>
					</body>
				_END;
			}
		// display customer details
		} else {
			$query = "SELECT * FROM customer
			INNER JOIN users ON customer.USER_ID = users.USER_ID
			WHERE customer.USER_ID = '$row[USER_ID]';
			";

			$result = $conn->query($query); 
			if(!$result) {
				die($conn->error);
			}

			$rows = $result->num_rows;

			for($j = 0; $j < $rows; $j++) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				
				echo <<<_END
					<body>
						<div class="container">
							<p>Account Details for $row[username] - customer</p><br>
							
							<p>Username: $row[username]<br>
							   First Name: $row[first_name]<br>
							   Last Name: $row[last_name]<br>
							   Address: $row[address]<br>
							   Customer ID: $row[CUST_ID]<br>
							</p>
						</div>
					</body>
				_END;
			}
		}
		
		 		
		echo <<<_END
			<div class="container">
				<a href="account_update.php?USER_ID=$row[USER_ID]&role=$row[role]"><button type="button" class="Button">Update Details</button></a>
			
				<form action='account_delete.php' method='post' class='exempt-form'>
					<input type='hidden' name='delete' value='yes'>
					<input type='hidden' name='USER_ID' value='$row[USER_ID]'>
					<input type='hidden' name='role' value='$row[role]'>
					<input type='submit' class='Button' value='Delete Account'>
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
}

$conn->close();

?>