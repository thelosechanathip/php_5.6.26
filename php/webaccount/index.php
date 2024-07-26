<?php require_once('ConnHos.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  if($theValue == "NULL"){
 			echo "<script>";
			echo "alert(\"::เกิดข้อผิดพลาดในการบันทึกคะ::\\n::กรุณากรอกข้อมูลให้ครบทุกช่องคะ::\"); ";
			echo "history.back();";
			echo "</script>"; 
	}
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_mode"])) && ($_POST["MM_mode"] == "save")){
	
	$iddata = $_POST['id'];	
	foreach($iddata as $id => $did){
		//check data repeat OPD
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_ch = "select * from paccountopd where pttype='".$did."'";
		$ch = mysql_query($query_ch, $ConnHos) or die(mysql_error());
		$totalRows_ch = mysql_num_rows($ch);
		
		if($totalRows_ch > 0){//Update
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_up = "update paccountopd set pttype='".$did."', paccount='".$_POST['opd'][$did]."' where pttype='".$did."'";
		$up = mysql_query($query_up, $ConnHos) or die(mysql_error());
		}else{//Insert
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_up = "insert into paccountopd(pttype,paccount) values('".$did."','".$_POST['opd'][$did]."')";
		//echo $query_up;
		$up = mysql_query($query_up, $ConnHos) or die(mysql_error());
		}
		//check data repeat IPD
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_ch = "select * from paccountipd where pttype='".$did."'";
		$ch = mysql_query($query_ch, $ConnHos) or die(mysql_error());
		$totalRows_ch = mysql_num_rows($ch);
		
		if($totalRows_ch > 0){//Update
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_up = "update paccountipd set pttype='".$did."', paccount='".$_POST['ipd'][$did]."' where pttype='".$did."'";
		$up = mysql_query($query_up, $ConnHos) or die(mysql_error());
		}else{//Insert
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_up = "insert into paccountipd(pttype,paccount) values('".$did."','".$_POST['ipd'][$did]."')";
		
		$up = mysql_query($query_up, $ConnHos) or die(mysql_error());
		}
		//echo $query_up;
	}//End loop
	echo "<meta http-equiv='refresh' content='0;URL=".$_SERVER['PHP_SELF']."'>";	
	exit();
}

		$query_nw = "select pttype,name from pttype p order by pttype asc";

		mysql_select_db($database_ConnHos, $ConnHos);
		$nw = mysql_query($query_nw, $ConnHos) or die(mysql_error());
		$row_nw = mysql_fetch_assoc($nw);
		$totalRows_nw = mysql_num_rows($nw);
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>เชื่อมสิทธิบัตรกับบัญชีลูกหนี้</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/site.css" rel="stylesheet" type="text/css">
<link href="plugin/calendapopup/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$root?>javascript/basic.js"></script>
<script type="text/javascript" src="plugin/calendapopup/script.js"></script>
<script type="text/javascript">
function chform(){
dml = document.form1;
	if(dml.name.value == "")	{
		alert("กรุณากรอก ขนาดแม๊กซ์ คะ");
		dml.name.select();
		return false;
	}else{		
		return true;
	}
}

