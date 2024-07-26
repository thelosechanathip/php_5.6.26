<?php require_once('ConnHos.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  // Avoid using get_magic_quotes_gpc as it's deprecated
  $theValue = addslashes($theValue);

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
    // Check data repeat OPD
    $query_ch = "SELECT * FROM paccountopd WHERE pttype=?";
    $stmt = $ConnHos->prepare($query_ch);
    $stmt->bind_param('s', $did);
    $stmt->execute();
    $result_ch = $stmt->get_result();
    $totalRows_ch = $result_ch->num_rows;
    $stmt->close();
    
    if($totalRows_ch > 0){ // Update
      $query_up = "UPDATE paccountopd SET paccount=? WHERE pttype=?";
      $stmt = $ConnHos->prepare($query_up);
      $stmt->bind_param('ss', $_POST['opd'][$did], $did);
      $stmt->execute();
      $stmt->close();
    } else { // Insert
      $query_up = "INSERT INTO paccountopd (pttype, paccount) VALUES (?, ?)";
      $stmt = $ConnHos->prepare($query_up);
      $stmt->bind_param('ss', $did, $_POST['opd'][$did]);
      $stmt->execute();
      $stmt->close();
    }
    
    // Check data repeat IPD
    $query_ch = "SELECT * FROM paccountipd WHERE pttype=?";
    $stmt = $ConnHos->prepare($query_ch);
    $stmt->bind_param('s', $did);
    $stmt->execute();
    $result_ch = $stmt->get_result();
    $totalRows_ch = $result_ch->num_rows;
    $stmt->close();
    
    if($totalRows_ch > 0){ // Update
      $query_up = "UPDATE paccountipd SET paccount=? WHERE pttype=?";
      $stmt = $ConnHos->prepare($query_up);
      $stmt->bind_param('ss', $_POST['ipd'][$did], $did);
      $stmt->execute();
      $stmt->close();
    } else { // Insert
      $query_up = "INSERT INTO paccountipd (pttype, paccount) VALUES (?, ?)";
      $stmt = $ConnHos->prepare($query_up);
      $stmt->bind_param('ss', $did, $_POST['ipd'][$did]);
      $stmt->execute();
      $stmt->close();
    }
  }
  echo "<meta http-equiv='refresh' content='0;URL=".$_SERVER['PHP_SELF']."'>";  
  exit();
}

// Retrieve data
$query_nw = "SELECT pttype, name FROM pttype ORDER BY pttype ASC";
$result_nw = $ConnHos->query($query_nw);
$totalRows_nw = $result_nw->num_rows;

?>
<!DOCTYPE html>
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
    if(dml.name.value == "") {
        alert("กรุณากรอก ขนาดแม๊กซ์ คะ");
        dml.name.select();
        return false;
    } else {        
        return true;
    }
}
</script>
<style type="text/css">
.btmap {
    font-family: Tahoma;
    height: 25;
    width: 72;
    background-image: url(images/icon/btmap.gif);
    border: 0px solid #371C00;
    cursor: pointer;
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" style="padding-left:7px"></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="99%">
              <table width="99%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC" style="margin-top:5px;">
                <tr bgcolor="#2771ec" style="color:#FFF">
                  <td width="100" height="35" align="center"><strong>ลำดับ</strong></td>
                  <td align="center"><strong>รหัสสิทธิ</strong></td>
                  <td align="left"><strong>ชื่อสิทธิบัตร</strong></td>
                  <td align="left"><strong>ผู้ป่วยนอก&nbsp;(OPD)</strong></td>
                  <td align="left"><strong>ผู้ป่วยใน&nbsp;(IPD)</strong></td>
                  <td width="100" align="center">&nbsp;</td>
                </tr>
                <?php if ($totalRows_nw > 0) { ?>
                  <?php 
                    $i = 1;
                    while ($row_nw = $result_nw->fetch_assoc()) { ?>
                      <tr bgcolor="#FFFFFF" style="font-size:14px">
                        <td height="30" align="center" class="font1">
                          <?php echo ($i++); ?>
                          <input type="hidden" name="id[<?php echo $row_nw['pttype']; ?>]" id="id[<?php echo $row_nw['pttype']; ?>]" value="<?php echo $row_nw['pttype']; ?>" />
                          <input name="MM_mode" type="hidden" id="MM_mode" value="save" />
                        </td>
                        <td align="center" style="padding-left:5px;"><?php echo $row_nw['pttype']; ?></td>
                        <td align="left" style="padding-left:5px;"><strong><?php echo $row_nw['name']; ?></strong></td>
                        <td align="left" style="padding-left:5px;">
                          <select name="opd[<?=$row_nw['pttype']?>]" class="selectbox bdc" id="opd[<?=$row_nw['pttype']?>]" style="width:99%; height:35px; font-size:14px; line-height:35px;">
                            <option value="">--ยังไม่เลือกลูกหนี้--</option>
                            <?php
                            $query_br = "SELECT paccount, name FROM paccount ORDER BY paccount ASC";
                            $result_br = $ConnHos->query($query_br);
                            while ($row_br = $result_br->fetch_assoc()) {
                              $query_ch = "SELECT pttype FROM paccountopd WHERE paccount=? AND pttype=?";
                              $stmt = $ConnHos->prepare($query_ch);
                              $stmt->bind_param('ss', $row_br['paccount'], $row_nw['pttype']);
                              $stmt->execute();
                              $result_ch = $stmt->get_result();
                              $totalRows_ch = $result_ch->num_rows;
                              $stmt->close();
                            ?>
                              <option value="<?php echo $row_br['paccount']?>" <?php if($totalRows_ch > 0) echo "selected";?>><?php echo $row_br['name']; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </td>
                        <td align="left" class="font1" style="padding-left:5px;">
                          <select name="ipd[<?=$row_nw['pttype']?>]" class="selectbox bdc" id="ipd[<?=$row_nw['pttype']?>]" style="width:99%; height:35px; font-size:14px; line-height:35px;">
                            <option value="">--ยังไม่เลือกลูกหนี้--</option>
                            <?php
                            $query_br = "SELECT paccount, name FROM paccount WHERE type <> 'opd' ORDER BY paccount ASC";
                            $result_br = $ConnHos->query($query_br);
                            while ($row_br = $result_br->fetch_assoc()) {
                              $query_ch = "SELECT pttype FROM paccountipd WHERE paccount=? AND pttype=?";
                              $stmt = $ConnHos->prepare($query_ch);
                              $stmt->bind_param('ss', $row_br['paccount'], $row_nw['pttype']);
                              $stmt->execute();
                              $result_ch = $stmt->get_result();
                              $totalRows_ch = $result_ch->num_rows;
                              $stmt->close();
                            ?>
                              <option value="<?php echo $row_br['paccount']?>" <?php if($totalRows_ch > 0) echo "selected";?>><?php echo $row_br['name']?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </td>
                        <td align="center" class="font1" style="padding-left:5px;">
                          <input name="btfind3" type="submit" style="margin-top:3px; font-size:16px; width:120px; height:35px; font-weight:normal" class="t-button bdc" id="btfind3" value="บันทึก"/>
                        </td>
                      </tr>
                    <?php } ?>
                <?php } ?>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <div style="width:99.5%;">
                <div class="pageall" style="font-size:16px; padding:10px;">
                  <br /> ทั้งหมด&nbsp;&nbsp;<?php echo number_format($totalRows_nw); ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;หน้า:&nbsp;<?php echo ($pageNum_nw+1)." / ".($totalPages_nw+1); ?> &nbsp;
                </div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
</center>
</body>
</html>
<?php $ConnHos->close(); ?>
