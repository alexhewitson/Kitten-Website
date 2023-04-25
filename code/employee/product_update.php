<html>
	<head>
		<title>Update Product-KFS</title>
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


if(isset($_GET['PROD_ID'])) {
	
	$PROD_ID = $_GET['PROD_ID'];
	
	$query = "SELECT * FROM product WHERE PROD_ID = '$PROD_ID'";

	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}

	$rows = $result->num_rows;

	for($j = 0; $j < $rows; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC); 

		echo <<<_END
			<div class="container">
				<p>Update a Product</p>
				
				<form action = "product_update.php" method = "post" style="text-align: center;">
				<input type='hidden' name='PROD_ID' value='$row[PROD_ID]'>
				
				<label>Name</label><br>
				<input type="text" class="box" name="name" value='$row[name]' required><br><br>
				
				<label>Description</label><br>
				<input type="text" class="box" name="description" value='$row[description]' required><br><br>
				
				<label>Price</label><br>
				<input type="text" class="box" name="price" type="number" value='$row[price]' required><br><br>
				
				<label>Inventory Amount</label><br>
				<input type="text" class="box" name="inventory" type="number" value='$row[inventory]' required><br><br>
				
				<label>imagepath</label><br>
				<input type="text" class="box" name="imagepath" value='$row[imagepath]' required><br><br>
				
				<input type='hidden' name='update' value='yes'>
				<input type="submit" class="Button" value="Update"><br>
			</form>
			</div>
		_END;
	}
	
}

if(isset($_POST['update'])) {
		
	$PROD_ID = $_POST['PROD_ID'];	
	
	$name = $_POST['name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$inventory = $_POST['inventory'];
	$imagepath = $_POST['imagepath'];
	
	$query = "UPDATE product 
				SET name='$name', description='$description', price='$price', 
				inventory='$inventory', imagepath='$imagepath' 
				WHERE PROD_ID='$PROD_ID'";
		
	$result = $conn->query($query); 
	if(!$result) {
		die($conn->error);
	}

	header("Location: product_inventory.php");
}

$conn->close();

?>