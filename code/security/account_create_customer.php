<html>
	<head>
		<title>Create Account-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<h1>Kitten Factory Skis</h1>
		</div>
	</head>
</html>

<?php

require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
	<div class="container">
		<form action = "account_create_customer.php" method = "post" style="text-align: center;">
			<p>Create a new customer account</p>
			<label>Username</label><br>
			<input type="text" class="box" name = "username" required><br><br>
			
			<label>Password</label><br>
			<input type="password" class="box" name = "password" required><br><br>
			
			<label>First Name</label><br>
			<input type="text" class="box" name = "first" required><br><br>
			
			<label>Last Name</label><br>
			<input type="text" class="box" name = "last" required><br><br>
			
			<label>Shipping Address</label><br>
			<input type="text" class="box" name = "address" required><br><br>
			
			<input type="submit" class="Button" value="Create"><br><br>
		</form>
	</div>
_END;


if(isset($_POST['username']) &&
	isset($_POST['password']) &&
	isset($_POST['first']) &&
	isset($_POST['last']) &&
	isset($_POST['address'])) {
		$username = mysql_entities_fix_string($conn, 'username');
		$password = mysql_entities_fix_string($conn, 'password');
		$role = "customer";
		$first = mysql_entities_fix_string($conn, 'first');
		$last = mysql_entities_fix_string($conn, 'last');
		$address = mysql_entities_fix_string($conn, 'address');
		
		// hash the password to store in DB
		$password = password_hash($password, PASSWORD_DEFAULT);
		
		// insert into users
		$query="INSERT INTO users (username, password, role) VALUES ".
			"('$username','$password','$role')";
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
			
		// SQL query to retrieve the USER_ID for the given username
		$query = "SELECT USER_ID FROM users WHERE username = '$username'";

		// Execute the query
		$result = $conn->query($query);
		if(!$result) echo "USER_ID retrieve failed: $query <br>" .
			$conn->error . "<br><br>";

		// fetch the results
		if ($result->num_rows != 1) {
			echo("Error in creating account");
			// dete the row just inserted into employees
			$query="DELETE FROM USERS WHERE username = '$username' AND password = '$password' AND role = '$role'";
			$result=$conn->query($query);
			if(!$result) echo "Delete failed: $query <br>" .
				$conn->error . "<br><br>";
		} else {		
			$result->data_seek(0);
			$row=$result->fetch_array(MYSQLI_BOTH);
			$user_id = $row[0];
		}
		
		// insert into customer
 		$query="INSERT INTO customer (first_name, last_name, address, USER_ID) VALUES ".
			"('$first','$last','$address', '$user_id')";
		$result=$conn->query($query);
		if (!$result) {
			echo "INSERT failed: $query <br>" . $conn->error . "<br><br>";
		} else {
			header("Location: login.php");
		}
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