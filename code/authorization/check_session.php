<?php

require_once "../authorization/user.php";

session_start();

if(!isset($_SESSION['user'])) {
	header("Location: ../security/login.php");
	exit();
} else {
	$user = $_SESSION['user'];
	$username = $user->username;
	$user_roles = $user->getRoles();
	
	$found = 0;
	foreach($user_roles as $urole) {
		foreach($page_roles as $prole) {
			if($urole == $prole) {
				$found = 1;
			}
		}
	}
	
	if(!$found) {
		header("Location: ../authorization/unauthorized.php");
		exit();
	}
}

?>