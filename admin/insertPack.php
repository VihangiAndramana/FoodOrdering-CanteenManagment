<?php
include('db.php');
include("function.php");


if(isset($_POST["operationA"]))
{
	if($_POST["operationA"] == "Add")
	{
	
		$statement = $connection->prepare("
			INSERT INTO package (package_title, package_amount) 
			VALUES (:availa, :e_cat_id)
		");
		$result = $statement->execute(
			array(
				':availa'	=>	$_POST["availability"],
				':e_cat_id'	=>	$_POST["value"]
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
			"UPDATE availability 
			SET p_cat_title = :availa
			WHERE p_cat_id = :id
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