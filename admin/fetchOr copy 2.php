<?php
include('db.php');
include("function.php");
$query = '';
$output = array();
$query .= "SELECT o.order_id, o.product_id, o.order_qty, o.order_price, o.date, o.time, p.product_title, c.customer_name, o.checkStatus FROM ordert o JOIN products1 p ON o.product_id = p.products_id JOIN customer c ON o.c_id = c.customer_id  ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE customer_name LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY time DESC ';
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
	$sub_array[] = $row["order_id"];
	$sub_array[] = $row["product_id"];
	$sub_array[] = $row["product_title"];
	$sub_array[] = $row["order_qty"];
	$sub_array[] = $row["order_price"];
	$sub_array[] = $row["time"];
	$sub_array[] = $row["customer_name"];       
	$sub_array[] = $row["checkStatus"];       
	$sub_array[] = '<button type="button" name="update" id="'.$row["order_id"].'" class="btn btn-warning btn-xs update">Update</button> ';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_recordsOr(),
	"data"				=>	$data
);
echo json_encode($output);
?>