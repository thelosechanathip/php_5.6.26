<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="report-day.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานประจำวัน :: Report</title>
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
$ward= $_GET['ward'];
$dmy = $_GET['dmy'];
include "../myclass.php";
$idate2 = FormatDateDefault($dmy);
include "../connect.php";
$sqlw = "SELECT name FROM ward WHERE ward = '$ward'";
$resultw = $conn->query($sqlw);
$rw = $resultw->fetch_row();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="left" class="tHead">INPATIENT CENSUS AND INPATIENT SERVICE DAYS ประจำวันที่ <?php echo FormatDateFull($idate2); ?>&nbsp;<?php echo $rw[0]; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="1643" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="27" rowspan="3" align="center" bgcolor="#CCFFE6"  style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">วันที่</span></td>
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
        <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $dd[0]; ?></span></td>
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
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
</table>
</body>
</html>