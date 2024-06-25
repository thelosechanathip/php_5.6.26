<?php
include "sess_uin.php";
$p = "reportmonth";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานประจำเดือน</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
<style type="text/css">
.containBody{
	height: 600px;
	display: block;
	overflow: auto;	
	border-bottom: 1px solid #CCC;
}
.tbl_headerFix{
	border-bottom: 0px;	
}
</style>
</head>

<body>
<?php
$month1 = $_POST['month1'];
if ($month1 == "") {
	$month1 = date("m");
}
$ynow = date("Y") + 543;
$year1 = $_POST['year1'];
if ($year1 == "") {
	$year1 = $ynow;
}
$year2 = $year1 - 543;
$i_status = $_POST['i_status'];
if ($i_status == "") {
	$i_status = "all";
}
include "myarray.php";
include "myclass.php";
$ward = $_SESSION["sess_ward"];
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">รายงานประจำเดือน</td>
          </tr
          ><tr>
            <td height="25" align="left"><table width="800" border="0" cellspacing="0" cellpadding="0">
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
                <td height="25" align="left"><select name="ward" id="ward">
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
                <td height="25" align="left">&nbsp;</td>
                </tr>
<?php //} //end admin ?>
              <tr>
                <td width="93" height="25" align="left">ประจำเดือน</td>
                <td width="233" height="25" align="left">
<select name="month1" id="month1">
  <?php
			foreach($month_r as $key => $val) {
				if ($month1 == $key) {
					echo "<option value='$key' selected>$val</option>";
				} else {
					echo "<option value='$key'>$val</option>";
				}
			}
			?>
</select>
&nbsp;ปี พ.ศ.&nbsp;
<select name="year1" id="year1">
  <?php
			for ($i = $ynow; $i >= 2553; $i--) {
				if ($year1 == $i) {
					echo "<option value='$i' selected>$i</option>";
				} else {
					echo "<option value='$i'>$i</option>";
				}
			}
			?>
</select></td>
                <td width="474" height="25" align="left">&nbsp;</td>
                </tr>
              <tr>
                <td height="25" align="left">ตัวเลือกข้อมูล</td>
                <td height="25" align="left"><label><input name="i_status" type="radio" id="radio" value="all" <?php if ($i_status == "all") { echo "checked=\"checked\""; } ?> />ทั้งหมด</label><label><input name="i_status" type="radio" id="radio" value="1" <?php if ($i_status == "1") { echo "checked=\"checked\""; } ?> />ยืนยันแล้ว</label><label><input name="i_status" type="radio" id="radio" value="0" <?php if ($i_status == "0") { echo "checked=\"checked\""; } ?> />ยังไม่ยืนยัน</label></td>
                <td height="25" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
              </tr>
</form>
            </table></td>
          </tr>
