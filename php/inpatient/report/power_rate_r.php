<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="power-rate.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>การผสมผสานอัตรากำลัง :: Report</title>
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
    <td height="25" align="left" class="tHead">การผสมผสานอัตรากำลัง ปีงบประมาณ <?php echo $year1; ?></td>
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
				$sum_rn = 0; //รวมการทำงาน RN ทั้งวอร์ดในปีงบประมาณ
				$sum_hour_em = 0; //รวมการทำงานทั้งหมดของทุกเดือน
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					$sqlrn = "SELECT SUM(em_hn) AS em_hn, SUM(em_rn) AS em_rn, SUM(em_tn) AS em_tn, SUM(em_pn) AS em_pn FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlrn .= " AND i_status = '$i_status'";
					}
					$resultrn = $conn->query($sqlrn);
					$rrn = $resultrn->fetch_array();
					//ผลรวมชั่วโมงการทำงานของ RN ใน 1 เดือน
					$rn = $rrn['em_hn'] + $rrn['em_rn'];
					$sum_rn += $rn;
					//ผลรวมชั่วโมงการทำงานของบุคลากรการพยาบาลทั้งหมดในเดือน
					$total_hour_em = $rrn['em_hn'] + $rrn['em_rn'] + $rrn['em_tn'] + $rrn['em_pn'];
					$sum_hour_em += $total_hour_em;
					$power_rate = 0; //อัตรากำลัง
					if ($total_hour_em != "0") {
						$power_rate = ($rn / $total_hour_em) * 100;
					}
					$sum_power_rate = 0; //รวมอัตรากำลัง
					if ($sum_hour_em != 0) {
						$sum_power_rate = ($sum_rn / $sum_hour_em) * 100;
					}
				?>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($power_rate, 2); ?></span></td>
                <?php } //end while month ?>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sum_power_rate, 2); ?></span></td>
              </tr>
              <?php } //end while ward ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
                <?php
				//////////////////////////////////////////////////////////รวมในปีงบประมาณ///////////////////////////////////////////////////////////////
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$sum_rn = 0; //รวมการทำงาน RN ทั้งวอร์ดในปีงบประมาณ
				$sum_hour_em = 0; //รวมการทำงานทั้งหมดของทุกเดือน
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					$sqlrn = "SELECT SUM(em_hn) AS em_hn, SUM(em_rn) AS em_rn, SUM(em_tn) AS em_tn, SUM(em_pn) AS em_pn FROM data_all WHERE idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlrn .= " AND i_status = '$i_status'";
					}
					$resultrn = $conn->query($sqlrn);
					$rrn = $resultrn->fetch_array();
					//ผลรวมชั่วโมงการทำงานของ RN ใน 1 เดือน
					$rn = $rrn['em_hn'] + $rrn['em_rn'];
					$sum_rn += $rn;
					//ผลรวมชั่วโมงการทำงานของบุคลากรการพยาบาลทั้งหมดในเดือน
					$total_hour_em = $rrn['em_hn'] + $rrn['em_rn'] + $rrn['em_tn'] + $rrn['em_pn'];
					$sum_hour_em += $total_hour_em;
					$power_rate = 0; //อัตรากำลัง
					if ($total_hour_em != "0") {
						$power_rate = ($rn / $total_hour_em) * 100;
					}
					$sum_power_rate = 0; //รวมอัตรากำลัง
					if ($sum_hour_em != 0) {
						$sum_power_rate = ($sum_rn / $sum_hour_em) * 100;
					}
				?>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($power_rate, 2); ?></span></td>
                <?php } //end while month ?>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo number_format($sum_power_rate, 2); ?></span></td>
              </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>