<?php
include('db.php');
include("function.php");
$query = '';
$output = array();
$query .= "SELECT p.products_id, p.product_title, p.product_price, p.product_img1, p.product_keywords, p.cost, c.cat_title, c.cat_id, pc.p_cat_id, pc.p_cat_title FROM products1 p JOIN category c ON c.cat_id = p.cat_id JOIN availability pc ON pc.p_cat_id = p.p_cat_id ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE product_title LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	// $query .= 'ORDER BY id DESC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["product_img1"] != '')
	{
		$image = '<img src="products/'.$row["product_img1"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $row["products_id"];
	$sub_array[] = $row["product_title"];
	$sub_array[] = $row["cat_title"];
	$sub_array[] = $row["p_cat_title"];
	$sub_array[] = $row["cost"];
	$sub_array[] = $row["product_price"];
	$sub_array[] = $image;
	$sub_array[] = '<button type="button" name="update" id="'.$row["products_id"].'" class="btn btn-warning btn-xs update">Update</button> <button type="button" name="delete" id="'.$row["products_id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>