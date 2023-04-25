<html>
	<head>
		<title>Logout-KFS</title>
		<link rel="stylesheet" type="text/css" href="../../styles/home_styles.css">
	</head>

	<body>
		<div class="container">
			<h1>Kitten Factory Skis</h1>
			<p>You are now logged out. Goodbye.</p><br>
			<p>Please login <a href='login.php'> HERE </a></p>
		</div>
	</body>
</html>

<?php

session_start();

destroy_session_and_data();

function destroy_session_and_data() {
	$_SESSION = array();
	setcookie(session_name(), '', time()-2592000, '/');
	session_destroy();
}


?>