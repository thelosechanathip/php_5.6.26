<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="productivity.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Productivity :: Report</title>
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
$month1 = $_GET['month1'];
$year1= $_GET['year1'];
$i_status = $_GET['i_status'];
include "../connect.php";
include "../myarray.php";
include "../myclass.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="left" class="tHead">การคำนวณผลผลิตทางการพยาบาล (productivity) ประจำเดือน <?php echo $month_r[$month1]; ?> พ.ศ.<?php echo $year1; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="1700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="85" height="25" align="center" bgcolor="#B9FFFF" class="tData" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;">ตึก/วันที่</td>
        <?php
				//วันที่ของเดือนที่เลือก
				//$num_day = cal_days_in_month(CAL_GREGORIAN, $month1, ($year1 - 543)); //จำนวนวันในเดือน
				$num_day = MonthInDays($month1, ($year1 - 543));
				$w = 1555 / $num_day;
				for ($i = 1; $i <= $num_day; $i++) {
				?>
        <td width="<?php echo $w; ?>" height="25" align="center" bgcolor="#CCFFE6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><?php echo $i; ?></td>
        <?php } //end for $i ?>
        <td width="60" height="25" align="center" bgcolor="#FFE1D2" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;">รวม</td>
      </tr>
      <?php
$sqlw = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw = $conn->query($sqlw);
$num_wage_day = 3; //จำนวนเวรในหนึ่งวัน
$num_hour = 7; //ชั่วโมงการทำงาน 1 เวร
while ($rw = $resultw->fetch_array()) {
	$sum_wpatient5 = 0; //รวมผู้ป่วยประเภท 5 ด ช บ
	$sum_wpatient4 = 0; //รวมผู้ป่วยประเภท 4 ด ช บ
	$sum_wpatient3 = 0; //รวมผู้ป่วยประเภท 3 ด ช บ
	$sum_wpatient2 = 0; //รวมผู้ป่วยประเภท 2 ด ช บ
	$sum_wpatient1 = 0; //รวมผู้ป่วยประเภท 1 ด ช บ
	$sum_em = 0; //รวมเจ้าหน้าที่ทั้งเดือน
?>
      <tr>
        <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><?php echo $rw['shortname']; ?></td>
        <?php
                for ($i = 1; $i <= $num_day; $i++) {
					$productivity_day = 0; //ผลผลิตทางการพยาบาล
					$sum_productivity = 0; //รวมผลผลิตทางการพยาบาล
				?>
        <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
				$ymdsearch = ($year1 - 543)."-".$month1."-".$i;
				//จำนวนรวมผู้ป่วยประเภท 5 ด ช บ (วิกฤต)
				$sql5 = "SELECT SUM(patient_type5) FROM data_all WHERE ward = '$rw[ward]' AND idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql5 .= " AND i_status = '$i_status'";
				}
				$result5 = $conn->query($sql5);
				$r5 = $result->fetch_row();
				$wpatient5 = $r5[0];
				$sum_wpatient5 += $wpatient5;
                //จำนวนรวมผู้ป่วยประเภท 4 ด ช บ
				$sql4 = "SELECT SUM(patient_type4) FROM data_all WHERE ward = '$rw[ward]' AND idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql4 .= " AND i_status = '$i_status'";
				}
				$result4 = $conn->query($sql4);
				$r4 = $result4->fetch_row();
				$wpatient4 = $r4[0];
				$sum_wpatient4 += $wpatient4;
				//จำนวนรวมผู้ป่วยประเภท 3 ด ช บ
				$sql3 = "SELECT SUM(patient_type3) FROM data_all WHERE ward = '$rw[ward]' AND idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql3 .= " AND i_status = '$i_status'";
				}
				$result3 = $conn->query($sql3);
				$r3 = $result3->fetch_row();
				$wpatient3 = $r3[0];
				$sum_wpatient3 += $wpatient3;
				//จำนวนรวมผู้ป่วยประเภท 2 ด ช บ
				$sql2 = "SELECT SUM(patient_type2) FROM data_all WHERE ward = '$rw[ward]' AND idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql2 .= " AND i_status = '$i_status'";
				}
				$result2 = $conn->query($sql2);
				$r2 = $result2->fetch_row();
				$wpatient2 = $r2[0];
				$sum_wpatient2 += $wpatient2;
				//จำนวนรวมผู้ป่วยประเภท 1 ด ช บ
				$sql1 = "SELECT SUM(patient_type1) FROM data_all WHERE ward = '$rw[ward]' AND idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql1 .= " AND i_status = '$i_status'";
				}
				$result1 = $conn->query($sql1);
				$r1 = $result1->fetch_row();
				$wpatient1 = $r1[0];
				$sum_wpatient1 += $wpatient1;
				$num_patient_day5 = $wpatient5 / $num_wage_day; //จำนวนผู้ป่วยประเภท 5 ใน 1 วัน
				$num_patient_day4 = $wpatient4 / $num_wage_day; //จำนวนผู้ป่วยประเภท 4 ใน 1 วัน
				$num_patient_day3 = $wpatient3 / $num_wage_day; //จำนวนผู้ป่วยประเภท 3 ใน 1 วัน
				$num_patient_day2 = $wpatient2 / $num_wage_day; //จำนวนผู้ป่วยประเภท 2 ใน 1 วัน
				$num_patient_day1 = $wpatient1 / $num_wage_day; //จำนวนผู้ป่วยประเภท 1 ใน 1 วัน
				$num_patient_day575 = $num_patient_day5 * 7.5; //รวมจำนวนผู้ป่วยประเภท 5 * 7.5 ทั้งเดือน
				$num_patient_day475 = $num_patient_day4 * 7.5; //จำนวนผู้ป่วยประเภท 4 * 7.5
				if ($rw['ward'] == "12" || $rw['ward'] == "13") { //ถ้าเป็น icu เด็ก, icu ผู้ใหญ่ ต้องคูณ 12
					$num_patient_day575 = $num_patient_day5 * 12; //รวมจำนวนผู้ป่วยประเภท 5 * 12 ใน 1 วัน
					$num_patient_day475 = $num_patient_day4 * 12; //รวมจำนวนผู้ป่วยประเภท 4 * 12 ใน 1 วัน
				}
				$num_patient_day355 = $num_patient_day3 * 5.5; //จำนวนผู้ป่วยประเภท 3 * 5.5
				$num_patient_day235 = $num_patient_day2 * 3.5; //จำนวนผู้ป่วยประเภท 2 * 3.5
				$num_patient_day115 = $num_patient_day1 * 1.5; //จำนวนผู้ป่วยประเภท 1 * 1.5
				$num_patient_day = $num_patient_day575 + $num_patient_day475 + $num_patient_day355 + $num_patient_day235 + $num_patient_day115; //จำนวนผู้ป่วยทุกประเภทใน 1 วัน
				//รวมจำนวนเจ้าหน้าที่ทีปฏิบัติงานในแต่ละวัน ด ช บ
				$sqlem = "SELECT SUM(em_hn) AS em_hn, SUM(em_rn) AS em_rn, SUM(em_tn) AS em_tn, SUM(em_pn) AS em_pn, SUM(em_aid) AS em_aid FROM data_all WHERE ward = '$rw[ward]' AND idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sqlem .= " AND i_status = '$i_status'";
				}
				$resultem = $conn->query($sqlem);
				$rem = $resultem->fetch_array();
				$num_em_day = $rem['em_hn'] + $rem['em_rn'] + $rem['em_tn'] + $rem['em_pn'] + $rem['em_aid']; //จำนวนเจ้าหน้าที่ในแต่ละวัน
				$sum_em += $num_em_day;
				if ($num_em_day != "0") {
					$productivity_day = (($num_patient_day * 100) / $num_em_day) / $num_hour; //ผลผลิตทางการพยาบาล
				}
				echo number_format($productivity_day, 2);
				?></td>
        <?php } //end if $num_day ?>
        <td height="25" align="center" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
				$sum_patient_day5 = $sum_wpatient5 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 5 ทั้งเดือน
				$sum_patient_day4 = $sum_wpatient4 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 4 ทั้งเดือน
				$sum_patient_day3 = $sum_wpatient3 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 3 ทั้งเดือน
				$sum_patient_day2 = $sum_wpatient2 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 2 ทั้งเดือน
				$sum_patient_day1 = $sum_wpatient1 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 1 ทั้งเดือน
				$sum_patient_day575 = $sum_patient_day5 * 7.5; //รวมจำนวนผู้ป่วยประเภท 4 * 7.5 ทั้งเดือน
				$sum_patient_day475 = $sum_patient_day4 * 7.5; //รวมจำนวนผู้ป่วยประเภท 4 * 7.5 ทั้งเดือน
				if ($rw['ward'] == "12" || $rw['ward'] == "13") { //ถ้าเป็น icu เด็ก, icu ผู้ใหญ่ ต้องคูณ 12
					$sum_patient_day575 = $sum_patient_day5 * 12; //รวมจำนวนผู้ป่วยประเภท 5 * 12 ทั้งเดือน
					$sum_patient_day475 = $sum_patient_day4 * 12; //รวมจำนวนผู้ป่วยประเภท 4 * 12 ทั้งเดือน
				}
				$sum_patient_day355 = $sum_patient_day3 * 5.5; //รวมจำนวนผู้ป่วยประเภท 3 * 5.5 ทั้งเดือน
				$sum_patient_day235 = $sum_patient_day2 * 3.5; //รวมจำนวนผู้ป่วยประเภท 2 * 3.5 ทั้งเดือน
				$sum_patient_day115 = $sum_patient_day1 * 1.5; //รวมจำนวนผู้ป่วยประเภท 1 * 1.5 ทั้งเดือน
				$sum_patient_day = $sum_patient_day575 + $sum_patient_day475 + $sum_patient_day355 + $sum_patient_day235 + $sum_patient_day115; //รวมจำนวนผู้ป่วยทุกประเภทใน 1 วัน
				if ($sum_em != "0") {
					$sum_productivity = (($sum_patient_day * 100) / $sum_em) / $num_hour; //รวมผลผลิตทางการพยาบาลทั้งเดือน
				}
                echo number_format($sum_productivity, 2);
				?></td>
      </tr>
      <?php } //end while ward ?>
      <?php if ($kk == "1") { ?>
      <tr>
        <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;">รวม</td>
        <?php
				$sum_wpatient4 = 0; //รวมผู้ป่วยประเภท 4 ด ช บ
				$sum_wpatient3 = 0; //รวมผู้ป่วยประเภท 3 ด ช บ
				$sum_wpatient2 = 0; //รวมผู้ป่วยประเภท 2 ด ช บ
				$sum_wpatient1 = 0; //รวมผู้ป่วยประเภท 1 ด ช บ
				$sum_em = 0; //รวมเจ้าหน้าที่ทั้งเดือน
                for ($i = 1; $i <= $num_day; $i++) {
					$productivity_day = 0; //ผลผลิตทางการพยาบาล
					$sum_productivity = 0; //รวมผลผลิตทางการพยาบาล
				?>
        <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
                //จำนวนรวมผู้ป่วยประเภท 4 ด ช บ
				$ymdsearch = ($year1 - 543)."-".$month1."-".$i;
				$sql4 = "SELECT SUM(patient_type4) FROM data_all WHERE idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql4 .= " AND i_status = '$i_status'";
				}
				$result4 = $conn->query($sql4);
				$r4 = $result4->fetch_row();
				$wpatient4 = $r4[0];
				$sum_wpatient4 += $wpatient4;
				//จำนวนรวมผู้ป่วยประเภท 3 ด ช บ
				$sql3 = "SELECT SUM(patient_type3) FROM data_all WHERE idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql3 .= " AND i_status = '$i_status'";
				}
				$result3 = $conn->query($sql3);
				$r3 = $result3->fetch_row();
				$wpatient3 = $r3[0];
				$sum_wpatient3 += $wpatient3;
				//จำนวนรวมผู้ป่วยประเภท 2 ด ช บ
				$sql2 = "SELECT SUM(patient_type2) FROM data_all WHERE idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql2 .= " AND i_status = '$i_status'";
				}
				$result2 = $conn->query($sql2);
				$r2 = $result2->fetch_row();
				$wpatient2 = $r2[0];
				$sum_wpatient2 += $wpatient2;
				//จำนวนรวมผู้ป่วยประเภท 1 ด ช บ
				$sql1 = "SELECT SUM(patient_type1) FROM data_all WHERE idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sql1 .= " AND i_status = '$i_status'";
				}
				$result1 = $conn->query($sql1);
				$r1 = $result1->fetch_row();
				$wpatient1 = $r1[0];
				$sum_wpatient1 += $wpatient1;
				$num_patient_day4 = $wpatient4 / $num_wage_day; //จำนวนผู้ป่วยประเภท 4 ใน 1 วัน
				$num_patient_day3 = $wpatient3 / $num_wage_day; //จำนวนผู้ป่วยประเภท 3 ใน 1 วัน
				$num_patient_day2 = $wpatient2 / $num_wage_day; //จำนวนผู้ป่วยประเภท 2 ใน 1 วัน
				$num_patient_day1 = $wpatient1 / $num_wage_day; //จำนวนผู้ป่วยประเภท 1 ใน 1 วัน
				$num_patient_day475 = $num_patient_day4 * 7.5; //จำนวนผู้ป่วยประเภท 4 * 7.5
				$num_patient_day355 = $num_patient_day3 * 5.5; //จำนวนผู้ป่วยประเภท 3 * 5.5
				$num_patient_day235 = $num_patient_day2 * 3.5; //จำนวนผู้ป่วยประเภท 2 * 3.5
				$num_patient_day115 = $num_patient_day1 * 1.5; //จำนวนผู้ป่วยประเภท 1 * 1.5
				$num_patient_day = $num_patient_day475 + $num_patient_day355 + $num_patient_day235 + $num_patient_day115; //จำนวนผู้ป่วยทุกประเภทใน 1 วัน
				//รวมจำนวนเจ้าหน้าที่ทีปฏิบัติงานในแต่ละวัน ด ช บ
				$sqlem = "SELECT SUM(em_hn) AS em_hn, SUM(em_rn) AS em_rn, SUM(em_tn) AS em_tn, SUM(em_pn) AS em_pn, SUM(em_aid) AS em_aid FROM data_all WHERE idate = '$ymdsearch'";
				if ($i_status != "all") {
					$sqlem .= " AND i_status = '$i_status'";
				}
				$resultem = $conn->query($sqlem);
				$rem = $resultem->fetch_array();
				$num_em_day = $rem['em_hn'] + $rem['em_rn'] + $rem['em_tn'] + $rem['em_pn'] + $rem['em_aid']; //จำนวนเจ้าหน้าที่ในแต่ละวัน
				$sum_em += $num_em_day;
				if ($num_em_day != "0") {
					$productivity_day = (($num_patient_day * 100) / $num_em_day) / $num_hour; //ผลผลิตทางการพยาบาล
				}
				echo number_format($productivity_day, 2);
				?></td>
        <?php } //end if $num_day ?>
        <td height="25" align="center" bgcolor="#FFF3C6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000;"><?php
				$sum_patient_day4 = $sum_wpatient4 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 4 ทั้งเดือน
				$sum_patient_day3 = $sum_wpatient3 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 3 ทั้งเดือน
				$sum_patient_day2 = $sum_wpatient2 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 2 ทั้งเดือน
				$sum_patient_day1 = $sum_wpatient1 / $num_wage_day; //รวมจำนวนผู้ป่วยประเภท 1 ทั้งเดือน
				$sum_patient_day475 = $sum_patient_day4 * 7.5; //รวมจำนวนผู้ป่วยประเภท 4 * 7.5 ทั้งเดือน
				$sum_patient_day355 = $sum_patient_day3 * 5.5; //รวมจำนวนผู้ป่วยประเภท 3 * 5.5 ทั้งเดือน
				$sum_patient_day235 = $sum_patient_day2 * 3.5; //รวมจำนวนผู้ป่วยประเภท 2 * 3.5 ทั้งเดือน
				$sum_patient_day115 = $sum_patient_day1 * 1.5; //รวมจำนวนผู้ป่วยประเภท 1 * 1.5 ทั้งเดือน
				$sum_patient_day = $sum_patient_day475 + $sum_patient_day355 + $sum_patient_day235 + $sum_patient_day115; //รวมจำนวนผู้ป่วยทุกประเภทใน 1 วัน
				if ($sum_em != "0") {
					$sum_productivity = (($sum_patient_day * 100) / $sum_em) / $num_hour; //รวมผลผลิตทางการพยาบาลทั้งเดือน
				}
                echo number_format($sum_productivity, 2);
				?></td>
      </tr>
      <?php } //end if $kk ?>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>