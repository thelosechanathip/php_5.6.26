<?php
include "sess_uin.php";
$p = "bedturn";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bed turn over rate</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
$ynow = date("Y") + 543;
if (date("m") >= 10) { //ถ้าเป็น ต.ค. - ธ.ค.
	$ynow += 1;
}
$year1= $_POST['year1'];
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">Bed turn over rate</td>
          </tr>
          <tr>
            <td align="left"><table width="780" border="0" cellspacing="0" cellpadding="0">
              <form method="post" action="bed_turn_overrate.php">
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
            <td height="25" align="left"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/bed_turn_overrate_r.php?year1=<?php echo $year1; ?>&i_status=<?php echo $i_status; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/bed_turn_overrate_r.php?year1=<?php echo $year1; ?>&i_status=<?php echo $i_status; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
          <tr>
            <td height="25">Bed turn over rate ประจำปีงบประมาณ <?php echo $year1; ?></td>
          </tr>
          <tr>
            <td align="left"><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="70" height="25" align="center" bgcolor="#FFDBCA">ตึก</td>
                <?php
				$sqlm = "SELECT month_id, month_sname FROM tb_month ORDER BY ordering";
				$resultm = $conn->query($sqlm);
				while ($rm = $resultm->fetch_array()) {
				?>
                <td width="43" height="25" align="center" bgcolor="#CCFFE6"><?php
                echo $rm['month_sname'];
				echo "<br>";
				if ($rm['month_id'] == "10" || $rm['month_id'] == "11" || $rm['month_id'] == "12") {
					echo substr(($year1 - 1), 2, 2);
				} else {
					echo substr($year1, 2, 2);
				}
				?></td>
                <?php } //end while month ?>
                <td width="65" height="25" align="center" bgcolor="#66FFB3">ปีงบ<br /><?php echo $year1; ?></td>
                <td width="65" height="25" align="center" bgcolor="#B9FFFF">ปีงบ<br /><?php echo ($year1 - 1); ?></td>
                <td width="72" align="center" bgcolor="#FFE1D2">เฉลี่ยต่อเดือน<br />
                  ปีงบ <?php echo ($year1 - 1); ?></td>
              </tr>
<?php
//ward group = 1
$sqlw1 = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ordering";
$resultw1 = $conn->query($sqlw1);
while ($rw1 = $resultw1->fetch_array()) {
?>
              <tr>
                <td height="25" align="center"><?php echo $rw1['shortname']; ?></td>
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
                <td height="25" align="center"><?php if ($amount_bed != "") { echo number_format($bto, 2); } ?></td>
                <?php } //end while month ?>
                <td height="25" align="center"><?php echo number_format($total_bto, 2); ?></td>
                <td height="25" align="center"><?php
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
					if ($amount_bed2 != 0) {
						$bto2 = ($rsp2['home_pt'] + $rsp2['move_b_pt'] + $rsp2['send_pt'] + $rsp2['dead_pt'] + $rsp2['non_voluntary_pt']) / $amount_bed2;
						$total_bto2 += number_format($bto2, 2);
					}
				} //end month
				echo number_format($total_bto2, 2);
				?></td>
                <td height="25" align="center"><?php
				$avg_bto2 = 0;
                if ($total_bto2 != "0") {
					$avg_bto2 = $total_bto2 / 12;
				}
				echo number_format($avg_bto2,  2);
				?></td>
              </tr>
<?php } //end while group 1 ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
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
                <td height="25" align="center" bgcolor="#FFF3C6"><?php if ($total_bed != "0") { echo number_format($bto, 2); } ?></td>
                <?php } //end while month ?>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo number_format($total_bto, 2); ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
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
                <td height="25" align="center" bgcolor="#FFF3C6"><?php
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
            <td align="left" valign="top">&nbsp;</td>
            </tr>
          <tr>
            <td height="25" align="left">สูตร = จำนวนผู้ป่วยจำหน่าย / จำนวนเตียง</td>
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