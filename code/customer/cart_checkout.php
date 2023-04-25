<html>
	<head>
		<title>Checkout-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a>
			<p>Checkout</p>
		</div>
	</head>
</html>

<?php

$page_roles = array('customer');

require_once "../../database/dbinfo.php";
require_once "cart.php";
require_once "../authorization/check_session.php";
require_once "../authorization/user.php";

if(isset($_POST['checkout'])){
	$cartarray = $_SESSION['cart'];
	$user = $_SESSION['user'];
	$quantity = $_POST['quantity'];

	$count = 0;
	$grand_total = 0;
	foreach($cartarray as $item){
		$productname = $item->productname;
		$units= $quantity[$count];
		$unitprice = $item->unitprice;
		$total = $units * $unitprice;
		$grand_total = $grand_total + $total;
		
		// set quantity
		$cartarray[$count]->units = $quantity[$count];
		$cartarray[$count]->total = $total;

		$count++;

		echo <<< _END
			<div class="container">
				<form>
					$units $productname at $$unitprice each.
					Total: $$total
					<br><br>
		_END;

	}
	echo <<< _END
				GRAND TOTAL: $grand_total <br><br>
				<a href='cart_pay.php?checkout=1'>PROCEED TO PAY</a>
			</form>
		</div>
	_END;
}

?>