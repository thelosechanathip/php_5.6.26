<?php
session_start();
//include "sess_uin.php";
$p = "news";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ประกาศข่าว/แจ้งข่าวสาร</title>
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">ประกาศข่าว/แจ้งข่าวสาร</td>
          </tr>
          <tr>
            <td align="left"><table width="600" border="0" cellspacing="0" cellpadding="0">
<?php
$id = $_GET['id'];
$st = "save";
if ($id != "") {
	$st = "edit";
}
$sqln = "SELECT * FROM tb_news WHERE id = '$id'";
$resultn = $conn->query($sqln);
$rn = $resultn->fetch_array();
$status_news =$rn['status_news'];
if ($status_news == "") {
	$status_news = "1";
}
?>
            <script>
			function chkData() {
				var frm = document.frm1;
				if (frm.title_news.value == "") {
					alert('กรุณากรอกชื่อหัวข้อข่าว');
					frm.title_news.focus();
					return false;
				}
				if (frm.detail_news.value == "") {
					alert('กรุณากรอกรายละเอียดข่าว');
					frm.detail_news.focus();
					return false;
				}
			}
			</script>
            <form method="post" name="frm1" action="news_save.php" onsubmit="return chkData()">
              <tr>
                <td width="103" height="25" align="left">หัวข้อข่าว/ขื่อเรื่อง</td>
                <td width="497" height="25" align="left"><input name="title_news" type="text" id="title_news" value="<?php echo $rn['title_news']; ?>" size="50" maxlength="255" />
                  <span class="textRedNormal">*</span></td>
              </tr>
              <tr>
                <td height="25" align="left">รายละเอียด</td>
                <td height="25" align="left"><textarea name="detail_news" id="detail_news" cols="50" rows="10"><?php echo $rn['detail_news']; ?></textarea>
                  <span class="textRedNormal">*</span></td>
              </tr>
              <tr>
                <td height="25" align="left">สถานะ</td>
                <td height="25" align="left"><label>
                  <input name="status_news" type="radio" id="radio" value="1" <?php if ($status_news == "1") { echo "checked=\"checked\""; } ?> />
                  เปิดใช้งาน</label>&nbsp;&nbsp;<label>
                  <input type="radio" name="status_news" id="radio" value="0" <?php if ($status_news == "0") { echo "checked=\"checked\""; } ?> />
                  ปิดใช้งาน</label></td>
              </tr>
              <tr>
                <td height="25" align="left">&nbsp;</td>
                <td height="25" align="left"><input type="submit" name="button" id="button" value="  บันทึก  " />
                  <input name="st" type="hidden" id="st" value="<?php echo $st; ?>" />
                  <input name="id" type="hidden" id="id" value="<?php echo $id; ?>" /></td>
              </tr>
              </form>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="left"><?php if ($id != "") { ?><a href="news.php" id="k1">เพิ่มข่าวใหม่</a><?php } else { ?>&nbsp;<?php } ?></td>
          </tr>
          <tr>
            <td align="left"><table width="800" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="37" height="25" align="center" bgcolor="#F7D4E8">#</td>
                <td width="445" height="25" align="center" bgcolor="#F7D4E8">ชื่อเรื่อง</td>
                <td width="101" height="25" align="center" bgcolor="#F7D4E8">วันที่</td>
                <td width="68" height="25" align="center" bgcolor="#F7D4E8">ผู้ประกาศ</td>
                <td width="55" align="center" bgcolor="#F7D4E8">สถานะ</td>
                <td width="39" align="center" bgcolor="#F7D4E8">ลบ</td>
                <td width="47" height="25" align="center" bgcolor="#F7D4E8">แก้ไข</td>
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
			  $sqln = "SELECT * FROM tb_news ORDER BY id DESC";
			  $resultn = $conn->query($sqln);
			  $rd = rand(0, 100000);
			  while ($rn = $resultn->fetch_array()) {
			  ?>
              <tr>
                <td height="25" align="center"><?php echo $rn['id']; ?></td>
                <td height="25" align="left"><a href="news_detail.php?id=<?php echo $rn['id']; ?>&amp;rd=<?php echo $rd; ?>" id="k1" rel="facebox"><?php echo $rn['title_news']; ?></a></td>
                <td height="25" align="center"><?php echo $rn['date_news']; ?></td>
                <td height="25" align="center"><?php echo $rn['user_update']; ?></td>
                <td height="25" align="center"><?php
                if ($rn['status_news'] == "1") {
					echo "เปิด";
				} else {
					echo "ปิด";
				}
				?></td>
                <td height="25" align="center"><a href="news_save.php?id=<?php echo $rn['id']; ?>&amp;st=del" onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่')"><img src="images/fail.png" width="23" height="23" border="0" /></a></td>
                <td height="25" align="center"><a href="news.php?id=<?php echo $rn['id']; ?>"><img src="images/edit.png" width="25" height="25" border="0" /></a></td>
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