<?php 	

	$host = "192.168.2.5";
	$user = "sa";
	$pass = "sa";
	$data = "hos";
	$conn = new mysqli($host, $user, $pass, $data);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->query("SET NAMES UTF8");
?>