<?php
include('db.php');
include("function.php");
if (isset($_POST["user_id"])) {
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM products1 
		WHERE products_id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$output["product_title"] = $row["product_title"];
		$output["cat_title"] = $row["cat_id"];
		$output["p_cat_title"] = $row["p_cat_id"];
		$output["cost"] = $row["cost"];
		$output["product_price"] = $row["product_price"];
		if ($row["product_img1"] != '') {
			$output['user_image'] = '<img src="products/' . $row["product_img1"] . '" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="' . $row["product_img1"] . '" />';
		} else {
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}

// SELECT p.products_id, p.product_title, p.product_price,
// p.product_img1, p.product_keywords, p.cost, c.cat_title,
// c.cat_id, pc.p_cat_id, pc.p_cat_title FROM products1 p 
// JOIN category c ON c.cat_id = p.cat_id JOIN availability 
// pc ON pc.p_cat_id = p.p_cat_id 
// WHERE p.products_id =