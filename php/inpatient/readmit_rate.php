<?php
include "sess_uin.php";
$p = "readmit";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>อัตราการรีแอดมิต</title>
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">อัตราการรีแอดมิต</td>
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
            <td height="25"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/readmit_rate_r.php?year1=<?php echo $year1; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/bed_rate_r.php?year1=<?php echo $year1; ?>&i_status=<?php echo $i_status; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
          <tr>
            <td height="25">รายงานอัตราการรีแอดมิต ประจำปีงบประมาณ <?php echo $year1; ?></td>
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
					echo "<a href='javascript:;' title='($r_r[readmit_amount] x 100) / $r_r[discharge_amount]'>".number_format($readmit_rate_ward, 2)."</a>";
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
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
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
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
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
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
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
            <td height="25" align="left">อัตราการรีแอดมิต = (จำนวนผู้ป่วยที่กลับเข้ารับการรักษาซ้ำด้วยโรค/อาการเดิม
ภายใน 28 วัน หลังจำหน่าย x 100) / จำนวนผู้ป่วยที่จำหน่ายทั้งหมดในเดือนก่อนหน้า</td>
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