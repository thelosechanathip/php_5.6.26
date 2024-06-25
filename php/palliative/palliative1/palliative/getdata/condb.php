<?php 	

	$host = "192.168.0.254";
	$user = "hosbm2011";
	$pass = "bmhos2554";
	$data = "hos";
	$conn = new mysqli($host, $user, $pass, $data);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->query("SET NAMES UTF8");
?>