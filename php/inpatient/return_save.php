<?php
include "sess_uin.php";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
$ward = $_GET['ward'];
$idate = $_GET['idate'];
$wage_type_id = $_GET['wage_type_id'];
include "myclass.php";
$datesearch = FormatDateDefault($idate);
include "connect.php";
$sql = "UPDATE data_all SET i_status = 0 WHERE ward = '$ward' AND idate = '$datesearch' AND wage_type_id = '$wage_type_id'";
$result = $conn->query($sql);
if ($result) {
	echo "<script>";
	echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว')";
	echo "</script>";
	echo "<meta http-equiv='refresh' content='0;url=return.php?ward=$ward&idate=$idate'>";
}
?>