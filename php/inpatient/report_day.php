<?php
include "sess_uin.php";
$p = "reportday";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานประจำวัน</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
$idate = $_POST['idate'];
if ($idate == "") {
	$dm = date("d/m/");
	$y = date("Y") + 543;
	$dmy = $dm.$y;
} else {
	$dmy = $idate;
}
$ward = $_SESSION["sess_ward"];
include "myclass.php";
$idate2 = FormatDateDefault($dmy);
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">รายงานประจำวัน</td>
          </tr
          ><tr>
            <td height="25" align="left"><table width="1580" border="0" cellspacing="0" cellpadding="0">
<script>
function chkData() {
	if (document.frm1.ward.value == "0") {
		alert('กรุณาเลือก ward');
		document.frm1.ward.focus();
		return false;
	}
}
</script>
<form method="post" name="frm1" action="<?php echo "$PHP_SELF"; ?>" onsubmit="return chkData()">
<?php
//if ($_SESSION["sess_ward"] == "00") { //ถ้าเป็น admin
if ($_POST['ward'] != "") {
	$ward = $_POST['ward'];
}
?>
              <tr>
                <td height="25" align="left">Ward</td>
                <td height="25" colspan="3" align="left"><select name="ward" id="ward">
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
                </tr>
<?php //} //end admin ?>
              <tr>
                <td width="66" height="25" align="left">ประจำวันที่</td>
                <td width="140" height="25" align="left">
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
                <td width="682" height="25" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
                <td width="692" align="left">&nbsp;</td>
              </tr>
</form>
            </table></td>
          </tr>
          <tr>
            <td height="25"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/report_day_r.php?ward=<?php echo $ward; ?>&dmy=<?php echo $dmy; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/report_day_r.php?ward=<?php echo $ward; ?>&dmy=<?php echo $dmy; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
<?php
$sqlw = "SELECT name FROM ward WHERE ward = '$ward'";
$resultw = $conn->query($sqlw);
$rw = $resultw->fetch_array();
?>
          <tr>
            <td>INPATIENT CENSUS AND INPATIENT SERVICE DAYS ประจำวันที่ <?php echo FormatDateFull($idate2); ?>&nbsp;<?php echo $rw[0]; ?></td>
          </tr>
          <tr>
            <td align="left"><table width="1644" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="26" rowspan="3" align="center" bgcolor="#CCFFE6">วันที่</td>
                <td width="25" rowspan="3" align="center" bgcolor="#B9FFFF">เวร</td>
                <td colspan="2" align="center" bgcolor="#FFE1D2">คงพยาบาล</td>
                <td colspan="4" align="center" bgcolor="#CCFFE6">การรับ</td>
                <td height="25" colspan="10" align="center" bgcolor="#B9FFFF">จำหน่าย</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">รวมจำหน่าย</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2">คงเหลือ</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">A&amp;D<br />
                  Same day</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2">Patient Day</td>
                <td colspan="5" rowspan="2" align="center" bgcolor="#FFE1D2">ประเภทผู้ป่วย</td>
                <td width="35" rowspan="3" align="center" bgcolor="#B9FFFF">รวมให้<br />
                  การพยาบาล</td>
                <td width="35" rowspan="3" align="center" bgcolor="#B9FFFF">จำนวน<br />
                  เตียง</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">เฉลี่ยนอนรพ.<br />
                  (คน)</td>
                <td width="60" rowspan="3" align="center" bgcolor="#FFE1D2">อัตราการ<br />
                  ครองเตียง</td>
                <td width="160" rowspan="3" align="center" bgcolor="#B9FFFF">turnover interval (T)<br />
                  ช่วงเวลาว่างของเตียง (วัน)</td>
                <td width="178" rowspan="3" align="center" bgcolor="#FFE1D2">Bed Turnover Rate (B)<br />
                  ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)</td>
                <td colspan="5" rowspan="2" align="center" bgcolor="#FFFF00">จนท.ปฏิบัติงาน</td>
                </tr>
              <tr>
                <td height="25" colspan="2" align="center" bgcolor="#FFE1D2">วานนี้</td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">รับใหม่</td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">รับย้าย</td>
                <td colspan="2" align="center" bgcolor="#B9FFFF">กลับบ้าน</td>
                <td colspan="2" align="center" bgcolor="#B9FFFF">ย้ายตึก</td>
                <td colspan="2" align="center" bgcolor="#B9FFFF">ส่งต่อ</td>
                <td colspan="2" align="center" bgcolor="#B9FFFF">ตาย</td>
                <td colspan="2" align="center" bgcolor="#B9FFFF">ไม่สมัครใจอยู่</td>
                </tr>
              <tr>
                <td width="30" height="25" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="30" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="28" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="28"  align="center" bgcolor="#CCFFE6">NB</td>
                <td width="28" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="28" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="28" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="28" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="28" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="28" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="28" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="28" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="28" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="28" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="37" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="37" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="35" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="35" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="25" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="25" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="32" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="32" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="26" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="26" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="25" align="center" bgcolor="#FFE1D2">วิกฤต</td>
                <td width="25" align="center" bgcolor="#FFE1D2">4</td>
                <td width="25" align="center" bgcolor="#FFE1D2">3</td>
                <td width="26" align="center" bgcolor="#FFE1D2">2</td>
                <td width="25" align="center" bgcolor="#FFE1D2">1</td>
                <td width="40" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="40" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="25" align="center" bgcolor="#FFFF00">HN</td>
                <td width="25" align="center" bgcolor="#FFFF00">RN</td>
                <td width="25" align="center" bgcolor="#FFFF00">TN</td>
                <td width="25" align="center" bgcolor="#FFFF00">PN</td>
                <td width="25" align="center" bgcolor="#FFFF00">AID</td>
              </tr>
