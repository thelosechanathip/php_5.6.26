<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="hour.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>จำนวนชั่วโมงการพยาบาลต่อวันนอนในโรงพยาบาล :: Report</title>
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
    <td height="25" align="left" class="tHead">จำนวนชั่วโมงการพยาบาลต่อวันนอนในโรงพยาบาล ประจำปีงบประมาณ <?php echo $year1; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="800" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="85" height="25" align="center" bgcolor="#FFDBCA" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">ตึก</span></td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {
				?>
                <td width="54" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">
                <?php
                echo $rm['month_sname'];
				echo "<br>";
				if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
					echo substr(($year1 - 1), 2, 2);
				} else {
					echo substr($year1, 2, 2);
				}
				?>
                </span></td>
                <?php } //end while month ?>
                <td width="65" height="25" align="center" bgcolor="#66FFB3" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">รวม<br />
                <?php echo $year1; ?><br />
                </span></td>
              </tr>
              <?php
//ward
$sqlw1 = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
while ($rw1 = $resultw1->fetch_array()) {
?>
              <tr>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $rw1['shortname']; ?></span></td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$total_service = 0; //รวมจำนวนผู้ให้บริกาาร
				$total_patient_day = 0; //รวม patient_day
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					$sqlservice = "SELECT SUM(em_rn) AS em_rn, SUM(em_tn) AS em_tn, SUM(em_pn) AS em_pn, SUM(em_aid) AS em_aid FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlservice .= " AND i_status = '$i_status'";
					}
					$resultservice = $conn->query($sqlservice);
					$rservice = $resultservice->fetch_array();
					//จำนวนผู้ให้บริการ
					$sum_service = $rservice['em_rn'] + $rservice['em_tn'] + $rservice['em_pn'] + $rservice['em_aid'];
					$total_service += $sum_service;
					//หา patient day
					$sqlpd = "SELECT wage_type_id, on_pt, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlpd .= " AND i_status = '$i_status'";
					}
					$resultpd = $conn->query($sqlpd);
					$on_pt = 0;
					$in_pt = 0;
					$move_pt = 0;
					$home_pt = 0;
					$move_b_pt = 0;
					$send_pt = 0;
					$dead_pt = 0;
					$non_voluntary_pt = 0;
					$ad_pt = 0;
					$patient_day = 0;
					while ($rpd = $resultpd->fetch_array()) {
						if ($rpd['wage_type_id'] == "1") { //ถ้าเป็นเวรดึก
							$on_pt += $rpd['on_pt'];
						}
						$in_pt += $rpd['in_pt'];
						$move_pt += $rpd['move_pt'];
						$home_pt += $rpd['home_pt'];
						$move_b_pt += $rpd['move_b_pt'];
						$send_pt += $rpd['send_pt'];
						$dead_pt += $rpd['dead_pt'];
						$non_voluntary_pt += $rpd['non_voluntary_pt'];
						$ad_pt += $rpd['ad_pt'];
					} //end while patient day
					$patient_day = ($on_pt + $in_pt + $move_pt) - ($home_pt + $move_b_pt + $send_pt + $dead_pt + $non_voluntary_pt) + $ad_pt;
					$total_patient_day += $patient_day;
					$hour_sleep = 0; //ชั่วโมงการพยาบาลต่อวันนอน
					if ($patient_day != "0") {
						$hour_sleep = ($sum_service / $patient_day) * 7;
					}
					$total_hour_sleep = 0; //รวมชั่วโมงการพยาบาลต่อวันนอน
					if ($total_patient_day != "0") {
						$total_hour_sleep = ($total_service / $total_patient_day) * 7;
					}
				?>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($hour_sleep, 2); ?></span></td>
                <?php } //end while month ?>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_hour_sleep, 2); ?></span></td>
              </tr>
              <?php } //end while ward ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
                <?php
				//////////////////////////////////////////////////////////รวมในปีงบประมาณ///////////////////////////////////////////////////////////////
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$total_service = 0; //รวมจำนวนผู้ให้บริกาาร
				$total_patient_day = 0; //รวม patient_day
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					$sqlservice = "SELECT SUM(em_rn) AS em_rn, SUM(em_tn) AS em_tn, SUM(em_pn) AS em_pn, SUM(em_aid) AS em_aid FROM data_all WHERE idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlservice .= " AND i_status = '$i_status'";
					}
					$resultservice = $conn->query($sqlservice);
					$rservice = $resultservice->fetch_array();
					//จำนวนผู้ให้บริการ
					$sum_service = $rservice['em_rn'] + $rservice['em_tn'] + $rservice['em_pn'] + $rservice['em_aid'];
					$total_service += $sum_service;
					//หา patient day
					$sqlpd = "SELECT wage_type_id, on_pt, in_pt, move_pt, home_pt, move_b_pt, send_pt, dead_pt, non_voluntary_pt, ad_pt FROM data_all WHERE idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlpd .= " AND i_status = '$i_status'";
					}
					$resultpd = $conn->query($sqlpd);
					$on_pt = 0;
					$in_pt = 0;
					$move_pt = 0;
					$home_pt = 0;
					$move_b_pt = 0;
					$send_pt = 0;
					$dead_pt = 0;
					$non_voluntary_pt = 0;
					$ad_pt = 0;
					$patient_day = 0;
					while ($rpd = $resultpd->fetch_array()) {
						if ($rpd['wage_type_id'] == "1") { //ถ้าเป็นเวรดึก
							$on_pt += $rpd['on_pt'];
						}
						$in_pt += $rpd['in_pt'];
						$move_pt += $rpd['move_pt'];
						$home_pt += $rpd['home_pt'];
						$move_b_pt += $rpd['move_b_pt'];
						$send_pt += $rpd['send_pt'];
						$dead_pt += $rpd['dead_pt'];
						$non_voluntary_pt += $rpd['non_voluntary_pt'];
						$ad_pt += $rpd['ad_pt'];
					} //end while patient day
					$patient_day = ($on_pt + $in_pt + $move_pt) - ($home_pt + $move_b_pt + $send_pt + $dead_pt + $non_voluntary_pt) + $ad_pt;
					$total_patient_day += $patient_day;
					$hour_sleep = 0; //ชั่วโมงการพยาบาลต่อวันนอน
					if ($patient_day != "0") {
						$hour_sleep = ($sum_service / $patient_day) * 7;
					}
					$total_hour_sleep = 0; //รวมชั่วโมงการพยาบาลต่อวันนอน
					if ($total_patient_day != "0") {
						$total_hour_sleep = ($total_service / $total_patient_day) * 7;
					}
				?>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($hour_sleep, 2); ?></span></td>
                <?php } //end while month ?>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($total_hour_sleep, 2); ?></span></td>
              </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>