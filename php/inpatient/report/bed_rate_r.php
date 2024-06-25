<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="bed-rate.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>อัตราการครองเตียง :: Report</title>
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
$year1= $_GET['year1'];
$i_status = $_GET['i_status'];
include "../connect.php";
include "../myclass.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="left" class="tHead">รายงานอัตราการครองเตียงประจำปีงบประมาณ <?php echo $year1; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="70" height="25" align="center" bgcolor="#FFDBCA" class="tData">ตึก</td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {
				?>
                <td width="50" height="25" align="center" bgcolor="#CCFFE6" class="tData"><?php
                echo $rm['month_sname'];
				echo "<br>";
				if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
					echo substr(($year1 - 1), 2, 2);
				} else {
					echo substr($year1, 2, 2);
				}
				?></td>
                <?php } //end while month ?>
                <td width="60" height="25" align="center" bgcolor="#66FFB3" class="tData">ปีงบ<br />
                  <?php echo substr($year1, 2, 2); ?><br /></td>
                <td width="60" align="center" bgcolor="#66FFB3" class="tData">ปีงบ<br /><?php echo substr(($year1 - 1), 2, 2); ?></td>
              </tr>
              <?php
$istart = ($year1 - 544)."10";
$ifinish = ($year1 - 543)."09";
$sqlw1 = "SELECT ward, shortname, ward_group FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
$amount_ward = 0; //จำนวนวอร์ดทั้งหมด
while ($rw1 = $resultw1->fetch_array()) {
	$amount_ward++;
	//หาจำนวนเดือนที่มีข้อมูลเพื่อนำมาเป็นตัวหารในการหาค่าเฉลี่ยในปีงบประมาณ
	$sqlc = "SELECT COUNT(DISTINCT(MID(idate, 1, 7))) FROM data_all WHERE ward = '$rw1[ward]' AND REPLACE(MID(idate, 1, 7), '-', '') >= $istart AND REPLACE(MID(idate, 1, 7), '-', '') <= $ifinish";
	if ($i_status != "all") {
		$sqlc .= " AND i_status = '$i_status'";
	}
	$resultc = $conn->query($sqlc);
	$rc = $resultc->fetch_array();
	$num_month = $rc[0];
?>
              <tr onmouseover=this.style.backgroundColor="#B9D5FF" onmouseout=this.style.backgroundColor="">
                <td height="25" align="center" class="tData"><?php echo $rw1['shortname']; ?></td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$total_bed_rate = 0; //รวมการครองเตียงทั้งปีเพื่อนำไปหาค่าเฉลี่ย
				$bed_rate_y1 = 0; //เฉลี่ยการครองเตียงในปีที่เลือก
				$sum_all_record = 0; //รวมจำนวนข้อมูลที่ต้องกรอกในปี
				$sum_record = 0; //รวมจำนวนข้อมูลที่กรอกทั้งปี
				while ($rm = $resultm->fetch_array()) {
					//$num_day = cal_days_in_month(CAL_GREGORIAN, $rm['month_id'], ($year1 - 543));
					$num_day = MonthInDays($rm['month_id'], ($year1 - 543));
					$num_all_record = $num_day * 3; //รวมจำนวนข้อมูลที่ต้องกรอกในเดือน
					$sum_all_record += $num_all_record; //รวมจำนวนข้อมูลที่ต้องกรอกในปี
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					//หาค่า patient day
					$sqlp = "SELECT on_pt, wage_type_id, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt, amount_bed FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlp .= " AND i_status = '$i_status'";
					}
					$sqlp .= " ORDER BY idate, wage_type_id";
					$resultp = $conn->query($sqlp);
					$num_record = $resultp->num_rows; //รวมจำนวนข้อมูลที่กรอกทั้งเดือน
					$sum_record += $num_record; //รวมจำนวนข้อมูลที่กรอกทั้งปี
					$on_pt = 0; //คงพยาบาล PT เฉพาะเวรดึก
					$in_pt = 0; //รับใหม่ PT
					$move_pt = 0; //รับย้าย PT
					$home_pt = 0; //กลับบ้าน PT
					$move_b_pt = 0; //ย้ายตึก PT
					$send_pt = 0; //ส่งต่อ PT
					$dead_pt = 0; //ตาย PT
					$non_voluntary_pt = 0; //ไม่สมัครใจอยู่ PT
					$ad_pt = 0; //A&D PT
					$avg_sleep = 0; //เฉลี่ยนอน รพ.
					$amount_bed = 0; //จำนวนเตียง
					$bed_rate = 0; //อัตราการครองเตียง
					while ($rp = $resultp->fetch_array()) {
						if ($rp['wage_type_id'] == "1") { //เวรดึก
							$on_pt += $rp['on_pt'];
						}
						//ผลรวม
						$in_pt += $rp['in_pt'];
						$move_pt += $rp['move_pt'];
						$home_pt += $rp['home_pt'];
						$move_b_pt += $rp['move_b_pt'];
						$send_pt += $rp['send_pt'];
						$dead_pt += $rp['dead_pt'];
						$non_voluntary_pt += $rp['non_voluntary_pt'];
						$ad_pt += $rp['ad_pt'];
						$amount_bed = $rp['amount_bed'];
					} //end while
					$sum_paid_pt = $home_pt + $move_b_pt + $send_pt + $dead_pt + $non_voluntary_pt; //รวมจำหน่วย PT รายแถว
					$result_pt = ($on_pt + $in_pt + $move_pt) - $sum_paid_pt; //คงเหลือ PT
					$patient_day = $result_pt + $ad_pt; //patient_day_pt
					if ($patient_day != "0") { //เฉลี่ยนอน รพ.
						$avg_sleep = $patient_day / $num_day;
					}
					if ($amount_bed != "0") {
						$bed_rate = ($avg_sleep * 100) / $amount_bed; //อัตราการครองเตียง
					}
					$total_bed_rate += $bed_rate; //รวมการครองเตียงทั้งปี
				?>
                <td height="25" align="center" class="tData">
                <?php
				if ($num_record == $num_all_record) {
					if ($bed_rate != "0") {
						echo number_format($bed_rate, 2);
					}
				} ?>
                </td>
                <?php } //end while month ?>
                <?php
				//เฉลี่ยในปีงบประมาณที่เลือก
				if ($num_month != "0") {
					$bed_rate_y1 = $total_bed_rate / $num_month; //เฉลี่ยในปีงบประมาณ
				}
				?>
                <td height="25" align="center" class="tData">
                <?php
                if ($sum_record == $sum_all_record) {
					if ($bed_rate_y1 != "0") {
						echo number_format($bed_rate_y1, 2);
					}
				} ?>
                </td>
                <td height="25" align="center" class="tData">
                <?php
                ////////////////////////////////////////////////////////ข้อมูลก่อนปีงบประมาณที่เลือก/////////////////////////////////////////////////////////////////////////////////////////
				$istart2 = ($year1 - 545)."10";
				$ifinish2 = ($year1 - 544)."09";
				//หาจำนวนเดือนที่มีข้อมูลเพื่อนำมาเป็นตัวหารในการหาค่าเฉลี่ยในปีงบประมาณ
				$sqlc2 = "SELECT COUNT(DISTINCT(MID(idate, 1, 7))) FROM data_all WHERE ward = '$rw1[ward]' AND REPLACE(MID(idate, 1, 7), '-', '') >= $istart2 AND REPLACE(MID(idate, 1, 7), '-', '') <= $ifinish2";
				if ($i_status != "all") {
					$sqlc2 .= " AND i_status = '$i_status'";
				}
				$resultc2 = $conn->query($sqlc2);
				$rc2 = $resultc2->fetch_array();
				$num_month2 = $rc2[0];
				$sqlm2 = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm2 = $conn->query($sqlm2);
				$total_bed_rate2 = 0; //รวมการครองเตียงทั้งปีเพื่อนำไปหาค่าเฉลี่ย
				$bed_rate_y2 = 0; //เฉลี่ยการครองเตียงก่อนปีที่เลือก
				$num_all_record2 = 0; //รวมจำนวนข้อมูลที่ต้องกรอกทั้งหมดของวอร์ด
				$num_record2 = 0; //จำนวนข้อมูลที่กรอกทั้งปี
				while ($rm2 = $resultm2->fetch_array()) {
					//$num_day2 = cal_days_in_month(CAL_GREGORIAN, $rm2['month_id'], ($year1 - 544));
					$num_day2 = MonthInDays($rm2['month_id'], ($year1 - 544));
					$num_all_record2 += $num_day2 * 3; //รวมจำนวนข้อมูลที่ต้องกรอกทั้งหมดของวอร์ด
					$likedate2 = ($year1 - 544)."-".$rm2['month_id'];
					if ($rm2['month_id'] == "10" || $rm2['month_id'] == "11" || $rm2['month_id'] == "12") {
						$likedate2 = ($year1 - 545)."-".$rm2['month_id'];
					}
					//หาค่า patient day
					$sqlp2 = "SELECT on_pt, wage_type_id, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt, amount_bed FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate2%'";
					if ($i_status != "all") {
						$sqlp2 .= " AND i_status = '$i_status'";
					}
					$sqlp2 .= " ORDER BY idate, wage_type_id";
					$resultp2 = $conn->query($sqlp2);
					$num_record2 += $resultp2->num_rows; //จำนวนข้อมูลที่กรอกทั้งปี
					$on_pt2 = 0;  //คงพยาบาลเฉพาะเวรดึก
					$in_pt2 = 0; //รับใหม่ PT
					$move_pt2 = 0; //รับย้าย PT
					$home_pt2 = 0; //กลับบ้าน PT
					$move_b_pt2 = 0; //ย้ายตึก PT
					$send_pt2 = 0; //ส่งต่อ PT
					$dead_pt2 = 0; //ตาย PT
					$non_voluntary_pt2 = 0; //ไม่สมัครใจอยู่ PT
					$ad_pt2 = 0; //A&D PT
					$avg_sleep2 = 0; //เฉลี่ยนอน รพ.
					$amount_bed2 = 0; //จำนวนเตียง
					$bed_rate2 = 0; //อัตราการครองเตียง
					while ($rp2 = $resultp2->fetch_array()) {
						if ($rp2['wage_type_id'] == "1") { //เวรดึก
							$on_pt2 += $rp2['on_pt'];
						}
						//ผลรวม
						$in_pt2 += $rp2['in_pt'];
						$move_pt2 += $rp2['move_pt'];
						$home_pt2 += $rp2['home_pt'];
						$move_b_pt2 += $rp2['move_b_pt'];
						$send_pt2 += $rp2['send_pt'];
						$dead_pt2 += $rp2['dead_pt'];
						$non_voluntary_pt2 += $rp2['non_voluntary_pt'];
						$ad_pt2 += $rp2['ad_pt'];
						$amount_bed2 = $rp2['amount_bed'];
					} //end while data
					$sum_paid_pt2 = $home_pt2 + $move_b_pt2 + $send_pt2 + $dead_pt2 + $non_voluntary_pt2; //รวมจำหน่วย PT รายแถว
					$result_pt2 = ($on_pt2 + $in_pt2 + $move_pt2) - $sum_paid_pt2; //คงเหลือ PT
					$patient_day2 = $result_pt2 + $ad_pt2; //patient_day_pt
					if ($patient_day2 != "0") { //เฉลี่ยนอน รพ.
						$avg_sleep2 = $patient_day2 / $num_day2;
					}
					if ($amount_bed2 != "0") {
						$bed_rate2 = ($avg_sleep2 * 100) / $amount_bed2; //อัตราการครองเตียง
					}
					$total_bed_rate2 += $bed_rate2; //รวมการครองเตียงทั้งปี
				} //while month
				//เฉลี่ยก่อนปีงบประมาณที่เลือก
				if ($num_month2 != "0") {
					$bed_rate_y2 = $total_bed_rate2 / $num_month2; //เฉลี่ยก่อนปีงบประมาณที่เลือก
				}
				if ($num_record2 == $num_all_record2) {
					if ($bed_rate_y2 != "0") {
						echo number_format($bed_rate_y2, 2);
					}
				}
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				?>
                </td>
              </tr>
              <?php } //end while ward ?>
              <tr class="tData">
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
                <?php