</script>
<style type="text/css">
<!--
.btmap {
	font-family: Tahoma;
	height: 25;
	width: 72;
	background-image: url(images/icon/btmap.gif);
	border: 0px solid #371C00;
	cursor: pointer;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (admin.psd) -->
<center>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" style="padding-left:7px">
      </td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="99%"><table width="99%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC" style="margin-top:5px;">
                <tr bgcolor="#2771ec" style="color:#FFF">
                  <td width="100" height="35" align="center"><strong>ลำดับ</strong></td>
                  <td align="center"   ><strong>รหัสสิทธิ</strong></td>
                  <td align="left"   ><strong>ชื่อสิทธิบัตร</strong></td>
                  <td align="left"   ><strong>ผู้ป่วยนอก&nbsp;(OPD)</strong></td>
                  <td align="left"   ><strong>ผู้ป่วยใน&nbsp;(IPD)</strong></td>
                  <td width="100" align="center" >&nbsp;</td>
                </tr>
                <?php if ($totalRows_nw > 0) { // Show if recordset not empty ?>
                  <?php 
						$i = 1;
						do { ?>
                    <tr bgcolor="#FFFFFF" style="font-size:14px" >
                      <td height="30" align="center" class="font1" ><?php echo ($startRow_nw)+($i++); ?>
                          <input type="hidden" name="id[<?php echo $row_nw['pttype']; ?>]" id="id[<?php echo $row_nw['pttype']; ?>]" value="<?php echo $row_nw['pttype']; ?>" />
                        <input name="MM_mode" type="hidden" id="MM_mode" value="save" /></td>
                      <td align="center"style="padding-left:5px;" ><?php echo $row_nw['pttype']; ?></td>
                      <td align="left"style="padding-left:5px;" ><strong><?php echo $row_nw['name']; ?></strong></td>
                      <td align="left"style="padding-left:5px;" >
                        <select name="opd[<?=$row_nw['pttype']?>]" class="selectbox bdc" id="opd[<?=$row_nw['pttype']?>]" style="width:99%; height:35px; font-size:14px; line-height:35px;" >
                          <option value="" >--ยังไม่เลือกลูกหนี้--</option>
                          <?php
mysql_select_db($database_ConnHos, $ConnHos);
$query_br = "SELECT paccount,name FROM paccount   ORDER BY paccount ASC";
$br = mysql_query($query_br, $ConnHos) or die(mysql_error());
$row_br = mysql_fetch_assoc($br);
$totalRows_br = mysql_num_rows($br);
do {  
		//opd
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_ch = "SELECT pttype FROM paccountopd  where paccount='".$row_br['paccount']."' and pttype='".$row_nw['pttype']."' ORDER BY paccount ASC";
		$ch = mysql_query($query_ch, $ConnHos) or die(mysql_error());
		$row_ch = mysql_fetch_assoc($ch);
		$totalRows_ch = mysql_num_rows($ch);		
?>
                  <option value="<?php echo $row_br['paccount']?>" <?php if($totalRows_ch > 0) echo "selected";?>><?php echo $row_br['name']; ?></option>
                  <?php
} while ($row_br = mysql_fetch_assoc($br));
  $rows = mysql_num_rows($br);
  if($rows > 0) {
      mysql_data_seek($br, 0);
	  $row_br = mysql_fetch_assoc($br);
  }
?>
                        </select>
                      </td>
                      <td align="left" class="font1" style="padding-left:5px;">
                        <select name="ipd[<?=$row_nw['pttype']?>]" class="selectbox bdc" id="ipd[<?=$row_nw['pttype']?>]" style="width:99%; height:35px; font-size:14px; line-height:35px;" >
                          <option value="" >--ยังไม่เลือกลูกหนี้--</option>
                          <?php
mysql_select_db($database_ConnHos, $ConnHos);
$query_br = "SELECT paccount,name FROM paccount where type <> 'opd' ORDER BY paccount ASC";
$br = mysql_query($query_br, $ConnHos) or die(mysql_error());
$row_br = mysql_fetch_assoc($br);
$totalRows_br = mysql_num_rows($br);
do {  
		//opd
		mysql_select_db($database_ConnHos, $ConnHos);
		$query_ch = "SELECT pttype FROM paccountipd  where paccount='".$row_br['paccount']."' and pttype='".$row_nw['pttype']."' ORDER BY paccount ASC";
		$ch = mysql_query($query_ch, $ConnHos) or die(mysql_error());
		$row_ch = mysql_fetch_assoc($ch);
		$totalRows_ch = mysql_num_rows($ch);	
?>
                  <option value="<?php echo $row_br['paccount']?>" <?php if($totalRows_ch > 0) echo "selected";?>><?php echo $row_br['name']?></option>
                  <?php
} while ($row_br = mysql_fetch_assoc($br));
  $rows = mysql_num_rows($br);
  if($rows > 0) {
      mysql_data_seek($br, 0);
	  $row_br = mysql_fetch_assoc($br);
  }
?>
                        </select>
                      </td>
                      <td align="center" class="font1" style="padding-left:5px;"><input name="btfind3" type="submit" style="margin-top:3px;  font-size:16px; width:120px; height:35px; font-weight:normal" class="t-button bdc" id="btfind3" value="บันทึก"/></td>
                    </tr>
                    <?php } while ($row_nw = mysql_fetch_assoc($nw)); ?>
                  <?php } // Show if recordset not empty ?>
            </table></td>
          </tr>
          <tr>
            <td><div style="width:99.5%;"><div class="pageall" style="font-size:16px; padding:10px;"><br /> ทั้งหมด&nbsp;&nbsp;<?php echo number_format($totalRows_nw); ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;หน้า:&nbsp;<?php echo ($pageNum_nw+1)." / ".($totalPages_nw+1); ?> &nbsp;</div>
              
              </td>
          </tr>
        </table></td>
    </tr>
  </table>
  </form>
</center>
<!-- End ImageReady Slices -->
</body>
</html>
<?php mysql_close(); ?>