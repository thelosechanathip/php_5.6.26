<?php
include "sess_uin.php";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
$st = $_REQUEST['st'];
$id = $_REQUEST['id'];
if ($st != "del") {
	$title_news = $_POST['title_news'];
	$detail_news = $_POST['detail_news'];
	$status_news = $_POST['status_news'];
	$ymdnow = date("Y-m-d");
	$tnow = date("H:i:s");
}
include "connect.php";
if ($st == "save") {
	$sql = "INSERT INTO tb_news(title_news, detail_news, status_news, date_news, time_news, user_update) VALUES('$title_news', '$detail_news', '$status_news', '$ymdnow', '$tnow', '$_SESSION[sess_uinid]')";
}
if ($st == "edit") {
	$sql = "UPDATE tb_news SET title_news = '$title_news', detail_news = '$detail_news', status_news = '$status_news', user_update = '$_SESSION[sess_uinid]' WHERE id = '$id'";
}
if ($st == "del") {
	$sql = "DELETE FROM tb_news WHERE id = '$id'";
}
$result = $conn->query($sql);
if ($result) {
	echo "<script>";
	echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว')";
	echo "</script>";
	echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
?>