//หาจำนวนเดือนที่มีข้อมูลเพื่อนำมาเป็นตัวหารในการหาค่าเฉลี่ยในปีงบประมาณ
$sqlc = "SELECT COUNT(DISTINCT(MID(idate, 1, 7))) FROM data_all WHERE REPLACE(MID(idate, 1, 7), '-', '') >= $istart AND REPLACE(MID(idate, 1, 7), '-', '') <= $ifinish";
if ($i_status != "all") {
	$sqlc .= " AND i_status = '$i_status'";
}
$resultc = $conn->query($sqlc);
$rc = $resultc->fetch_array();
$num_month = $rc[0];
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$total_bed_rate = 0; //รวมการครองเตียงทั้งปีเพื่อนำไปหาค่าเฉลี่ย
				$bed_rate_y1 = 0; //เฉลี่ยการครองเตียงในปีที่เลือก
				$sum_all_record = 0; //รวมจำนวนข้อมูลที่ต้องกรอกในปี
				$sum_record = 0; //รวมจำนวนข้อมูลที่กรอกทั้งปี
				while ($rm = $resultm->fetch_array()) {
					$num_all_record = 0; //รวมจำนวนข้อมูลที่ต้องกรอกในเดือน
					$num_record = 0; //รวมจำนวนข้อมูลที่กรอกทั้งเดือน
					//$num_day = cal_days_in_month(CAL_GREGORIAN, $rm['month_id'], ($year1 - 543));
					$num_day = MonthInDays($rm['month_id'], ($year1 - 543));
					$num_all_record += $num_day * 3 * $amount_ward; //รวมจำนวนข้อมูลที่ต้องกรอกในเดือน
					$sum_all_record += $num_all_record; //รวมจำนวนข้อมูลที่ต้องกรอกในปี
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					//หาค่า patient day
					$sqlp = "SELECT on_pt, wage_type_id, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt FROM data_all WHERE idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlp .= " AND i_status = '$i_status'";
					}
					$sqlp .= " ORDER BY idate, wage_type_id";
					$resultp = $conn->query($sqlp);
					$num_record += $resultp->num_rows; //รวมจำนวนข้อมูลที่กรอกทั้งเดือน
					$sum_record += $num_record; //รวมจำนวนข้อมูลที่กรอกทั้งปี
					$on_pt = 0; //คงพยาบาล PT เฉพาะเวรดึก
					$in_pt = 0; //รับใหม่ PT
					$move_pt = 0; //รับย้าย PT
					$home_pt = 0; //กลับบ้าน PT
					$move_b_pt = 0; //ย้ายตึก PT
					$send_pt = 0; //ส่งต่อ PT
					$dead_pt = 0; //ตาย PT
					$non_voluntary_pt = 0; //ไม่สมัครใจอยู่ PT
					$ad_pt = 0; //A&D PT
					$avg_sleep = 0; //เฉลี่ยนอน รพ.
					$bed_rate = 0; //อัตราการครองเตียง
					while ($rp = $resultp->fetch_array()) {
						if ($rp['wage_type_id'] == "1") { //เวรดึก
							$on_pt += $rp['on_pt'];
						}
						//ผลรวม
						$in_pt += $rp['in_pt'];
						$move_pt += $rp['move_pt'];
						$home_pt += $rp['home_pt'];
						$move_b_pt += $rp['move_b_pt'];
						$send_pt += $rp['send_pt'];
						$dead_pt += $rp['dead_pt'];
						$non_voluntary_pt += $rp['non_voluntary_pt'];
						$ad_pt += $rp['ad_pt'];
					} //end while
					$sum_paid_pt = $home_pt + $move_b_pt + $send_pt + $dead_pt + $non_voluntary_pt; //รวมจำหน่วย PT รายแถว
					$result_pt = ($on_pt + $in_pt + $move_pt) - $sum_paid_pt; //คงเหลือ PT
					$patient_day = $result_pt + $ad_pt; //patient_day_pt
					if ($patient_day != "0") { //เฉลี่ยนอน รพ.
						$avg_sleep = $patient_day / $num_day;
					}
					//หาจำนวนเตียง
					$total_bed = 0; //รวมเตียง ยกเว้น ICU + ห้องคลอด
					$sqlb = "SELECT amount_bed FROM data_all WHERE idate LIKE '$likedate%' AND ward NOT IN('12', '13', '16')";
					if ($i_status != "all") {
						$sqlb .= " AND i_status = '$i_status'";
					}
					$sqlb .= " GROUP BY ward ORDER BY idate, wage_type_id";
					$resultb = $conn->query($sqlb);
					while ($rb = $resultb->fetch_array()) {
						$total_bed += $rb[0];
					}
					if ($total_bed != "0") {
						$bed_rate = ($avg_sleep * 100) / $total_bed; //อัตราการครองเตียง
					}
					$total_bed_rate += $bed_rate; //รวมการครองเตียงทั้งปี
				?>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
				if ($num_record == $num_all_record) {
					if ($bed_rate != "0") {
						echo number_format($bed_rate, 2);
					}
				}?></td>
                <?php } //end while month ?>
                <?php
				//เฉลี่ยในปีงบประมาณที่เลือก
				if ($num_month != "0") {
					$bed_rate_y1 = $total_bed_rate / $num_month; //เฉลี่ยในปีงบประมาณ
				}
				?>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
                if ($sum_record == $sum_all_record) {
					if ($bed_rate_y1 != "0") {
						echo number_format($bed_rate_y1, 2);
					}
				} ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
                ////////////////////////////////////////////////////////////////รวมทั้งสิ้นก่อนปีงบประมาณที่เลือก////////////////////////////////////////////////////////////////////////////////////
				$sqlc2 = "SELECT COUNT(DISTINCT(MID(idate, 1, 7))) FROM data_all WHERE REPLACE(MID(idate, 1, 7), '-', '') >= $istart2 AND REPLACE(MID(idate, 1, 7), '-', '') <= $ifinish2";
				if ($i_status != "all") {
					$sqlc2 .= " AND i_status = '$i_status'";
				}
				$resultc2 = $conn->query($sqlc2);
				$rc2 = $resultc2->fetch_array();
				$num_month2 = $rc2[0];
				$sqlm2 = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm2 = $conn->query($sqlm2);
				$total_bed_rate2 = 0; //รวมการครองเตียงทั้งปีเพื่อนำไปหาค่าเฉลี่ย
				$bed_rate_y2 = 0; //เฉลี่ยการครองเตียงก่อนปีที่เลือก
				while ($rm2 = $resultm2->fetch_array()) {
					//$num_day2 = cal_days_in_month(CAL_GREGORIAN, $rm2['month_id'], ($year1 - 544));
					$num_day2 = MonthInDays($rm2['month_id'], ($year1 - 544));
					$sum_all_record2 += $num_day2 * 3 * $amount_ward; //รวมจำนวนข้อมูลที่ต้องกรอกทั้งหมด
					$likedate2 = ($year1 - 544)."-".$rm2['month_id'];
					if ($rm2['month_id'] == "10" || $rm2['month_id'] == "11" || $rm2['month_id'] == "12") {
						$likedate2 = ($year1 - 545)."-".$rm2['month_id'];
					}
					//หาค่า patient day
					$sqlp2 = "SELECT on_pt, wage_type_id, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt FROM data_all WHERE idate LIKE '$likedate2%'";
					if ($i_status != "all") {
						$sqlp2 .= " AND i_status = '$i_status'";
					}
					$sqlp2 .= " ORDER BY idate, wage_type_id";
					$resultp2 = $conn->query($sqlp2);
					$sum_record2 += $resultp2->num_rows; //รวมจำนวนที่กรอกทั้งปี
					$on_pt2 = 0; //คงพยาบาล PT เฉพาะเวรดึก
					$in_pt2 = 0; //รับใหม่ PT
					$move_pt2 = 0; //รับย้าย PT
					$home_pt2 = 0; //กลับบ้าน PT
					$move_b_pt2 = 0; //ย้ายตึก PT
					$send_pt2 = 0; //ส่งต่อ PT
					$dead_pt2 = 0; //ตาย PT
					$non_voluntary_pt2 = 0; //ไม่สมัครใจอยู่ PT
					$ad_pt2 = 0; //A&D PT
					$avg_sleep2 = 0; //เฉลี่ยนอน รพ.
					$bed_rate2 = 0; //อัตราการครองเตียง
					while ($rp2 = $resultp2->fetch_array()) {
						if ($rp2['wage_type_id'] == "1") { //เวรดึก
							$on_pt2 += $rp2['on_pt'];
						}
						//ผลรวม
						$in_pt2 += $rp2['in_pt'];
						$move_pt2 += $rp2['move_pt'];
						$home_pt2 += $rp2['home_pt'];
						$move_b_pt2 += $rp2['move_b_pt'];
						$send_pt2 += $rp2['send_pt'];
						$dead_pt2 += $rp2['dead_pt'];
						$non_voluntary_pt2 += $rp2['non_voluntary_pt'];
						$ad_pt2 += $rp2['ad_pt'];
					} //end while data
					$sum_paid_pt2 = $home_pt2 + $move_b_pt2 + $send_pt2 + $dead_pt2 + $non_voluntary_pt2; //รวมจำหน่วย PT รายแถว
					$result_pt2 = ($on_pt2 + $in_pt2 + $move_pt2) - $sum_paid_pt2; //คงเหลือ PT
					$patient_day2 = $result_pt2 + $ad_pt2; //patient_day_pt
					if ($patient_day2 != "0") { //เฉลี่ยนอน รพ.
						$avg_sleep2 = $patient_day2 / $num_day2;
					}
					//หาจำนวนเตียง
					$total_bed2 = 0; //รวมเตียง ยกเว้น ICU + ห้องคลอด
					$sqlb2 = "SELECT amount_bed FROM data_all WHERE idate LIKE '$likedate2%' AND ward NOT IN('12', '13', '16')";
					if ($i_status != "all") {
						$sqlb2 .= " AND i_status = '$i_status'";
					}
					$sqlb2 .= " GROUP BY ward ORDER BY idate, wage_type_id";
					$resultb2 = $conn->query($sqlb2);
					while ($rb2 = $resultb2->fetch_array()) {
						$total_bed2 += $rb2[0];
					}
					if ($total_bed2 != "0") {
						$bed_rate2 = ($avg_sleep2 * 100) / $total_bed2; //อัตราการครองเตียง
					}
					$total_bed_rate2 += $bed_rate2; //รวมการครองเตียงทั้งปี
				} //end while month
				if ($num_month2 != "0") {
					$bed_rate_y2 = $total_bed_rate2 / $num_month2; //เฉลี่ยในปีงบประมาณ
				}
				if ($sum_record2 == $sum_all_record2) {
					if ($bed_rate_y2 != "0") {
						echo number_format($bed_rate_y2, 2);
					}
				}
				/////////////////////////////////////////////////สิ้นสุดก่อนปีงบประมาณที่เลือก/////////////////////////////////////////////////////
				?></td>
          </tr>
			</table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>