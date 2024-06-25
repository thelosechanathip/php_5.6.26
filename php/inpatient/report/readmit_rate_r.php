<?php
include "../sess_uin.php";
include "../connect.php";
$year1 = $_GET['year1'];
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="readmit-rate.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานอัตราการรีแอดมิต</title>
<link rel="stylesheet" type="text/css" href="../css/mycss.css"/>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="center">รายงานอัตราการรีแอดมิต ประจำปีงบประมาณ <?php echo $year1; ?></td>
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
              <tr>
                <td height="25" align="center"><?php echo $rw1['shortname']; ?></td>
                <?php
				$resultm = $conn->query($sqlm);
				$sum_readmit_ward = 0;
				$sum_discharge_ward = 0;
				while ($rm = $resultm->fetch_array()) {
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$month1 = ($year1 - 544)."-".$rm['month_id'];
					} else {
						$month1 = ($year1 - 543)."-".$rm['month_id'];
					}
				?>
                <td height="25" align="center"><?php
				//อัตราการรีแอดมิดแต่ละตึก แต่ละเดือน
				$sql_r = "select * from readmit where ward = \"$rw1[ward]\" and month1 = '$month1'";
				$result_r = $conn->query($sql_r);
				$r_r = $result_r->fetch_array();
				$sum_readmit_ward += $r_r['readmit_amount'];
				$sum_discharge_ward += $r_r['discharge_amount'];
				if ($r_r['discharge_amount'] != 0) {
					$readmit_rate_ward = ($r_r['readmit_amount'] * 100) / $r_r['discharge_amount'];
					echo number_format($readmit_rate_ward, 2);
				}
				?></td>
                <?php } //end while month $rm ?>
                <td height="25" align="center"><?php
                //รวมราย ward
				if ($sum_discharge_ward != 0) {
					$sum_readmit_rate_ward = ($sum_readmit_ward * 100) / $sum_discharge_ward;
					echo number_format($sum_readmit_rate_ward, 2);
				}
				?></td>
              </tr>
<?php } //end while ward $rw1 ?>
              <tr>
                <td height="25" align="center" bgcolor="#CCCCCC" class="textBlackBold">รวม</td>
                <?php
				$sum_readmit = 0;
				$sum_discharge = 0;
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {	
					if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
						$month1 = ($year1 - 544)."-".$rm['month_id'];
					} else {
						$month1 = ($year1 - 543)."-".$rm['month_id'];
					}
				?>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php
                //อัตราการรีแอดมิต แต่ละเดือน
				$sql_r = "select sum(readmit_amount) readmit_amount, sum(discharge_amount) discharge_amount from readmit where month1 = '$month1'";
				$result_r = $conn->query($sql_r);
				$r_r = $result_r->fetch_array();
				$sum_readmit += $r_r['readmit_amount'];
				$sum_discharge += $r_r['discharge_amount'];
				if ($r_r['discharge_amount'] != 0) {
					$readmit_rate = ($r_r['readmit_amount'] * 100) / $r_r['discharge_amount'];
					echo number_format($readmit_rate, 2);
				}
				?></td>
                <?php } //end month ?>
                <td height="25" align="center" bgcolor="#CCCCCC"><?php
                 //รวมทั้งหมด
				if ($sum_discharge != 0) {
					$sum_readmit_rate = ($sum_readmit * 100) / $sum_discharge;
					echo number_format($sum_readmit_rate, 2);
				}
				?></td>
        </tr>
	</table></td>
  </tr>
  <tr>
    <td height="25" align="center">อัตราการรีแอดมิต = (จำนวนผู้ป่วยที่กลับเข้ารับการรักษาซ้ำด้วยโรค/อาการเดิม
ภายใน 28 วัน หลังจำหน่าย x 100) / จำนวนผู้ป่วยที่จำหน่ายทั้งหมดในเดือนก่อนหน้า</td>
  </tr>
</table>
</body>
</html>