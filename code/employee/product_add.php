<html>
	<head>
		<title>Add Product-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a><br><br>
		</div>
	</head>
</html>

<?php

$page_roles = array('employee');

require_once "../authorization/check_session.php";
require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(isset($_POST['add_prod'])) {
	
	echo <<<_END
		<div class="container">
			<form action = "product_add.php" method = "post" style="text-align: center;">
				<p>Add a new Product</p>
				
				<label>Name</label><br>
				<input type="text" class="box" name="name" required><br><br>
				
				<label>Description</label><br>
				<input type="text" class="box" name="description" required><br><br>
				
				<label>Price</label><br>
				<input type="text" class="box" name="price" type="number" required><br><br>
				
				<label>Inventory Amount</label><br>
				<input type="text" class="box" name="inventory" type="number" required><br><br>
				
				<label>imagepath</label><br>
				<input type="text" class="box" name="imagepath" required><br><br>
				
				<input type="submit" class="Button" value="Create"><br>
			</form>
		</div>
	_END;
}

if(isset($_POST['name']) &&
	isset($_POST['description']) &&
	isset($_POST['price']) &&
	isset($_POST['inventory']) &&
	isset($_POST['imagepath'])) {
		
		$name = mysql_entities_fix_string($conn, 'name');
		$description = mysql_entities_fix_string($conn, 'description');
		$price = $_POST['price'];
		$inventory = $_POST['inventory'];
		$imagepath = mysql_entities_fix_string($conn, 'imagepath');

		// insert into payment
		$query = "INSERT INTO product (name, description, price, inventory, imagepath) 
					VALUES ('$name', '$description', '$price', '$inventory', '$imagepath')";
			
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
			
		header("Location: product_inventory.php");
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