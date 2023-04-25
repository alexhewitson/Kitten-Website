<html>
	<head>
		<title>Products-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a><br><br>
			<a href='../customer/cart_view.php'>Go to shopping cart</a><br><br>
			<p>Available Products</p>
		</div>
	</head>
</html>

<?php

$page_roles = array('customer', 'employee');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";
require_once '../customer/cart.php';
require_once "../authorization/user.php";

$user = $_SESSION['user'];
$_SESSION['user'] = $user;


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM product";

$result = $conn->query($query); 
if(!$result) die($conn->error);

while($row = $result->fetch_array(MYSQLI_ASSOC)){

	if ($row['inventory'] > 0) {
		echo <<< _END
			<div class="product-container">
				<br><div class="product-image">
					<img src="$row[imagepath]", alt="$row[name]">
				</div>
				<div class="product-details">
					<h2 class="product-name">$row[name]</h2>
					<p class="product-description">$row[description]</p>
					<p class="product-price">$$row[price]</p>
					<form action='product_list.php' method='post' class='exempt-form'>
						<input type='hidden' name='price' value='$row[price]'>
						<input type='hidden' name='PROD_ID' value='$row[PROD_ID]'>
						<input type='hidden' name='name' value='$row[name]'>
						<input type='submit' class='Button' value='Add to Cart'>
					</form>
				</div>
			</div>
		_END;
	}
}

// add to cart
if(isset($_POST["PROD_ID"])){
	
	// if cart exists in session, then use it
	// else add the new cart into the session
	$cart = array();	
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
	}
	
	$user = $_SESSION['user'];
    $username = $user->username;
    $date = date("Y/m/d");
    $productid = $_POST["PROD_ID"];
	$productname = $_POST["name"];
    $units = 0;
    $unitprice = $_POST['price'];
    $total = 0;
    $status = "active";
	
	// create a cart item object
	$cartitem = new CartItem($username, $date, $productname, $productid, $units, $unitprice, $total, $status);
	
	// add cart item into cart then into session
	array_push($cart, $cartitem);
	$_SESSION["cart"] = $cart;
}

$conn->close();

?>