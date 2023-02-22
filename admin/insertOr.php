<?php
include('db.php');
include("function.php");
if(isset($_POST["operationA"]))
{
	// if($_POST["operationA"] == "Add")
	// {
	
	// 	$statement = $connection->prepare("
	// 		INSERT INTO availability (p_cat_title) 
	// 		VALUES (:availa)
	// 	");
	// 	$result = $statement->execute(
	// 		array(
	// 			':availa'	=>	$_POST["availability"]
	// 			// ':e_cat_id'	=>	$_POST["e_cat_id"],
	// 		)
	// 	);
	// 	if(!empty($result))
	// 	{
	// 		echo 'Data Inserted';
	// 	}
	// }
	if($_POST["operationA"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE ordert 
			SET checkStatus = :availa
			WHERE order_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':availa'	=>	$_POST["availa"],
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