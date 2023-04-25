<html>
	<head>
		<title>Returned Orders-KFS</title>
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

// print each order
$query = "SELECT orders.ORD_ID, orders.date, payment.credit_card, orders.status, orders.total_price, users.username
			FROM orders
			JOIN customer ON orders.CUST_ID = customer.CUST_ID
			JOIN users ON customer.USER_ID = users.USER_ID
			JOIN payment ON orders.PMT_ID = payment.PMT_ID
			WHERE orders.status LIKE 'RTN%';";

$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

echo <<<_END
	<div class="container">
		<p>Returned Orders</p>
	<table>
		<tr>
			<th>Order ID</th>
			<th>Date</th>
			<th>Credit Card</th>
			<th>Status</th>
			<th>Items</th>
			<th>Total</th>
			<th>Username</th>
			<th>Update Status</th>
		</tr>
_END;

$rows = $result->num_rows;

for($i = 0; $i < $rows; $i++) {
	$row = $result->fetch_array(MYSQLI_ASSOC); 

	// get each order item
	$query2 = "SELECT product.name, orderline.quantity
				FROM product
				INNER JOIN orderline ON product.PROD_ID = orderline.PROD_ID
				WHERE orderline.ORD_ID = '$row[ORD_ID]'";

	$result2 = $conn->query($query2);
	if(!$result2) {
		die($conn->error);
	}
	
	$rows2 = $result2->num_rows;

	$items = '';
	for($j = 0; $j < $rows2; $j++) {
		$row2 = $result2->fetch_array(MYSQLI_ASSOC);
		$items = $items . "$row2[quantity]: $row2[name]<br>";
	}

	echo "<tr>";
	echo "<td>" . $row['ORD_ID'] . "</td>";
	echo "<td>" . $row['date'] . "</td>";
	echo "<td>" . $row['credit_card'] . "</td>";
	echo "<td>" . $row['status'] . "</td>";
	echo "<td>" . $items . "</td>";
	echo "<td>" . $row['total_price'] . "</td>";
	echo "<td>" . $row['username'] . "</td>";
	echo "<td>" . "<a href='order_update.php?ORD_ID=$row[ORD_ID]'>Update</a>" . "</td>";
	echo "</tr>";
}
echo "</table></div>";


$conn->close();

?>