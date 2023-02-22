<?php
include('db.php');
include("function.php");

if(isset($_POST["operationA"]))
{
	
	if($_POST["operationA"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE customer 
			SET customer_contact = :availa, uname = :uname, customer_pass = :pass 
			WHERE customer_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':availa'	=>	$_POST["mobile"],
				':uname'	=>	$_POST["uname"],
				':pass'	=>	$_POST["pass"],
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