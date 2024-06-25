<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="on-pt-day.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานคงพยาบาลประจำวัน</title>
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

<body>
<?php
$i_status = $_GET['i_status'];
include "../connect.php";
include "../myclass.php";
$idate2 = FormatDateDefault($_GET['idate']);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="left" class="tHead">รายงานคงพยาบาล ประจำวันที่ <?php echo FormatDateFull($idate2); ?></td>
  </tr>
  <tr>
    <td align="left"><table width="1750" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="63" rowspan="3" align="center" bgcolor="#CCFFE6" class="tHead" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;">ตึก</td>
        <td colspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">คงพยาบาล</span></td>
        <td colspan="4" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">การรับ</span></td>
        <td height="25" colspan="10" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">จำหน่าย</span></td>
        <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">รวมจำหน่าย</span></td>
        <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">คงเหลือ</span></td>
        <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">A&amp;D<br />
          Same day</span></td>
        <td colspan="2" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">Patient Day</span></td>
        <td colspan="4" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">ประเภทผู้ป่วย</span></td>
        <td width="39" rowspan="3" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">จำนวน<br />
          เตียง</span></td>
        <?php if ($kk == 1) { ?>
        <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">เฉลี่ยนอนรพ.<br />
          (คน)</span></td>
        <td width="69" rowspan="3" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">อัตราการ<br />
          ครองเตียง</span></td>
        <td width="145" rowspan="3" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">turnover interval (T)<br />
          ช่วงเวลาว่างของเตียง (วัน)</span></td>
        <td width="180" rowspan="3" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">Bed Turnover Rate (B)<br />
          ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)</span></td>
        <?php } //end $kk ?>
        <td colspan="5" rowspan="2" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">จนท.ปฏิบัติงาน</span></td>
        <?php if ($kk == 1) { ?>
        <td width="56" rowspan="3" align="center" bgcolor="#00CC66" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">ผลรวม<br />
          ชม.<br />
          การทำงาน<br />
          RN</span></td>
        <td width="60" rowspan="3" align="center" bgcolor="#FF9966" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">ผลรวม<br />
          ชม.<br />
          การทำงาน<br />
          บุคลากร</span></td>
        <td width="57" rowspan="3" align="center" bgcolor="#6699CC" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">จำนวน<br />
          ผู้ให้<br />
          บริการ</span></td>
        <td width="51" rowspan="3" align="center" bgcolor="#0099FF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">ยอด<br />
          ผู้ป่วย<br />
          ต้นเดือน</span></td>
        <td width="48" rowspan="3" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">ยอด<br />
          ยกไป<br />
          เดือนใหม่</span></td>
        <td width="38" rowspan="3" align="center" bgcolor="#FF9999" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tHead">LOS</span></td>
      </tr>
      <?php } //end $kk ?>
      <tr>
        <td height="25" colspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">วานนี้</span></td>
        <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">รับใหม่</span></td>
        <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">รับย้าย</span></td>
        <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">กลับบ้าน</span></td>
        <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">ย้ายตึก</span></td>
        <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">ส่งต่อ</span></td>
        <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">ตาย</span></td>
        <td colspan="2" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">ไม่สมัครใจอยู่</span></td>
      </tr>
      <tr>
        <td width="29" height="25" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="30" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="27" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="27"  align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="30" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="27" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="33" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="30" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="30" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="30" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="30" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="30" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="30" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="30" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="39" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="39" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="37" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="37" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="27" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="27" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="35" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="35" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="39" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="38" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <td width="27" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">4</span></td>
        <td width="27" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">3</span></td>
        <td width="28" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">2</span></td>
        <td width="27" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">1</span></td>
        <?php if ($kk == 1) { ?>
        <td width="46" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PT</span></td>
        <td width="46" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">NB</span></td>
        <?php } //end $kk ?>
        <td width="27" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">HN</span></td>
        <td width="26" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">RN</span></td>
        <td width="27" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">TN</span></td>
        <td width="26" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">PN</span></td>
        <td width="27" align="center" bgcolor="#FFFF00" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tHead">AID</span></td>
      </tr>
      <?php
