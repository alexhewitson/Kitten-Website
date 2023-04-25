<html>
	<head>
		<title>Payment List-KFS</title>
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
require_once "../authorization/user.php";

$username = '';
// get the logged in user's username
if(!isset($_SESSION['user'])) {
	header("Location: ../authorization/unauthorized.php");
	exit();
} else {
	$user = $_SESSION['user'];
	$username = $user->username;
}


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}


$query = "SELECT USER_ID FROM users WHERE username = '$username';";

$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

$row = $result->fetch_array(MYSQLI_ASSOC);
$USER_ID = $row['USER_ID'];

// get the CUST_ID from the USER_ID
$query = "SELECT customer.CUST_ID
			FROM customer
			JOIN users
			ON customer.USER_ID = users.USER_ID
			WHERE users.USER_ID = '$USER_ID';
			";
			
$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

$row = $result->fetch_array(MYSQLI_ASSOC);

$CUST_ID = $row['CUST_ID'];

// button to add a new payment method
echo <<<_END
	<style>
		form {
			display: flex;
			justify-content: center;
		}
	</style>
	<form action='payment_add.php' method='post' class='exempt-form'>
		<input type='hidden' name='add_pmt' value='yes'>
		<input type='hidden' name='CUST_ID' value='$CUST_ID'>
		<input type='hidden' name='username' value='$username'>
		<input type='submit' class='Button' value='Add Card'>
	</form>
_END;

// print each payment method
$query = "SELECT * FROM payment WHERE CUST_ID = '$CUST_ID';";

$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

echo <<<_END
	<div class="container">
		<p>Method of Payment</p>
	<table>
		<tr>
			<th>PMT_ID</th>
			<th>Date</th>
			<th>Credit Card Number</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
_END;

$rows = $result->num_rows;

for($j = 0; $j < $rows; $j++) {
	$row = $result->fetch_array(MYSQLI_ASSOC); 

	echo "<tr>";
	echo "<td>" . $row['PMT_ID'] . "</td>";
	echo "<td>" . $row['exp_date'] . "</td>";
	echo "<td>" . $row['credit_card'] . "</td>";
	echo "<td>" . "<a href='payment_update.php?PMT_ID=$row[PMT_ID]&username=$username'>Update</a>" . "</td>";
	echo "<td>" . "<a href='payment_delete.php?PMT_ID=$row[PMT_ID]&username=$username'>Delete</a>" . "</td>";
	echo "</tr>";
}
echo "</table></div>";

$conn->close();

?>