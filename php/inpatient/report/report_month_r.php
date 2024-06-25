<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="report-month.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานประจำเดือน :: Report</title>
<style>
.tHead {
	font-family: "TH SarabunPSK", Verdana, sans-serif, Tahoma;
	font-size: 24px;
}
.tData {
	font-family: "TH SarabunPSK", Verdana, sans-serif, Tahoma;
	font-size: 20px;
}
</style>
</head>

<body <?php if ($ac == "p") { ?> onload="window.print();" <?php } ?>>
<?php
$ward = $_GET['ward'];
$month1 = $_GET['month1'];
$year1= $_GET['year1'];
$year2 = $year1 - 543;
$i_status = $_GET['i_status'];
include "../connect.php";
include "../myarray.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="left" class="tHead">INPATIENT CENSUS AND INPATIENT SERVICE DAYS ประจำเดือน <?php echo $month_r[$month1]; ?> พ.ศ. <?php echo $year1; ?>&nbsp;<?php echo $rw[0]; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="1643" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="27" rowspan="3" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">วันที่</span></td>
                <td width="26" rowspan="3" align="center" bgcolor="#B9FFFF"  style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">เวร</span></td>
                <td colspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">คงพยาบาล</span></td>
                <td colspan="4" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">การรับ</span></td>
                <td height="25" colspan="10" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">จำหน่าย</span></td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">รวมจำหน่าย</span></td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">คงเหลือ</span></td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">A&amp;D<br />
                Same day</span></td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">Patient Day</span></td>
                <td colspan="5" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">ประเภทผู้ป่วย</span></td>
                <td width="37" rowspan="3" align="center" bgcolor="#B9FFFF" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;">รวมให้<br />
                การพยาบาล</td>
                <td width="37" rowspan="3" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">จำนวน<br />
                เตียง</span></td>
                <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">เฉลี่ยนอนรพ.<br />
                (คน)</span></td>
                <td width="64" rowspan="3" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">อัตราการ<br />
                ครองเตียง</span></td>
                <td width="164" rowspan="3" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">turnover interval (T)<br />
                ช่วงเวลาว่างของเตียง (วัน)</span></td>
                <td width="185" rowspan="3" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">Bed Turnover Rate (B)<br />
                ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)</span></td>
                <td colspan="5" rowspan="2" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">จนท.ปฏิบัติงาน</span></td>
                </tr>
              <tr>
                <td height="25" colspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">วานนี้</span></td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">รับใหม่</span></td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">รับย้าย</span></td>
                <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">กลับบ้าน</span></td>
                <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ย้ายตึก</span></td>
                <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ส่งต่อ</span></td>
                <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ตาย</span></td>
                <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ไม่สมัครใจอยู่</span></td>
                </tr>
              <tr>
                <td width="31" height="25" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="31" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="29" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="29"  align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="29" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="29" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="29" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="38" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="38" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="36" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="36" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="26" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="26" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="33" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="33" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="36" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="36" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="26" align="center" bgcolor="#FFE1D2" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;">วิกฤต</td>
                <td width="26" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">4</span></td>
                <td width="26" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">3</span></td>
                <td width="27" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">2</span></td>
                <td width="26" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">1</span></td>
                <td width="41" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="41" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="26" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">HN</span></td>
                <td width="26" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">RN</span></td>
                <td width="26" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">TN</span></td>
                <td width="26" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PN</span></td>
                <td width="38" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">AID</span></td>
              </tr>