//ward group = 1
$sqlw1 = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
$sum_on_pt = 0; //รวมคงพยาบาล PT
$sum_on_nb = 0; //รวมคงพยาบาล NB
$sum_in_pt = 0; //รวมรับใหม่ PT
$sum_in_nb = 0; //รวมรับใหม่ NB
$sum_move_pt = 0; //รวมรับย้าย PT
$sum_move_nb = 0; //รวมรับย้าย NB
$sum_home_pt = 0; //รวมกลับบ้าน PT
$sum_home_nb = 0; //รวมกลับบ้าน NB
$sum_move_b_pt = 0; //รวมย้ายตึก PT
$sum_move_b_nb = 0; //รวมย้ายตึก PT
$sum_send_pt = 0; //รวมส่งต่อ PT
$sum_send_nb = 0; //รวมส่งต่อ NB
$sum_dead_pt = 0; //รวมตาย PT
$sum_dead_nb = 0; //รวมตาย NB
$sum_non_voluntary_pt = 0; //รวมไม่สมัครใจอยู่ PT
$sum_non_voluntary_nb = 0; //รวมไม่สมัครใจอยู่ NB
$total_paid_pt = 0; //รวมจำหน่าย PT
$total_paid_nb = 0; //รวมจำหน่าย NB
$total_pt = 0; //รวมคงเหลือ PT
$total_nb = 0; //รวมคงเหลือ NB
$sum_ad_pt = 0; //รวม AD PT
$sum_ad_nb = 0; //รวม AD NB
$sum_patient_day_pt = 0; //รวม patient_day PT
$sum_patient_day_nb = 0; //รวม patitent_day NB
$sum_patient_type4 = 0; //รวม patient_type4
$sum_patient_type3 = 0; //รวม patient_type3
$sum_patient_type2 = 0; //รวม patient_type2
$sum_patient_type1 = 0; //รวม patient_type1
$sum_bed = 0; //รวมเตียง
$sum_bed_rate = 0; //รวมอัตราการครองเตียง
$sum_bed_free = 0; //รวมช่วงเวลาว่างของเตียง
$sum_bed_paid_avg = 0; //รวมจำนวนผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง
$sum_em_hn = 0; //รวม em_hn
$sum_em_rn = 0; //รวม em_rn
$sum_em_tn = 0; //รวม em_tn
$sum_em_pn = 0; //รวม em_pn
$sum_em_aid = 0; //รวม em_aid
$sum_begin_patient = 0; //รวมผู้ป่วยต้นเดือน
$sum_end_patient = 0; //รวมผู้ป่วยปลายเดือน
$sum_los = 0; //รวม LOS
while ($rw1 = $resultw1->fetch_array()) { //while ward
$sql = "SELECT data_all.on_pt, data_all.on_nb, data_all.wage_type_id, wage_type.wage_type_names, data_all.in_pt, data_all.in_nb, data_all.move_pt, data_all.move_nb, data_all.home_pt, data_all.home_nb, data_all.move_b_pt, data_all.move_b_nb, data_all.send_pt, data_all.send_nb, data_all.dead_pt, data_all.dead_nb, data_all.non_voluntary_pt, data_all.non_voluntary_nb, data_all.ad_pt, data_all.ad_nb, data_all.patient_type4, data_all.patient_type3, data_all.patient_type2, data_all.patient_type1, data_all.amount_bed, data_all.em_hn, data_all.em_rn, data_all.em_tn, data_all.em_pn, data_all.em_aid FROM data_all LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id WHERE data_all.idate = '$idate2' AND data_all.ward = '$rw1[ward]'";
if ($i_status != "all") {
	$sql .= " AND data_all.i_status = '$i_status'";
}
$sql .= " ORDER BY data_all.wage_type_id";
$result = $conn->query($sql);
$on_pt = 0; //คงพยาบาล PT เฉพาะเวรดึก
$on_nb = 0; //คงพยาบาล NB เฉพาะเวรดึก
$in_pt = 0; //รับใหม่ PT
$in_nb = 0; //รับใหม่ NB
$move_pt = 0; //รับย้าย PT
$move_nb = 0; //รับย้าย NB
$home_pt = 0; //กลับบ้าน PT
$home_nb = 0; //กลับบ้าน NB
$move_b_pt = 0; //ย้ายตึก PT
$move_b_nb = 0; //ย้ายตึก NB
$send_pt = 0; //ส่งต่อ PT
$send_nb = 0; //ส่งต่อ NB
$dead_pt = 0; //ตาย PT
$dead_nb = 0; //ตาย NB
$non_voluntary_pt = 0; //ไม่สมัครใจอยู่ PT
$non_voluntary_nb = 0; //ไม่สมัครใจอยู่ NB
$ad_pt = 0; //A&D PT
$ad_nb = 0; //A&D NB
$patient_type4 = 0; //patient_type4
$patient_type3 = 0; //patient_type3
$patient_type2 = 0; //patient_type2
$patient_type1 = 0; //patient_type1
$amount_bed = 0; //จำนวนเตียง
$avg_pt = 0; //เฉลี่ยนอนรพ.(คน) PT
$avg_nb = 0; //เฉลี่ยนอนรพ.(คน) NB
$bed_rate = 0; //อัตราการครองเตียง
$bed_free = 0; //ช่วงเวลาว่างของเตียง
$bed_paid_avg = 0; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
$em_hn = 0; //รวม จนท. HN
$em_rn = 0; //รวม จนท. RN
$em_tn = 0; //รวม จนท. TN
$em_pn = 0; //รวม จนท. PN
$em_aid = 0; //รวม จนท. AID
$hw_rn = 0; //ผลรวมชม.การทำงาน RN
$hw_p = 0; //ผลรวมชม.การทำงานบุคลากร
$amount_sr = 0; //จำนวนผู้ให้บริการ
$begin_patient = 0; //จำนวนผู้ป่วยต้นเดือน
$end_patient = 0; //ผู้ป่วยยกไป
$los = 0; //LOS
$i = 1;
while ($r = $result->fetch_array()) {
	if ($r['wage_type_id'] == "1") { //เวรดึก
		$on_pt = $r['on_pt'];
		$on_nb = $r['on_nb'];
	}
	if ($i == 1) {
		$begin_patient = $r['on_pt']; //ผู้ป่วยต้นเดือน
	}
	$end_patient = ($r['on_pt'] + $r['in_pt'] + $r['move_pt']) - ($r['home_pt'] + $r['move_b_pt'] + $r['send_pt'] + $r['dead_pt'] + $r['non_voluntary_pt']); //ผู้ป่วยยกไป
	//ผลรวม
	$in_pt += $r['in_pt'];
	$in_nb += $r['in_nb'];
	$move_pt += $r['move_pt'];
	$move_nb += $r['move_nb'];
	$home_pt += $r['home_pt'];
	$home_nb += $r['home_nb'];
	$move_b_pt += $r['move_b_pt'];
	$move_b_nb += $r['move_b_nb'];
	$send_pt += $r['send_pt'];
	$send_nb += $r['send_nb'];
	$dead_pt += $r['dead_pt'];
	$dead_nb += $r['dead_nb'];
	$non_voluntary_pt += $r['non_voluntary_pt'];
	$non_voluntary_nb += $r['non_voluntary_nb'];
	$ad_pt += $r['ad_pt'];
	$ad_nb += $r['ad_nb'];
	$patient_type4 += $r['patient_type4'];
	$patient_type3 += $r['patient_type3'];
	$patient_type2 += $r['patient_type2'];
	$patient_type1 += $r['patient_type1'];
	$amount_bed = $r['amount_bed'];
	$em_hn += $r['em_hn'];
	$em_rn += $r['em_rn'];
	$em_tn += $r['em_tn'];
	$em_pn += $r['em_pn'];
	$em_aid += $r['em_aid'];
	$i++;
} //end while
$sum_paid_pt = $home_pt + $move_b_pt + $send_pt + $dead_pt + $non_voluntary_pt; //รวมจำหน่วย PT รายแถว
$sum_paid_nb = $home_nb + $move_b_bn + $send_nb + $dead_nb + $non_voluntary_nb; //รวมจำหน่าย NB รายแถว
$result_pt = ($on_pt + $in_pt + $move_pt) - $sum_paid_pt; //คงเหลือ PT
$result_nb = ($on_nb + $in_nb + $move_nb) - $sum_paid_nb; //คงเหลือ NB
$patient_day_pt = $result_pt + $ad_pt; //patient_day_pt
$patient_day_nb = $result_nb + $ad_nb; //patient_day_nb
if ($amount_bed != "0") {
	$bed_rate = ($patient_day_pt * 100) / $amount_bed; //อัตราการครองเตียง
	$bed_paid_avg = $sum_paid_pt / $amount_bed; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
}
if ($sum_paid_pt != 0) {
 $bed_free = ($amount_bed - $patient_day_pt) / $sum_paid_pt; //ช่วงเวลาว่างของเตียง
}
$hw_rn = ($em_hn + $em_rn) * 8; //ผลรวมชม.การทำงาน RN
$hw_em = ($em_hn + $em_rn + $em_tn + $em_pn) * 8; //ผลรวมชม.การทำงานบุคลากร
$amount_sr = $em_rn + $em_tn + $em_pn + $em_aid; //จำนวนผู้ให้บริการ
if ($in_pt != "0" || $move_pt != "0") {
	$los = $patient_day_pt / ($in_pt + $move_pt); //LOS
}
//รวมย่อย
$sum_on_pt += $on_pt;
$sum_on_nb += $on_nb;
$sum_in_pt += $in_pt;
$sum_in_nb += $in_nb;
$sum_move_pt += $move_pt;
$sum_move_nb += $move_nb;
$sum_home_pt += $home_pt;
$sum_home_nb += $home_nb;
$sum_move_b_pt += $move_b_pt;
$sum_move_b_nb += $move_b_nb;
$sum_send_pt += $send_pt;
$sum_send_nb += $send_nb;
$sum_dead_pt += $dead_pt;
$sum_dead_nb += $dead_nb;
$sum_non_voluntary_pt += $non_voluntary_pt;
$sum_non_voluntary_nb += $non_voluntary_nb;
$total_paid_pt += $sum_paid_pt;
$total_paid_nb += $sum_paid_nb;
$total_pt += $result_pt;
$total_nb += $result_nb;
$sum_ad_pt += $ad_pt;
$sum_ad_nb += $ad_nb;
$sum_patient_day_pt += $patient_day_pt;
$sum_patient_day_nb += $patient_day_nb;
$sum_patient_type4 += $patient_type4;
$sum_patient_type3 += $patient_type3;
$sum_patient_type2 += $patient_type2;
$sum_patient_type1 += $patient_type1;
$sum_bed2 += $amount_bed;
if ($rw1['ward'] != "12" && $rw1['ward'] != "13" && $rw1['ward'] != "16") {
	$sum_bed += $amount_bed;
}
$sum_em_hn += $em_hn;
$sum_em_rn += $em_rn;
$sum_em_tn += $em_tn;
$sum_em_pn += $em_pn;
$sum_em_aid += $em_aid;
$sum_begin_patient += $begin_patient;
$sum_end_patient += $end_patient;
?>
      <tr>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $rw1['shortname']; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $in_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $in_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $move_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $move_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $home_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $home_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $move_b_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $move_b_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $send_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $send_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $dead_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $dead_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $non_voluntary_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $non_voluntary_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_paid_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_paid_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $result_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $result_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $ad_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $ad_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_type4; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_type3; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_type2; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_type1; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $amount_bed; ?></span></td>
        <?php if ($kk == 1) { ?>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $patient_day_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($bed_rate, 2); ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($bed_free, 2); ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($bed_paid_avg, 2); ?></span></td>
        <?php } //end $kk ?>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $em_hn; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $em_rn; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $em_tn; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $em_pn; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $em_aid; ?></span></td>
        <?php if ($kk == 1) { ?>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $hw_rn; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $hw_em; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $amount_sr; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $begin_patient; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $end_patient; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($los, 2); ?></span></td>
        <?php } //end $kk ?>
      </tr>
      <?php
} //end while group = 1
//$sum_avg_pt = $sum_patient_day_pt / $num_day; //รวมเฉลี่ยนอนรพ.(คน) PT
//$sum_avg_nb = $sum_patient_day_nb / $num_day; //รวมเฉลี่ยนอนรพ.(คน) NB
if ($sum_bed != "0") {
	$sum_bed_rate = ($total_pt * 100) / $sum_bed; //รวมอัตราการครองเตียง
	$sum_bed_paid_avg = $total_paid_pt / $sum_bed; //รวมผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง
}
if ($total_paid_pt != "") {
	$sum_bed_free = ($sum_bed -  $sum_patient_day_pt) / $total_paid_pt; //รวมช่วงเวลาว่างของเตียง
}
$sum_hw_rn = ($sum_em_hn + $sum_em_rn) * 8; //รวมชม.การทำงาน RN
$sum_hw_em = ($sum_em_hn + $sum_em_rn + $sum_em_tn + $sum_em_pn) * 8; //รวมชม.การทำงานบุคลากร
$sum_amount_sr = $sum_em_rn + $sum_em_tn + $sum_em_pn + $sum_em_aid; //รวมจำนวนผู้ให้บริการ
if ($sum_in_pt != "0" || $sum_move_pt != "0") {
	$sum_los = $sum_patient_day_pt / ($sum_in_pt + $sum_move_pt); //รวม LOS
}
?>
      <tr>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_on_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_on_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_in_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_in_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_move_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_move_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_home_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_home_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_move_b_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_move_b_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_send_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_send_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_dead_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_dead_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_non_voluntary_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_non_voluntary_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_paid_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_ad_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_ad_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_day_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_day_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_type4; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_type3; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_type2; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_type1; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_bed2; ?></span></td>
        <?php if ($kk == 1) { ?>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_day_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_patient_day_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sum_bed_rate, 2); ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sum_bed_free, 2); ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sum_bed_paid_avg, 2); ?></span></td>
        <?php } //end $kk ?>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_em_hn; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_em_rn; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_em_tn; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_em_pn; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_em_aid; ?></span></td>
        <?php if ($kk == 1) { ?>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_hw_rn; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_hw_em; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_amount_sr; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_begin_patient; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $sum_end_patient; ?></span></td>
        <td height="25" align="center" bgcolor="#CCCCCC" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sum_los, 2); ?></span></td>
        <?php } //end $kk ?>
      </tr>
      <?php
