<?php

if (isset($_POST['submit_newCustomer'])) {
	
	include "dbh.inc.php";

	$givenname = $_POST['newCustomer_givenname'];
	$familyname = $_POST['newCustomer_familyname'];
	$gender = $_POST['newCustomer_gender'];
	$contactnumber = $_POST['newCustomer_contactnumber'];
	$email = $_POST['newCustomer_email'];
	$postalcode = $_POST['newCustomer_postalcode'];
	$blockNstreetname = $_POST['newCustomer_blockNstreetname'];
	$buildingNhousenumber = $_POST['newCustomer_buildingNhousenumber'];
	$unitnumber = $_POST['newCustomer_unitnumber'];

	$sqlCust = "INSERT INTO customers (cust_givenname, cust_familyname, cust_gender, cust_email) VALUES ('$givenname', '$familyname', '$gender', '$email');";
	$resultCust = mysqli_query($link, $sqlCust) or die("sql error");
	
	$cust_id = mysqli_insert_id($link);
	
	$sqlAddr = "INSERT INTO addresses (cust_id, addr_postalcode, addr_blockNstreetname, addr_buildingNhousenumber, addr_unitnumber) VALUES ($cust_id, $postalcode, '$blockNstreetname', '$buildingNhousenumber', '$unitnumber');";
	$resultAddr = mysqli_query($link, $sqlAddr) or die("sql error");
	
	$sqlCont = "INSERT INTO addresses (cust_id, cust_contactnumber, label) VALUES ($cust_id, $contactnumber, 'MOBILE');";
	$resultCont = mysqli_query($link, $sqlCont) or die("sql error");
	
	mysqli_close($link);

	echo '<script type="text/javascript">';
	echo 'alert("Created");';
	echo 'location.replace("' . $this_url .'");';
	echo '</script>';
	
} else {
	header("Location: $this_url");
	exit();
}

?>
