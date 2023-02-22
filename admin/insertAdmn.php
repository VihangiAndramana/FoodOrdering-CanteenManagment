<?php
include('db.php');
include("function.php");


if(isset($_POST["operationA"]))
{
	if($_POST["operationA"] == "Add")
	{
	
		$statement = $connection->prepare("
			INSERT INTO admin (name, email, password) 
			VALUES (:availa, :e_cat_id, :pass)
		");
		$result = $statement->execute(
			array(
				':availa'	=>	$_POST["name"],
				':e_cat_id'	=>	$_POST["value"],
				':pass' =>	$_POST["pass"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}

}

?>