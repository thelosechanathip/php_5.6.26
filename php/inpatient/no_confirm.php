<?php
include "sess_uin.php";
$p = "noconfirm";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายการข้อมูลที่ยังไม่ยืนยัน</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
include "myclass.php";
$ward = $_POST['ward'];
if ($ward == "") {
	$ward = 0;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><?php include "header.php"; ?></td>
  </tr>
  <tr>
    <td height="25" align="left">&nbsp;&nbsp;<?php include "account_data.php"; ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10%" align="left" valign="top"><?php include "menu.php"; ?></td>
        <td width="90%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">รายการข้อมูลที่ยังไม่ยืนยัน</td>
          </tr>
          <form method="post" action="<?php echo "$PHP_SELF"; ?>">
          <tr>
            <td height="25" align="left">Ward 
              <select name="ward" id="ward">
              <option value="0" selected="selected">--ทั้งหมด--</option>
              <?php
				  $sqlw = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ward";
				  $resultw = $conn->query($sqlw);
				  while ($rw = $resultw->fetch_array()) {
					  if ($ward == $rw['ward']) {
						echo "<option value='$rw[ward]' selected>$rw[shortname]</option>";
					  } else {
					  	echo "<option value='$rw[ward]'>$rw[shortname]</option>";
					  }
				  }
				  ?>
            </select>
              <input type="submit" name="button" id="button" value="  ตกลง  " /></td>
          </tr>
          </form>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><table width="470" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="38" height="25" align="center" bgcolor="#B9FFFF">ลำดับ</td>
                <td width="112" height="25" align="center" bgcolor="#B9FFFF">Ward</td>
                <td width="159" height="25" align="center" bgcolor="#B9FFFF">วันที่</td>
                <td width="151" height="25" align="center" bgcolor="#B9FFFF">เวร</td>
                </tr>
              <?php
			  $sql = "SELECT data_all.ward, ward.name, data_all.idate, data_all.wage_type_id, wage_type.wage_type_name FROM data_all LEFT OUTER JOIN ward ON data_all.ward = ward.ward LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id WHERE data_all.i_status = 0";
			  if ($ward != "0") {
				  $sql .= " AND data_all.ward = '$ward'";
			  }
			  $sql .= " ORDER BY data_all.ward, data_all.idate, data_all.wage_type_id";
			  $result = $conn->query($sql);
			  $i = 1;
			  while ($r = $result->fetch_array()) {
			  ?>
              <tr onmouseover="this.style.backgroundColor=&quot;#FAE5EE&quot;" onmouseout="this.style.backgroundColor=&quot;&quot;">
                <td height="25" align="center"><?php echo $i++; ?></td>
                <td height="25" align="center"><?php echo $r['name']; ?></td>
                <td height="25" align="center"><?php echo FormatDateFull($r['idate']); ?></td>
                <td height="25" align="center"><?php echo $r['wage_type_name']; ?></td>
                </tr>
              <?php } //end while ?>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php include "footer.php"; ?></td>
  </tr>
</table>
</body>
</html>