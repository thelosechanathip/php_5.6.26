<?php
date_default_timezone_set('Asia/Bangkok');
session_start();
if ($_SESSION["sess_id"] != session_id() || $_SESSION["sess_uinid"] == "") {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit();
}
?>