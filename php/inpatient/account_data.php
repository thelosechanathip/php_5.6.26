<?php
echo "ยินดีต้อนรับ&nbsp;";
if ($_SESSION["sess_uinid"] != "") {
	echo "$_SESSION[sess_uinid]&nbsp;$_SESSION[sess_uinname]";
} else {
	echo "ผู้ใช้ทั่วไป";
}
?>