<html>
	<head>
		<title>Your Returns-KFS</title>
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

// get the logged in user's user_id
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

// print each product method
$query = "SELECT orders.*, payment.credit_card
			FROM orders
			JOIN payment ON orders.PMT_ID = payment.PMT_ID
			WHERE orders.CUST_ID = '$CUST_ID' AND orders.status LIKE 'RTN%'
			ORDER BY date DESC;";

$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

echo <<<_END
	<div class="container">
		<p>Your Returns</p>
	<table>
		<tr>
			<th>Date</th>
			<th>Total</th>
			<th>Credit Card</th>
			<th>Status</th>
			<th>Details</th>
		</tr>
_END;

$rows = $result->num_rows;

for($j = 0; $j < $rows; $j++) {
	$row = $result->fetch_array(MYSQLI_ASSOC); 

	echo "<tr>";
	echo "<td>" . $row['date'] . "</td>";
	echo "<td>" . $row['total_price'] . "</td>";
	echo "<td>" . $row['credit_card'] . "</td>";
	echo "<td>" . $row['status'] . "</td>";
	echo "<td>" . "<a href='order_details.php?ORD_ID=$row[ORD_ID]'>View</a>" . "</td>";
	echo "</tr>";
}
echo "</table></div>";


$conn->close();

?>