<html>
	<head>
		<title>Order Details-KFS</title>
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

if(isset($_GET['ORD_ID'])) {
	
	$ORD_ID = $_GET['ORD_ID'];

	$query = "SELECT orders.*, payment.credit_card
			FROM orders
			JOIN payment ON orders.PMT_ID = payment.PMT_ID
			WHERE ORD_ID = '$ORD_ID';";

	$result = $conn->query($query);
	if(!$result) {
		die($conn->error);
	}

	$rows = $result->num_rows;
	
	$status = '';
	for($j = 0; $j < $rows; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$status = $row['status'];
		echo <<<_END
			<body>
				<div class="container">
					<p>Details for order on $row[date]</p><br>
					
					<p>Grand Total: $row[total_price]<br>
					   Status: $status<br>
					   Credit Card: $row[credit_card]<br>
					   <br>
					</p>
				</div>
			</body>
		_END;
	}
	
	// pring each order item
	echo <<<_END
		<div class="container">
			<p>Order Items</p>
		<table>
			<tr>
				<th>Quantity</th>
				<th>Product</th>
				<th>Unit Price</th>
				<th>Total</th>
			</tr>
	_END;
	
	$query = "SELECT product.name, orderline.quantity, orderline.unit_price, orderline.total_price
				FROM product
				INNER JOIN orderline ON product.PROD_ID = orderline.PROD_ID
				WHERE orderline.ORD_ID = '$ORD_ID'";

	$result = $conn->query($query);
	if(!$result) {
		die($conn->error);
	}
	
		$rows = $result->num_rows;

	for($j = 0; $j < $rows; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		echo "<tr>";
		echo "<td>" . $row['quantity'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['unit_price'] . "</td>";
		echo "<td>" . $row['total_price'] . "</td>";
		echo "</tr>";
	}
	echo "</table></div>";
		
	if (!str_starts_with($status, 'RTN')) {
		echo <<<_END
			<div class="container"><br>
				<form action='order_return.php' method='post' class='exempt-form'>
					<input type='hidden' name='return' value='yes'>
					<input type='hidden' name='ORD_ID' value='$ORD_ID'>
					<input type='submit' class='Button' value='Return Order'>
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