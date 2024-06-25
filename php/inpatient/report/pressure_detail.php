<?php
include "../sess_uin.php";
$ward = $_GET['ward'];
$year1 = $_GET['year1'];
$month1 = $_GET['month1'];
$year1_thai = $year1;
if ($month1 == "10" || $month1 == "11" || $month1 == "12") {
	$year1_thai = $year1 - 1;
	$year1 = $year1 - 544;
} else {
	$year1 = $year1 - 543;
}
include "../connect.php";
include "../myclass.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายละเอียดอัตราการเกิดแผลกดทับ</title>
<link rel="stylesheet" type="text/css" href="../css/mycss.css"/>
</head>

<body>
<?php
$sqlw = "select name from ward where ward = '$ward'";
$resultw = $conn->query($sqlw);
$rw = mysql_fetch_row($resultw);
//
$sqlm = "select month_fname from tb_month where month_id = '$month1'";
$resultm = $conn->query($sqlm);
$rm = $resultm->fetch_row();
//
$num_day = MonthInDays($month1, ($year1_thai - 543));
?>
<table width="2000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="left" class="textBlackBold">ข้อมูลอัตรการเกิดแผลกดทับ ตึก : <?php echo $rw[0]; ?></td>
  </tr>
  <tr>
    <td height="25" align="left" style="border-bottom:1px solid #999;">ข้อมูลเดือน : <?php echo $rm[0]." ".$year1_thai; ?></td>
  </tr>
  <tr>
    <td align="left"><table width="2000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="304" height="25" align="center" bgcolor="#F0F0F0" class="textBlackBold" style="border-bottom:1px solid #999; border-left:1px solid #999;">รายการ / วันที่</td>
        <?php
		$w = 1626 / $num_day;
		for($i = 1; $i <= $num_day; $i++) {
		?>
        <td width="<?php echo $w; ?>" height="25" align="center" bgcolor="#F0F0F0" style="border-bottom:1px solid #999; border-left:1px solid #999;"><?php echo $i; ?></td>
        <?php } //end for day ?>
        <td width="70" height="25" align="center" bgcolor="#F0F0F0" class="textBlackBold" style="border-bottom:1px solid #999; border-left:1px solid #999; border-right:1px solid #999;">รวม</td>
      </tr>
      <tr>
        <td height="25" align="left" style="border-bottom:1px solid #999; border-left:1px solid #999;">จำนวนครั้งของการเกิดแผลกดทับระดับ 2 - 4</td>
        <?php
		$sum_do_month = 0;
		for($i = 1; $i <= $num_day; $i++) {
			$idate = $year1."-".$month1."-".$i;
		?>
        <td height="25" align="center" style="border-bottom:1px solid #999; border-left:1px solid #999;"><?php
        //เกิดแผลกดทับรายวันที่
		$sql_do = "select do_pressure from pressure where ward = '$ward' and idate = '$idate'";
		$result_do = $conn->query($sql_do);
		$r_do = $result_do->fetch_row();
		$sum_do_month += $r_do[0];
		echo $r_do[0];
		?></td>
        <?php } //end for day ?>
        <td height="25" align="center" style="border-bottom:1px solid #999; border-left:1px solid #999; border-right:1px solid #999;"><?php echo number_format($sum_do_month, 0); ?></td>
      </tr>
      <tr>
        <td height="25" align="left" style="border-bottom:1px solid #999; border-left:1px solid #999;">จำนวนวันนอนรวมของผู้ป่วยที่เสี่ยงต่อการเกิดแผลกดทับ</td>
        <?php
		$sum_risk_month = 0;
		for($i = 1; $i <= $num_day; $i++) {
			$idate = $year1."-".$month1."-".$i;
		?>
        <td height="25" align="center" style="border-bottom:1px solid #999; border-left:1px solid #999;"><?php
        //เสี่ยงเกิดแผลกดทับรายวันที่
		$sql_risk = "select risk_pressure from pressure where ward = '$ward' and idate = '$idate'";
		$result_risk = $conn->query($sql_risk);
		$r_risk = $result_risk->fetch_row();
		$sum_risk_month += $r_risk[0];
		echo $r_risk[0];
		?></td>
        <?php } //end for day ?>
        <td height="25" align="center" style="border-bottom:1px solid #999; border-left:1px solid #999; border-right:1px solid #999;"><?php echo number_format($sum_risk_month, 0); ?></td>
      </tr>
      <tr>
        <td height="25" bgcolor="#F0F0F0" style="border-bottom:1px solid #999; border-left:1px solid #999;">อัตราการเกิดแผลกดทับ</td>
        <?php
		for($i = 1; $i <= $num_day; $i++) {
			$idate = $year1."-".$month1."-".$i;
		?>
        <td height="25" align="center" bgcolor="#F0F0F0" style="border-bottom:1px solid #999; border-left:1px solid #999;"><?php
        //เกิดแผลกดทับรายวันที่
		$sql_do = "select do_pressure from pressure where ward = '$ward' and idate = '$idate'";
		$result_do = $conn->query($sql_do);
		$r_do = $result_do->fetch_row();
		//เสี่ยงเกิดแผลกดทับรายวันที่
		$sql_risk = "select risk_pressure from pressure where ward = '$ward' and idate = '$idate'";
		$result_risk = $conn->query($sql_risk);
		$r_risk = $result_risk->fetch_row();
		//อัตราการเกิดแผลกดทับรายวันที่
		if ($r_risk[0] != 0) {
			$pressure_rate = ($r_do[0] * 1000) / $r_risk[0];
			echo number_format($pressure_rate, 2);
		}
		?></td>
        <?php } //end for day ?>
        <td height="25" align="center" bgcolor="#F0F0F0" style="border-bottom:1px solid #999; border-left:1px solid #999; border-right:1px solid #999;"><?php
        //อัตราการเกิดแผลกดทับรายเดือน
		if ($sum_risk_month != 0) {
			$pressure_rate = ($sum_do_month * 1000) / $sum_risk_month;
			echo number_format($pressure_rate, 2);
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