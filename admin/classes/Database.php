<?php

/**
 * 
 */
class Database
{
	
	private $conn;
	public function connect(){
		$this->conn= new Mysqli("localhost", "root", "", "canteenDb");
		return $this->conn;
	}
}

?>