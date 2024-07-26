<?php

include 'conlis.php';

session_start();

$username = $_POST['username'];
$password = md5($_POST['password']);

try {
	$stmt = $conn->prepare("SELECT * FROM employee WHERE username = :username AND pass = :password ");
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($result) {
		$_SESSION['username'] = $username;
		echo "<script>";
		echo "window.location='index.php'";
		echo "</script>";
	} else {
		echo "<srcipt>";
		echo "alert('ข้อมูลการ Login ไม่ถูกต้อง')";
		echo "<meta http-equiv='refresh' content='0;url=login.php'>";
		echo "</script>";
	}
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}

?>