//ward group = 2
$sqlw1 = "SELECT ward, shortname FROM ward WHERE ward_group = '2' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
/*$sum_on_pt = 0; //รวมคงพยาบาล PT
$sum_on_nb = 0; //รวมคงพยาบาล NB
$sum_in_pt = 0; //รวมรับใหม่ PT
$sum_in_nb = 0; //รวมรับใหม่ NB
$sum_move_pt = 0; //รวมรับย้าย PT
$sum_move_nb = 0; //รวมรับย้าย NB
$sum_home_pt = 0; //รวมกลับบ้าน PT
$sum_home_nb = 0; //รวมกลับบ้าน NB
$sum_move_b_pt = 0; //รวมย้ายตึก PT
$sum_move_b_nb = 0; //รวมย้ายตึก PT
$sum_send_pt = 0; //รวมส่งต่อ PT
$sum_send_nb = 0; //รวมส่งต่อ NB
$sum_dead_pt = 0; //รวมตาย PT
$sum_dead_nb = 0; //รวมตาย NB
$sum_non_voluntary_pt = 0; //รวมไม่สมัครใจอยู่ PT
$sum_non_voluntary_nb = 0; //รวมไม่สมัครใจอยู่ NB
$total_paid_pt = 0; //รวมจำหน่าย PT
$total_paid_nb = 0; //รวมจำหน่าย NB
$total_pt = 0; //รวมคงเหลือ PT
$total_nb = 0; //รวมคงเหลือ NB
$sum_ad_pt = 0; //รวม AD PT
$sum_ad_nb = 0; //รวม AD NB
$sum_patient_day_pt = 0; //รวม patient_day PT
$sum_patient_day_nb = 0; //รวม patitent_day NB
$sum_patient_type4 = 0; //รวม patient_type4
$sum_patient_type3 = 0; //รวม patient_type3
$sum_patient_type2 = 0; //รวม patient_type2
$sum_patient_type1 = 0; //รวม patient_type1*/
$sum_bed2 = 0; //รวมเตียง
$sum_bed_rate = 0; //รวมอัตราการครองเตียง
$sum_bed_free = 0; //รวมช่วงเวลาว่างของเตียง
$sum_bed_paid_avg = 0; //รวมจำนวนผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง
/*$sum_em_hn = 0; //รวม em_hn
$sum_em_rn = 0; //รวม em_rn
$sum_em_tn = 0; //รวม em_tn
$sum_em_pn = 0; //รวม em_pn
$sum_em_aid = 0; //รวม em_aid*/
$sum_begin_patient = 0; //รวมผู้ป่วยต้นเดือน
$sum_end_patient = 0; //รวมผู้ป่วยปลายเดือน
$sum_los = 0; //รวม LOS
while ($rw1 = $resultw1->fetch_array()) {
$sql = "SELECT data_all.on_pt, data_all.on_nb, data_all.wage_type_id, wage_type.wage_type_names, data_all.in_pt, data_all.in_nb, data_all.move_pt, data_all.move_nb, data_all.home_pt, data_all.home_nb, data_all.move_b_pt, data_all.move_b_nb, data_all.send_pt, data_all.send_nb, data_all.dead_pt, data_all.dead_nb, data_all.non_voluntary_pt, data_all.non_voluntary_nb, data_all.ad_pt, data_all.ad_nb, data_all.patient_type4, data_all.patient_type3, data_all.patient_type2, data_all.patient_type1, data_all.amount_bed, data_all.em_hn, data_all.em_rn, data_all.em_tn, data_all.em_pn, data_all.em_aid FROM data_all LEFT OUTER JOIN wage_type ON data_all.wage_type_id = wage_type.wage_type_id";
if ($type_search == "m") { //ตามเดือน
	$sql .= " WHERE MID(data_all.idate, 1, 4) = '$yearsearch' AND MID(idate, 6, 2) = '$month1'";
}
if ($type_search == "r") { //ตามช่วงเดือน
	$sql .= " WHERE MID(replace(idate, '-', ''), 1, 6) BETWEEN '$ymsearch2' AND '$ymsearch3'";
}
$sql .= "  AND data_all.ward = '$rw1[ward]'";
if ($i_status != "all") {
	$sql .= " AND data_all.i_status = '$i_status'";
}
$sql .= " ORDER BY data_all.idate";
$result = $conn->query($sql);
$on_pt = 0; //คงพยาบาล PT เฉพาะเวรดึก
$on_nb = 0; //คงพยาบาล NB เฉพาะเวรดึก
$in_pt = 0; //รับใหม่ PT
$in_nb = 0; //รับใหม่ NB
$move_pt = 0; //รับย้าย PT
$move_nb = 0; //รับย้าย NB
$home_pt = 0; //กลับบ้าน PT
$home_nb = 0; //กลับบ้าน NB
$move_b_pt = 0; //ย้ายตึก PT
$move_b_nb = 0; //ย้ายตึก NB
$send_pt = 0; //ส่งต่อ PT
$send_nb = 0; //ส่งต่อ NB
$dead_pt = 0; //ตาย PT
$dead_nb = 0; //ตาย NB
$non_voluntary_pt = 0; //ไม่สมัครใจอยู่ PT
$non_voluntary_nb = 0; //ไม่สมัครใจอยู่ NB
$ad_pt = 0; //A&D PT
$ad_nb = 0; //A&D NB
$patient_type4 = 0; //patient_type4
$patient_type3 = 0; //patient_type3
$patient_type2 = 0; //patient_type2
$patient_type1 = 0; //patient_type1
$amount_bed = 0; //จำนวนเตียง
$avg_pt = 0; //เฉลี่ยนอนรพ.(คน) PT
$avg_nb = 0; //เฉลี่ยนอนรพ.(คน) NB
$bed_rate = 0; //อัตราการครองเตียง
$bed_free = 0; //ช่วงเวลาว่างของเตียง
$bed_paid_avg = 0; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
$em_hn = 0; //รวม จนท. HN
$em_rn = 0; //รวม จนท. RN
$em_tn = 0; //รวม จนท. TN
$em_pn = 0; //รวม จนท. PN
$em_aid = 0; //รวม จนท. AID
$hw_rn = 0; //ผลรวมชม.การทำงาน RN
$hw_p = 0; //ผลรวมชม.การทำงานบุคลากร
$amount_sr = 0; //จำนวนผู้ให้บริการ
$begin_patient = 0; //จำนวนผู้ป่วยต้นเดือน
$end_patient = 0; //ผู้ป่วยยกไป
$los = 0; //LOS
$i = 1;
while ($r = $result->fetch_array()) {
	if ($r['wage_type_id'] == "1") { //เวรดึก
		$on_pt += $r['on_pt'];
		$on_nb += $r['on_nb'];
	}
	if ($i == 1) {
		$begin_patient = $r['on_pt']; //ผู้ป่วยต้นเดือน
	}
	$end_patient = ($r['on_pt'] + $r['in_pt'] + $r['move_pt']) - ($r['home_pt'] + $r['move_b_pt'] + $r['send_pt'] + $r['dead_pt'] + $r['non_voluntary_pt']); //ผู้ป่วยยกไป
	//ผลรวม
	$in_pt += $r['in_pt'];
	$in_nb += $r['in_nb'];
	$move_pt += $r['move_pt'];
	$move_nb += $r['move_nb'];
	$home_pt += $r['home_pt'];
	$home_nb += $r['home_nb'];
	$move_b_pt += $r['move_b_pt'];
	$move_b_nb += $r['move_b_nb'];
	$send_pt += $r['send_pt'];
	$send_nb += $r['send_nb'];
	$dead_pt += $r['dead_pt'];
	$dead_nb += $r['dead_nb'];
	$non_voluntary_pt += $r['non_voluntary_pt'];
	$non_voluntary_nb += $r['non_voluntary_nb'];
	$ad_pt += $r['ad_pt'];
	$ad_nb += $r['ad_nb'];
	$patient_type4 += $r['patient_type4'];
	$patient_type3 += $r['patient_type3'];
	$patient_type2 += $r['patient_type2'];
	$patient_type1 += $r['patient_type1'];
	$amount_bed = $r['amount_bed'];
	$em_hn += $r['em_hn'];
	$em_rn += $r['em_rn'];
	$em_tn += $r['em_tn'];
	$em_pn += $r['em_pn'];
	$em_aid += $r['em_aid'];
	$i++;
} //end while
$sum_paid_pt = $home_pt + $move_b_pt + $send_pt + $dead_pt + $non_voluntary_pt; //รวมจำหน่วย PT รายแถว
$sum_paid_nb = $home_nb + $move_b_bn + $send_nb + $dead_nb + $non_voluntary_nb; //รวมจำหน่าย NB รายแถว
$result_pt = ($on_pt + $in_pt + $move_pt) - $sum_paid_pt; //คงเหลือ PT
$result_nb = ($on_nb + $in_nb + $move_nb) - $sum_paid_nb; //คงเหลือ NB
$patient_day_pt = $result_pt + $ad_pt; //patient_day_pt
$patient_day_nb = $result_nb + $ad_nb; //patient_day_nb
if ($patient_day_pt != "0") {
	//$avg_pt = $patient_day_pt / $num_day; //เฉลี่ยนอนรพ.(คน) PT
}
if ($patient_day_nb != "0") {
	//$avg_nb = $patient_day_nb / $num_day; //เฉลี่ยนอนรถ.(คน) NB
}
if ($amount_bed != "0") {
	$bed_rate = ($avg_pt * 100) / $amount_bed; //อัตราการครองเตียง
	$bed_paid_avg = $sum_paid_pt / $amount_bed; //ผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง(คน)
}
if ($sum_paid_pt != 0) {
 $bed_free = (($amount_bed * $num_day) - $patient_day_pt) / $sum_paid_pt; //ช่วงเวลาว่างของเตียง
}
$hw_rn = ($em_hn + $em_rn) * 8; //ผลรวมชม.การทำงาน RN
$hw_em = ($em_hn + $em_rn + $em_tn + $em_pn) * 8; //ผลรวมชม.การทำงานบุคลากร
$amount_sr = $em_rn + $em_tn + $em_pn + $em_aid; //จำนวนผู้ให้บริการ
if ($in_pt != "0" || $move_pt != "0") {
	$los = $patient_day_pt / ($in_pt + $move_pt); //LOS
}
//รวมย่อย
$sum_on_pt += $on_pt;
$sum_on_nb += $on_nb;
$sum_in_pt += $in_pt;
$sum_in_nb += $in_nb;
$sum_move_pt += $move_pt;
$sum_move_nb += $move_nb;
$sum_home_pt += $home_pt;
$sum_home_nb += $home_nb;
$sum_move_b_pt += $move_b_pt;
$sum_move_b_nb += $move_b_nb;
$sum_send_pt += $send_pt;
$sum_send_nb += $send_nb;
$sum_dead_pt += $dead_pt;
$sum_dead_nb += $dead_nb;
$sum_non_voluntary_pt += $non_voluntary_pt;
$sum_non_voluntary_nb += $non_voluntary_nb;
$total_paid_pt += $sum_paid_pt;
$total_paid_nb += $sum_paid_nb;
$total_pt += $result_pt;
$total_nb += $result_nb;
$sum_ad_pt += $ad_pt;
$sum_ad_nb += $ad_nb;
$sum_patient_day_pt += $patient_day_pt;
$sum_patient_day_nb += $patient_day_nb;
$sum_patient_type4 += $patient_type4;
$sum_patient_type3 += $patient_type3;
$sum_patient_type2 += $patient_type2;
$sum_patient_type1 += $patient_type1;
$sum_bed2 += $amount_bed;
$sum_em_hn += $em_hn;
$sum_em_rn += $em_rn;
$sum_em_tn += $em_tn;
$sum_em_pn += $em_pn;
$sum_em_aid += $em_aid;
$sum_begin_patient += $begin_patient;
$sum_end_patient += $end_patient;
?>
      <?php
} //end while group = 2
$sum_bed2 += $sum_bed; //รวมเตียง ICU + ห้องคลอด
//$sum_avg_pt = $sum_patient_day_pt / $num_day; //รวมเฉลี่ยนอนรพ.(คน) PT
//$sum_avg_nb = $sum_patient_day_nb / $num_day; //รวมเฉลี่ยนอนรพ.(คน) NB
if ($sum_bed != "0") {
	$sum_bed_rate = ($sum_avg_pt * 100) / $sum_bed; //รวมอัตราการครองเตียง
	$sum_bed_paid_avg = $total_paid_pt / $sum_bed2; //รวมผู้ป่วยจำหน่ายเฉลี่ยต่อเตียง
}
if ($total_paid_pt != "") {
	$sum_bed_free = (($sum_bed2 * $num_day) -  $sum_patient_day_pt) / $total_paid_pt; //รวมช่วงเวลาว่างของเตียง
}
$sum_hw_rn = ($sum_em_hn + $sum_em_rn) * 8; //รวมชม.การทำงาน RN
$sum_hw_em = ($sum_em_hn + $sum_em_rn + $sum_em_tn + $sum_em_pn) * 8; //รวมชม.การทำงานบุคลากร
$sum_amount_sr = $sum_em_rn + $sum_em_tn + $sum_em_pn + $sum_em_aid; //รวมจำนวนผู้ให้บริการ
if ($sum_in_pt != "0" || $sum_move_pt != "0") {
	$sum_los = $sum_patient_day_pt / ($sum_in_pt + $sum_move_pt); //รวม LOS
}
?>
    </table></td>
  </tr>
</table>
</body>
</html>