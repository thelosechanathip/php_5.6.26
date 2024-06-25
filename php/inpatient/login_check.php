<?php
include "connect.php";
session_start();
$user_login = ($_POST['user_login']);
$pass_login = ($_POST['pass_login']);
if ($user_login == "" || $pass_login == "") {
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<br><br><center>ข้อมูลผิดพลาด กรุณาตรวจสอบการกรอกข้อมูล</center>";
	exit();
}

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$sql = "SELECT id, user_name, ward FROM account WHERE user_login = '$user_login' AND pass_login = '$pass_login' AND ward != ''";
$result = $conn->query($sql);

if ($result === false) {
    die("Error in SQL query: " . $conn->error);
}

$num = $result->num_rows;
if ($num > 0) {
	$r = $result->fetch_array();
	$_SESSION['sess_id'] = session_id();
	$_SESSION['sess_uinid'] = $user_login;
	$_SESSION['sess_uinname'] = $r['user_name'];
	$_SESSION['sess_ward'] = $r['ward'];
	setcookie("cook_id", $r['id']);
    //Syslog::SignUp(null,"inpatient",$user_login,"user");

	echo "<meta http-equiv='refresh' content='0;url=index.php'>";
} else {
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script>";
	echo "alert('ข้อมูลการล็อกอินไม่ถูกต้อง')";
	echo "</script>";
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