<?php
$dd = explode('/', $dmy);
if (substr($dd[0], 0, 1) == 0) {
	$dd = substr($dd[0], 1, 1);
}
$sql = "SELECT data_all.on_pt, data_all.on_nb, wage_type.wage_type_names, data_all.in_pt, data_all.in_nb, data_all.move_pt, data_all.move_nb, data_all.home_pt, data_all.home_nb, data_all.move_b_pt, data_all.move_b_nb, data_all.send_pt, data_all.send_nb, data_all.dead_pt, data_all.dead_nb, data_all.non_voluntary_pt, data_all.non_voluntary_nb, data_all.ad_pt, data_all.ad_nb, data_all.patient_type5, data_all.patient_type4, data_all.patient_type3, data_all.patient_type2, data_all.patient_type1, data_all.amount_bed, data_all.em_hn, data_all.em_rn, data_all.em_tn, data_all.em_pn, data_all.em_aid, data_all.i_status FROM data_all LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id WHERE data_all.idate = '$idate2' AND data_all.ward = '$ward' ORDER BY data_all.wage_type_id ASC";
$result = $conn->query($sql);
$i = 1;
while ($r = $result->fetch_array()) {
	$total_sub_paid_pt = $r['home_pt'] + $r['move_b_pt'] + $r['send_pt'] + $r['dead_pt'] + $r['non_voluntary_pt']; //รวมจำหน่าย PT รายแถว
	$total_sub_paid_nb = $r['home_nb'] + $r['move_b_nb'] + $r['send_nb'] + $r['dead_nb'] + $r['non_voluntary_nb']; //รวมจำหน่าย NB รายแถว
	$result_pt = $r['on_pt'] + $r['in_pt'] + $r['move_pt'] - $total_sub_paid_pt; //คงเหลือ PT
	$result_nb = $r['on_nb'] + $r['in_nb'] + $r['move_nb'] - $total_sub_paid_nb; //คงเหลือ NB
	$patient_day_pt = $result_pt + $r['ad_pt']; //patient_day_pt
	$patient_day_nb = $result_nb + $r['ad_nb']; //patient_day_nb
	$bed_rate = ($result_pt * 100) / $r['amount_bed'];//อัตราการครองเตียง
	if ($total_sub_paid_pt != 0) {
		$bed_free = ($r['amount_bed'] - $patient_day_pt) / $total_sub_paid_pt; //ช่วงเวลาว่างของเตียง
	}
	$bed_paid_avg = $total_sub_paid_pt / $r['amount_bed']; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
	//ผลรวม
	if ($i == 1) {
		$total_on_pt = $r['on_pt'];
		$total_on_nb = $r['on_nb'];
	}
	$total_in_pt += $r['in_pt']; //รวมรับใหม่ PT
	$total_in_nb += $r['in_nb']; //รวมรับใหม่ NB
	$total_move_pt += $r['move_pt']; //รวมรับย้าย PT
	$total_move_nb += $r['move_nb']; //รวมรับย้าย NB
	$total_home_pt += $r['home_pt']; //รวมกลับบ้าน PT
	$total_home_nb += $r['home_nb']; //รวมกลับบ้าน NB
	$total_move_b_pt += $r['move_b_pt']; //รวมย้ายตึก PT
	$total_move_b_nb += $r['move_b_nb']; //รวมย้ายตึก NB
	$total_send_pt += $r['send_pt']; //รวมส่งต่อ PT
	$total_send_nb += $r['send_nb']; //รวมส่งต่อ NB
	$total_dead_pt += $r['dead_pt']; //รวมตาย PT
	$total_dead_nb += $r['dead_nb']; //รวมตาย NB
	$total_non_voluntary_pt += $r['non_voluntary_pt']; //รวมไม่สมัครใจอยู่ PT
	$total_non_voluntary_nb += $r['non_voluntary_nb']; //รวมไม่สมัครใจอยู่ NB
	$total_paid_pt += $total_sub_paid_pt; //รวมจำหน่าย PT
	$total_paid_nb += $total_sub_paid_nb; //รวมจำหน่าย NB
	$total_ad_pt += $r['ad_pt']; //รวม ad PT
	$total_ad_nb += $r['ad_nb']; //รวม ad NB
	$total_patient_type5 += $r['patient_type5']; //รวม patient_type5
	$total_patient_type4 += $r['patient_type4']; //รวม patient_type4
	$total_patient_type3 += $r['patient_type3']; //รวม patient_type3
	$total_patient_type2 += $r['patient_type2']; //รวม patient_type2
	$total_patient_type1 += $r['patient_type1']; //รวม patient_type1
	$amount_bed = $r['amount_bed']; //จำนวนเตียง
	$total_em_hn += $r['em_hn']; //รวม จนท. HN
	$total_em_rn += $r['em_rn']; //รวม จนท. RN
	$total_em_tn += $r['em_tn']; //รวม จนท. TN
	$total_em_pn += $r['em_pn']; //รวม จนท. PN
	$total_em_aid += $r['em_aid']; //รวม จนท. AID
	if ($r['i_status'] == "1") {
		$bgc = "#00CC66";
	} else {
		$bgc = "#FFA4A4";
	}
?>
              <tr bgcolor="<?php echo $bgc; ?>">
                <td height="25" align="center"><?php echo $dd[0]; ?></td>
                <td height="25" align="center"><?php echo $r['wage_type_names']; ?></td>
                <td height="25" align="center"><?php if ($r['on_pt'] != "0") { echo $r['on_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['on_nb'] != "0") { echo $r['on_nb']; } ?></td>
                <td height="25" align="center"><?php if ($r['in_pt'] != "0") { echo $r['in_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['in_nb'] != "0") { echo $r['in_nb']; } ?></td>
                <td height="25" align="center"><?php if ($r['move_pt'] != "0") { echo $r['move_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['move_nb'] != "0") { echo $r['move_nb']; } ?></td>
                <td height="25" align="center"><?php if ($r['home_pt'] != "0") { echo $r['home_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['home_nb'] != "0") { echo $r['home_nb']; } ?></td>
                <td height="25" align="center"><?php if ($r['move_b_pt'] != "0") { echo $r['move_b_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['move_b_nb'] != "0") { echo $r['move_b_nb']; } ?></td>
                <td height="25" align="center"><?php if ($r['send_pt'] != "0") { echo $r['send_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['send_nb'] != "0") { echo $r['send_nb']; } ?></td>
                <td height="25" align="center"><?php if ($r['dead_pt'] != "0") { echo $r['dead_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['dead_nb'] != "0") { echo $r['dead_nb']; } ?></td>
                <td height="25" align="center"><?php if ($r['non_voluntary_pt'] != "0") { echo $r['non_voluntary_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['non_voluntary_nb'] != "0") { echo $r['non_voluntary_nb']; } ?></td>
                <td height="25" align="center"><?php echo $total_sub_paid_pt; ?></td>
                <td height="25" align="center"><?php echo $total_sub_paid_nb; ?></td>
                <td height="25" align="center"><?php echo $result_pt; ?></td>
                <td height="25" align="center"><?php echo $result_nb; ?></td>
                <td height="25" align="center"><?php if ($r['ad_pt'] != "0") { echo $r['ad_pt']; } ?></td>
                <td height="25" align="center"><?php if ($r['ad_nb'] != "0") { echo $r['ad_nb']; } ?></td>
                <td height="25" align="center"><?php echo $patient_day_pt; ?></td>
                <td height="25" align="center"><?php echo $patient_day_nb; ?></td>
                <td align="center"><?php if ($r['patient_type5'] != "0") { echo $r['patient_type5']; } ?></td>
                <td height="25" align="center"><?php if ($r['patient_type4'] != "0") { echo $r['patient_type4']; } ?></td>
                <td height="25" align="center"><?php if ($r['patient_type3'] != "0") { echo $r['patient_type3']; } ?></td>
                <td height="25" align="center"><?php if ($r['patient_type2'] != "0") { echo $r['patient_type2']; } ?></td>
                <td height="25" align="center"><?php if ($r['patient_type1'] != "0") { echo $r['patient_type1']; } ?></td>
                <td align="center"><?php echo number_format(($r['on_pt'] + $r['in_pt'] + $r['move_pt']), 0); ?></td>
                <td height="25" align="center"><?php if ($r['amount_bed'] != "0") { echo $r['amount_bed']; } ?></td>
                <td height="25" align="center"><?php echo $patient_day_pt; ?></td>
                <td height="25" align="center"><?php echo $patient_day_nb; ?></td>
                <td height="25" align="center"><?php echo number_format($bed_rate, 2); ?></td>
                <td height="25" align="center"><?php echo number_format($bed_free, 2); ?></td>
                <td height="25" align="center"><?php echo number_format($bed_paid_avg, 2); ?></td>
                <td height="25" align="center"><?php if ($r['em_hn'] != "0") { echo $r['em_hn']; } ?></td>
                <td height="25" align="center"><?php if ($r['em_rn'] != "0") { echo $r['em_rn']; } ?></td>
                <td height="25" align="center"><?php if ($r['em_tn'] != "0") { echo $r['em_tn']; } ?></td>
                <td height="25" align="center"><?php if ($r['em_pn'] != "0") { echo $r['em_pn']; } ?></td>
                <td height="25" align="center"><?php if ($r['em_aid'] != "0") { echo $r['em_aid']; } ?></td>
              </tr>
<?php
$i++;
} //end while
$total_pt = $total_on_pt + $total_in_pt + $total_move_pt - $total_paid_pt; //รวมคงเหลือ PT
$total_nb = $total_on_nb + $total_in_nb + $total_move_nb - $total_paid_nb; //รวมคงเหลือ NB
$total_patient_day_pt = $total_pt + $total_ad_pt; //รวม Patient Day PT
$total_patient_day_nb = $total_nb + $total_ad_nb; //รวม Patient Day NB
if ($amount_bed != "") {
	$total_bed_rate = ($total_patient_day_pt * 100) / $amount_bed; //รวมอัตราการครองเตียง
	$total_bed_paid_avg = $total_paid_pt / $amount_bed; //รวมผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง
}
if ($total_paid_pt != "") {
	$total_bed_free = ($amount_bed - $total_patient_day_pt) / $total_paid_pt; //รวมช่วงเวลาว่างของเตียง
}
?>
              <tr>
                <td height="25" colspan="2" align="center" bgcolor="#CCCCCC">รวม</td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_on_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_on_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_in_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_in_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_home_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_home_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_b_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_b_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_send_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_send_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_dead_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_dead_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_non_voluntary_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_non_voluntary_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_paid_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_paid_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_ad_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_ad_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_nb; ?></td>
                <td align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type5; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type4; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type3; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type2; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type1; ?></td>
                <td align="center" bgcolor="#CCCCCC"><?php echo number_format(($total_on_pt + $total_in_pt + $total_move_pt), 0); ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $amount_bed; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_pt; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_nb; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_rate, 2); ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_free, 2); ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_paid_avg, 2); ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_hn; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_rn; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_tn; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_pn; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_aid; ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left">รวมให้การพยาบาล = (คงพยาบาล + รับใหม่ + รับย้าย) PT</td>
          </tr>
          <tr>
            <td align="left"><table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20" height="25" align="left" bgcolor="#00CC66">&nbsp;</td>
                <td width="11" height="25" align="left">&nbsp;</td>
                <td width="469" height="25" align="left">ยืนยันข้อมูลแล้ว</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="left" bgcolor="#FFA4A4">&nbsp;</td>
                <td height="25" align="left">&nbsp;</td>
                <td height="25" align="left">ยังไม่ยืนยัน</td>
              </tr>
            </table></td>
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