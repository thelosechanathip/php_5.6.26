<?php
include "sess_uin.php";
$p = "index";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>หน้าแรก</title>
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">หน้าแรก</td>
          </tr>
          <tr>
            <td height="25" align="left">ข่าวประชาสัมพันธ์จากผู้ดูแลระบบ</td>
          </tr>
          <tr>
            <td align="left"><table width="700" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="33" height="25" align="center" bgcolor="#F7D4E8">#</td>
                <td width="424" height="25" align="center" bgcolor="#F7D4E8">ชื่อเรื่อง</td>
                <td width="92" height="25" align="center" bgcolor="#F7D4E8">วันที่</td>
                <td width="70" height="25" align="center" bgcolor="#F7D4E8">ผู้ประกาศ</td>
                <?php if ($_SESSION["sess_ward"] == "00") { //ถ้าเป็นผู้ดูแลระบบ ?>
                <td width="35" align="center" bgcolor="#F7D4E8">ลบ</td>
                <td width="39" height="25" align="center" bgcolor="#F7D4E8">แก้ไข</td>
                <?php } ?>
              </tr>
<script src="facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
<link href="facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facefiles/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>
              <?php
			  $sqln = "SELECT * FROM tb_news WHERE status_news = 1 ORDER BY id DESC";
			  $resultn = $conn->query($sqln);
			  $rd = rand(0, 100000);
			  while ($rn = $resultn->fetch_assoc()) {
			  ?>
              <tr>
                <td height="25" align="center"><?php echo $rn['id']; ?></td>
                <td height="25" align="left"><a href="news_detail.php?id=<?php echo $rn['id']; ?>&rd=<?php echo $rd; ?>" id="k1" rel="facebox"><?php echo $rn['title_news']; ?></a></td>
                <td height="25" align="center"><?php echo $rn['date_news']; ?></td>
                <td height="25" align="center"><?php echo $rn['user_update']; ?></td>
                <?php if ($_SESSION["sess_ward"] == "00") { //ถ้าเป็นผู้ดูแลระบบ ?>
                <td height="25" align="center"><a href="news_save.php?id=<?php echo $rn['id']; ?>&amp;st=del" onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')"><img src="images/fail.png" width="23" height="23" border="0" /></a></td>
                <td height="25" align="center"><a href="news.php?id=<?php echo $rn['id']; ?>"><img src="images/edit.png" width="25" height="25" border="0" /></a></td>
                <?php } ?>
              </tr>
              <?php } //end while ?>
            </table></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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