<?php
$sqlw = "SELECT name FROM ward WHERE ward = '$ward'";
$resultw = $conn->query($sqlw);
$rw = $resultw->fetch_array();
?>
          <tr>
            <td height="25" align="left"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/report_month_r.php?ward=<?php echo $ward; ?>&month1=<?php echo $month1; ?>&year1=<?php echo $year1; ?>&i_status=<?php echo $i_status; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/report_month_r.php?ward=<?php echo $ward; ?>&month1=<?php echo $month1; ?>&year1=<?php echo $year1; ?>&i_status=<?php echo $i_status; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
          <tr>
            <td align="left">INPATIENT CENSUS AND INPATIENT SERVICE DAYS ประจำเดือน <?php echo $month_r[$month1]; ?> พ.ศ. <?php echo $year1; ?>&nbsp;<?php echo $rw[0]; ?></td>
          </tr>
          <?php if ($kk == 1) { ?>
          <tr>
            <td align="left"><table width="2000" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="28" rowspan="3" align="center" bgcolor="#CCFFE6">วันที่</td>
                <td width="26" rowspan="3" align="center" bgcolor="#B9FFFF">เวร</td>
                <td colspan="2" align="center" bgcolor="#FFE1D2">คงพยาบาล</td>
                <td colspan="4" align="center" bgcolor="#CCFFE6">การรับ</td>
                <td height="25" colspan="10" align="center" bgcolor="#B9FFFF">จำหน่าย</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">รวมจำหน่าย</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2">คงเหลือ</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">A&amp;D<br />
                  Same day</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2">Patient Day</td>
                <td colspan="5" rowspan="2" align="center" bgcolor="#FFE1D2">ประเภทผู้ป่วย</td>
                <td width="69" rowspan="3" align="center" bgcolor="#B9FFFF">รวมให้<br />
                  การพยาบาล</td>
                <td width="50" rowspan="3" align="center" bgcolor="#B9FFFF">จำนวน<br />
                  เตียง</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">เฉลี่ยนอนรพ.<br />
                  (คน)</td>
                <td width="70" rowspan="3" align="center" bgcolor="#FFE1D2">อัตราการ<br />
                  ครองเตียง</td>
                <td width="153" rowspan="3" align="center" bgcolor="#B9FFFF">turnover interval (T)<br />
                  ช่วงเวลาว่างของเตียง (วัน)</td>
                <td width="148" rowspan="3" align="center" bgcolor="#FFE1D2">Bed Turnover Rate (B)<br />
                  ผู้ป่วยจำหน่าย<br />
                  เฉลี่ยต่อเตียง(คน)</td>
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
                <td width="32" height="25" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="32" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="32" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="32"  align="center" bgcolor="#CCFFE6">NB</td>
                <td width="31" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="32" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="32" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="32" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="32" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="32" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="32" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="32" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="29" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="29" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="36" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="35" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="40" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="40" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="40" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="40" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="40" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="40" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="40" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="40" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="40" align="center" bgcolor="#FFE1D2">วิกฤต</td>
                <td width="46" align="center" bgcolor="#FFE1D2">4</td>
                <td width="47" align="center" bgcolor="#FFE1D2">3</td>
                <td width="46" align="center" bgcolor="#FFE1D2">2</td>
                <td width="46" align="center" bgcolor="#FFE1D2">1</td>
                <td width="48" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="48" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="40" align="center" bgcolor="#FFFF00">HN</td>
                <td width="40" align="center" bgcolor="#FFFF00">RN</td>
                <td width="40" align="center" bgcolor="#FFFF00">TN</td>
                <td width="40" align="center" bgcolor="#FFFF00">PN</td>
                <td width="55" align="center" bgcolor="#FFFF00">AID</td>
              </tr>
              <tr>
                <td height="25" colspan="43" align="left">
                <div class="containBody">
                  <table class="tbl_headerFix" width="1996" border="1" cellspacing="0" cellpadding="0">
<?php
//หาวันที่
$sqld = "SELECT DISTINCT idate AS day1 FROM data_all WHERE MID(data_all.idate, 1, 4) = '$year2' AND MID(data_all.idate, 6, 2) = '$month1' AND data_all.ward = '$ward'";
if ($i_status != "all") {
	$sqld .= " AND data_all.i_status = '$i_status'";
}
$sqld .= " ORDER BY day1";
$resultd = $conn->query($sqld);
$num_day = $resultd->num_rows; //จำนวนวันที่กรอกข้อมูลในเดือนที่เลือก
while ($rd = $resultd->fetch_array()) { //วนรอบ รอบแรก วันที่
	$date1 = substr($rd['day1'], 8, 2);
	if (substr($date1, 0, 1) == "0") {
		$date1 = substr($date1, 1, 1);
	}
	$sql = "SELECT data_all.wage_type_id, data_all.on_pt, data_all.on_nb, wage_type.wage_type_names, data_all.in_pt, data_all.in_nb, data_all.move_pt, data_all.move_nb, data_all.home_pt, data_all.home_nb, data_all.move_b_pt, data_all.move_b_nb, data_all.send_pt, data_all.send_nb, data_all.dead_pt, data_all.dead_nb, data_all.non_voluntary_pt, data_all.non_voluntary_nb, data_all.ad_pt, data_all.ad_nb, data_all.patient_type5, data_all.patient_type4, data_all.patient_type3, data_all.patient_type2, data_all.patient_type1, data_all.amount_bed, data_all.em_hn, data_all.em_rn, data_all.em_tn, data_all.em_pn, data_all.em_aid, data_all.i_status FROM data_all LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id WHERE data_all.idate = '$rd[day1]' AND data_all.ward = '$ward' ORDER BY data_all.idate, data_all.wage_type_id";
	if ($i_status != "all") {
		$sql .= " AND data_all.i_status = '$i_status'";
	}
$result = $conn->query($sql);
	//ตัวแปรเริ่มต้น
	$i = 1;
	$total_in_pt = 0; //รวมรับใหม่ PT แต่ละวัน
	$total_in_nb = 0; //รวมรับใหม่ NB แต่ละวัน
	$total_move_pt = 0; //รวมรับย้าย PT แต่ละวัน
	$total_move_nb = 0; //รวมรับย้าย NB แต่ละวัน
	$total_home_pt = 0; //รวมกลับบ้าน PT แต่ละวัน
	$total_home_nb = 0; //รวมกลับบ้าน NB แต่ละวัน
	$total_move_b_pt = 0; //รวมย้ายตึก PT แต่ละวัน
	$total_move_b_nb = 0; //รวมย้ายตึก NB แต่ละวัน
	$total_send_pt = 0; //รวมส่งต่อ PT แต่ละวัน
	$total_send_nb = 0; //รวมส่งต่อ NB แต่ละวัน
	$total_dead_pt = 0; //รวมตาย PT แต่ละวัน
	$total_dead_nb = 0; //รวมตาย NB แต่ละวัน
	$total_non_voluntary_pt = 0; //รวมไม่สมัครใจอยู่ PT แต่ละวัน
	$total_non_voluntary_nb = 0; //รวมไม่สมัครใจอยู่ NB แต่ละวัน
	$total_paid_pt = 0; //รวมจำหน่าย PT แต่ละวัน
	$total_paid_nb = 0; //รวมจำหน่าย NB แต่ละวัน
	$total_ad_pt = 0; //รวม ad PT แต่ละวัน
	$total_ad_nb = 0; //รวม ad NB แต่ละวัน
	$total_patient_type5 = 0; //รวม patient_type5 แต่ละวัน
	$total_patient_type4 = 0; //รวม patient_type4 แต่ละวัน
	$total_patient_type3 = 0; //รวม patient_type3 แต่ละวัน
	$total_patient_type2 = 0; //รวม patient_type2 แต่ละวัน
	$total_patient_type1 = 0; //รวม patient_type1 แต่ละวัน
	$total_em_hn = 0; //รวม จนท. HN แต่ละวัน
	$total_em_rn = 0; //รวม จนท. RN แต่ละวัน
	$total_em_tn = 0; //รวม จนท. TN แต่ละวัน
	$total_em_pn = 0; //รวม จนท. PN แต่ละวัน
	$total_em_aid = 0; //รวม จนท. AID แต่ละวัน
	while ($r = $result->fetch_array()) {
		$total_sub_paid_pt = $r['home_pt'] + $r['move_b_pt'] + $r['send_pt'] + $r['dead_pt'] + $r['non_voluntary_pt']; //รวมจำหน่าย PT รายแถว
		$total_sub_paid_nb = $r['home_nb'] + $r['move_b_nb'] + $r['send_nb'] + $r['dead_nb'] + $r['non_voluntary_nb']; //รวมจำหน่าย NB รายแถว
		$result_pt = $r['on_pt'] + $r['in_pt'] + $r['move_pt'] - $total_sub_paid_pt; //คงเหลือ PT
		$result_nb = $r['on_nb'] + $r['in_nb'] + $r['move_nb'] - $total_sub_paid_nb; //คงเหลือ NB
		$patient_day_pt = $result_pt + $r['ad_pt']; //patient_day_pt
		$patient_day_nb = $result_nb + $r['ad_nb']; //patient_day_nb
		if ($r['amount_bed'] != 0) {
			$bed_rate = ($result_pt * 100) / $r['amount_bed'];//อัตราการครองเตียง
			$bed_paid_avg = $total_sub_paid_pt / $r['amount_bed']; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
		}
		if ($total_sub_paid_pt != 0) {
			$bed_free = ($r['amount_bed'] - $patient_day_pt) / $total_sub_paid_pt; //ช่วงเวลาว่างของเตียง
		}
		//ผลรวม
		if ($i == 1) {
			$total_on_pt = $r['on_pt']; //รวมคงพยาบาล PT แต่ละวัน
			$total_on_nb = $r['on_nb']; //รวมคงพยาบาล NB แต่ละวัน
		}
		if ($r['wage_type_id'] == "1") { //ถ้าเป็นเวรดึก
			$total_on_pt1_m += $r['on_pt']; //รวมคงพยาบาลเวรดึก PT ทั้งเดือน
			$total_on_nb1_m += $r['on_nb']; //รวมคงพยาบาลเวรดึก NB ทั้งเดือน
			$total_in_pt1_m += $r['in_pt']; //รวมรับใหม่ PT ทั้งเดือน
			$total_in_nb1_m += $r['in_nb']; //รวมรับใหม่ NB ทั้งเดือน
			$total_move_pt1_m += $r['move_pt']; //รวมรับย้าย PT ทั้งเดือน
			$total_move_nb1_m += $r['move_nb']; //รวมรับย้าย NB ทั้งเดือน
			$total_home_pt1_m += $r['home_pt']; //รวมกลับบ้าน PT ทั้งเดือน
			$total_home_nb1_m += $r['home_nb']; //รวมกลับบ้าน NB ทั้งเดือน
			$total_move_b_pt1_m += $r['move_b_pt']; //รวมย้ายตึก PT ทั้งเดือน
			$total_move_b_nb1_m += $r['move_b_nb']; //รวมย้ายตึก NB ทั้งเดือน
			$total_send_pt1_m += $r['send_pt']; //รวมส่งต่อ PT ทั้งเดือน
			$total_send_nb1_m += $r['send_nb']; //รวมส่งต่อ NB ทั้งเดือน
			$total_dead_pt1_m += $r['dead_pt']; //รวมตาย PT ทั้งเดือน
			$total_dead_nb1_m += $r['dead_nb']; //รวมตาย NB ทั้งเดือน
			$total_non_voluntary_pt1_m += $r['non_voluntary_pt']; //รวมไม่สมัครใจอยู่ PT ทั้งเดือน
			$total_non_voluntary_nb1_m += $r['non_voluntary_nb']; //รวมไม่สมัครใจอยู่ NB ทั้งเดือน
			$total_ad_pt1_m += $r['ad_pt']; //รวม AD PT ทั้งเดือน
			$total_ad_nb1_m += $r['ad_nb']; //รวม AD NB ทั้งเดือน
			$total_patient_type51_m += $r['patient_type5']; //รวม type5 ทั้งเดือน
			$total_patient_type41_m += $r['patient_type4']; //รวม type4 ทั้งเดือน
			$total_patient_type31_m += $r['patient_type3']; //รวม type3 ทั้งเดือน
			$total_patient_type21_m += $r['patient_type2']; //รวม type2 ทั้งเดือน
			$total_patient_type11_m += $r['patient_type1']; //รวม type1 ทั้งเดือน
			$total_em_hn1_m += $r['em_hn']; //รวมจนท. HN ทั้งเดือน
			$total_em_rn1_m += $r['em_rn']; //รวมจนท. RN ทั้งเดือน
			$total_em_tn1_m += $r['em_tn']; //รวมจนท. TN ทั้งเดือน
			$total_em_pn1_m += $r['em_pn']; //รวมจนท. PN ทั้งเดือน
			$total_em_aid1_m += $r['em_aid']; //รวมจนท. AID ทั้งเดือน
		}
		if ($r['wage_type_id'] == "2") { //ถ้าเป็นเวรเช้า
			$total_on_pt2_m += $r['on_pt']; //รวมคงพยาบาลเวรดึก PT ทั้งเดือน
			$total_on_nb2_m += $r['on_nb']; //รวมคงพยาบาลเวรดึก NB ทั้งเดือน
			$total_in_pt2_m += $r['in_pt']; //รวมรับใหม่ PT ทั้งเดือน
			$total_in_nb2_m += $r['in_nb']; //รวมรับใหม่ NB ทั้งเดือน
			$total_move_pt2_m += $r['move_pt']; //รวมรับย้าย PT ทั้งเดือน
			$total_move_nb2_m += $r['move_nb']; //รวมรับย้าย NB ทั้งเดือน
			$total_home_pt2_m += $r['home_pt']; //รวมกลับบ้าน PT ทั้งเดือน
			$total_home_nb2_m += $r['home_nb']; //รวมกลับบ้าน NB ทั้งเดือน
			$total_move_b_pt2_m += $r['move_b_pt']; //รวมย้ายตึก PT ทั้งเดือน
			$total_move_b_nb2_m += $r['move_b_nb']; //รวมย้ายตึก NB ทั้งเดือน
			$total_send_pt2_m += $r['send_pt']; //รวมส่งต่อ PT ทั้งเดือน
			$total_send_nb2_m += $r['send_nb']; //รวมส่งต่อ NB ทั้งเดือน
			$total_dead_pt2_m += $r['dead_pt']; //รวมตาย PT ทั้งเดือน
			$total_dead_nb2_m += $r['dead_nb']; //รวมตาย NB ทั้งเดือน
			$total_non_voluntary_pt2_m += $r['non_voluntary_pt']; //รวมไม่สมัครใจอยู่ PT ทั้งเดือน
			$total_non_voluntary_nb2_m += $r['non_voluntary_nb']; //รวมไม่สมัครใจอยู่ NB ทั้งเดือน
			$total_ad_pt2_m += $r['ad_pt']; //รวม AD PT ทั้งเดือน
			$total_ad_nb2_m += $r['ad_nb']; //รวม AD NB ทั้งเดือน
			$total_patient_type52_m += $r['patient_type5']; //รวม type5 ทั้งเดือน
			$total_patient_type42_m += $r['patient_type4']; //รวม type4 ทั้งเดือน
			$total_patient_type32_m += $r['patient_type3']; //รวม type3 ทั้งเดือน
			$total_patient_type22_m += $r['patient_type2']; //รวม type2 ทั้งเดือน
			$total_patient_type12_m += $r['patient_type1']; //รวม type1 ทั้งเดือน
			$total_em_hn2_m += $r['em_hn']; //รวมจนท. HN ทั้งเดือน
			$total_em_rn2_m += $r['em_rn']; //รวมจนท. RN ทั้งเดือน
			$total_em_tn2_m += $r['em_tn']; //รวมจนท. TN ทั้งเดือน
			$total_em_pn2_m += $r['em_pn']; //รวมจนท. PN ทั้งเดือน
			$total_em_aid2_m += $r['em_aid']; //รวมจนท. AID ทั้งเดือน
		}
		if ($r['wage_type_id'] == "3") { //ถ้าเป็นเวรบ่าย
			$total_on_pt3_m += $r['on_pt']; //รวมคงพยาบาลเวรดึก PT ทั้งเดือน
			$total_on_nb3_m += $r['on_nb']; //รวมคงพยาบาลเวรดึก NB ทั้งเดือน
			$total_in_pt3_m += $r['in_pt']; //รวมรับใหม่ PT ทั้งเดือน
			$total_in_nb3_m += $r['in_nb']; //รวมรับใหม่ NB ทั้งเดือน
			$total_move_pt3_m += $r['move_pt']; //รวมรับย้าย PT ทั้งเดือน
			$total_move_nb3_m += $r['move_nb']; //รวมรับย้าย NB ทั้งเดือน
			$total_home_pt3_m += $r['home_pt']; //รวมกลับบ้าน PT ทั้งเดือน
			$total_home_nb3_m += $r['home_nb']; //รวมกลับบ้าน NB ทั้งเดือน
			$total_move_b_pt3_m += $r['move_b_pt']; //รวมย้ายตึก PT ทั้งเดือน
			$total_move_b_nb3_m += $r['move_b_nb']; //รวมย้ายตึก NB ทั้งเดือน
			$total_send_pt3_m += $r['send_pt']; //รวมส่งต่อ PT ทั้งเดือน
			$total_send_nb3_m += $r['send_nb']; //รวมส่งต่อ NB ทั้งเดือน
			$total_dead_pt3_m += $r['dead_pt']; //รวมตาย PT ทั้งเดือน
			$total_dead_nb3_m += $r['dead_nb']; //รวมตาย NB ทั้งเดือน
			$total_non_voluntary_pt3_m += $r['non_voluntary_pt']; //รวมไม่สมัครใจอยู่ PT ทั้งเดือน
			$total_non_voluntary_nb3_m += $r['non_voluntary_nb']; //รวมไม่สมัครใจอยู่ NB ทั้งเดือน
			$total_ad_pt3_m += $r['ad_pt']; //รวม AD PT ทั้งเดือน
			$total_ad_nb3_m += $r['ad_nb']; //รวม AD NB ทั้งเดือน
			$total_patient_type53_m += $r['patient_type5']; //รวม type5 ทั้งเดือน
			$total_patient_type43_m += $r['patient_type4']; //รวม type4 ทั้งเดือน
			$total_patient_type33_m += $r['patient_type3']; //รวม type3 ทั้งเดือน
			$total_patient_type23_m += $r['patient_type2']; //รวม type2 ทั้งเดือน
			$total_patient_type13_m += $r['patient_type1']; //รวม type1 ทั้งเดือน
			$total_em_hn3_m += $r['em_hn']; //รวมจนท. HN ทั้งเดือน
			$total_em_rn3_m += $r['em_rn']; //รวมจนท. RN ทั้งเดือน
			$total_em_tn3_m += $r['em_tn']; //รวมจนท. TN ทั้งเดือน
			$total_em_pn3_m += $r['em_pn']; //รวมจนท. PN ทั้งเดือน
			$total_em_aid3_m += $r['em_aid']; //รวมจนท. AID ทั้งเดือน
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
		$total_paid_nb += $total-sub_paid_nb; //รวมจำหน่าย NB
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
			$bgc = "#00FF33";
		} else {
			$bgc = "#FFA4A4";
		}
?>
                    <tr bgcolor="<?php echo $bgc; ?>">
                      <td width="26" height="25" align="center"><?php echo $date1; ?></td>
                      <td width="26" height="25" align="center"><?php echo $r['wage_type_names']; ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['on_pt'] != "0") { echo $r['on_pt']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['on_nb'] != "0") { echo $r['on_nb']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['in_pt'] != "0") { echo $r['in_pt']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['in_nb'] != "0") { echo $r['in_nb']; } ?></td>
                      <td width="31" height="25" align="center"><?php if ($r['move_pt'] != "0") { echo $r['move_pt']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['move_nb'] != "0") { echo $r['move_nb']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['home_pt'] != "0") { echo $r['home_pt']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['home_nb'] != "0") { echo $r['home_nb']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['move_b_pt'] != "0") { echo $r['move_b_pt']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['move_b_nb'] != "0") { echo $r['move_b_nb']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['send_pt'] != "0") { echo $r['send_pt']; } ?></td>
                      <td width="32" height="25" align="center"><?php if ($r['send_nb'] != "0") { echo $r['send_nb']; } ?></td>
                      <td width="29" height="25" align="center"><?php if ($r['dead_pt'] != "0") { echo $r['dead_pt']; } ?></td>
                      <td width="29" height="25" align="center"><?php if ($r['dead_nb'] != "0") { echo $r['dead_nb']; } ?></td>
                      <td width="36" height="25" align="center"><?php if ($r['non_voluntary_pt'] != "0") { echo $r['non_voluntary_pt']; } ?></td>
                      <td width="35" height="25" align="center"><?php if ($r['non_voluntary_nb'] != "0") { echo $r['non_voluntary_nb']; } ?></td>
                      <td width="40" height="25" align="center"><?php echo $total_sub_paid_pt; ?></td>
                      <td width="40" height="25" align="center"><?php echo $total_sub_paid_nb; ?></td>
                      <td width="40" height="25" align="center"><?php echo $result_pt; ?></td>
                      <td width="40" height="25" align="center"><?php echo $result_nb; ?></td>
                      <td width="40" height="25" align="center"><?php if ($r['ad_pt'] != "0") { echo $r['ad_pt']; } ?></td>
                      <td width="40" height="25" align="center"><?php if ($r['ad_nb'] != "0") { echo $r['ad_nb']; } ?></td>
                      <td width="40" height="25" align="center"><?php echo $patient_day_pt; ?></td>
                      <td width="40" height="25" align="center"><?php echo $patient_day_nb; ?></td>
                      <td width="40" height="25" align="center"><?php if ($r['patient_type5'] != "0") { echo $r['patient_type5']; } ?></td>
                      <td width="46" height="25" align="center"><?php if ($r['patient_type4'] != "0") { echo $r['patient_type4']; } ?></td>
                      <td width="47" height="25" align="center"><?php if ($r['patient_type3'] != "0") { echo $r['patient_type3']; } ?></td>
                      <td width="46" height="25" align="center"><?php if ($r['patient_type2'] != "0") { echo $r['patient_type2']; } ?></td>
                      <td width="46" height="25" align="center"><?php if ($r['patient_type1'] != "0") { echo $r['patient_type1']; } ?></td>
                      <td width="69" height="25" align="center"><?php echo number_format(($r['on_pt']+ $r['in_pt'] + $r['move_pt']), 0); ?></td>
                      <td width="50" height="25" align="center"><?php if ($r['amount_bed'] != "0") { echo $r['amount_bed']; } ?></td>
                      <td width="48" height="25" align="center"><?php echo $patient_day_pt; ?></td>
                      <td width="48" height="25" align="center"><?php echo $patient_day_nb; ?></td>
                      <td width="70" height="25" align="center"><?php echo number_format($bed_rate, 2); ?></td>
                      <td width="153" height="25" align="center"><?php echo number_format($bed_free, 2); ?></td>
                      <td width="148" height="25" align="center"><?php echo number_format($bed_paid_avg, 2); ?></td>
                      <td width="40" height="25" align="center"><?php if ($r['em_hn'] != "0") { echo $r['em_hn']; } ?></td>
                      <td width="40" height="25" align="center"><?php if ($r['em_rn'] != "0") { echo $r['em_rn']; } ?></td>
                      <td width="40" height="25" align="center"><?php if ($r['em_tn'] != "0") { echo $r['em_tn']; } ?></td>
                      <td width="40" height="25" align="center"><?php if ($r['em_pn'] != "0") { echo $r['em_pn']; } ?></td>
                      <td width="53" height="25" align="left"><?php if ($r['em_aid'] != "0") { echo $r['em_aid']; } ?></td>
                    </tr>
<?php
$i++;
} //end while แต่ละวัน
$total_pt = $total_on_pt + $total_in_pt + $total_move_pt - $total_paid_pt; //รวมคงเหลือ PT
$total_nb = $total_on_nb + $total_in_nb + $total_move_nb - $total_paid_nb; //รวมคงเหลือ NB
$total_patient_day_pt = $total_pt + $total_ad_pt; //รวม Patient Day PT
$total_patient_day_nb = $total_nb + $total_ad_nb; //รวม Patient Day NB
if ($amount_bed != 0) {
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
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type5; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type4; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type3; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type2; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type1; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format(($total_on_pt + $total_in_pt + $total_move_pt), 0); ?></td>
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
                      <td height="25" align="left" bgcolor="#CCCCCC"><?php echo $total_em_aid; ?></td>
                    </tr>
<?php
} // end while day
$total_paid_pt1_m = $total_home_pt1_m + $total_move_b_pt1_m + $total_send_pt1_m + $total_dead_pt1_m + $total_non_voluntary_pt1_m; //รวมจำหน่ายเวรดึก PT ทั้งเดือน
$total_paid_pt2_m = $total_home_pt2_m + $total_move_b_pt2_m + $total_send_pt2_m + $total_dead_pt2_m + $total_non_voluntary_pt2_m; //รวมจำหน่ายเวรเช้า PT ทั้งเดือน
$total_paid_pt3_m = $total_home_pt3_m + $total_move_b_pt3_m + $total_send_pt3_m + $total_dead_pt3_m + $total_non_voluntary_pt3_m; //รวมจำหน่ายเวรบ่าย PT ทั้งเดือน
$total_paid_nb1_m = $total_home_nb1_m + $total_move_b_nb1_m + $total_send_nb1_m + $total_dead_nb1_m + $total_non_voluntary_nb1_m; //รวมจำหน่ายเวรดึก NB ทั้งเดือน
$total_paid_nb2_m = $total_home_nb2_m + $total_move_b_nb2_m + $total_send_nb2_m + $total_dead_nb2_m + $total_non_voluntary_nb2_m; //รวมจำหน่ายเวรเช้า NB ทั้งเดือน
$total_paid_nb3_m = $total_home_nb3_m + $total_move_b_nb3_m + $total_send_nb3_m + $total_dead_nb3_m + $total_non_voluntary_nb3_m; //รวมจำหน่ายเวรบ่าย NB ทั้งเดือน
$total_pt1_m = ($total_on_pt1_m + $total_in_pt1_m + $total_move_pt1_m) - $total_paid_pt1_m; //คงเหลือเวรดึก PT ทั้งเดือน
$total_pt2_m = ($total_on_pt2_m + $total_in_pt2_m + $total_move_pt2_m) - $total_paid_pt2_m; //คงเหลือเวรเช้า PT ทั้งเดือน
$total_pt3_m = ($total_on_pt3_m + $total_in_pt3_m + $total_move_pt3_m) - $total_paid_pt3_m; //คงเหลือเวรบ่าย PT ทั้งเดือน
$total_nb1_m = ($total_on_nb1_m + $total_in_nb1_m + $total_move_nb1_m) - $total_paid_nb1_m; //คงเหลือเวรดึก NB ทั้งเดือน
$total_nb2_m = ($total_on_nb2_m + $total_in_nb2_m + $total_move_nb2_m) - $total_paid_nb2_m; //คงเหลือเวรเช้า NB ทั้งเดือน
$total_nb3_m = ($total_on_nb3_m + $total_in_nb3_m + $total_move_nb3_m) - $total_paid_nb3_m; //คงเหลือเวรบ่าย NB ทั้งเดือน
$total_patient_day_pt1_m = $total_pt1_m + $total_ad_pt1_m; //รวม Patient Day PT เวรดึกทั้งเดือน
$total_patient_day_pt2_m = $total_pt2_m + $total_ad_pt2_m; //รวม Patient Day PT เวรเช้าทั้งเดือน
$total_patient_day_pt3_m = $total_pt3_m + $total_ad_pt3_m; //รวม Patient Day PT เวรบ่ายทั้งเดือน
$total_patient_day_nb1_m = $total_nb1_m + $total_ad_nb1_m; //รวม Patient Day NB เวรดึกทั้งเดือน
$total_patient_day_nb2_m = $total_nb2_m + $total_ad_nb2_m; //รวม Patient Day NB เวรเช้าทั้งเดือน
$total_patient_day_nb3_m = $total_nb3_m + $total_ad_nb3_m; //รวม Patient Day NB เวรบ่ายทั้งเดือน
//$num_day = cal_days_in_month(CAL_GREGORIAN, $month1, $year2); //จำนวนวันในเดือน
//$num_day = 31;
if ($num_day > 0) {
	$sleep_avg_pt1_m = $total_patient_day_pt1_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรดึกทั้งเดือน
	$sleep_avg_pt2_m = $total_patient_day_pt2_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรเช้าทั้งเดือน
	$sleep_avg_pt3_m = $total_patient_day_pt3_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรบ่ายทั้งเดือน
	$sleep_avg_nb1_m = $total_patient_day_nb1_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรดึกทั้งเดือน
	$sleep_avg_nb2_m = $total_patient_day_nb2_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรเช้าทั้งเดือน
	$sleep_avg_nb3_m = $total_patient_day_nb3_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรบ่ายทั้งเดือน
}
if ($amount_bed != "") {
	$total_bed_rate1_m = ($sleep_avg_pt1_m * 100) / $amount_bed; //เฉลี่ยอัตราการครองเตียงเวรดึกทั้งเดือน
	$total_bed_rate2_m = ($sleep_avg_pt2_m * 100) / $amount_bed; //เฉลี่ยอัตราการครองเตียงเวรเช้าทั้งเดือน
	$total_bed_rate3_m = ($sleep_avg_pt3_m * 100) / $amount_bed; //เฉลี่ยอัตราการครองเตียงเวรบ่ายทั้งเดือน
	$total_bed_paid_avg1 = $total_paid_pt1_m / $amount_bed; //ผู้ป่วยเฉลี่ยต่อเตียงเวรดึกทั้งเดือน
	$total_bed_paid_avg2 = $total_paid_pt2_m / $amount_bed; //ผู้ป่วยเฉลี่ยต่อเตียงเวรเช้าทั้งเดือน
	$total_bed_paid_avg3 = $total_paid_pt3_m / $amount_bed; //ผู้ป่วยเฉลี่ยต่อเตียงเวรบ่ายทั้งเดือน
}
if ($total_paid_pt1_m != "0") {
	$total_bed_free1_m = (($amount_bed * $num_day) - $total_patient_day_pt1_m) / $total_paid_pt1_m; //ช่วงเวลาว่างของเตียงเวรดึกทั้งเดือน
}
if ($total_paid_pt2_m != "0") {
	$total_bed_free2_m = (($amount_bed * $num_day) - $total_patient_day_pt2_m) / $total_paid_pt2_m; //ช่วงเวลาว่างของเตียงเวรเช้าทั้งเดือน
}
if ($total_paid_pt3_m != "0") {
	$total_bed_free3_m = (($amount_bed * $num_day) - $total_patient_day_pt3_m) / $total_paid_pt3_m; //ช่วงเวลาว่างของเตียงเวรบ่ายทั้งเดือน
}
//รวมทั้งสิ้น
$total_in_pt_all = $total_in_pt1_m + $total_in_pt2_m + $total_in_pt3_m; //รวมรับใหม่ PT ทั้งหมด
$total_in_nb_all = $total_in_nb1_m + $total-in_nb2_m + $total_in_nb3_m; //รวมรับใหม่ NB ทั้งหมด
$total_move_pt_all = $total_move_pt1_m + $total_move_pt2_m + $total_move_pt3_m; //รวมรับย้าย PT ทั้งหมด
$total_move_nb_all = $total_move_nb1_m + $total_move_nb2_m + $total_move_nb3_m; //รวมรับย้าย NB ทั้งหมด
$total_home_pt_all = $total_home_pt1_m + $total_home_pt2_m + $total_home_pt3_m; //รวมกลับบ้าน PT ทั้งหมด
$total_home_nb_all = $total_home_nb1_m + $total_home_nb2_m + $total_home_nb3_m; //รวมกลับบ้าน NB ทั้งหมด
$total_move_b_pt_all = $total_move_b_pt1_m + $total_move_b_pt2_m + $total_move_b_pt3_m; //รวมย้ายตึก PT ทั้งหมด
$total_move_b_nb_all = $total_move_b_nb1_m + $total_move_b_nb2_m + $total_move_b_nb3_m; //รวมย้ายตึก NB ทั้งหมด
$total_send_pt_all = $total_send_pt1_m + $total_send_pt2_m + $total_send_pt3_m; //รวมส่งต่อ PT ทั้งหมด
$total_send_nb_all = $total_send_nb1_m + $total_send_nb2_m + $total_send_nb3_m; //รวมส่งต่อ NB ทั้งหมด
$total_dead_pt_all = $total_dead_pt1_m + $total_dead_pt2_m + $total_dead_pt3_m; //รวมตาย PT ทั้งหมด
$total_dead_nb_all = $total_dead_nb1_m + $total_dead_nb2_m + $total_dead_nb3_m; //รวมตาย NB ทั้งหมด
$total_non_voluntary_pt_all = $total_non_voluntary_pt1_m + $total_non_voluntary_pt2_m + $total_non_voluntary_pt3_m; //รวมไม่สมัครใจอยู่ PT ทั้งหมด
$total_non_voluntary_nb_all = $total_non_voluntary_nb1_m + $total_non_voluntary_nb2_m + $total_non_voluntary_nb3_m; //รวมไม่สมัครใจอยู่ NB ทั้งหมด
$total_paid_pt_all = $total_paid_pt1_m + $total_paid_pt2_m + $total_paid_pt3_m; //รวมจำหน่าย PT ทั้งหมด
$total_paid_nb_all = $total_paid_nb1_m + $total_paid_nb2_m + $total_paid_nb3_m; //รวมจำหน่าย NB ทั้งหมด
$total_pt_all = ($total_on_pt1_m + $total_in_pt_all + $total_move_pt_all) - $total_paid_pt_all; //คงเหลือ PT ทั้งหมด
$total_nb_all = ($total_on_nb1_m + $total_in_nb_all + $total_move_nb_all) - $total_paid_nb_all; //คงเหลือ NB ทั้งหมด
$total_ad_pt_all = $total_ad_pt1_m + $total_ad_pt2_m + $total_ad_pt3_m; //รวม AD PT ทั้งหมด
$total_ad_nb_all = $total_ad_nb1_m + $total_ad_nb2_m + $total_ad_nb3_m; //รวม AD NB ทั้งหมด
$total_patient_day_pt_all = $total_pt_all + $total_ad_pt_all; //รวม Patient Day PT ทั้งหมด
$total_patient_day_nb_all = $total_nb_all + $total_ad_nb_all; //รวม Patient Day NB ทั้งหมด
$total_patient_type5_all =  $total_patient_type51_m +  $total_patient_type52_m +  $total_patient_type53_m; //รวม type5 ทั้งหมด
$total_patient_type4_all =  $total_patient_type41_m +  $total_patient_type42_m +  $total_patient_type43_m; //รวม type4 ทั้งหมด
$total_patient_type3_all =  $total_patient_type31_m +  $total_patient_type32_m +  $total_patient_type33_m; //รวม type3 ทั้งหมด
$total_patient_type2_all =  $total_patient_type21_m +  $total_patient_type22_m +  $total_patient_type23_m; //รวม type2 ทั้งหมด
$total_patient_type1_all =  $total_patient_type11_m +  $total_patient_type12_m +  $total_patient_type13_m; //รวม type1 ทั้งหมด
if ($num_day > 0) {
	$sleep_avg_pt_all = $total_patient_day_pt_all / $num_day; //เฉลี่ยนอนรพ. PT ทั้งหมด
	$sleep_avg_nb_all = $total_patient_day_nb_all / $num_day; //เฉลี่ยนอนรพ. NB ทั้งหมด
}
if ($amount_bed != "") {
	$total_bed_rate_all = ($sleep_avg_pt_all * 100) / $amount_bed; //อัตราการครองเตียง PT ทั้งหมด
	$total_bed_paid_avg_all = $total_paid_pt_all / $amount_bed; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียงทั้งหมด
}
if ($total_paid_pt_all != "0") {
	$total_bed_free_all = (($amount_bed * $num_day) - $total_patient_day_pt_all) / $total_paid_pt_all; //รวมช่วงเวลาว่างของเตียงทั้งหมด
}
$total_em_hn_all = $total_em_hn1_m + $total_em_hn2_m + $total_em_hn3_m; //รวมจนท. HN ทั้งหมด
$total_em_rn_all = $total_em_rn1_m + $total_em_rn2_m + $total_em_rn3_m; //รวมจนท. RN ทั้งหมด
$total_em_tn_all = $total_em_tn1_m + $total_em_tn2_m + $total_em_tn3_m; //รวมจนท. TN ทั้งหมด
$total_em_pn_all = $total_em_pn1_m + $total_em_pn2_m + $total_em_pn3_m; //รวมจนท. PN ทั้งหมด
$total_em_aid_all = $total_em_aid1_m + $total_em_aid2_m + $total_em_aid3_m; //รวมจนท. AID ทั้งหมด
?>
                    <tr>
                      <td rowspan="3" align="center">รวม<br />
                        แต่<br />
                        ละ<br />
                        เวร</td>
                      <td height="25" align="center">ด</td>
                      <td height="25" align="center"><?php echo $total_on_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_on_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_in_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_in_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_home_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_home_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_b_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_b_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_send_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_send_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_dead_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_dead_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_non_voluntary_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_non_voluntary_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_paid_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_paid_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_ad_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_ad_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_day_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_day_nb1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type51_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type41_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type31_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type21_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type11_m; ?></td>
                      <td height="25" align="center"><?php echo number_format(($total_on_pt1_m + $total_in_pt1_m + $total_move_pt1_m), 0); ?></td>
                      <td height="25" align="center"><?php echo $amount_bed; ?></td>
                      <td height="25" align="center"><?php echo number_format($sleep_avg_pt1_m, 3); ?></td>
                      <td height="25" align="center"><?php echo number_format($sleep_avg_nb1_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_rate1_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_free1_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_paid_avg1, 2); ?></td>
                      <td height="25" align="center"><?php echo $total_em_hn1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_rn1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_tn1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_pn1_m; ?></td>
                      <td height="25" align="left"><?php echo $total_em_aid1_m; ?></td>
                    </tr>
                    <tr>
                      <td height="25" align="center">ช</td>
                      <td height="25" align="center"><?php echo $total_on_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_on_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_in_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_in_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_home_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_home_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_b_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_b_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_send_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_send_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_dead_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_dead_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_non_voluntary_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_non_voluntary_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_paid_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_paid_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_ad_pt2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_ad_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_day_pt1_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_day_nb2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type52_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type42_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type32_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type22_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type12_m; ?></td>
                      <td height="25" align="center"><?php echo number_format(($total_on_pt2_m + $total_in_pt2_m + $total_move_pt2_m), 0); ?></td>
                      <td height="25" align="center"><?php echo $amount_bed; ?></td>
                      <td height="25" align="center"><?php echo number_format($sleep_avg_pt2_m, 3); ?></td>
                      <td height="25" align="center"><?php echo number_format($sleep_avg_nb2_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_rate2_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_free2_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_paid_avg2, 2); ?></td>
                      <td height="25" align="center"><?php echo $total_em_hn2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_rn2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_tn2_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_pn2_m; ?></td>
                      <td height="25" align="left"><?php echo $total_em_aid2_m; ?></td>
                    </tr>
                    <tr>
                      <td height="25" align="center">บ</td>
                      <td height="25" align="center"><?php echo $total_on_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_on_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_in_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_in_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_home_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_home_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_b_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_move_b_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_send_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_send_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_dead_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_dead_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_non_voluntary_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_non_voluntary_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_paid_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_paid_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_ad_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_ad_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_day_pt3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_day_nb3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type53_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type43_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type33_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type23_m; ?></td>
                      <td height="25" align="center"><?php echo $total_patient_type13_m; ?></td>
                      <td height="25" align="center"><?php echo number_format(($total_on_pt3_m + $total_in_pt3_m + $total_move_pt3_m), 0); ?></td>
                      <td height="25" align="center"><?php echo $amount_bed; ?></td>
                      <td height="25" align="center"><?php echo number_format($sleep_avg_pt3_m, 3); ?></td>
                      <td height="25" align="center"><?php echo number_format($sleep_avg_nb3_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_rate3_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_free3_m, 2); ?></td>
                      <td height="25" align="center"><?php echo number_format($total_bed_paid_avg3, 2); ?></td>
                      <td height="25" align="center"><?php echo $total_em_hn3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_rn3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_tn3_m; ?></td>
                      <td height="25" align="center"><?php echo $total_em_pn3_m; ?></td>
                      <td height="25" align="left"><?php echo $total_em_aid3_m; ?></td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2" align="center" bgcolor="#CCCCCC">รวม</td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_on_pt1_m; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_on_nb1_m; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_in_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_in_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_home_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_home_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_b_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_b_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_send_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total-send_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_dead_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total-dead_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_non_voluntary_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_non_voluntary_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_paid_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_paid_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_ad_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_ad_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_pt_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_nb_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type5_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type4_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type3_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type2_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type1_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format(($total_on_pt1_m + $total_in_pt_all + $total_move_pt_all), 0); ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $amount_bed; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($sleep_avg_pt_all, 3); ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($sleep_avg_nb_all, 2); ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_rate_all, 2); ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_free_all, 2); ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_paid_avg_all, 2); ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_hn_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_rn_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_tn_all; ?></td>
                      <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_pn_all; ?></td>
                      <td height="25" align="left" bgcolor="#CCCCCC"><?php echo $total_em_aid_all; ?></td>
                    </tr>
                  </table>
                  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                </div>
                </td>
                </tr>
			</table></td>
          </tr>
          <?php } //end kk ?>
          
         <?php //if ($kk == "1") { ?> 
          <tr>
            <td align="left"><table width="1643" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="25" rowspan="3" align="center" bgcolor="#CCFFE6">วันที่</td>
                <td width="24" rowspan="3" align="center" bgcolor="#B9FFFF">เวร</td>
                <td colspan="2" align="center" bgcolor="#FFE1D2">คงพยาบาล</td>
                <td colspan="4" align="center" bgcolor="#CCFFE6">การรับ</td>
                <td height="25" colspan="10" align="center" bgcolor="#B9FFFF">จำหน่าย</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">รวมจำหน่าย</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2">คงเหลือ</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">A&amp;D<br />
                  Same day</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2">Patient Day</td>
                <td colspan="5" rowspan="2" align="center" bgcolor="#FFE1D2">ประเภทผู้ป่วย</td>
                <td width="60" rowspan="3" align="center" bgcolor="#B9FFFF">รวมให้<br />
                  การพยาบาล</td>
                <td width="35" rowspan="3" align="center" bgcolor="#B9FFFF">จำนวน<br />
                  เตียง</td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6">เฉลี่ยนอนรพ.<br />
                  (คน)</td>
                <td width="58" rowspan="3" align="center" bgcolor="#FFE1D2">อัตราการ<br />
                  ครองเตียง</td>
                <td width="154" rowspan="3" align="center" bgcolor="#B9FFFF">turnover interval (T)<br />
                  ช่วงเวลาว่างของเตียง (วัน)</td>
                <td width="175" rowspan="3" align="center" bgcolor="#FFE1D2">Bed Turnover Rate (B)<br />
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
                <td width="29" height="25" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="29" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="26" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="26"  align="center" bgcolor="#CCFFE6">NB</td>
                <td width="26" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="26" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="27" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="27" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="26" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="26" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="26" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="26" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="26" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="26" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="36" align="center" bgcolor="#B9FFFF">PT</td>
                <td width="36" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="34" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="34" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="24" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="24" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="30" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="30" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="35" align="center" bgcolor="#FFE1D2">PT</td>
                <td width="32" align="center" bgcolor="#FFE1D2">NB</td>
                <td width="24" align="center" bgcolor="#FFE1D2">วิกฤต</td>
                <td width="24" align="center" bgcolor="#FFE1D2">4</td>
                <td width="24" align="center" bgcolor="#FFE1D2">3</td>
                <td width="25" align="center" bgcolor="#FFE1D2">2</td>
                <td width="24" align="center" bgcolor="#FFE1D2">1</td>
                <td width="39" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="39" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="24" align="center" bgcolor="#FFFF00">HN</td>
                <td width="24" align="center" bgcolor="#FFFF00">RN</td>
                <td width="24" align="center" bgcolor="#FFFF00">TN</td>
                <td width="24" align="center" bgcolor="#FFFF00">PN</td>
                <td width="42" align="center" bgcolor="#FFFF00">AID</td>
              </tr>
