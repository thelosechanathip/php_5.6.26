<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายละเอียดข่าว</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
$id = $_GET['id'];
$rd = $_GET['rd'];
include "connect.php";
$sql = "SELECT * FROM tb_news WHERE id = '$id' AND status_news = 1";
$result = $conn->query($sql);
$r = $result->fetch_array();
?>
<table width="600" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td align="left" class="textBlackBold" style="border-bottom:2px solid #F90;"><?php echo $r['title_news']; ?></td>
  </tr>
  <tr>
    <td align="left"><?php echo nl2br($r['detail_news']); ?></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">Date <?php echo $r['date_news']; ?> By <?php echo $r['user_update']; ?></td>
  </tr>
</table>
</body>
</html>