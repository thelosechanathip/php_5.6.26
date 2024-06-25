<?php
$con= mysqli_connect("10.10.10.5","sa","sa","palliative") or die("Error: " . mysqli_error($con));

mysqli_query($con, "SET NAMES 'utf8' ");
 
?>