<?php
include "sess_uin.php";
$p = "return";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ส่งกลับให้วอร์ดแก้ไขข้อมูล</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
$ward = $_REQUEST['ward'];
$idate = $_REQUEST['idate'];
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">ส่งกลับให้วอร์ดแก้ไขข้อมูล</td>
          </tr>
          <tr>
            <td align="left"><table width="600" border="0" cellspacing="0" cellpadding="0">
            <script>
			function chkData() {
				if (document.frm1.ward.value == "0") {
					alert('กรุณาเลือก Ward');
					document.frm1.ward.focus();
					return false;
				}
			}
			</script>
            <form method="post" name="frm1" action="<?php echo "$PHP_SELF"; ?>" onsubmit="return chkData()">
              <tr>
                <td width="43" height="25" align="left">Ward</td>
                <td width="110" height="25" align="left"><select name="ward" id="ward">
                  <option value="0" selected="selected">--เลือก--</option>
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
                </select></td>
                <td width="39" height="25" align="left">วันที่</td>
                <td width="140" align="left"><?php
if ($idate == "") {
	$dm = date("d/m/");
	$y = date("Y") + 543;
	$dmy = $dm.$y;
} else {
	$dmy = $idate;
}
		?>
                  <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />
                  <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
                  <script type="text/javascript" src="js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
                  <script type="text/javascript" src="js/dp.js"></script>
                  <style type="text/css">
			/*demo page css
			body{ font: 80% "Trebuchet MS", sans-serif; margin: 50px;}*/
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		      </style>
                  <input name="idate" type="text" id="datepicker-th-1" size="15" maxlength="30" readonly="readonly" value="<?php echo $dmy; ?>" /></td>
                <td width="268" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
              </tr>
              </form>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
<?php
if ($ward != "") {
	include "myclass.php";
	$datesearch = FormatDateDefault($idate);
	$sql = "SELECT data_all.ward, ward.name, data_all.idate, data_all.wage_type_id, wage_type.wage_type_name FROM data_all LEFT OUTER JOIN ward ON data_all.ward = ward.ward LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id WHERE data_all.ward = '$ward' AND data_all.idate = '$datesearch' AND data_all.i_status = 1 ORDER BY data_all.wage_type_id";
	$result = $conn->query($sql);
	$num = $result->num_rows;
	if ($num > 0) { //แสดงว่ามีข้อมูล
?>
          <tr>
            <td align="left"><table width="600" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="38" height="25" align="center" bgcolor="#B9FFFF">ลำดับ</td>
                <td width="112" height="25" align="center" bgcolor="#B9FFFF">Ward</td>
                <td width="159" height="25" align="center" bgcolor="#B9FFFF">วันที่</td>
                <td width="151" height="25" align="center" bgcolor="#B9FFFF">เวร</td>
                <td width="128" height="25" align="center" bgcolor="#B9FFFF">ส่งกลับ</td>
              </tr>
              <?php
			  $i = 1;
			  while ($r = $result->fetch_array()) {
			  ?>
              <tr onmouseover=this.style.backgroundColor="#FAE5EE" onmouseout=this.style.backgroundColor="">
                <td height="25" align="center"><?php echo $i++; ?></td>
                <td height="25" align="center"><?php echo $r['name']; ?></td>
                <td height="25" align="center"><?php echo FormatDateFull($r['idate']); ?></td>
                <td height="25" align="center"><?php echo $r['wage_type_name']; ?></td>
                <td height="25" align="center"><a href="return_save.php?ward=<?php echo $ward; ?>&idate=<?php echo $idate; ?>&wage_type_id=<?php echo $r['wage_type_id']; ?>" title="คลิกเพื่ออนุญาตให้วอร์ดแก้ไขข้อมูลได้" onclick="return confirm('ต้องการอนุญาตให้วอร์ดแก้ไขข้อมูลนี้ใช่หรือไม่')"><img src="images/left.png" width="22" height="22" border="0" /></a></td>
              </tr>
              <?php } //end while ?>
            </table></td>
          </tr>
          <?php } else { //end $num ?>
          <tr>
            <td height="25" align="center">ไม่พบข้อมูลที่ค้นหา กรุณาตรวจสอบข้อมูลให้ถูกต้อง</td>
            </tr>
            <?php } //end ไม่มีข้อมูล ?>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
<?php } //end $ward ?>
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