<?php
//หาวันที่
$sqld = "SELECT DISTINCT idate AS day1 FROM data_all WHERE MID(data_all.idate, 1, 4) = '$year2' AND MID(idate, 6, 2) = '$month1' AND data_all.ward = '$ward'";
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
		$bed_rate = ($result_pt * 100) / $r['amount_bed'];//อัตราการครองเตียง
		if ($total_sub_paid_pt != 0) {
			$bed_free = ($r['amount_bed'] - $patient_day_pt) / $total_sub_paid_pt; //ช่วงเวลาว่างของเตียง
		}
		$bed_paid_avg = $total_sub_paid_pt / $r['amount_bed']; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
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
?>
              <tr>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $date1; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $r['wage_type_names']; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['on_pt'] != "0") { echo $r['on_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['on_nb'] != "0") { echo $r['on_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['in_pt'] != "0") { echo $r['in_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['in_nb'] != "0") { echo $r['in_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['move_pt'] != "0") { echo $r['move_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['move_nb'] != "0") { echo $r['move_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['home_pt'] != "0") { echo $r['home_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['home_nb'] != "0") { echo $r['home_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['move_b_pt'] != "0") { echo $r['move_b_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['move_b_nb'] != "0") { echo $r['move_b_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['send_pt'] != "0") { echo $r['send_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['send_nb'] != "0") { echo $r['send_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['dead_pt'] != "0") { echo $r['dead_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['dead_nb'] != "0") { echo $r['dead_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['non_voluntary_pt'] != "0") { echo $r['non_voluntary_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['non_voluntary_nb'] != "0") { echo $r['non_voluntary_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_sub_paid_pt; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_sub_paid_nb; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $result_pt; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $result_nb; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['ad_pt'] != "0") { echo $r['ad_pt']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['ad_nb'] != "0") { echo $r['ad_nb']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_pt; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_nb; ?></span></td>
                <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php if ($r['patient_type5'] != "0") { echo $r['patient_type5']; } ?></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['patient_type4'] != "0") { echo $r['patient_type4']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['patient_type3'] != "0") { echo $r['patient_type3']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['patient_type2'] != "0") { echo $r['patient_type2']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['patient_type1'] != "0") { echo $r['patient_type1']; } ?>
                </span></td>
                <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format(($r['on_pt'] + $r['in_pt'] + $r['move_pt']), 0); ?></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['amount_bed'] != "0") { echo $r['amount_bed']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_pt; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_nb; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($bed_rate, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($bed_free, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($bed_paid_avg, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['em_hn'] != "0") { echo $r['em_hn']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['em_rn'] != "0") { echo $r['em_rn']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['em_tn'] != "0") { echo $r['em_tn']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['em_pn'] != "0") { echo $r['em_pn']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($r['em_aid'] != "0") { echo $r['em_aid']; } ?>
                </span></td>
              </tr>
<?php
$i++;
} //end while แต่ละวัน
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
                <td height="25" colspan="2" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_nb; ?></span></td>
                <td align="center" bgcolor="#CCCCCC" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo $total_patient_type5; ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type4; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type3; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type2; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type1; ?></span></td>
                <td align="center" bgcolor="#CCCCCC" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format(($total_on_pt + $total_in_pt + $total_move_pt), 0); ?></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $amount_bed; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_rate, 2); ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_free, 2); ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_paid_avg, 2); ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_hn; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_rn; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_tn; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_pn; ?></span></td>
                <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_aid; ?></span></td>
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
$sleep_avg_pt1_m = $total_patient_day_pt1_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรดึกทั้งเดือน
$sleep_avg_pt2_m = $total_patient_day_pt2_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรเช้าทั้งเดือน
$sleep_avg_pt3_m = $total_patient_day_pt3_m / $num_day; //รวมเฉลี่ยนอนรพ. PT เวรบ่ายทั้งเดือน
$sleep_avg_nb1_m = $total_patient_day_nb1_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรดึกทั้งเดือน
$sleep_avg_nb2_m = $total_patient_day_nb2_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรเช้าทั้งเดือน
$sleep_avg_nb3_m = $total_patient_day_nb3_m / $num_day; //รวมเฉลี่ยนอนรพ. NB เวรบ่ายทั้งเดือน
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
$sleep_avg_pt_all = $total_patient_day_pt_all / $num_day; //เฉลี่ยนอนรพ. PT ทั้งหมด
$sleep_avg_nb_all = $total_patient_day_nb_all / $num_day; //เฉลี่ยนอนรพ. NB ทั้งหมด
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
                <td rowspan="3" align="center" valign="middle" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม<br />
                แต่<br />
                ละ<br />
                เวร</span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ด</span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_nb1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_pt1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_nb1_m; ?></span></td>
                <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo $total_patient_type51_m; ?></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type41_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type31_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type21_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type11_m; ?></span></td>
                <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format(($total_on_pt1_m + $total_in_pt1_m + $total_move_pt1_m), 0); ?></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $amount_bed; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_pt1_m, 3); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_nb1_m, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_rate1_m, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_free1_m, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_paid_avg1, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_hn1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_rn1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_tn1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_pn1_m; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_aid1_m; ?></span></td>
              </tr>
			<tr>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ช</span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_nb2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_pt2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_nb2_m; ?></span></td>
			  <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo $total_patient_type52_m; ?></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type42_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type32_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type22_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type12_m; ?></span></td>
			  <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format(($total_on_pt2_m + $total_in_pt2_m + $total_move_pt2_m), 0); ?></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $amount_bed; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_pt2_m, 3); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_nb2_m, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_rate2_m, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_free2_m, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_paid_avg2, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_hn2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_rn2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_tn2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_pn2_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_aid2_m; ?></span></td>
			  </tr>
			<tr>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">บ</span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_nb3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_pt3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_nb3_m; ?></span></td>
			  <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo $total_patient_type53_m; ?></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type43_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type33_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type23_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type13_m; ?></span></td>
			  <td align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format(($total_on_pt3_m + $total_in_pt3_m + $total_move_pt3_m), 0); ?></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $amount_bed; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_pt3_m, 3); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_nb3_m, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_rate3_m, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_free3_m, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_paid_avg3, 2); ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_hn3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_rn3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_tn3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_pn3_m; ?></span></td>
			  <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_aid3_m; ?></span></td>
			  </tr>
			<tr>
			  <td height="25" colspan="2" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">ทั้งหมด</span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt1_m; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb1_m; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_in_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_home_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_move_b_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_send_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total-send_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dead_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total-dead_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_non_voluntary_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ad_nb_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_pt_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_day_nb_all; ?></span></td>
			  <td align="center" bgcolor="#CCCCCC" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo $total_patient_type5_all; ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type4_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type3_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type2_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_patient_type1_all; ?></span></td>
			  <td align="center" bgcolor="#CCCCCC" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format(($total_on_pt1_m + $total_in_pt_all + $total_move_pt_all), 0); ?></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $amount_bed; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_pt_all, 3); ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sleep_avg_nb_all, 2); ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_rate_all, 2); ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_free_all, 2); ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_bed_paid_avg_all, 2); ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_hn_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_rn_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_tn_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_pn_all; ?></span></td>
			  <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_em_aid_all; ?></span></td>
  </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>