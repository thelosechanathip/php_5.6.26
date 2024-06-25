<?php
include "sess_uin.php";
$p = "confirm";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ยืนยันการส่งข้อมูล</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">ยืนยันการส่งข้อมูล</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><table width="600" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="56" height="25" align="center" bgcolor="#B9FFFF">ลำดับ</td>
                <td width="238" height="25" align="center" bgcolor="#B9FFFF">วันที่</td>
                <td width="99" height="25" align="center" bgcolor="#B9FFFF">เวร</td>
                <td width="197" height="25" align="center" bgcolor="#B9FFFF">ยืนยันการส่งข้อมูล</td>
              </tr>
<?php
include "myclass.php";
$sql = "SELECT data_all.idate, data_all.wage_type_id, wage_type.wage_type_name FROM data_all LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id WHERE data_all.ward = '$_SESSION[sess_ward]' AND data_all.i_status = 0 ORDER BY data_all.idate, data_all.wage_type_id";
$result = $conn->query($sql);
$i = 1;
while ($r = $result->fetch_array()) {
?>
              <tr onmouseover=this.style.backgroundColor="#FAE5EE" onmouseout=this.style.backgroundColor="">
                <td height="25" align="center"><?php echo $i++; ?></td>
                <td height="25" align="center"><?php echo FormatDateFull($r['idate']); ?></td>
                <td height="25" align="center"><?php echo $r['wage_type_name']; ?></td>
                <td height="25" align="center"><a href="confirm_data_save.php?idate=<?php echo $r['idate']; ?>&wage=<?php echo $r['wage_type_id']; ?>" onclick="return confirm('ต้องการบันทึกยืนยันการส่งข้อมูลใช่หรือไม่')"><img src="images/pass.png" width="25" height="24" border="0" align="absmiddle" title="คลิกเพื่อยืนยันการส่งข้อมูล" style="cursor:hand;" /></a>&nbsp;คลิกไอค่อนเพื่อยืนยัน</td>
              </tr>
<?php } //end while ?>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="left">***กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนคลิก &quot;ยืนยันการส่งข้อมูล&quot;</td>
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