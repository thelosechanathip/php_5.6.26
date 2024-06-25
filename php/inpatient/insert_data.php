<?php
include "sess_uin.php";
$p = "insert";
include "connect.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บันทึกข้อมูลประจำวัน</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
<script type="text/javascript">
function calPatientPT() { /////////////////////////////PT
	var frm2 = document.frm2;
	var on_pt = 0; //คงพยาบาล
	if (frm2.on_pt.value != "") {
		on_pt = parseInt(frm2.on_pt.value);
	}
	var in_pt = 0; //รับใหม่
	if (frm2.in_pt.value != "") {
		in_pt =  parseInt(frm2.in_pt.value);
	}
	var move_pt = 0; //รับย้าย
	if (frm2.move_pt.value != "") {
		move_pt = parseInt(frm2.move_pt.value);
	}
	var home_pt = 0; //กลับบ้าน
	if (frm2.home_pt.value != "") {
		home_pt = parseInt(frm2.home_pt.value);
	}
	var move_b_pt = 0; //ย้ายตึก
	if (frm2.move_b_pt.value != "") {
		move_b_pt = parseInt(frm2.move_b_pt.value);
	}
	var send_pt = 0; //ส่งต่อ
	if (frm2.send_pt.value != "") {
		send_pt = parseInt(frm2.send_pt.value);
	}
	var dead_pt = 0; //ตาย
	if (frm2.dead_pt.value != "") {
		dead_pt = parseInt(frm2.dead_pt.value);
	}
	var non_voluntary_pt = 0; //ไม่สมัครใจอยู่
	if (frm2.non_voluntary_pt.value != "") {
		non_voluntary_pt = parseInt(frm2.non_voluntary_pt.value);
	}
	var ad_pt = 0; //A&D Same day
	if (frm2.ad_pt.value != "") {
		ad_pt = parseInt(frm2.ad_pt.value);
	}
	var onhand = on_pt + in_pt + move_pt; //รวมที่มีอยู่
	var paid = home_pt + move_b_pt + send_pt + dead_pt + non_voluntary_pt; //รวมจำหน่วย
	var result = onhand - paid + ad_pt;
	frm2.patient_day_pt.value = result;
}
function calPatientNB() { //////////////////////////////////NB
	var frm2 = document.frm2;
	var on_nb = 0; //คงพยาบาล
	if (frm2.on_nb.value != "") {
		on_nb = parseInt(frm2.on_nb.value);
	}
	var in_nb = 0; //รับใหม่
	if (frm2.in_nb.value != "") {
		in_nb =  parseInt(frm2.in_nb.value);
	}
	var move_nb = 0; //รับย้าย
	if (frm2.move_nb.value != "") {
		move_nb = parseInt(frm2.move_nb.value);
	}
	var home_nb = 0; //กลับบ้าน
	if (frm2.home_nb.value != "") {
		home_nb = parseInt(frm2.home_nb.value);
	}
	var move_b_nb = 0; //ย้ายตึก
	if (frm2.move_b_nb.value != "") {
		move_b_nb = parseInt(frm2.move_b_nb.value);
	}
	var send_nb = 0; //ส่งต่อ
	if (frm2.send_nb.value != "") {
		send_nb = parseInt(frm2.send_nb.value);
	}
	var dead_nb = 0; //ตาย
	if (frm2.dead_nb.value != "") {
		dead_nb = parseInt(frm2.dead_nb.value);
	}
	var non_voluntary_nb = 0; //ไม่สมัครใจอยู่
	if (frm2.non_voluntary_nb.value != "") {
		non_voluntary_nb = parseInt(frm2.non_voluntary_nb.value);
	}
	var ad_nb = 0; //A&D Same day
	if (frm2.ad_nb.value != "") {
		ad_nb = parseInt(frm2.ad_nb.value);
	}
	var onhand = on_nb + in_nb + move_nb; //รวมที่มีอยู่
	var paid = home_nb + move_b_nb + send_nb + dead_nb + non_voluntary_nb; //รวมจำหน่วย
	var result = onhand - paid + ad_nb;
	frm2.patient_day_nb.value = result;
}
</script>
</head>

