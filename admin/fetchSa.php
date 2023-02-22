<?php
include('db.php');
include("function.php");
$query = '';
$output = array();
$query .= "SELECT s.products_id, p.product_title, s.date, s.daily_amount, s.sold_amount, s.rest_amount, s.daily_cost, s.daily_value, s.profit FROM sales s JOIN products1 p ON s.products_id = p.products_id ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE product_title LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR date LIKE "%'.$_POST["search"]["value"].'%" ';
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
	$sub_array = array();
	$sub_array[] = $row["products_id"];
	$sub_array[] = $row["date"];
	$sub_array[] = $row["product_title"];
	$sub_array[] = $row["daily_amount"];
	$sub_array[] = $row["sold_amount"];
	$sub_array[] = $row["rest_amount"];
	$sub_array[] = $row["daily_cost"];
	$sub_array[] = $row["daily_value"];
	$sub_array[] = $row["profit"];
	// $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button> <button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_recordsSa(),
	"data"				=>	$data
);
echo json_encode($output);
?>