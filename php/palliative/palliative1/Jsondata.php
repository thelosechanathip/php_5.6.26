<?php
header('Cotent-Type: application/json');
$objConnect = mysqli_connect("192.168.0.254","hosbm2011","bmhos2554");
$objDB = mysqli_select_db("hos");
mysql_query("SET NAME UTF8");
 $strSQL ="SELECT * FROM house";
 $objQuery = mysql_query($strSQL);
 $resulTArray = array();
 while($obResylt = mysqli_fetch_assoc($objQuery))
 {
	 array_push($resulTArray,$obResylt);
 }
 echo json_encode($resulTArray);
 ?>