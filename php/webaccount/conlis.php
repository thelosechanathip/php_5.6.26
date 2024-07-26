<?php
	$servername = "10.10.10.25";
	$username = "webairhos";
	$password = "aakkaatthhooss";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=airoffice", $username, $password);
		// Set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "Connected successfully";
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

?>