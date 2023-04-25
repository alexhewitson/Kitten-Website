<html>
	<head>
		<title>View Products-KFS</title>
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

// button to add a new product
echo <<<_END
	<style>
		form {
			display: flex;
			justify-content: center;
		}
	</style>
	<form action='product_add.php' method='post' class='exempt-form'>
		<input type='hidden' name='add_prod' value='yes'>
		<input type='submit' class='Button' value='Add Product'>
	</form>
_END;

// print each product
$query = "SELECT * FROM product;";

$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

echo <<<_END
	<div class="container">
		<p>Current Inventory</p>
	<table>
		<tr>
			<th>PROD_ID</th>
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>
			<th>Inventory</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
_END;

$rows = $result->num_rows;

for($j = 0; $j < $rows; $j++) {
	$row = $result->fetch_array(MYSQLI_ASSOC); 

	echo "<tr>";
	echo "<td>" . $row['PROD_ID'] . "</td>";
	echo "<td>" . $row['name'] . "</td>";
	echo "<td>" . $row['description'] . "</td>";
	echo "<td>" . $row['price'] . "</td>";
	echo "<td>" . $row['inventory'] . "</td>";
	echo "<td>" . "<a href='product_update.php?PROD_ID=$row[PROD_ID]'>Update</a>" . "</td>";
	echo "<td>" . "<a href='product_delete.php?PROD_ID=$row[PROD_ID]'>Delete</a>" . "</td>";
	echo "</tr>";
}
echo "</table></div>";


$conn->close();

?>