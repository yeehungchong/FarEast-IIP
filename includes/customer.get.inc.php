<?php

include "dbh.inc.php";

$customer = $_GET['customer'];

$sql = "SELECT * FROM customers c
		INNER JOIN addresses a ON a.cust_id = c.cust_id
		INNER JOIN contactnumbers n ON n.cust_id = c.cust_id
		WHERE c.cust_id = $customer;";
$result = mysqli_query($link, $sql);

$row = mysqli_fetch_assoc($result);

echo json_encode($row);

?>