<?php
//หาวันที่
$sqld = "SELECT DISTINCT idate AS day1 FROM data_all WHERE MID(data_all.idate, 1, 4) = '$year2' AND MID(data_all.idate, 6, 2) = '$month1' AND data_all.ward = '$ward'";
if ($i_status != "all") {
	$sqld .= " AND data_all.i_status = '$i_status'";
}
$sqld .= " ORDER BY day1";
$resultd = $conn->query($sqld);
$num_day = $resultd->num_rows; //จำนวนวันที่กรอกข้อมูลในเดือนที่เลือก
while ($rd = $resultd->fetch_array()) { //วนรอบ รอบแรก วันที่
	$date1 = substr($rd['day1'], 8, 2);
	if (substr($date1, 0, 1) == "0") {
		$date1 = substr($date1, 1, 1);
	}
	$sql = "SELECT data_all.wage_type_id, data_all.on_pt, data_all.on_nb, wage_type.wage_type_names, data_all.in_pt, data_all.in_nb, data_all.move_pt, data_all.move_nb, data_all.home_pt, data_all.home_nb, data_all.move_b_pt, data_all.move_b_nb, data_all.send_pt, data_all.send_nb, data_all.dead_pt, data_all.dead_nb, data_all.non_voluntary_pt, data_all.non_voluntary_nb, data_all.ad_pt, data_all.ad_nb, data_all.patient_type5, data_all.patient_type4, data_all.patient_type3, data_all.patient_type2, data_all.patient_type1, data_all.amount_bed, data_all.em_hn, data_all.em_rn, data_all.em_tn, data_all.em_pn, data_all.em_aid, data_all.i_status FROM data_all LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id WHERE data_all.idate = '$rd[day1]' AND data_all.ward = '$ward' ORDER BY data_all.idate, data_all.wage_type_id";
	if ($i_status != "all") {
		$sql .= " AND data_all.i_status = '$i_status'";
	}
$result = $conn->query($sql);
	//ตัวแปรเริ่มต้น
	$i = 1;
	$total_in_pt = 0; //รวมรับใหม่ PT แต่ละวัน
	$total_in_nb = 0; //รวมรับใหม่ NB แต่ละวัน
	$total_move_pt = 0; //รวมรับย้าย PT แต่ละวัน
	$total_move_nb = 0; //รวมรับย้าย NB แต่ละวัน
	$total_home_pt = 0; //รวมกลับบ้าน PT แต่ละวัน
	$total_home_nb = 0; //รวมกลับบ้าน NB แต่ละวัน
	$total_move_b_pt = 0; //รวมย้ายตึก PT แต่ละวัน
	$total_move_b_nb = 0; //รวมย้ายตึก NB แต่ละวัน
	$total_send_pt = 0; //รวมส่งต่อ PT แต่ละวัน
	$total_send_nb = 0; //รวมส่งต่อ NB แต่ละวัน
	$total_dead_pt = 0; //รวมตาย PT แต่ละวัน
	$total_dead_nb = 0; //รวมตาย NB แต่ละวัน
	$total_non_voluntary_pt = 0; //รวมไม่สมัครใจอยู่ PT แต่ละวัน
	$total_non_voluntary_nb = 0; //รวมไม่สมัครใจอยู่ NB แต่ละวัน
	$total_paid_pt = 0; //รวมจำหน่าย PT แต่ละวัน
	$total_paid_nb = 0; //รวมจำหน่าย NB แต่ละวัน
	$total_ad_pt = 0; //รวม ad PT แต่ละวัน
	$total_ad_nb = 0; //รวม ad NB แต่ละวัน
	$total_patient_type5 = 0; //รวม patient_type5 แต่ละวัน
	$total_patient_type4 = 0; //รวม patient_type4 แต่ละวัน
	$total_patient_type3 = 0; //รวม patient_type3 แต่ละวัน
	$total_patient_type2 = 0; //รวม patient_type2 แต่ละวัน
	$total_patient_type1 = 0; //รวม patient_type1 แต่ละวัน
	$total_em_hn = 0; //รวม จนท. HN แต่ละวัน
	$total_em_rn = 0; //รวม จนท. RN แต่ละวัน
	$total_em_tn = 0; //รวม จนท. TN แต่ละวัน
	$total_em_pn = 0; //รวม จนท. PN แต่ละวัน
	$total_em_aid = 0; //รวม จนท. AID แต่ละวัน
	while ($r = $result->fetch_array()) {
		$total_sub_paid_pt = $r['home_pt'] + $r['move_b_pt'] + $r['send_pt'] + $r['dead_pt'] + $r['non_voluntary_pt']; //รวมจำหน่าย PT รายแถว
		$total_sub_paid_nb = $r['home_nb'] + $r['move_b_nb'] + $r['send_nb'] + $r['dead_nb'] + $r['non_voluntary_nb']; //รวมจำหน่าย NB รายแถว
		$result_pt = $r['on_pt'] + $r['in_pt'] + $r['move_pt'] - $total_sub_paid_pt; //คงเหลือ PT
		$result_nb = $r['on_nb'] + $r['in_nb'] + $r['move_nb'] - $total_sub_paid_nb; //คงเหลือ NB
		$patient_day_pt = $result_pt + $r['ad_pt']; //patient_day_pt
		$patient_day_nb = $result_nb + $r['ad_nb']; //patient_day_nb
		if ($r['amount_bed'] != 0) {
			$bed_rate = ($result_pt * 100) / $r['amount_bed'];//อัตราการครองเตียง
			$bed_paid_avg = $total_sub_paid_pt / $r['amount_bed']; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
		}
		if ($total_sub_paid_pt != 0) {
			$bed_free = ($r['amount_bed'] - $patient_day_pt) / $total_sub_paid_pt; //ช่วงเวลาว่างของเตียง
		}
		//ผลรวม
		if ($i == 1) {
			$total_on_pt = $r['on_pt']; //รวมคงพยาบาล PT แต่ละวัน
			$total_on_nb = $r['on_nb']; //รวมคงพยาบาล NB แต่ละวัน
		}
		if ($r['wage_type_id'] == "1") { //ถ้าเป็นเวรดึก
			$total_on_pt1_m += $r['on_pt']; //รวมคงพยาบาลเวรดึก PT ทั้งเดือน
			$total_on_nb1_m += $r['on_nb']; //รวมคงพยาบาลเวรดึก NB ทั้งเดือน
			$total_in_pt1_m += $r['in_pt']; //รวมรับใหม่ PT ทั้งเดือน
			$total_in_nb1_m += $r['in_nb']; //รวมรับใหม่ NB ทั้งเดือน
			$total_move_pt1_m += $r['move_pt']; //รวมรับย้าย PT ทั้งเดือน
			$total_move_nb1_m += $r['move_nb']; //รวมรับย้าย NB ทั้งเดือน
			$total_home_pt1_m += $r['home_pt']; //รวมกลับบ้าน PT ทั้งเดือน
			$total_home_nb1_m += $r['home_nb']; //รวมกลับบ้าน NB ทั้งเดือน
			$total_move_b_pt1_m += $r['move_b_pt']; //รวมย้ายตึก PT ทั้งเดือน
			$total_move_b_nb1_m += $r['move_b_nb']; //รวมย้ายตึก NB ทั้งเดือน
			$total_send_pt1_m += $r['send_pt']; //รวมส่งต่อ PT ทั้งเดือน
			$total_send_nb1_m += $r['send_nb']; //รวมส่งต่อ NB ทั้งเดือน
			$total_dead_pt1_m += $r['dead_pt']; //รวมตาย PT ทั้งเดือน
			$total_dead_nb1_m += $r['dead_nb']; //รวมตาย NB ทั้งเดือน
			$total_non_voluntary_pt1_m += $r['non_voluntary_pt']; //รวมไม่สมัครใจอยู่ PT ทั้งเดือน
			$total_non_voluntary_nb1_m += $r['non_voluntary_nb']; //รวมไม่สมัครใจอยู่ NB ทั้งเดือน
			$total_ad_pt1_m += $r['ad_pt']; //รวม AD PT ทั้งเดือน
			$total_ad_nb1_m += $r['ad_nb']; //รวม AD NB ทั้งเดือน
			$total_patient_type51_m += $r['patient_type5']; //รวม type5 ทั้งเดือน
			$total_patient_type41_m += $r['patient_type4']; //รวม type4 ทั้งเดือน
			$total_patient_type31_m += $r['patient_type3']; //รวม type3 ทั้งเดือน
			$total_patient_type21_m += $r['patient_type2']; //รวม type2 ทั้งเดือน
			$total_patient_type11_m += $r['patient_type1']; //รวม type1 ทั้งเดือน
			$total_em_hn1_m += $r['em_hn']; //รวมจนท. HN ทั้งเดือน
			$total_em_rn1_m += $r['em_rn']; //รวมจนท. RN ทั้งเดือน
			$total_em_tn1_m += $r['em_tn']; //รวมจนท. TN ทั้งเดือน
			$total_em_pn1_m += $r['em_pn']; //รวมจนท. PN ทั้งเดือน
			$total_em_aid1_m += $r['em_aid']; //รวมจนท. AID ทั้งเดือน
		}
		if ($r['wage_type_id'] == "2") { //ถ้าเป็นเวรเช้า
			$total_on_pt2_m += $r['on_pt']; //รวมคงพยาบาลเวรดึก PT ทั้งเดือน
			$total_on_nb2_m += $r['on_nb']; //รวมคงพยาบาลเวรดึก NB ทั้งเดือน
			$total_in_pt2_m += $r['in_pt']; //รวมรับใหม่ PT ทั้งเดือน
			$total_in_nb2_m += $r['in_nb']; //รวมรับใหม่ NB ทั้งเดือน
			$total_move_pt2_m += $r['move_pt']; //รวมรับย้าย PT ทั้งเดือน
			$total_move_nb2_m += $r['move_nb']; //รวมรับย้าย NB ทั้งเดือน
			$total_home_pt2_m += $r['home_pt']; //รวมกลับบ้าน PT ทั้งเดือน
			$total_home_nb2_m += $r['home_nb']; //รวมกลับบ้าน NB ทั้งเดือน
			$total_move_b_pt2_m += $r['move_b_pt']; //รวมย้ายตึก PT ทั้งเดือน
			$total_move_b_nb2_m += $r['move_b_nb']; //รวมย้ายตึก NB ทั้งเดือน
			$total_send_pt2_m += $r['send_pt']; //รวมส่งต่อ PT ทั้งเดือน
			$total_send_nb2_m += $r['send_nb']; //รวมส่งต่อ NB ทั้งเดือน
			$total_dead_pt2_m += $r['dead_pt']; //รวมตาย PT ทั้งเดือน
			$total_dead_nb2_m += $r['dead_nb']; //รวมตาย NB ทั้งเดือน
			$total_non_voluntary_pt2_m += $r['non_voluntary_pt']; //รวมไม่สมัครใจอยู่ PT ทั้งเดือน
			$total_non_voluntary_nb2_m += $r['non_voluntary_nb']; //รวมไม่สมัครใจอยู่ NB ทั้งเดือน
			$total_ad_pt2_m += $r['ad_pt']; //รวม AD PT ทั้งเดือน
			$total_ad_nb2_m += $r['ad_nb']; //รวม AD NB ทั้งเดือน
			$total_patient_type52_m += $r['patient_type5']; //รวม type5 ทั้งเดือน
			$total_patient_type42_m += $r['patient_type4']; //รวม type4 ทั้งเดือน
			$total_patient_type32_m += $r['patient_type3']; //รวม type3 ทั้งเดือน
			$total_patient_type22_m += $r['patient_type2']; //รวม type2 ทั้งเดือน
			$total_patient_type12_m += $r['patient_type1']; //รวม type1 ทั้งเดือน
			$total_em_hn2_m += $r['em_hn']; //รวมจนท. HN ทั้งเดือน
			$total_em_rn2_m += $r['em_rn']; //รวมจนท. RN ทั้งเดือน
			$total_em_tn2_m += $r['em_tn']; //รวมจนท. TN ทั้งเดือน
			$total_em_pn2_m += $r['em_pn']; //รวมจนท. PN ทั้งเดือน
			$total_em_aid2_m += $r['em_aid']; //รวมจนท. AID ทั้งเดือน
		}
		if ($r['wage_type_id'] == "3") { //ถ้าเป็นเวรบ่าย
			$total_on_pt3_m += $r['on_pt']; //รวมคงพยาบาลเวรดึก PT ทั้งเดือน
			$total_on_nb3_m += $r['on_nb']; //รวมคงพยาบาลเวรดึก NB ทั้งเดือน
			$total_in_pt3_m += $r['in_pt']; //รวมรับใหม่ PT ทั้งเดือน
			$total_in_nb3_m += $r['in_nb']; //รวมรับใหม่ NB ทั้งเดือน
			$total_move_pt3_m += $r['move_pt']; //รวมรับย้าย PT ทั้งเดือน
			$total_move_nb3_m += $r['move_nb']; //รวมรับย้าย NB ทั้งเดือน
			$total_home_pt3_m += $r['home_pt']; //รวมกลับบ้าน PT ทั้งเดือน
			$total_home_nb3_m += $r['home_nb']; //รวมกลับบ้าน NB ทั้งเดือน
			$total_move_b_pt3_m += $r['move_b_pt']; //รวมย้ายตึก PT ทั้งเดือน
			$total_move_b_nb3_m += $r['move_b_nb']; //รวมย้ายตึก NB ทั้งเดือน
			$total_send_pt3_m += $r['send_pt']; //รวมส่งต่อ PT ทั้งเดือน
			$total_send_nb3_m += $r['send_nb']; //รวมส่งต่อ NB ทั้งเดือน
			$total_dead_pt3_m += $r['dead_pt']; //รวมตาย PT ทั้งเดือน
			$total_dead_nb3_m += $r['dead_nb']; //รวมตาย NB ทั้งเดือน
			$total_non_voluntary_pt3_m += $r['non_voluntary_pt']; //รวมไม่สมัครใจอยู่ PT ทั้งเดือน
			$total_non_voluntary_nb3_m += $r['non_voluntary_nb']; //รวมไม่สมัครใจอยู่ NB ทั้งเดือน
			$total_ad_pt3_m += $r['ad_pt']; //รวม AD PT ทั้งเดือน
			$total_ad_nb3_m += $r['ad_nb']; //รวม AD NB ทั้งเดือน
			$total_patient_type53_m += $r['patient_type5']; //รวม type5 ทั้งเดือน
			$total_patient_type43_m += $r['patient_type4']; //รวม type4 ทั้งเดือน
			$total_patient_type33_m += $r['patient_type3']; //รวม type3 ทั้งเดือน
			$total_patient_type23_m += $r['patient_type2']; //รวม type2 ทั้งเดือน
			$total_patient_type13_m += $r['patient_type1']; //รวม type1 ทั้งเดือน
			$total_em_hn3_m += $r['em_hn']; //รวมจนท. HN ทั้งเดือน
			$total_em_rn3_m += $r['em_rn']; //รวมจนท. RN ทั้งเดือน
			$total_em_tn3_m += $r['em_tn']; //รวมจนท. TN ทั้งเดือน
			$total_em_pn3_m += $r['em_pn']; //รวมจนท. PN ทั้งเดือน
			$total_em_aid3_m += $r['em_aid']; //รวมจนท. AID ทั้งเดือน
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
                <td height="25" align="center"><?php echo $date1; ?></td>
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
                <td align="center"><?php echo number_format(($r['on_pt']+ $r['in_pt'] + $r['move_pt']), 0); ?></td>
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
} //end while แต่ละวัน
$total_pt = $total_on_pt + $total_in_pt + $total_move_pt - $total_paid_pt; //รวมคงเหลือ PT
$total_nb = $total_on_nb + $total_in_nb + $total_move_nb - $total_paid_nb; //รวมคงเหลือ NB
$total_patient_day_pt = $total_pt + $total_ad_pt; //รวม Patient Day PT
$total_patient_day_nb = $total_nb + $total_ad_nb; //รวม Patient Day NB
if ($amount_bed != 0) {
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
<?php
} // end while day
$total_paid_pt1_m = $total_home_pt1_m + $total_move_b_pt1_m + $total_send_pt1_m + $total_dead_pt1_m + $total_non_voluntary_pt1_m; //รวมจำหน่ายเวรดึก PT ทั้งเดือน
$total_paid_pt2_m = $total_home_pt2_m + $total_move_b_pt2_m + $total_send_pt2_m + $total_dead_pt2_m + $total_non_voluntary_pt2_m; //รวมจำหน่ายเวรเช้า PT ทั้งเดือน
$total_paid_pt3_m = $total_home_pt3_m + $total_move_b_pt3_m + $total_send_pt3_m + $total_dead_pt3_m + $total_non_voluntary_pt3_m; //รวมจำหน่ายเวรบ่าย PT ทั้งเดือน
$total_paid_nb1_m = $total_home_nb1_m + $total_move_b_nb1_m + $total_send_nb1_m + $total_dead_nb1_m + $total_non_voluntary_nb1_m; //รวมจำหน่ายเวรดึก NB ทั้งเดือน
$total_paid_nb2_m = $total_home_nb2_m + $total_move_b_nb2_m + $total_send_nb2_m + $total_dead_nb2_m + $total_non_voluntary_nb2_m; //รวมจำหน่ายเวรเช้า NB ทั้งเดือน
$total_paid_nb3_m = $total_home_nb3_m + $total_move_b_nb3_m + $total_send_nb3_m + $total_dead_nb3_m + $total_non_voluntary_nb3_m; //รวมจำหน่ายเวรบ่าย NB ทั้งเดือน
$total_pt1_m = ($total_on_pt1_m + $total_in_pt1_m + $total_move_pt1_m) - $total_paid_pt1_m; //คงเหลือเวรดึก PT ทั้งเดือน
$total_pt2_m = ($total_on_pt2_m + $total_in_pt2_m + $total_move_pt2_m) - $total_paid_pt2_m; //คงเหลือเวรเช้า PT ทั้งเดือน
$total_pt3_m = ($total_on_pt3_m + $total_in_pt3_m + $total_move_pt3_m) - $total_paid_pt3_m; //คงเหลือเวรบ่าย PT ทั้งเดือน
$total_nb1_m = ($total_on_nb1_m + $total_in_nb1_m + $total_move_nb1_m) - $total_paid_nb1_m; //คงเหลือเวรดึก NB ทั้งเดือน
$total_nb2_m = ($total_on_nb2_m + $total_in_nb2_m + $total_move_nb2_m) - $total_paid_nb2_m; //คงเหลือเวรเช้า NB ทั้งเดือน
$total_nb3_m = ($total_on_nb3_m + $total_in_nb3_m + $total_move_nb3_m) - $total_paid_nb3_m; //คงเหลือเวรบ่าย NB ทั้งเดือน
$total_patient_day_pt1_m = $total_pt1_m + $total_ad_pt1_m; //รวม Patient Day PT เวรดึกทั้งเดือน
$total_patient_day_pt2_m = $total_pt2_m + $total_ad_pt2_m; //รวม Patient Day PT เวรเช้าทั้งเดือน
$total_patient_day_pt3_m = $total_pt3_m + $total_ad_pt3_m; //รวม Patient Day PT เวรบ่ายทั้งเดือน
$total_patient_day_nb1_m = $total_nb1_m + $total_ad_nb1_m; //รวม Patient Day NB เวรดึกทั้งเดือน
$total_patient_day_nb2_m = $total_nb2_m + $total_ad_nb2_m; //รวม Patient Day NB เวรเช้าทั้งเดือน
$total_patient_day_nb3_m = $total_nb3_m + $total_ad_nb3_m; //รวม Patient Day NB เวรบ่ายทั้งเดือน
//$num_day = cal_days_in_month(CAL_GREGORIAN, $month1, $year2); //จำนวนวันในเดือน
//$num_day = 31;
if ($num_day > 0) {
	$sleep_avg_pt1_m = $total_patient_day_pt1_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรดึกทั้งเดือน
	$sleep_avg_pt2_m = $total_patient_day_pt2_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรเช้าทั้งเดือน
	$sleep_avg_pt3_m = $total_patient_day_pt3_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรบ่ายทั้งเดือน
	$sleep_avg_nb1_m = $total_patient_day_nb1_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรดึกทั้งเดือน
	$sleep_avg_nb2_m = $total_patient_day_nb2_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรเช้าทั้งเดือน
	$sleep_avg_nb3_m = $total_patient_day_nb3_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรบ่ายทั้งเดือน
}
if ($amount_bed != "") {
	$total_bed_rate1_m = ($sleep_avg_pt1_m * 100) / $amount_bed; //เฉลี่ยอัตราการครองเตียงเวรดึกทั้งเดือน
	$total_bed_rate2_m = ($sleep_avg_pt2_m * 100) / $amount_bed; //เฉลี่ยอัตราการครองเตียงเวรเช้าทั้งเดือน
	$total_bed_rate3_m = ($sleep_avg_pt3_m * 100) / $amount_bed; //เฉลี่ยอัตราการครองเตียงเวรบ่ายทั้งเดือน
	$total_bed_paid_avg1 = $total_paid_pt1_m / $amount_bed; //ผู้ป่วยเฉลี่ยต่อเตียงเวรดึกทั้งเดือน
	$total_bed_paid_avg2 = $total_paid_pt2_m / $amount_bed; //ผู้ป่วยเฉลี่ยต่อเตียงเวรเช้าทั้งเดือน
	$total_bed_paid_avg3 = $total_paid_pt3_m / $amount_bed; //ผู้ป่วยเฉลี่ยต่อเตียงเวรบ่ายทั้งเดือน
}
if ($total_paid_pt1_m != "0") {
	$total_bed_free1_m = (($amount_bed * $num_day) - $total_patient_day_pt1_m) / $total_paid_pt1_m; //ช่วงเวลาว่างของเตียงเวรดึกทั้งเดือน
}
if ($total_paid_pt2_m != "0") {
	$total_bed_free2_m = (($amount_bed * $num_day) - $total_patient_day_pt2_m) / $total_paid_pt2_m; //ช่วงเวลาว่างของเตียงเวรเช้าทั้งเดือน
}
if ($total_paid_pt3_m != "0") {
	$total_bed_free3_m = (($amount_bed * $num_day) - $total_patient_day_pt3_m) / $total_paid_pt3_m; //ช่วงเวลาว่างของเตียงเวรบ่ายทั้งเดือน
}
//รวมทั้งสิ้น
$total_in_pt_all = $total_in_pt1_m + $total_in_pt2_m + $total_in_pt3_m; //รวมรับใหม่ PT ทั้งหมด
$total_in_nb_all = $total_in_nb1_m + $total_in_nb2_m + $total_in_nb3_m; //รวมรับใหม่ NB ทั้งหมด
$total_move_pt_all = $total_move_pt1_m + $total_move_pt2_m + $total_move_pt3_m; //รวมรับย้าย PT ทั้งหมด
$total_move_nb_all = $total_move_nb1_m + $total_move_nb2_m + $total_move_nb3_m; //รวมรับย้าย NB ทั้งหมด
$total_home_pt_all = $total_home_pt1_m + $total_home_pt2_m + $total_home_pt3_m; //รวมกลับบ้าน PT ทั้งหมด
$total_home_nb_all = $total_home_nb1_m + $total_home_nb2_m + $total_home_nb3_m; //รวมกลับบ้าน NB ทั้งหมด
$total_move_b_pt_all = $total_move_b_pt1_m + $total_move_b_pt2_m + $total_move_b_pt3_m; //รวมย้ายตึก PT ทั้งหมด
$total_move_b_nb_all = $total_move_b_nb1_m + $total_move_b_nb2_m + $total_move_b_nb3_m; //รวมย้ายตึก NB ทั้งหมด
$total_send_pt_all = $total_send_pt1_m + $total_send_pt2_m + $total_send_pt3_m; //รวมส่งต่อ PT ทั้งหมด
$total_send_nb_all = $total_send_nb1_m + $total_send_nb2_m + $total_send_nb3_m; //รวมส่งต่อ NB ทั้งหมด
$total_dead_pt_all = $total_dead_pt1_m + $total_dead_pt2_m + $total_dead_pt3_m; //รวมตาย PT ทั้งหมด
$total_dead_nb_all = $total_dead_nb1_m + $total_dead_nb2_m + $total_dead_nb3_m; //รวมตาย NB ทั้งหมด
$total_non_voluntary_pt_all = $total_non_voluntary_pt1_m + $total_non_voluntary_pt2_m + $total_non_voluntary_pt3_m; //รวมไม่สมัครใจอยู่ PT ทั้งหมด
$total_non_voluntary_nb_all = $total_non_voluntary_nb1_m + $total_non_voluntary_nb2_m + $total_non_voluntary_nb3_m; //รวมไม่สมัครใจอยู่ NB ทั้งหมด
$total_paid_pt_all = $total_paid_pt1_m + $total_paid_pt2_m + $total_paid_pt3_m; //รวมจำหน่าย PT ทั้งหมด
$total_paid_nb_all = $total_paid_nb1_m + $total_paid_nb2_m + $total_paid_nb3_m; //รวมจำหน่าย NB ทั้งหมด
$total_pt_all = ($total_on_pt1_m + $total_in_pt_all + $total_move_pt_all) - $total_paid_pt_all; //คงเหลือ PT ทั้งหมด
$total_nb_all = ($total_on_nb1_m + $total_in_nb_all + $total_move_nb_all) - $total_paid_nb_all; //คงเหลือ NB ทั้งหมด
$total_ad_pt_all = $total_ad_pt1_m + $total_ad_pt2_m + $total_ad_pt3_m; //รวม AD PT ทั้งหมด
$total_ad_nb_all = $total_ad_nb1_m + $total_ad_nb2_m + $total_ad_nb3_m; //รวม AD NB ทั้งหมด
$total_patient_day_pt_all = $total_pt_all + $total_ad_pt_all; //รวม Patient Day PT ทั้งหมด
$total_patient_day_nb_all = $total_nb_all + $total_ad_nb_all; //รวม Patient Day NB ทั้งหมด
$total_patient_type5_all =  $total_patient_type51_m +  $total_patient_type52_m +  $total_patient_type53_m; //รวม type5 ทั้งหมด
$total_patient_type4_all =  $total_patient_type41_m +  $total_patient_type42_m +  $total_patient_type43_m; //รวม type4 ทั้งหมด
$total_patient_type3_all =  $total_patient_type31_m +  $total_patient_type32_m +  $total_patient_type33_m; //รวม type3 ทั้งหมด
$total_patient_type2_all =  $total_patient_type21_m +  $total_patient_type22_m +  $total_patient_type23_m; //รวม type2 ทั้งหมด
$total_patient_type1_all =  $total_patient_type11_m +  $total_patient_type12_m +  $total_patient_type13_m; //รวม type1 ทั้งหมด
if ($num_day > 0) {
	$sleep_avg_pt_all = $total_patient_day_pt_all / $num_day; //เฉลี่ยนอนรพ. PT ทั้งหมด
	$sleep_avg_nb_all = $total_patient_day_nb_all / $num_day; //เฉลี่ยนอนรพ. NB ทั้งหมด
}
if ($amount_bed != "") {
	$total_bed_rate_all = ($sleep_avg_pt_all * 100) / $amount_bed; //อัตราการครองเตียง PT ทั้งหมด
	$total_bed_paid_avg_all = $total_paid_pt_all / $amount_bed; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียงทั้งหมด
}
if ($total_paid_pt_all != "0") {
	$total_bed_free_all = (($amount_bed * $num_day) - $total_patient_day_pt_all) / $total_paid_pt_all; //รวมช่วงเวลาว่างของเตียงทั้งหมด
}
$total_em_hn_all = $total_em_hn1_m + $total_em_hn2_m + $total_em_hn3_m; //รวมจนท. HN ทั้งหมด
$total_em_rn_all = $total_em_rn1_m + $total_em_rn2_m + $total_em_rn3_m; //รวมจนท. RN ทั้งหมด
$total_em_tn_all = $total_em_tn1_m + $total_em_tn2_m + $total_em_tn3_m; //รวมจนท. TN ทั้งหมด
$total_em_pn_all = $total_em_pn1_m + $total_em_pn2_m + $total_em_pn3_m; //รวมจนท. PN ทั้งหมด
$total_em_aid_all = $total_em_aid1_m + $total_em_aid2_m + $total_em_aid3_m; //รวมจนท. AID ทั้งหมด
?>
			<tr>
                <td rowspan="3" align="center" valign="middle">รวม<br />
                  แต่<br />
                  ละ<br />
                  เวร</td>
                <td height="25" align="center">ด</td>
                <td height="25" align="center"><?php echo $total_on_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_on_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_in_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_in_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_move_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_move_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_home_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_home_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_move_b_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_move_b_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_send_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_send_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_dead_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_dead_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_non_voluntary_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_non_voluntary_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_paid_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_paid_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_ad_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_ad_nb1_m; ?></td>
                <td height="25" align="center"><?php echo $total_patient_day_pt1_m; ?></td>
                <td height="25" align="center"><?php echo $total_patient_day_nb1_m; ?></td>
                <td align="center"><?php echo $total_patient_type51_m; ?></td>
                <td height="25" align="center"><?php echo $total_patient_type41_m; ?></td>
                <td height="25" align="center"><?php echo $total_patient_type31_m; ?></td>
                <td height="25" align="center"><?php echo $total_patient_type21_m; ?></td>
                <td height="25" align="center"><?php echo $total_patient_type11_m; ?></td>
                <td align="center"><?php echo number_format(($total_on_pt1_m + $total_in_pt1_m + $total_move_pt1_m), 0); ?></td>
                <td height="25" align="center"><?php echo $amount_bed; ?></td>
                <td height="25" align="center"><?php echo number_format($sleep_avg_pt1_m, 3); ?></td>
                <td height="25" align="center"><?php echo number_format($sleep_avg_nb1_m, 2); ?></td>
                <td height="25" align="center"><?php echo number_format($total_bed_rate1_m, 2); ?></td>
                <td height="25" align="center"><?php echo number_format($total_bed_free1_m, 2); ?></td>
                <td height="25" align="center"><?php echo number_format($total_bed_paid_avg1, 2); ?></td>
                <td height="25" align="center"><?php echo $total_em_hn1_m; ?></td>
                <td height="25" align="center"><?php echo $total_em_rn1_m; ?></td>
                <td height="25" align="center"><?php echo $total_em_tn1_m; ?></td>
                <td height="25" align="center"><?php echo $total_em_pn1_m; ?></td>
                <td height="25" align="center"><?php echo $total_em_aid1_m; ?></td>
              </tr>
			<tr>
			  <td height="25" align="center">ช</td>
			  <td height="25" align="center"><?php echo $total_on_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_on_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_in_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_in_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_home_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_home_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_b_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_b_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_send_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_send_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_dead_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_dead_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_non_voluntary_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_non_voluntary_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_paid_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_paid_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_ad_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_ad_nb2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_day_pt2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_day_nb2_m; ?></td>
			  <td align="center"><?php echo $total_patient_type52_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type42_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type32_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type22_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type12_m; ?></td>
			  <td align="center"><?php echo number_format(($total_on_pt2_m + $total_in_pt2_m + $total_move_pt2_m), 0); ?></td>
			  <td height="25" align="center"><?php echo $amount_bed; ?></td>
			  <td height="25" align="center"><?php echo number_format($sleep_avg_pt2_m, 3); ?></td>
			  <td height="25" align="center"><?php echo number_format($sleep_avg_nb2_m, 2); ?></td>
			  <td height="25" align="center"><?php echo number_format($total_bed_rate2_m, 2); ?></td>
			  <td height="25" align="center"><?php echo number_format($total_bed_free2_m, 2); ?></td>
			  <td height="25" align="center"><?php echo number_format($total_bed_paid_avg2, 2); ?></td>
			  <td height="25" align="center"><?php echo $total_em_hn2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_rn2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_tn2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_pn2_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_aid2_m; ?></td>
			  </tr>
			<tr>
			  <td height="25" align="center">บ</td>
			  <td height="25" align="center"><?php echo $total_on_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_on_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_in_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_in_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_home_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_home_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_b_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_move_b_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_send_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_send_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_dead_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_dead_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_non_voluntary_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_non_voluntary_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_paid_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_paid_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_ad_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_ad_nb3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_day_pt3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_day_nb3_m; ?></td>
			  <td align="center"><?php echo $total_patient_type53_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type43_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type33_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type23_m; ?></td>
			  <td height="25" align="center"><?php echo $total_patient_type13_m; ?></td>
			  <td align="center"><?php echo number_format(($total_on_pt3_m + $total_in_pt3_m + $total_move_pt3_m), 0); ?></td>
			  <td height="25" align="center"><?php echo $amount_bed; ?></td>
			  <td height="25" align="center"><?php echo number_format($sleep_avg_pt3_m, 3); ?></td>
			  <td height="25" align="center"><?php echo number_format($sleep_avg_nb3_m, 2); ?></td>
			  <td height="25" align="center"><?php echo number_format($total_bed_rate3_m, 2); ?></td>
			  <td height="25" align="center"><?php echo number_format($total_bed_free3_m, 2); ?></td>
			  <td height="25" align="center"><?php echo number_format($total_bed_paid_avg3, 2); ?></td>
			  <td height="25" align="center"><?php echo $total_em_hn3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_rn3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_tn3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_pn3_m; ?></td>
			  <td height="25" align="center"><?php echo $total_em_aid3_m; ?></td>
			  </tr>
			<tr>
			  <td height="25" colspan="2" align="center" bgcolor="#CCCCCC">ทั้งหมด</td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_on_pt1_m; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_on_nb1_m; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_in_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_in_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_home_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_home_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_b_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_move_b_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_send_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total-send_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_dead_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total-dead_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_non_voluntary_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_non_voluntary_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_paid_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_paid_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_ad_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_ad_nb_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_pt_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_day_nb_all; ?></td>
			  <td align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type5_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type4_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type3_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type2_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_patient_type1_all; ?></td>
			  <td align="center" bgcolor="#CCCCCC"><?php echo number_format(($total_on_pt1_m + $total_in_pt_all + $total_move_pt_all), 0); ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $amount_bed; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($sleep_avg_pt_all, 3); ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($sleep_avg_nb_all, 2); ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_rate_all, 2); ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_free_all, 2); ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo number_format($total_bed_paid_avg_all, 2); ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_hn_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_rn_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_tn_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_pn_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC"><?php echo $total_em_aid_all; ?></td>
			  </tr>
            </table></td>
          </tr>
          <?php //} //end if $kk ?>
          <tr>
            <td align="left">รวมให้การพยาบาล = (คงพยาบาล + รับใหม่ + รับย่าย) PT</td>
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