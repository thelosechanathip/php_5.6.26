<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="bed-turn-overrate.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bed Turn Overrate :: Report</title>
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
    <td height="25" align="left" class="tHead">Bed turn over rate ประจำปีงบประมาณ <?php echo $year1; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="800" border="0" cellspacing="0" cellpadding="0">
              <tr class="tData">
                <td width="85" height="25" align="center" bgcolor="#FFDBCA" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;">ตึก</td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {
				?>
                <td width="41" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><?php
                echo $rm['month_sname'];
				echo "<br>";
				if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
					echo substr(($year1 - 1), 2, 2);
				} else {
					echo substr($year1, 2, 2);
				}
				?></td>
                <?php } //end while month ?>
                <td width="67" height="25" align="center" bgcolor="#66FFB3" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;">ปีงบ<br /><?php echo $year1; ?></td>
                <td width="65" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;">ปีงบ<br /><?php echo ($year1 - 1); ?></td>
                <td width="85" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;">เฉลี่ยต่อเดือน<br />
                  ปีงบ <?php echo ($year1 - 1); ?></td>
              </tr>
<?php
//ward group = 1
$sqlw1 = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
while ($rw1 = $resultw1->fetch_array()) {
?>
              <tr>
                <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><?php echo $rw1['shortname']; ?></td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$total_bto = 0; //รวมทั้งวอร์ดในปีงบประมาณ
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					//หาจำนวนเตียงในเดือน
					$sqlbed = "SELECT amount_bed FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlbed .= " AND i_status = '$i_status'";
					}
					$sqlbed .= " ORDER BY idate DESC, wage_type_id DESC LIMIT 0, 1";
					$resultbed = $conn->query($sqlbed);
					$rbed = $resultbed->fetch_row();
					$amount_bed = $rbed[0];
					//รวมจำหน่าย
					$sqlsp = "SELECT SUM(home_pt) AS home_pt, SUM(move_b_pt) AS move_b_pt, SUM(send_pt) AS send_pt, SUM(dead_pt) AS dead_pt, SUM(non_voluntary_pt) AS non_voluntary_pt FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlsp .= " AND i_status = '$i_status'";
					}
					$resultsp = $conn->query($sqlsp);
					$rsp = $resultsp->fetch_array();
					if ($amount_bed != "") {
						$bto = ($rsp['home_pt'] + $rsp['move_b_pt'] + $rsp['send_pt'] + $rsp['dead_pt'] + $rsp['non_voluntary_pt']) / $amount_bed;
						$total_bto += number_format($bto, 2);
					}
				?>
                <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php if ($amount_bed != "") { echo number_format($bto, 2); } ?></td>
                <?php } //end while month ?>
                <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format($total_bto, 2); ?></td>
                <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
                ////////////////////////////////////////////////ข้อมูลก่อนปีงบประมาณที่เลือก///////////////////////////////////////////////////////////
				$sqlm2 = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm2 = $conn->query($sqlm2);
				$total_bto2 = 0; //รวมทั้งวอร์ดในปีงบประมาณ
				while ($rm2 = $resultm2->fetch_array()) {
					$likedate2 = ($year1 - 544)."-".$rm2['month_id'];
					if ($rm2['month_id'] == "10" || $rm2['month_id'] == "11" || $rm2['month_id'] == "12") {
						$likedate2 = ($year1 - 545)."-".$rm2['month_id'];
					}
					//หาจำนวนเตียงในเดือน
					$sqlbed2 = "SELECT amount_bed FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate2%'";
					if ($i_status != "all") {
						$sqlbed2 .= " AND i_status = '$i_status'";
					}
					$sqlbed2 .= " ORDER BY idate DESC, wage_type_id DESC LIMIT 0, 1";
					$resultbed2 = $conn->query($sqlbed2);
					$rbed2 = $resultbed2->fetch_row();
					$amount_bed2 = $rbed2[0];
					//รวมจำหน่าย
					$sqlsp2 = "SELECT SUM(home_pt) AS home_pt, SUM(move_b_pt) AS move_b_pt, SUM(send_pt) AS send_pt, SUM(dead_pt) AS dead_pt, SUM(non_voluntary_pt) AS non_voluntary_pt FROM data_all WHERE ward = '$rw1[ward]' AND idate LIKE '$likedate2%'";
					if ($i_status != "all") {
						$sqlsp2 .= " AND i_status = '$i_status'";
					}
					$resultsp2 = $conn->query($sqlsp2);
					$rsp2 = $resultsp2->fetch_array();
					if ($amount_bed2 != "") {
						$bto2 = ($rsp2['home_pt'] + $rsp2['move_b_pt'] + $rsp2['send_pt'] + $rsp2['dead_pt'] + $rsp2['non_voluntary_pt']) / $amount_bed2;
						$total_bto2 += number_format($bto2, 2);
					}
				} //end month
				echo number_format($total_bto2, 2);
				?></td>
                <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
				$avg_bto2 = 0;
                if ($total_bto2 != "0") {
					$avg_bto2 = $total_bto2 / 12;
				}
				echo number_format($avg_bto2,  2);
				?></td>
        </tr>
