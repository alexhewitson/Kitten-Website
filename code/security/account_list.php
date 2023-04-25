<html>
	<head>
		<title>Account List-KFS</title>
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

// print employees
$query = "SELECT * FROM users INNER JOIN employee ON users.USER_ID = employee.USER_ID;";

$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

echo <<<_END
	<div class="container">
		<br><p>All Active Accounts</p>
		<p>Employees</p>
	<table>
		<tr>
			<th>USER_ID</th>
			<th>EMP_ID</th>
			<th>username</th>
			<th>role</th>
			<th>first_name</th>
			<th>last_name</th>
			<th>position</th>
		</tr>
_END;

$rows = $result->num_rows;

for($j = 0; $j < $rows; $j++) {
	$row = $result->fetch_array(MYSQLI_ASSOC); 

	echo "<tr>";
	echo "<td>" . $row['USER_ID'] . "</td>";
	echo "<td>" . $row['EMP_ID'] . "</td>";
	echo "<td>" . "<a href='account_details.php?username=$row[username]'>$row[username]</a>" . "</td>";
	echo "<td>" . $row['role'] . "</td>";
	echo "<td>" . $row['first_name'] . "</td>";
	echo "<td>" . $row['last_name'] . "</td>";
	echo "<td>" . $row['position'] . "</td>";
	echo "</tr>";
}
echo "</table></div><br>";

// print customers
$query = "SELECT * FROM users INNER JOIN customer ON users.USER_ID = customer.USER_ID;";

$result = $conn->query($query);
if(!$result) {
	die($conn->error);
}

echo <<<_END
	<div class="container">
		<p>Customers</p>
	<table>
		<tr>
			<th>USER_ID</th>
			<th>CUST_ID</th>
			<th>username</th>
			<th>role</th>
			<th>first_name</th>
			<th>last_name</th>
			<th>address</th>
		</tr>
_END;

$rows = $result->num_rows;

for($j = 0; $j < $rows; $j++) {
	$row = $result->fetch_array(MYSQLI_ASSOC); 

	echo "<tr>";
	echo "<td>" . $row['USER_ID'] . "</td>";
	echo "<td>" . $row['CUST_ID'] . "</td>";
	echo "<td>" . "<a href='account_details.php?username=$row[username]'>$row[username]</a>" . "</td>";
	echo "<td>" . $row['role'] . "</td>";
	echo "<td>" . $row['first_name'] . "</td>";
	echo "<td>" . $row['last_name'] . "</td>";
	echo "<td>" . $row['address'] . "</td>";
	echo "</tr>";
}
echo "</table></div>";

$conn->close();

?>