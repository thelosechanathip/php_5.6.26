<?php
	date_default_timezone_set("Asia/Bangkok");
	$host="10.10.10.5";
	$Datauser="sa";
	$Datapass="sa";
	$Dataname="hos";
	$con=mysqli_connect($host,$Datauser,$Datapass,$Dataname)or die("Cannot connect Host");
	mysqli_query($con,"SET NAMES UTF8");


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