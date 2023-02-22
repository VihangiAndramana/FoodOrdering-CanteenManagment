<?php
include('db.php');
include("function.php");

if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")

	{	
		$email = $_POST["uemail"];
		$conn = new mysqli("localhost", "root", "", "canteenDb");
		$sql = "SELECT customer_id FROM customer WHERE customer_email = '$email'";
		$resultset = mysqli_query($conn, $sql);
		while ($rows = mysqli_fetch_assoc($resultset)) {
		
			$id = $rows['customer_id'];
		}

		$statement = $connection->prepare(
			// "INSERT INTO credit (customer_id, package_id, lastAmount, renew_date) 
			// VALUES (:email, :availa, :cost, current_timestamp()) "
			"UPDATE credit 
			SET package_id = :availa, lastAmount = :cost,  renewDate = current_timestamp(), lastUpdated = current_timestamp()
			WHERE customer_id = :idd
			"
			);
		$result = $statement->execute(
			array(
				':availa' => $_POST["availa"],
				':idd' =>	$id,
				':cost'	=>	$_POST["cost"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE credit 
			SET package_id = :availa, lastAmount = :cost,  renewDate = current_timestamp(), lastUpdated = current_timestamp()
			WHERE customer_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':availa' => $_POST["availa"],
				// ':idd' =>	$id,
				':cost'	=>	$_POST["cost"],
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