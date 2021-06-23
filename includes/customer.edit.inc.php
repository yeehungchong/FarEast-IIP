<?php

if (isset($_POST['submit_editCustomer'])) {
	
	include "dbh.inc.php";

	$customer = $_POST['editCustomer_customer'];
	$givenname = $_POST['editCustomer_givenname'];
	$familyname = $_POST['editCustomer_familyname'];
	$gender = $_POST['editCustomer_gender'];
	$contactnumber = $_POST['editCustomer_contactnumber'];
	$email = $_POST['editCustomer_email'];
	$postalcode = $_POST['editCustomer_postalcode'];
	$blockNstreetname = $_POST['editCustomer_blockNstreetname'];
	$buildingNhousenumber = $_POST['editCustomer_buildingNhousenumber'];
	$unitnumber = $_POST['editCustomer_unitnumber'];

	$sqlCust = "UPDATE customers SET cust_givenname = '$givenname', cust_familyname = '$familyname', cust_gender = '$gender', cust_email = '$email' WHERE cust_id = $customer;";
	$resultCust = mysqli_query($link, $sqlCust) or die("sql error");
	
	$sqlAddr = "UPDATE addresses SET addr_postalcode = $postalcode, addr_blockNstreetname = '$blockNstreetname', addr_buildingNhousenumber = '$buildingNhousenumber', addr_unitnumber = '$unitnumber' WHERE cust_id = $customer;";
	$resultAddr = mysqli_query($link, $sqlAddr) or die("sql error");
	
	$sqlCont = "UPDATE contactnumbers SET cust_contactnumber = $contactnumber WHERE cust_id = $customer;";
	$resultCont = mysqli_query($link, $sqlCont) or die("sql error");
	
	mysqli_close($link);

	echo '<script type="text/javascript">';
	echo 'alert("Updated");';
	echo 'location.replace("' . $this_url .'");';
	echo '</script>';
	
} else {
	header("Location: $this_url");
	exit();
}

?>
