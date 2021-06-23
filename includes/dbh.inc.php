<?php

$this_url = "https://demo.yeehungchong.com/fareast";

$host = "localhost:3306";
$user = "demo_fareast";
$pass = "7^WjG8*3k4bo1fu8";
$db = "demo_fareast";

$link = mysqli_connect($host, $user, $pass, $db);

if (!$link) {
	die("Connection failed: ".mysqli_connect_error());
}

?>