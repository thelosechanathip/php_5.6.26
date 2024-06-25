<?php
include "../sess_uin.php";
include "../connect.php";
$year1 = $_GET['year1'];
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="pressure-rate.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานอัตราการเกิดแผลกดทับ</title>
<link rel="stylesheet" type="text/css" href="../css/mycss.css"/>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="center">รายงานอัตราการเกิดแผลกดทับ ประจำปีงบประมาณ <?php echo $year1; ?></td>
  </tr>
  <tr>
    <td align="center"><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="70" height="25" align="center" bgcolor="#CCCCCC" class="textBlackBold">ตึก</td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {
				?>
                <td width="50" height="25" align="center" bgcolor="#CCCCCC"><?php
                echo $rm['month_sname'];
				echo "<br>";
				if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
					echo substr(($year1 - 1), 2, 2);
				} else {
					echo substr($year1, 2, 2);
				}
				?></td>
                <?php } //end while month ?>
                <td width="60" height="25" align="center" bgcolor="#CCCCCC" class="textBlackBold">รวม</td>
        </tr>
              <?php
$sqlw1 = "SELECT ward, shortname, ward_group FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
while ($rw1 = $resultw1->fetch_array()) {
?>
              <tr onmouseover=this.style.backgroundColor="#B9D5FF" onmouseout=this.style.backgroundColor="">
                <td height="25" align="center"><?php echo $rw1['shortname']; ?></td>
                <?php
				$resultm = $conn->query($sqlm);
				$sum_do_pressure_ward = 0;
				$sum_risk_pressure_ward = 0;
				while ($rm = $resultm->fetch_array()) {
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$d_start = ($year1 - 544)."-".$rm['month_id']."-01";
						$d_end = ($year1 - 544)."-".$rm['month_id']."-31";
					} else {
						$d_start = ($year1 - 543)."-".$rm['month_id']."-01";
						$d_end = ($year1 - 543)."-".$rm['month_id']."-31";
					}
				?>
                <td height="25" align="center"><?php
				//อัตราการเกิดแผลกดทับแต่ละตึก แต่ละเดือน
				$sql_p = "select sum(do_pressure) sum_do_pressure, sum(risk_pressure) sum_risk_pressure from pressure where ward = \"$rw1[ward]\" and idate between '$d_start' and '$d_end'";
				$result_p = $conn->query($sql_p);
				$r_p = $result_p->fetch_array();
				$sum_do_pressure_ward += $r_p['sum_do_pressure'];
				$sum_risk_pressure_ward += $r_p['sum_risk_pressure'];
				if ($r_p['sum_risk_pressure'] != 0) {
					$pressure_rate_ward = ($r_p['sum_do_pressure'] * 1000) / $r_p['sum_risk_pressure'];
					echo number_format($pressure_rate_ward, 2);
				}
				?></td>
                <?php } //end while month $rm ?>
                <td height="25" align="center"><?php
                //รวมราย ward
				if ($sum_risk_pressure_ward != 0) {
					$sum_pressure_rate_ward = ($sum_do_pressure_ward * 1000) / $sum_risk_pressure_ward;
					echo number_format($sum_pressure_rate_ward, 2);
				}
				?></td>
              </tr>
<?php } //end while ward $rw1 ?>
              <tr>
                <td height="25" align="center" bgcolor="#CCCCCC" class="textBlackBold">รวม</td>
                <?php
				$sum_do_pressure = 0;
				$sum_risk_pressure = 0;
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {	
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$d_start = ($year1 - 544)."-".$rm['month_id']."-01";
						$d_end = ($year1 - 544)."-".$rm['month_id']."-31";
					} else {
						$d_start = ($year1 - 543)."-".$rm['month_id']."-01";
						$d_end = ($year1 - 543)."-".$rm['month_id']."-31";
					}
				?>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php
                //อัตราการเกิดแผลกดทับ แต่ละเดือน
				$sql_p = "select sum(do_pressure) sum_do_pressure, sum(risk_pressure) sum_risk_pressure from pressure where idate between '$d_start' and '$d_end'";
				$result_p = $conn->query($sql_p);
				$r_p = $result_p->fetch_array();
				$sum_do_pressure += $r_p['sum_do_pressure'];
				$sum_risk_pressure += $r_p['sum_risk_pressure'];
				if ($r_p['sum_risk_pressure'] != 0) {
					$pressure_rate = ($r_p['sum_do_pressure'] * 1000) / $r_p['sum_risk_pressure'];
					echo number_format($pressure_rate, 2);
				}
				?></td>
                <?php } //end month ?>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php
                 //รวมทั้งหมด
				if ($sum_risk_pressure != 0) {
					$sum_pressure_rate = ($sum_do_pressure * 1000) / $sum_risk_pressure;
					echo number_format($sum_pressure_rate, 2);
				}
				?></td>
        </tr>
	</table></td>
  </tr>
  <tr>
    <td height="25" align="center">อัตราการเกิดแผลกดทับ = (จำนวนครั้งของการเกิดแผลกดทับระดับ 2 - 4 x 1,000) / จำนวนวันนอนรวมของผู้ป่วยที่เสี่ยงต่อการเกิดแผลกดทับ</td>
  </tr>
</table>
</body>
</html>