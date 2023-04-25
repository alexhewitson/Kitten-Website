<html>
	<?php
	$page_roles = array('customer', 'employee');

	require_once "../authorization/check_session.php";
	?>
	<head>
		<title>Unauthorized-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/styles.css">
		<div class="container">
			<br><a href="../both/home_page.php"><img src="../../images/logo.jpg" width="605" height="42"></img></a>
		</div>
	</head>
</html>

	<body>
		<div class="container">
			<br><p>You are unauthorized to view this page.</p>
		</div>
	</body>
</html>