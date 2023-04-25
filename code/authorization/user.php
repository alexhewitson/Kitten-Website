<?php

require_once "../../database/dbinfo.php";

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

class User {
	
	public $username;
	public $roles = array();
	
	function __construct($username) {
		global $conn;
		
		$this->username = $username;
		
		$query = "select * from users where username='$username' ";
		
		$result = $conn->query($query);
		if(!$result) die($conn->error);
			
		$rows = $result->num_rows;	
		
		$roles = array();
		for($i = 0; $i < $rows; $i++){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$roles[] = $row['role'];
		}	
		
		$this->roles = $roles;
	}
	
	function getRoles() {
		return $this->roles;
	}
}

?>