<body>
<?php
$idate = $_POST['idate'];
$wage_type = $_POST['wage_type'];
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">บันทึกข้อมูลประจำวัน</td>
          </tr>
          <tr>
            <td align="left"><table width="500" border="0" cellspacing="0" cellpadding="0">
<form name="frm1" method="post" action="<?php echo "$PHP_SELF"; ?>">
              <tr>
                <td width="29" height="25" align="left">วันที่</td>
                <td width="152" height="25" align="left"><?php
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
                <td width="26" height="25" align="left">เวร</td>
                <td width="66" height="25" align="left"><select name="wage_type" id="wage_type">
                  <?php
$sqlwt = "SELECT wage_type_id, wage_type_name FROM wage_type ORDER BY wage_type_id ASC";
$resultwt =  $conn->query($sqlwt);
while ($rwt = $resultwt->fetch_array()) {
  if ($wage_type == $rwt['wage_type_id']) {
      echo "<option value='{$rwt['wage_type_id']}' selected>{$rwt['wage_type_name']}</option>";
  } else {
      echo "<option value='{$rwt['wage_type_id']}'>{$rwt['wage_type_name']}</option>";
  }
}

?>
                </select></td>
                <td width="227" height="25" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
              </tr>
</form>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
<?php
if ($wage_type != "") {
	include "myclass.php";
	$idate2 = FormatDateDefault($dmy);
	$sqlc = "SELECT i_status FROM data_all WHERE idate = '$idate2' AND ward = '$_SESSION[sess_ward]' AND wage_type_id = '$wage_type'";
	$resultc = $conn->query($sqlc);
	$rc = $resultc->fetch_array();
	if ($rc['i_status'] != "") { //ถ้ามีข้อมูลอยู่แล้ว
?>
		<tr>
            <td height="25" align="center">ข้อมูลนี้ ได้รับการบันทึกแล้ว<br />ถ้าต้องการแก้ไขข้อมูลนี้ ให้ไปที่หน้าจอ "แก้ไขข้อมูลประจำวัน"</td>
          </tr>
<?php
	} //end ถ้ายืนยันข้อมูลแล้ว
	if ($rc['i_status'] == "") { //ยังไม่มีข้อมูล สามารถบันทึกใหม่ได้
		$sql = "SELECT on_pt, on_nb, in_pt, in_nb, move_pt, move_nb, home_pt, home_nb, move_b_pt, move_b_nb, send_pt, send_nb, dead_pt, dead_nb, non_voluntary_pt, non_voluntary_nb, amount_bed FROM data_all WHERE ward = '$_SESSION[sess_ward]' AND idate <= '$idate2' ORDER BY idate DESC, wage_type_id DESC LIMIT 0, 1";
		$result = $conn->query($sql);
		$r = $result->fetch_array();
		$total_paid_pt = $r['home_pt'] + $r['move_b_pt'] + $r['send_pt'] + $r['dead_pt'] + $r['non_voluntary_pt']; //รวมจำหน่าย PT ของเวรที่แล้ว
		$total_paid_nb = $r['home_nb'] + $r['move_b_nb'] + $r['send_nb'] + $r['dead_nb'] + $r['non_voluntary_nb']; //รวมจำหน่าย NB ของเวรที่แล้ว
		$result_pt = $r['on_pt'] + $r['in_pt'] + $r['move_pt'] - $total_paid_pt; //คงเหลือ PT นำไปเป็นยอดคงพยาบาลเวรต่อไป
		$result_nb = $r['on_nb'] + $r['in_nb'] + $r['move_nb'] - $total_paid_nb; //คงเหลือ NB นำไปเป็นยอดคงพยาบาลเวรต่อไป
?>
<script>
function chkData() {
	var on_pt = 0;
	if (frm2.on_pt.value != "") {
		on_pt = parseInt(frm2.on_pt.value);
	}
	var in_pt = 0;
	if (frm2.in_pt.value != "") {
		in_pt = parseInt(frm2.in_pt.value);
	}
	var move_pt = 0;
	if (frm2.move_pt.value != "") {
		move_pt = parseInt(frm2.move_pt.value);
	}
	var home_pt = 0;
	if (frm2.home_pt.value != "") {
		home_pt = parseInt(frm2.home_pt.value);
	}
	var move_b_pt = 0;
	if (frm2.move_b_pt .value != "") {
		move_b_pt = parseInt(frm2.move_b_pt.value);
	}
	var send_pt = 0;
	if (frm2.send_pt.value != "") {
		send_pt = parseInt(frm2.send_pt.value);
	}
	var dead_pt = 0;
	if (frm2.dead_pt.value != "") {
		dead_pt = parseInt(frm2.dead_pt.value);
	}
	var non_voluntary_pt = 0;
	if (frm2.non_voluntary_pt.value != "") {
		non_voluntary_pt = parseInt(frm2.non_voluntary_pt.value);
	}
	var result1 = (on_pt + in_pt + move_pt) - (home_pt + move_b_pt + send_pt + dead_pt + non_voluntary_pt);
	var patient_type1 = 0;
	if (frm2.patient_type1.value != "") {
		patient_type1 = parseInt(frm2.patient_type1.value);
	}
	var patient_type2 = 0;
	if (frm2.patient_type2.value != "") {
		patient_type2 = parseInt(frm2.patient_type2.value);
	}
	var patient_type3 = 0;
	if (frm2.patient_type3.value != "") {
		patient_type3 = parseInt(frm2.patient_type3.value);
	}
	var patient_type4 = 0;
	if (frm2.patient_type4.value != "") {
		patient_type4 = parseInt(frm2.patient_type4.value);
	}
	var result2 = (patient_type1 + patient_type2 + patient_type3 + patient_type4);
	/*if (result2 != result1) {
		alert('กรอกข้อมูลประเภทผู้ป่วยไม่ตรงกับจำนวนผู้ป่วยคงเหลือ');
		return false;
	}*/
	if (frm2.amount_bed.value == "") {
		alert('กรุณาระบุจำนวนเตียงด้วยครับ');
		frm2.amount_bed.focus();
		return false;
	}
	var cf = confirm('ต้องการบันทึกข้อมูลใช่หรือไม่');
	if (cf == true) {
		return true;
	} else {
		return false;
	}
}
</script>
          <tr>
            <td align="left"><form name="frm2" method="post" action="manage_data.php" onsubmit="return chkData()"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><table width="780" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="104" align="left" valign="top"><table width="100" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="2" align="center" bgcolor="#FFE1D2">คงพยาบาล</td>
                  </tr>
                  <tr>
                    <td height="25" colspan="2" align="center" bgcolor="#FFE1D2">วานนี้</td>
                  </tr>
                  <tr>
                    <td width="47" height="25" align="center" bgcolor="#FFE1D2">PT</td>
                    <td width="47" height="25" align="center" bgcolor="#FFE1D2">NB</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFE1D2"><input name="on_pt" type="text" class="txtBox2" id="on_pt" value="<?php echo $result_pt; ?>" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td height="25" align="center" bgcolor="#FFE1D2"><input name="on_nb" type="text" class="txtBox2" id="on_nb" value="<?php echo $result_nb; ?>" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                  </tr>
                </table></td>
                <td width="204" align="left" valign="top"><table width="200" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="4" align="center" bgcolor="#CCFFE6">การรับ</td>
                  </tr>
                  <tr>
                    <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">รับใหม่</td>
                    <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">รับย้าย</td>
                  </tr>
                  <tr>
                    <td width="45" height="25" align="center" bgcolor="#CCFFE6">PT</td>
                    <td width="51" align="center" bgcolor="#CCFFE6">NB</td>
                    <td width="41" height="25" align="center" bgcolor="#CCFFE6">PT</td>
                    <td width="53" height="25" align="center" bgcolor="#CCFFE6">NB</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#CCFFE6"><input name="in_pt" type="text" class="txtBox2" id="in_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td height="25" align="center" bgcolor="#CCFFE6"><input name="in_nb" type="text" class="txtBox2" id="in_nb" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                    <td height="25" align="center" bgcolor="#CCFFE6"><input name="move_pt" type="text" class="txtBox2" id="move_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td align="center" bgcolor="#CCFFE6"><input name="move_nb" type="text" class="txtBox2" id="move_nb" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                  </tr>
                </table></td>
                <td width="472" align="left" valign="top"><table width="460" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="10" align="center" bgcolor="#B9FFFF">จำหน่าย</td>
                  </tr>
                  <tr>
                    <td height="25" colspan="2" align="center" bgcolor="#B9FFFF">กลับบ้าน</td>
                    <td height="25" colspan="2" align="center" bgcolor="#B9FFFF">ย้ายตึก</td>
                    <td height="25" colspan="2" align="center" bgcolor="#B9FFFF">ส่งต่อ</td>
                    <td height="25" colspan="2" align="center" bgcolor="#B9FFFF">ตาย</td>
                    <td colspan="2" align="center" bgcolor="#B9FFFF">ไม่สมัครใจอยู่</td>
                  </tr>
                  <tr>
                    <td width="41" height="25" align="center" bgcolor="#B9FFFF">PT</td>
                    <td width="50" align="center" bgcolor="#B9FFFF">NB</td>
                    <td width="32" align="center" bgcolor="#B9FFFF">PT</td>
                    <td width="55" align="center" bgcolor="#B9FFFF">NB</td>
                    <td width="20" height="25" align="center" bgcolor="#B9FFFF">PT</td>
                    <td width="61" align="center" bgcolor="#B9FFFF">NB</td>
                    <td width="18" height="25" align="center" bgcolor="#B9FFFF">PT</td>
                    <td width="72" align="center" bgcolor="#B9FFFF">NB</td>
                    <td width="30" height="25" align="center" bgcolor="#B9FFFF">PT</td>
                    <td width="59" align="center" bgcolor="#B9FFFF">NB</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="home_pt" type="text" class="txtBox2" id="home_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="home_nb" type="text" class="txtBox2" id="home_nb" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="move_b_pt" type="text" class="txtBox2" id="move_b_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="move_b_nb" type="text" class="txtBox2" id="move_b_nb" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="send_pt" type="text" class="txtBox2" id="send_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="send_nb" type="text" class="txtBox2" id="send_nb" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                    <td align="center" bgcolor="#B9FFFF"><input name="dead_pt" type="text" class="txtBox2" id="dead_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td align="center" bgcolor="#B9FFFF"><input name="dead_nb" type="text" class="txtBox2" id="dead_nb" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                    <td align="center" bgcolor="#B9FFFF"><input name="non_voluntary_pt" type="text" class="txtBox2" id="non_voluntary_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td align="center" bgcolor="#B9FFFF"><input name="non_voluntary_nb" type="text" class="txtBox2" id="non_voluntary_nb" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="left"><table width="780" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="104" align="left" valign="top"><table width="100" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">A&amp;D Same day</td>
                  </tr>
                  <tr>
                    <td width="47" height="25" align="center" bgcolor="#CCFFE6">PT</td>
                    <td width="47" height="25" align="center" bgcolor="#CCFFE6">NB</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#CCFFE6"><input name="ad_pt" type="text" class="txtBox2" id="ad_pt" value="0" size="3" maxlength="10" onkeyup="calPatientPT()" /></td>
                    <td height="25" align="center" bgcolor="#CCFFE6"><input name="ad_nb" type="text" class="txtBox2" id="textfield" value="0" size="3" maxlength="10" onkeyup="calPatientNB()" /></td>
                  </tr>
                </table></td>
                <td width="252" align="left" valign="top"><table width="247" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="5" align="center" bgcolor="#FFE1D2">ประเภทผู้ป่วย</td>
                  </tr>
                  <tr>
                    <td width="47" align="center" bgcolor="#FFE1D2">5</td>
                    <td width="47" height="25" align="center" bgcolor="#FFE1D2">4</td>
                    <td width="47" align="center" bgcolor="#FFE1D2">3</td>
                    <td width="47" height="25" align="center" bgcolor="#FFE1D2">2</td>
                    <td width="47" height="25" align="center" bgcolor="#FFE1D2">1</td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#FFE1D2"><input name="patient_type5" type="text" class="txtBox2" id="patient_type" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFE1D2"><input name="patient_type4" type="text" class="txtBox2" id="patient_type4" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFE1D2"><input name="patient_type3" type="text" class="txtBox2" id="textfield13" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFE1D2"><input name="patient_type2" type="text" class="txtBox2" id="textfield12" value="0" size="3" maxlength="10" /></td>
                    <td align="center" bgcolor="#FFE1D2"><input name="patient_type1" type="text" class="txtBox2" id="textfield14" value="0" size="3" maxlength="10" /></td>
                  </tr>
                </table></td>
                <td width="56" align="left" valign="top"><table width="47" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="52" align="center" bgcolor="#B9FFFF">จำนวน<br />เตียง</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="amount_bed" type="text" class="txtBox2" id="textfield20" value="<?php echo $r['amount_bed']; ?>" size="3" maxlength="10" /></td>
                  </tr>
                </table></td>
                <td width="368" align="left" valign="top"><table width="247" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="5" align="center" bgcolor="#FFFFB7">จนท.ปฏิบัติงาน</td>
                  </tr>
                  <tr>
                    <td width="47" height="25" align="center" bgcolor="#FFFFB7">HN</td>
                    <td width="47" align="center" bgcolor="#FFFFB7">RN</td>
                    <td width="47" align="center" bgcolor="#FFFFB7">TN</td>
                    <td width="47" align="center" bgcolor="#FFFFB7">PN</td>
                    <td width="47" height="25" align="center" bgcolor="#FFFFB7">AID</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="em_hn" type="text" class="txtBox2" id="textfield15" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="em_rn" type="text" class="txtBox2" id="textfield16" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="em_tn" type="text" class="txtBox2" id="textfield17" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="em_pn" type="text" class="txtBox2" id="textfield18" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="em_aid" type="text" class="txtBox2" id="textfield19" value="0" size="3" maxlength="10" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <?php if ($wage_type == "3") { //เฉพาะเวรบ่าย ?>
              <tr>
                <td height="25" align="left">การให้บริการผู้ป่วยในแต่ละสาขา (ลงข้อมูลในเวรบ่าย)</td>
              </tr>
              <tr>
                <td align="left"><table width="780" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="104" align="left" valign="top"><table width="100" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="2" align="center" bgcolor="#FFE1D2">Patient Day</td>
                  </tr>
                  <tr>
                    <td width="47" height="32" align="center" bgcolor="#FFE1D2">PT</td>
                    <td width="47" height="32" align="center" bgcolor="#FFE1D2">NB</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFE1D2"><input name="patient_day_pt" type="text" class="txtBox2" id="patient_day_pt" value="<?php echo $result_pt; ?>" size="3" maxlength="10" readonly="readonly" /></td>
                    <td height="25" align="center" bgcolor="#FFE1D2"><input name="patient_day_nb" type="text" class="txtBox2" id="patient_day_nb" value="<?php echo $result_nb; ?>" size="3" maxlength="10" readonly="readonly" /></td>
                  </tr>
                </table></td>
                <td width="676" align="right" valign="top"><table width="670" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="13" align="center" bgcolor="#B9FFFF">แยกแผนกผู้ป่วย (ห้องสามัญ)</td>
                  </tr>
                  <tr>
                    <td width="27" height="25" align="center" bgcolor="#B9FFFF">OBS</td>
                    <td width="31" height="25" align="center" bgcolor="#B9FFFF">NB</td>
                    <td width="38" align="center" bgcolor="#B9FFFF">GYN</td>
                    <td width="54" align="center" bgcolor="#B9FFFF">SURG</td>
                    <td width="60" align="center" bgcolor="#B9FFFF">MED</td>
                    <td width="67" align="center" bgcolor="#B9FFFF">PSYCH</td>
                    <td width="57" align="center" bgcolor="#B9FFFF">SKIN</td>
                    <td width="52" align="center" bgcolor="#B9FFFF">PED</td>
                    <td width="70" align="center" bgcolor="#B9FFFF">ORTHO</td>
                    <td width="50" align="center" bgcolor="#B9FFFF">EYE</td>
                    <td width="51" align="center" bgcolor="#B9FFFF">ENT</td>
                    <td width="37" align="center" bgcolor="#B9FFFF">DENT</td>
                    <td width="48" align="center" bgcolor="#B9FFFF">NEURO SURG</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="obs_n" type="text" class="txtBox2" id="obs_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="nb_n" type="text" class="txtBox2" id="nb_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="gyn_n" type="text" class="txtBox2" id="gyn_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="surg_n" type="text" class="txtBox2" id="surg_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="med_n" type="text" class="txtBox2" id="med_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="psych_n" type="text" class="txtBox2" id="psych_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="skin_n" type="text" class="txtBox2" id="skin_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="ped_n" type="text" class="txtBox2" id="ped_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="ortho_n" type="text" class="txtBox2" id="ortho_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="eye_n" type="text" class="txtBox2" id="eye_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="ent_n" type="text" class="txtBox2" id="ent_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="dent_n" type="text" class="txtBox2" id="dent_n" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#B9FFFF"><input name="neuro_surg_n" type="text" class="txtBox2" id="neuro_surg_n" value="0" size="3" maxlength="10" /></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top"><table width="670" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="25" colspan="13" align="center" bgcolor="#FFFFB7">แยกแผนกผู้ป่วย (ห้องพิเศษ)</td>
                  </tr>
                  <tr>
                    <td width="27" height="25" align="center" bgcolor="#FFFFB7">OBS</td>
                    <td width="31" height="25" align="center" bgcolor="#FFFFB7">NB</td>
                    <td width="38" align="center" bgcolor="#FFFFB7">GYN</td>
                    <td width="53" align="center" bgcolor="#FFFFB7">SURG</td>
                    <td width="61" align="center" bgcolor="#FFFFB7">MED</td>
                    <td width="67" align="center" bgcolor="#FFFFB7">PSYCH</td>
                    <td width="57" align="center" bgcolor="#FFFFB7">SKIN</td>
                    <td width="52" align="center" bgcolor="#FFFFB7">PED</td>
                    <td width="70" align="center" bgcolor="#FFFFB7">ORTHO</td>
                    <td width="50" align="center" bgcolor="#FFFFB7">EYE</td>
                    <td width="51" align="center" bgcolor="#FFFFB7">ENT</td>
                    <td width="37" align="center" bgcolor="#FFFFB7">DENT</td>
                    <td width="48" align="center" bgcolor="#FFFFB7">NEURO SURG</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="obs_s" type="text" class="txtBox2" id="obs_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="nb_s" type="text" class="txtBox2" id="nb_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="gyn_s" type="text" class="txtBox2" id="gyn_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="surg_s" type="text" class="txtBox2" id="surg_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="med_s" type="text" class="txtBox2" id="med_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="psych_s" type="text" class="txtBox2" id="psych_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="skin_s" type="text" class="txtBox2" id="skin_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="ped_s" type="text" class="txtBox2" id="ped_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="ortho_s" type="text" class="txtBox2" id="ortho_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="eye_s" type="text" class="txtBox2" id="eye_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="ent_s" type="text" class="txtBox2" id="ent_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="dent_s" type="text" class="txtBox2" id="dent_s" value="0" size="3" maxlength="10" /></td>
                    <td height="25" align="center" bgcolor="#FFFFB7"><input name="neuro_surg_s" type="text" class="txtBox2" id="neuro_surg_s" value="0" size="3" maxlength="10" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="left" bgcolor="#D7FFFF">อัตราการเกิดแผลกดทับ (ลงข้อมูลในเวรบ่าย)</td>
              </tr>
              <tr>
                <td align="left"><table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="338" height="25" align="center" style="border-bottom:1px solid #666;">จำนวนครั้งของการเกิดแผลกดทับระดับ 2 - 4</td>
                <td width="262" height="25" align="left"><input name="do_pressure" type="text" id="do_pressure" value="0" size="10" maxlength="10" /></td>
              </tr>
              <tr>
                <td height="25" align="center">จำนวนวันนอนรวมของผู้ป่วยที่เสี่ยงต่อการเกิดแผลกดทับ</td>
                <td height="25" align="left"><input name="risk_pressure" type="text" id="risk_pressure" value="0" size="10" maxlength="10" /></td>
              </tr>
            </table></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <?php } //end เวรบ่าย ?>
              <tr>
                <td height="25" align="left" bgcolor="#EFE0D1">ข้อมูลการรีแอดมิต (ลงข้อมูลเดือนละครั้ง)</td>
              </tr>
              <tr>
                <td align="left"><table width="600" border="0" cellspacing="0" cellpadding="0">
<?php
$sql_r = "select * from readmit where ward = '$_SESSION[sess_ward]' and month1 = '".substr($idate2, 0, 7)."'";
$result_r = $conn->query($sql_r);
$r_r = $result_r->fetch_array();
?>
                  <tr>
                    <td width="338" height="25" align="center" style="border-bottom:1px solid #666;">จำนวนผู้ป่วยที่กลับเข้ารับการรักษาซ้ำด้วยโรค/อาการเดิม<br />
                      ภายใน 28 วัน หลังจำหน่าย</td>
                    <td width="262" height="25" align="left"><input name="readmit_amount" type="text" id="readmit_amount" size="10" maxlength="10" value="<?php echo $r_r['readmit_amount']; ?>" /></td>
                  </tr>
                  <tr>
                    <td height="25" align="center">จำนวนผู้ป่วยที่จำหน่ายทั้งหมดในเดือนก่อนหน้า</td>
                    <td height="25" align="left"><input name="discharge_amount" type="text" id="discharge_amount" size="10" maxlength="10" value="<?php echo $r_r['discharge_amount']; ?>" /></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="left"><input type="submit" name="button2" id="button2" value="  บันทึกข้อมูล  " />
		      <input name="idate" type="hidden" id="idate" value="<?php echo $idate; ?>" />
		  <input name="wage_type" type="hidden" id="wage_type" value="<?php echo $wage_type; ?>" />
		  <input name="st" type="hidden" id="st" value="save" />
		  <span class="textRedNormal">*กดปุ่ม &quot;บันทึกข้อมูล&quot; เพียงครั้งเดียวต่อการบันทึกแต่ละรายการ เมื่อกดแล้วไม่ต้องกดซ้ำ เพราะอาจจะทำให้ข้อมูลถูกบันทึกหลายครั้ง</span></td>
              </tr>
            </table></form></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
<?php
	} //end บันทึกข้อมูลใหม่
} //end if $wage_type
?>
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