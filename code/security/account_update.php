<html>
	<head>
		<title>Update Account-KFS</title>
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
require_once "../authorization/user.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}


if(isset($_GET['USER_ID'])) {
	
	$USER_ID = $_GET['USER_ID'];
	$role = $_GET['role'];
	
	if ($role == 'employee') {
	
		$query = "SELECT * FROM employee
						INNER JOIN users ON employee.USER_ID = users.USER_ID
						WHERE employee.USER_ID = '$USER_ID'";

		$result = $conn->query($query); 
		if(!$result) {
			die($conn->error);
		}

		$rows = $result->num_rows;

		for($j = 0; $j < $rows; $j++) {
			$row = $result->fetch_array(MYSQLI_ASSOC); 

			echo <<<_END
				<div class="container">
					<p>Update Account Details for $row[username] - employee</p>
					<form action="account_update.php" method="post">
						<input type='hidden' name='USER_ID' value='$row[USER_ID]'>
						<input type='hidden' name='EMP_ID' value='$row[EMP_ID]'>
						<input type='hidden' name='role' value='employee'>
					
						Username: <input type="text" name="username" value="$row[username]" required><br><br>
						
						First Name: <input type="text" name="first_name" value="$row[first_name]" required><br><br>
						
						Last Name: <input type="text" name="last_name" value="$row[last_name]" required><br><br>
						
						Position: <input type="text" name="position" value="$row[position]" required><br><br>
						
						Create New Password (optional): <input type="password" name="password""><br><br>
										
						<input type='hidden' name='update' value='yes'>
						<input type='hidden' name='movie_id' value='$row[USER_ID]'>
						<input type='submit' class='Button' value='Update'>
					</form>
				</div>
			_END;
		}
	} else {
			
		$query = "SELECT * FROM customer
						INNER JOIN users ON customer.USER_ID = users.USER_ID
						WHERE customer.USER_ID = '$USER_ID'";

		$result = $conn->query($query); 
		if(!$result) {
			die($conn->error);
		}

		$rows = $result->num_rows;

		for($j = 0; $j < $rows; $j++) {
			$row = $result->fetch_array(MYSQLI_ASSOC); 

			echo <<<_END
				<div class="container">
					<p>Update Account Details for $row[username] - customer</p>
					<form action="account_update.php" method="post">
						<input type='hidden' name='USER_ID' value='$row[USER_ID]'>
						<input type='hidden' name='CUST_ID' value='$row[CUST_ID]'>
						<input type='hidden' name='role' value='customer'>
					
						Username: <input type="text" name="username" value="$row[username]" required><br><br>
						
						First Name: <input type="text" name="first_name" value="$row[first_name]" required><br><br>
						
						Last Name: <input type="text" name="last_name" value="$row[last_name]" required><br><br>
						
						Address: <input type="text" name="address" value="$row[address]" required><br><br>
						
						Create New Password (optional): <input type="password" name="password""><br><br>
										
						<input type='hidden' name='update' value='yes'>
						<input type='submit' class='Button' value='Update'>
					</form>
				</div>
			_END;
		}
	}
}

if(isset($_POST['update'])) {
		
	$USER_ID = $_POST['USER_ID'];	
	
	$username = $_POST['username'];
	$role = $_POST['role'];
	$first = $_POST['first_name'];
	$last = $_POST['last_name'];
	
	if ($role == 'employee') {
		$position = $_POST['position'];
		$EMP_ID = $_POST['EMP_ID'];
		$query = "UPDATE employee
				JOIN users ON employee.USER_ID = users.USER_ID
				SET employee.first_name = '$first', employee.last_name = '$last', employee.position = '$position', users.username = '$username'
				WHERE employee.EMP_ID = '$EMP_ID';";
	} else {
		$address = $_POST['address'];
		$CUST_ID = $_POST['CUST_ID'];
		$query = "UPDATE customer
				JOIN users ON customer.USER_ID = users.USER_ID
				SET customer.first_name = '$first', customer.last_name = '$last', customer.address = '$address', users.username = '$username'
				WHERE customer.CUST_ID = '$CUST_ID';";
	}
		
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}
	
	// update the password if it was changed
	if($_POST['password'] != '') {
		// hash the password to store in DB
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$query = "UPDATE users
				SET password = '$password'
				WHERE USER_ID = '$USER_ID';";

		$result = $conn->query($query); 
		if(!$result) {
			die($conn->error);
		}
	}
	header("Location: logout.php");
}

$conn->close();

?>