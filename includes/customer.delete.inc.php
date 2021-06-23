<?php
	
include "dbh.inc.php";

$customer = $_POST['customer'];

$sqlCust = "DELETE FROM customers WHERE cust_id = $customer;";
$resultCust = mysqli_query($link, $sqlCust) or die("sql error");

$sqlAddr = "DELETE FROM addresses WHERE cust_id = $customer;";
$resultCust = mysqli_query($link, $sqlAddr) or die("sql error");

$sqlCont = "DELETE FROM contactnumbers WHERE cust_id = $customer;";
$resultCont = mysqli_query($link, $sqlCont) or die("sql error");

mysqli_close($link);

echo json_encode($link);

?>
