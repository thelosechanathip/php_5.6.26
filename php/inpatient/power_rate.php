<?php
include "sess_uin.php";
$p = "power";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>การผสมผสานอัตรากำลัง</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">การผสมผสานอัตรากำลัง</td>
          </tr>
          <tr>
            <td align="left"><table width="780" border="0" cellspacing="0" cellpadding="0">
              <form method="post" action="<?php echo "$PHP_SELF"; ?>">
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
                  <td height="25" align="left">ตัวเลือกข้อมูล</td>
                  <td height="25" colspan="2" align="left"><label><input name="i_status" type="radio" id="radio" value="all" <?php if ($i_status == "all") { echo "checked=\"checked\""; } ?> />ทั้งหมด</label><label><input name="i_status" type="radio" id="radio" value="1" <?php if ($i_status == "1") { echo "checked=\"checked\""; } ?> />ยืนยันแล้ว</label><label><input name="i_status" type="radio" id="radio" value="0" <?php if ($i_status == "0") { echo "checked=\"checked\""; } ?> />ยังไม่ยืนยัน</label></td>
                  </tr>
                <tr>
                  <td height="25" align="left">&nbsp;</td>
                  <td height="25" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
                  <td align="left">&nbsp;</td>
                </tr>
              </form>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="left"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/power_rate_r.php?year1=<?php echo $year1; ?>&i_status=<?php echo $i_status; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/power_rate_r.php?year1=<?php echo $year1; ?>&i_status=<?php echo $i_status; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
          <tr>
            <td height="25" align="left">การผสมผสานอัตรากำลัง ปีงบประมาณ <?php echo $year1; ?></td>
          </tr>
          <tr>
            <td align="left"><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
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
                <td width="100" height="25" align="center" bgcolor="#66FFB3">รวม<br />
                  <?php echo $year1; ?><br /></td>
              </tr>
              <?php
//ward
$sqlw1 = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
while ($rw1 = $resultw1->fetch_array()) {
?>
              <tr>
                <td height="25" align="center"><?php echo $rw1['shortname']; ?></td>
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
                <td height="25" align="center"><?php echo number_format($power_rate, 2); ?></td>
                <?php } //end while month ?>
                <td height="25" align="center"><?php echo number_format($sum_power_rate, 2); ?></td>
              </tr>
              <?php } //end while ward ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
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
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo number_format($power_rate, 2); ?></td>
                <?php } //end while month ?>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo number_format($sum_power_rate, 2); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            </tr>
          <tr>
            <td align="left">สูตร = (ผลรวมชั่วโมงการทำงานของ RN ใน 1 เดือน / ผลรวมชั่วโมงการทำงานของบุคลากรการพยาบาลทั้งหมดในเดือน) * 100</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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