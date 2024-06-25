<?php require_once('connect.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Inpatient</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
<style type="text/css">
<!--
body {
	margin-top: 100px;
}
-->
</style>
</head>

<body onload="document.frm1.user_login.focus()">
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-left:1px solid #F3CDDF; border-right:1px solid #F3CDDF; border-top:1px solid #F3CDDF;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="50" colspan="2" align="center" class="textBlackBold">Login<br />ระบบรายงานจำนวนผู้ป่วยใน</td>
        </tr>
<script>
function chkData() {
	var frm = document.frm1;
	if (frm.user_login.value == "") {
		alert('กรุณากรอก Username');
		frm.user_login.focus();
		return false;
	}
	if (frm.pass_login.value == "") {
		alert('กรุณากรอก Password');
		frm.pass_login.focus();
		return false;
	}
}
		</script>
        <form method="post" name="frm1" action="login_check.php" onsubmit="return chkData()">
      <tr>
        <td width="38%" height="25" align="right">Username :&nbsp;</td>
        <td width="62%" height="25" align="left"><input name="user_login" type="text" class="txtBox" id="user_login" /></td>
      </tr>
      <tr>
        <td height="25" align="right">Password :&nbsp;</td>
        <td height="25" align="left"><input name="pass_login" type="password" class="txtBox" id="pass_login" /></td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td height="25" align="left"><input type="submit" name="button" id="button" value="  Login  " /></td>
      </tr>
      </form>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td height="25" align="left">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>