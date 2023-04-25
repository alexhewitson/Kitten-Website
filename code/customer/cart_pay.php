<html>
	<head>
		<title>Pay-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a><br><br>
		</div>
	</head>
</html>

<?php

$page_roles = array('customer');

require_once "../../database/dbinfo.php";
require_once "cart.php";
require_once "../authorization/check_session.php";
require_once "../authorization/user.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) {
	die($conn->connect_error);
}

if(isset($_GET['checkout'])){
	$cartarray = $_SESSION['cart'];
	$user = $_SESSION['user'];
	$username = $user->username;
	
	// get the USER_ID from the username
	$username = $user->username;

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
		
	// print each payment method
	$query = "SELECT * FROM payment WHERE CUST_ID = '$CUST_ID';";

	$result = $conn->query($query);
	if(!$result) {
		die($conn->error);
	}

	echo <<<_END
		<div class="container">
			<p>Select Method of Payment</p>
		<table>
			<tr>
				<th>PMT_ID</th>
				<th>Date</th>
				<th>Credit Card Number</th>
				<th>Select Card</th>
			</tr>
	_END;

	$rows = $result->num_rows;

	for($j = 0; $j < $rows; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC); 

		echo "<tr>";
		echo "<td>" . $row['PMT_ID'] . "</td>";
		echo "<td>" . $row['exp_date'] . "</td>";
		echo "<td>" . $row['credit_card'] . "</td>";
		echo "<td>" . "<a href='cart_pay.php?PMT_ID=$row[PMT_ID]&CUST_ID=$CUST_ID'>Pay Now</a>" . "</td>";
		echo "</tr>";
	}
	echo "</table></div>";
	
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
	
}

if(isset($_GET['PMT_ID'])) {
	$PMT_ID = $_GET['PMT_ID'];
	$CUST_ID = $_GET['CUST_ID'];
		
	$cartarray = $_SESSION['cart'];
	$firstcart = $cartarray[0];
	$userid = $firstcart->userid;
	$date = $firstcart->cartdate;
	
	// get grand total for the order
	$grand_total = 0;
	foreach($cartarray as $item) {
		$total = $item->total;
		$grand_total = $grand_total + $total;
	}
	
	// insert order row	
	$query = "INSERT INTO orders (total_price, status, date, PMT_ID, CUST_ID)
				VALUES ($grand_total, 'Processing', '$date', $PMT_ID, $CUST_ID)";

	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$ORD_ID = $conn->insert_id;
	
	$status = True;
	// process each orderline item in the cart
	foreach ($cartarray as $item){		
		$PROD_ID = $item->productid;
		$productname = $item->productname; 
		$units = $item->units; 
		$unit_price = $item->unitprice;
		$total_price = $item->total;

		// create orderline rows
		$query = "INSERT INTO orderline (PROD_ID, quantity, unit_price, total_price, ORD_ID)
					VALUES ($PROD_ID, $units, $unit_price, $total_price, $ORD_ID)";
		$result = $conn->query($query); 
		if(!$result) die($conn->error);
		
		$status = decrementInventory($PROD_ID, $units, $conn);
	}

	// empty the cart
	$_SESSION["cart"] = null;		
		
	$user = $_SESSION['user'];	
	$username = $user->username;
	
	// order will ship soon if all items are in stock
	if ($status) {
		echo <<< _END
			<div class="container">
				<form action = "../both/home_page.php">
					Thank you, $username. Your order is successfully submitted. Your purchase will ship soon.<br><br><br>
					<input type="submit" class="Button" value="Home"><br>
				</form>
			</div>
		_END;
	// otherwise, notify the customer that they will have to wait and change the rder status
	} else {
		// Update the order's status
		$query = "UPDATE orders SET status = 'Wait Inv' WHERE `ORD_ID` = '$ORD_ID'";
		$conn->query($query);
		echo <<< _END
			<div class="container">
				<form action = "../both/home_page.php">
					Thank you, $username. Your order is successfully submitted. Your purchase will ship as soon as all items become available.<br><br><br>
					<input type="submit" class="Button" value="Home"><br>
				</form>
			</div>
		_END;
	}
}

function decrementInventory($PROD_ID, $quantity, $conn) {
	// Get the current inventory for the product
	$sql = "SELECT inventory FROM product WHERE PROD_ID = $PROD_ID";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$current_inventory = $row['inventory'];

	// Decrement the inventory by the number of units ordered
	$new_inventory = $current_inventory - $quantity;
	
	$status = True;
	if ($new_inventory < 0) {
		$status = False;
	}

	// Update the inventory in the database
	$query = "UPDATE product SET inventory = $new_inventory WHERE PROD_ID = $PROD_ID";
	$conn->query($query);
	
	return $status;
}

$conn->close();

?>