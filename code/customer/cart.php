<?php

$page_roles = array('customer');

require_once "../authorization/check_session.php";

class CartItem {
	
	public $userid, $cartdate, $productname, $productid, $units, $unitprice, $total, $status;
	
	function __construct($userid, $date, $productname, $productid, $units, $unitprice, $total, $status) {
		$this->userid = $userid;
		$this->cartdate = $date;
		$this->productid = $productid;
		$this->productname = $productname;
		$this->units = $units;
		$this->unitprice = $unitprice;
		$this->total = $total;
		$this->status = $status;
	}
}

?>