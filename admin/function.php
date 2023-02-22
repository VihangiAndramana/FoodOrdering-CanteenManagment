<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './products/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id)
{
	include('db.php');
	$statement = $connection->prepare("SELECT product_img1 FROM products1 WHERE products_id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["product_img1"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT p.products_id, p.product_title, p.product_price, p.product_img1, p.product_keywords, p.cost, c.cat_title, c.cat_id, pc.p_cat_id, pc.p_cat_title FROM products1 p JOIN category c ON c.cat_id = p.cat_id JOIN availability pc ON pc.p_cat_id = p.p_cat_id");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsA()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM availability");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsCat()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM category");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsUs()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM student");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsCrdt()
{
	include('db.php');
	$statement = $connection->prepare("select cr.customer_id, c.customer_name, cr.package_id, p.package_title, p.package_amount, cr.lastAmount, cr.renewDate, cr.lastUpdated FROM customer c JOIN credit cr ON cr.customer_id = c.customer_id JOIN package p on p.package_id = cr.package_id");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsSa()
{
	include('db.php');
	$statement = $connection->prepare("SELECT s.products_id, p.product_title, s.date, s.daily_amount, s.sold_amount, s.rest_amount, s.daily_cost, s.daily_value, s.profit FROM sales s JOIN products1 p ON s.products_id = p.products_id");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsPack()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM package  ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsAdmn()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM admin  ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsCus()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM customer  ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsOr()
{
	include('db.php');
	$statement = $connection->prepare("SELECT o.order_id, o.product_id, o.order_qty, o.order_price, o.date, p.product_title, c.customer_name, o.checkStatus FROM ordert o JOIN products1 p ON o.product_id = p.products_id JOIN customer c ON o.c_id = c.customer_id  ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsQty()
{
	include('db.php');
	$statement = $connection->prepare("SELECT pq.product_id, pq.daily_tot, p.product_title FROM product_qty pq JOIN products1 p ON pq.product_id = p.products_id  ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_recordsFb()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM feedback   ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
?>