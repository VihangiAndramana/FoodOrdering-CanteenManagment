<?php
include('db.php');
include("function.php");

if(isset($_POST["operationA"]))
{
	if($_POST["operationA"] == "Add")
	{
	
		$statement = $connection->prepare("
			INSERT INTO category (cat_title) 
			VALUES (:availa)
		");
		$result = $statement->execute(
			array(
				':availa'	=>	$_POST["availability"]
				// ':e_cat_id'	=>	$_POST["e_cat_id"],
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operationA"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE category 
			SET cat_title = :availa
			WHERE cat_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':availa'	=>	$_POST["availability"],
				':id' => $_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>