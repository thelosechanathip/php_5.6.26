﻿<?php
$hostname_ConnHos = '192.168.2.5'; //ชื่อเซริฟเวอร์
$database_ConnHos = "hos"; //ชื่อฐานข้อมูล
$username_ConnHos = "sa"; // ชื่อผู้ใช้งาน
$password_ConnHos = "sa"; // รหัสผ่าน
$ConnHos = mysql_connect($hostname_ConnHos, $username_ConnHos, $password_ConnHos) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8",$ConnHos);
?>