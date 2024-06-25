<?php
include "sess_uin.php";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
$idate = $_GET['idate'];
$wage_type_id = $_GET['wage'];
if ($idate == "" || $wage_type_id == "") {
	echo "<br><br><center>ข้อมูลผิดพลาด กรุณาตรวจสอบการกรอกข้อมูล</center>";
	exit();
}
include "connect.php";
$ymdnow = date("Y-m-d H:i:s");
$sql = "INSERT INTO data_confirm (ward, idate, wage_type_id, cdate, cuser) VALUES ('$_SESSION[sess_ward]', '$idate', '$wage_type_id', '$ymdnow', '$_SESSION[sess_uinid]')";
$result = $conn->query($sql);
$sql = "UPDATE data_all SET i_status = 1 WHERE ward = '$_SESSION[sess_ward]' AND idate = '$idate' AND wage_type_id = '$wage_type_id'";
$result = $conn->query($sql);
if ($result) {
	echo "<script>";
	echo "alert('ยืนยันการส่งข้อมูลเรียบร้อยแล้ว')";
	echo "</script>";
	echo "<meta http-equiv='refresh' content='0;url=confirm_data.php'>";
}
?>