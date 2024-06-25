<?php
include "sess_uin.php";
$p = "pressure";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>อัตราการเกิดแผลกดทับ</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
include "myclass.php";
$ynow = date("Y") + 543;
if (date("m") >= 10) { //ถ้าเป็น ต.ค. - ธ.ค.
	$ynow += 1;
}
$year1 = $_POST['year1'];
if ($year1 == "") {
	$year1 = $ynow;
}
$i_status = $_POST['i_status'];
if ($i_status == "") {
	$i_status = "all";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><?php include "header.php"; ?></td>
  </tr>
  <tr>
    <td height="25" align="left">&nbsp;&nbsp;<?php include "account_data.php"; ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10%" align="left" valign="top"><?php include "menu.php"; ?></td>
        <td width="90%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">อัตราการเกิดแผลกดทับ</td>
          </tr>
          <tr>
            <td align="left"><form method="post" action="<?php echo $PHP_SELF; ?>"><table width="780" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="82" height="25" align="left">ปีงบประมาณ</td>
                  <td width="77" height="25" align="left"><select name="year1" id="year1">
                    <?php
			for ($i = $ynow; $i >= 2553; $i--) {
				if ($year1 == $i) {
					echo "<option value='$i' selected>$i</option>";
				} else {
					echo "<option value='$i'>$i</option>";
				}
			}
			?>
                  </select></td>
                  <td width="621" align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td height="25" align="left">&nbsp;</td>
                  <td height="25" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
                  <td align="left">&nbsp;</td>
                </tr>
            </table></form></td>
          </tr>
          <tr>
            <td height="25"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/pressure_rate_r.php?year1=<?php echo $year1; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/pressure_rate_r.php?year1=<?php echo $year1; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
          <tr>
            <td height="25">รายงานอัตราการเกิดแผลกดทับ ประจำปีงบประมาณ <?php echo $year1; ?></td>
          </tr>
          <tr>
            <td><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="70" height="25" align="center" bgcolor="#FFDBCA">ตึก</td>
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
                <td width="60" height="25" align="center" bgcolor="#66FFB3">รวม</td>
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
				$sql_p = "select sum(do_pressure) sum_do_pressure, sum(risk_pressure) sum_risk_pressure, count(ward) cw from pressure where ward = \"$rw1[ward]\" and idate between '$d_start' and '$d_end'";
				$result_p = $conn->query($sql_p);
				$r_p = $result_p->fetch_array();
				$sum_do_pressure_ward += $r_p['sum_do_pressure'];
				$sum_risk_pressure_ward += $r_p['sum_risk_pressure'];
				if ($r_p['cw'] > 0) {
					if ($r_p['sum_risk_pressure'] != 0) {
						$pressure_rate_ward = ($r_p['sum_do_pressure'] * 1000) / $r_p['sum_risk_pressure'];
						echo "<a href='report/pressure_detail.php?ward=$rw1[ward]&year1=$year1&month1=$rm[month_id]' target='_blank'>".number_format($pressure_rate_ward, 2)."</a>";
					} else {
						echo "<a href='report/pressure_detail.php?ward=$rw1[ward]&year1=$year1&month1=$rm[month_id]' target='_blank'>0.00<a>";
					}
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
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
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
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
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
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
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
            <td height="25" align="left">อัตราการเกิดแผลกดทับ = (จำนวนครั้งของการเกิดแผลกดทับระดับ 2 - 4 x 1,000) / จำนวนวันนอนรวมของผู้ป่วยที่เสี่ยงต่อการเกิดแผลกดทับ</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php include "footer.php"; ?></td>
  </tr>
</table>
</body>
</html>