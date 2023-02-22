<?php
include('db.php');
include("function.php");
$query = '';
$output = array();
$query .= "SELECT * FROM `customer` ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE customer_name LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
// else
// {
// 	$query .= 'ORDER BY id DESC ';
// }

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
	$sub_array[] = $row["customer_id"];
	$sub_array[] = $row["index_no"];
	$sub_array[] = $row["customer_name"];
	$sub_array[] = $row["customer_email"];
	$sub_array[] = $row["stream"];
	$sub_array[] = $row["intake"];
	$sub_array[] = $row["customer_contact"];
	$sub_array[] = $row["c_type"];
	$sub_array[] = $row["uname"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["customer_id"].'" class="btn btn-warning btn-xs update">Update</button> <button type="button" name="delete" id="'.$row["customer_id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_recordsCus(),
	"data"				=>	$data
);
echo json_encode($output);
?>