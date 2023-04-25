<html>
	<head>
		<title>Login-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
	</head>
	
	<body>
		<div class="container">
			<h1>Kitten Factory Skis</h1><br><br>
			<form method = "post" action="login.php">
				<label>Username</label><br>
				<input type="text" name='username' class="box" required><br><br>

				<label for="password">Password</label><br>
				<input type="password" name='password' class="box" required><br><br>


				<input type="submit" class="Button" value="Sign in"><br><br>

				<hr>

				<p>New around here? <br><a href="account_create_customer.php">Sign up as customer</a><br>
				<a href="account_create_employee.php">Sign up as employee</a></p>

			</form>
		</div>
	</body>
</html>

<?php

require_once "../../database/dbinfo.php";
require_once "../authorization/user.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if (isset($_POST['username']) && isset($_POST['password'])) {
	
	// get and sanitize values from login screen
	$tmp_username = mysql_entities_fix_string($conn, 'username');
	$tmp_password = mysql_entities_fix_string($conn, 'password');
	
	// get password from DB w/ SQL
	$query = "SELECT password FROM users WHERE username = '$tmp_username'";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$rows = $result->num_rows;
	$passwordFromDB="";
	for($j = 0; $j < $rows; $j++) {
		$result->data_seek($j); 
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$passwordFromDB = $row['password'];
	}
	
	// compare passwords
	if(password_verify($tmp_password,$passwordFromDB)) {
		echo "successful login<br>";

		$user = new User($tmp_username);
		
		session_start();
		
		$_SESSION['user'] = $user;
		
		header("Location: ../both/home_page.php");
	} else {
		echo "incorrect username/password combination<br>";
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