<?php } //end while group 1 ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;">รวม</td>
                <?php
				//////////////////////////////////////////////////////////////////////รวมทั้งสิ้น/////////////////////////////////////////////////////////////////////////////
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				$total_bto = 0;
				while ($rm = $resultm->fetch_array()) {
					$likedate = ($year1 - 543)."-".$rm['month_id'];
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$likedate = ($year1 - 544)."-".$rm['month_id'];
					}
					//หาจำนวนเตียง
					$total_bed = 0; //รวมเตียง
					$sqlb = "SELECT amount_bed FROM data_all WHERE idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlb .= " AND i_status = '$i_status'";
					}
					$sqlb .= " GROUP BY ward ORDER BY idate, wage_type_id";
					$resultb = $conn->query($sqlb);
					while ($rb = $resultb->fetch_array()) {
						$total_bed += $rb[0];
					}
					//รวมจำหน่าย
					$sqlsp = "SELECT SUM(home_pt) AS home_pt, SUM(move_b_pt) AS move_b_pt, SUM(send_pt) AS send_pt, SUM(dead_pt) AS dead_pt, SUM(non_voluntary_pt) AS non_voluntary_pt FROM data_all WHERE idate LIKE '$likedate%'";
					if ($i_status != "all") {
						$sqlsp .= " AND i_status = '$i_status'";
					}
					$resultsp = $conn->query($sqlsp);
					$rsp = $resultsp->fetch_array();
					if ($total_bed != "0") {
						$bto = ($rsp['home_pt'] + $rsp['move_b_pt'] + $rsp['send_pt'] + $rsp['dead_pt'] + $rsp['non_voluntary_pt']) / $total_bed;
						$total_bto += number_format($bto, 2);
					}
				?>
                <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php if ($total_bed != "0") { echo number_format($bto, 2); } ?></td>
                <?php } //end while month ?>
                <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php echo number_format($total_bto, 2); ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
                //////////////////////////////////////////////////////////////////////รวมทั้งสิ้นก่อนปีงบประมาณที่เลือก/////////////////////////////////////////////////////////////////////////////
				$sqlm2 = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm2 = $conn->query($sqlm2);
				$total_bto2 = 0;
				while ($rm2 = $resultm2->fetch_array()) {
					$likedate2 = ($year1 - 544)."-".$rm2['month_id'];
					if ($rm2['month_id'] == "10" || $rm2['month_id'] == "11" || $rm2['month_id'] == "12") {
						$likedate2 = ($year1 - 545)."-".$rm2['month_id'];
					}
					//หาจำนวนเตียง
					$total_bed2 = 0; //รวมเตียง
					$sqlb2 = "SELECT amount_bed FROM data_all WHERE idate LIKE '$likedate2%'";
					if ($i_status != "all") {
						$sqlb2 .= " AND i_status = '$i_status'";
					}
					$sqlb2 .= " GROUP BY ward ORDER BY idate, wage_type_id";
					$resultb2 = $conn->query($sqlb2);
					while ($rb2 = $resultb2->fetch_array()) {
						$total_bed2 += $rb2[0];
					}
					//รวมจำหน่าย
					$sqlsp2 = "SELECT SUM(home_pt) AS home_pt, SUM(move_b_pt) AS move_b_pt, SUM(send_pt) AS send_pt, SUM(dead_pt) AS dead_pt, SUM(non_voluntary_pt) AS non_voluntary_pt FROM data_all WHERE idate LIKE '$likedate2%'";
					if ($i_status != "all") {
						$sqlsp2 .= " AND i_status = '$i_status'";
					}
					$resultsp2 = $conn->query($sqlsp2);
					$rsp2 = $resultsp2->fetch_array();
					if ($total_bed2 != "0") {
						$bto2 = ($rsp2['home_pt'] + $rsp2['move_b_pt'] + $rsp2['send_pt'] + $rsp2['dead_pt'] + $rsp2['non_voluntary_pt']) / $total_bed2;
						$total_bto2 += number_format($bto2, 2);
					}
				} //end while
				echo number_format($total_bto2, 2);
				?></td>
                <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
				$avg_bto2 = 0;
                if ($total_bto2 != "0") {
					$avg_bto2 = $total_bto2 / 12;
				}
				echo number_format($avg_bto2,  2);
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