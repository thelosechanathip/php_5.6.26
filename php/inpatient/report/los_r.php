<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="los.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOS :: Report</title>
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
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" class="tHead">LOS ประจำปีงบประมาณ <?php echo $year1; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr class="tData">
                <td width="92" height="25" align="center" bgcolor="#FFDBCA">ตึก</td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {
				?>
                <td width="50" height="25" align="center" bgcolor="#CCFFE6"><?php
                echo $rm['month_sname'];
				echo "<br>";
				if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
					echo substr(($year1 - 1), 2, 2);
				} else {
					echo substr($year1, 2, 2);
				}
				?></td>
                <?php } //end while month ?>
                <td width="100" height="25" align="center" bgcolor="#66FFB3">เฉลี่ย<br />
                  <?php echo substr($year1, 2, 2); ?><br /></td>
                </tr>
              <?php
$istart = ($year1 - 544)."10";
$ifinish = ($year1 - 543)."09";
//ward group = 1
$sqlw1 = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
while ($rw1 = $resultw1->fetch_array()) {
	//หาจำนวนเดือนที่มีข้อมูลเพื่อนำมาเป็นตัวหารในการหาค่าเฉลี่ยในปีงบประมาณ
	$sqlc = "SELECT COUNT(DISTINCT(MID(idate, 1, 7))) FROM data_all WHERE ward = '$rw1[ward]' AND REPLACE(MID(idate, 1, 7), '-', '') >= $istart AND REPLACE(MID(idate, 1, 7), '-', '') <= $ifinish";
	if ($i_status != "all") {
		$sqlc .= " AND i_status = '$i_status'";
	}
	$resultc = $conn->query($sqlc);
	$rc = $resultc->fetch_array();
	$num_month = $rc[0];
?>
              <tr class="tData">
                <td height="25" align="center"><?php echo $rw1['shortname']; ?></td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$sum_los = 0; //รวม
				$avg_los = 0; //เฉลี่ย
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					//หาค่า LOS จากสูตร patient day / (ยกมา + รับใหม่ + รับย้าย)
					$sqlp = "SELECT on_pt, wage_type_id, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt, idate FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlp .= " AND i_status = '$i_status'";
					}
					$resultp = $conn->query($sqlp);
					$on_pt = 0; //คงพยาบาล PT เฉพาะเวรดึก
					$in_pt = 0; //รับใหม่ PT
					$move_pt = 0; //รับย้าย PT
					$home_pt = 0; //กลับบ้าน PT
					$move_b_pt = 0; //ย้ายตึก PT
					$send_pt = 0; //ส่งต่อ PT
					$dead_pt = 0; //ตาย PT
					$non_voluntary_pt = 0; //ไม่สมัครใจอยู่ PT
					$ad_pt = 0; //A&D PT
					$los = 0; //los
					while ($rp = $resultp->fetch_array()) {
						if ($rp['wage_type_id'] == "1") { //เวรดึก
							$on_pt += $rp['on_pt'];
							if ($rp['idate'] == ($likedate."-01")) {
								$take_pt = $rp['on_pt']; //คงพยาบาลยกมา เวรดึก วันที่ 1 ของเดือน
							}
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
					if ($in_pt != "0" || $move_pt != "0") {
						$los = $patient_day / ($take_pt + $in_pt + $move_pt); //LOS
						$sum_los += $los;
					}
					if ($num_month != "0") {
						$avg_los = $sum_los / $num_month; //เฉลี่ยในปีงบประมาณ
					}
				?>
                <td height="25" align="center"><?php if ($los != "0") { echo number_format($los, 2); } ?></td>
                <?php } //end while month ?>
                <td height="25" align="center"><?php echo number_format($avg_los, 2); ?></td>
        </tr>
              <?php } //end while group 1 ?>
              <tr class="tData">
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
                <?php
				//////////////////////////////////////////////////////////รวมในปีงบประมาณ///////////////////////////////////////////////////////////////
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
				$sum_los = 0; //รวม
				$avg_los = 0; //เฉลี่ย
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					//หายอดยกมาของทุกวอร์ด
					$sum_take_pt = 0; //รวมยอดยกมา
					$d1 = $likedate."-01";
					$sqlp = "SELECT SUM(on_pt) AS c1 FROM data_all WHERE idate = '$d1' AND wage_type_id = 1";
					if ($i_status != "all") {
						$sqlp .= " AND i_status = '$i_status'";
					}
					$resultp = $conn->query($sqlp);
					$rp = $resultp->fetch_row();
					$sum_take_pt = $rp[0];
					//หาค่า LOS จากสูตร patient day / (ยกมา + รับใหม่ + รับย้าย)
					$sqlp = "SELECT on_pt, wage_type_id, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt FROM data_all WHERE idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlp .= " AND i_status = '$i_status'";
					}
					$resultp = $conn->query($sqlp);
					$on_pt = 0; //คงพยาบาล PT เฉพาะเวรดึก
					$in_pt = 0; //รับใหม่ PT
					$move_pt = 0; //รับย้าย PT
					$home_pt = 0; //กลับบ้าน PT
					$move_b_pt = 0; //ย้ายตึก PT
					$send_pt = 0; //ส่งต่อ PT
					$dead_pt = 0; //ตาย PT
					$non_voluntary_pt = 0; //ไม่สมัครใจอยู่ PT
					$ad_pt = 0; //A&D PT
					$los = 0; //los
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
					} //end while data
					$sum_paid_pt = $home_pt + $move_b_pt + $send_pt + $dead_pt + $non_voluntary_pt; //รวมจำหน่วย PT รายแถว
					$result_pt = ($on_pt + $in_pt + $move_pt) - $sum_paid_pt; //คงเหลือ PT
					$patient_day = $result_pt + $ad_pt; //patient_day_pt
					if ($in_pt != "0" || $move_pt != "0") {
						$los = $patient_day / ($sum_take_pt + $in_pt + $move_pt); //LOS
						$sum_los += $los;
					}
					if ($num_month != "0") {
						$avg_los = $sum_los / $num_month; //เฉลี่ยในปีงบประมาณ
					}
				?>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php if ($los != "0") { echo number_format($los, 2); } ?></td>
                <?php } //end while month ?>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo number_format($avg_los, 2); ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
</table>
</body>
</html>