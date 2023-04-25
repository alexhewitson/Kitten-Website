<html>
	<head>
		<title>Cart-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a>
		</div>
	</head>
</html>

<?php

$page_roles = array('customer');

require_once "../../database/dbinfo.php";
require_once "cart.php";
require_once "../authorization/check_session.php";
require_once "../authorization/user.php";


if(isset($_SESSION['cart'])) {
	$cart = $_SESSION['cart'];
	$user = $_SESSION['user'];
	$username = $user->username;

	echo <<< _END
		<div class="container">
			<p>Shopping Cart for $username</p>
			<form method='post' action='cart_checkout.php'>
	_END;

	foreach($cart as $item){
		$productname = $item->productname;
		$unitprice = $item->unitprice;

		echo <<<_END
				$productname, $$unitprice each
				<br>Quantity <input type='text' name='quantity[]' value=1 size='2'><br><br>
		_END;
	}

	echo <<< _END
			<input type='hidden' name='checkout'>
		</div>
		<center><input type='submit' class='Button' value='Checkout'></form></center>
	_END;

} else {
	echo <<< _END
		<div class="container">
			<p>Your shopping cart is empty</p>
			<a href="../both/product_list.php">View Products</a>
		</div>
	_END;
}

?>