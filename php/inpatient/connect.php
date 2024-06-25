<?php
date_default_timezone_set('Asia/Bangkok');
$servername = "10.10.10.25";
$username = "webairhos";
$password = "aakkaatthhooss";
$database = "db_inpatient";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $database);

$conn->set_charset("utf8");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}  else {
    // echo "Connected Successfully!";
} 
?>
