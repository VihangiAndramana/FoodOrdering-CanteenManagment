<?php
include('db.php');
include("function.php");
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO products1 (p_cat_id, cat_id, date, product_title, product_img1, cost, product_price, product_keywords) 
			VALUES (:availa, :e_cat_id, current_timestamp(), :product_title, :image, :cost, :price, ':image' )
		");
		$result = $statement->execute(
			array(
				':availa'	=>	$_POST["availa"],
				':e_cat_id'	=>	$_POST["e_cat_id"],
				':product_title'	=>	$_POST["product_title"],
				':image'		=>	$image,
				':cost'	=>	$_POST["cost"],
				':price'	=>	$_POST["price"]
				// ':e_cat_id'	=>	$_POST["e_cat_id"],
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE products1 
			SET p_cat_id = :availa, cat_id = :e_cat_id,  date = current_timestamp(), 
			product_title = :product_title,  product_img1 = :image, cost = :cost, 
			product_price = :price 
			WHERE products_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':availa' => $_POST["availa"],
				':e_cat_id' =>$_POST["e_cat_id"],
				':product_title' => $_POST["product_title"],
				':image' =>	$image,
				':cost' => $_POST["cost"],
				':price' => $_POST["price"],
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