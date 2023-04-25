<html>

	<?php
	$page_roles = array('customer', 'employee');

	require_once "../authorization/check_session.php";
	?>

	<head>
		<title>Home-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/home_styles.css">
	</head>

	<body>
		<div class="container">
			<h1>Kitten Factory Skis</h1>
				<?php
					require_once "../authorization/user.php";

					// get the logged in user's username
					$user = $_SESSION['user'];
					$username = $user->username;

					echo <<<_END
						Hello $username
						<a href="../security/logout.php">Logout</a>
					_END;
				?>
			<br>
			<div class="navbar">
				<!-- repreated code for each dropdown menu item -->
				<div class="dropdown">
					<button class="dropbtn">Account
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<?php
							require_once "../authorization/user.php";

							// get the logged in user's username
							$user = $_SESSION['user'];
							$username = $user->username;

							echo <<<_END
								<a href="../security/account_details.php?username=$username">Account Management</a>
							_END;
						?>
						<a href="../customer/payment_list.php">Payment Methods</a>
					</div>
				</div>

				<div class="dropdown">
					<a class="dropbtn" href="product_list.php">Products</a>
				</div>

				<div class="dropdown">
					<a class="dropbtn" href='../customer/cart_view.php'>Shopping Cart</a>
				</div>

				<div class="dropdown">
					<a class="dropbtn" href="../customer/orders_list.php">Orders</a>
				</div>

				<div class="dropdown">
					<a class="dropbtn" href="../customer/returns_list.php">Returns</a>
				</div>

				<div class="dropdown">
					<button class="dropbtn">Employees
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="../security/account_list.php">Account List</a>
						<a href="../employee/product_inventory.php">Inventory</a>
						<a href="../employee/stock_alert.php">Stock Alert</a>
					</div>
				</div>

				<div class="dropdown">
					<button class="dropbtn">Reports
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="../employee/report_sales.php">Sales Report</a>
						<a href="../employee/report_unfulfilled.php">Unfulfilled Orders</a>
						<a href="../employee/report_returns.php">Returned Orders</a>
					</div>
				</div>
			</div>
			<img src="../../images/skier.png" width="500" height="500">
		</div>
	</body>
</html>