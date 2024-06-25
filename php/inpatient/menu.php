<?php
//รายการที่ยังไม่ยืนยันการส่งข้อมูล
$sqla = "SELECT COUNT(ward) FROM data_all WHERE i_status = 0";
if ($_SESSION["sess_ward"] != "00" && $_SESSION["sess_ward"] != "") { //ถ้าเป็นผู้บันทึกข้อมูลของแต่ละวอร์ด
	$sqla .= " AND ward = '$_SESSION[sess_ward]'";
}

$resulta = $conn->query($sqla);
$ra = $resulta->fetch_row();
?>
<div id="menu13">
<ul>
<li><a href="index.php" <?php if ($p == "index") { echo "id=current"; } ?>>หน้าแรก</a></li>
<?php
if ($_SESSION["sess_ward"] != "00" && $_SESSION["sess_ward"] != "") { //ถ้าเป็นผู้บันทึกข้อมูลแต่ละวอร์ด
?>
<li><a href="insert_data.php" <?php if ($p == "insert") { echo "id=current"; } ?>>บันทึกข้อมูลประจำวัน</a></li>
<li><a href="edit_data.php" <?php if ($p == "edit") { echo "id=current"; } ?>>แก้ไขข้อมูลประจำวัน</a></li>
<li><a href="confirm_data.php" <?php if ($p == "confirm") { echo "id=current"; } ?>>ยืนยันการส่งข้อมูล&nbsp;<?php if ($ra[0] > 0) { echo "($ra[0])"; } ?></a></li>
<br />
<li><a href="../contentment/index.php?ward=<?php echo $_SESSION["sess_ward"]; ?>&id=<?php echo $_COOKIE["cook_id"]; ?>" target="_blank">อัตราความพึงพอใจ</a></li>
<?php
} //end ผู้บันทึกข้อมูล
if ($_SESSION["sess_ward"] == "00") { //ผู้ดูแลระบบ
?>
<li><a href="news.php" <?php if ($p == "news") { echo "id=current"; } ?>>ประกาศข่าว/แจ้งข่าวสาร</a></li>
<li><a href="return.php" <?php if ($p == "return") { echo "id=current"; } ?>>ส่งกลับให้วอร์ดแก้ข้อมูล</a></li>
<li><a href="no_confirm.php" <?php if ($p == "noconfirm") { echo "id=current"; } ?>>รายการที่ยังไม่ยืนยัน&nbsp;<?php if ($ra[0] > 0) { echo "($ra[0])"; } ?></a></li>
<?php
} //end ผู้ดูแลระบบ
?>
</ul>
<div id="d1">รายงาน</div>
<ul>
<?php if ($_SESSION["sess_ward"] != "") { //ผ่านการล็อกอินมาแล้ว ?>
<li><a href="report_day.php" <?php if ($p == "reportday") { echo "id=current"; } ?>>รายงานประจำวัน</a></li>
<li><a href="report_day_all.php" <?php if ($p == "reportday_all") { echo "id=current"; } ?>>รายงานประจำวัน รวมทุกตึก&nbsp;<img src="images/new.gif" border="0" /></a></li>
<li><a href="report_month.php" <?php if ($p == "reportmonth") { echo "id=current"; } ?>>รายงานประจำเดือน</a></li>
<?php
}
if ($_SESSION["sess_ward"] == "00") { //ผู้ดูแลระบบ
?>
<li><a href="on_pt_day.php" <?php if ($p == "onptday") { echo "id=current"; } ?>>ยอดคงพยาบาล ประจำวัน</a></li>
<li><a href="on_pt.php" <?php if ($p == "onpt") { echo "id=current"; } ?>>ยอดคงพยาบาล ประจำเดือน</a></li>
<?php } //end ผู้ดูแลระบบ ?>
<li><a href="bed_turn_overrate.php" <?php if ($p == "bedturn") { echo "id=current"; } ?>>Bed turn over rate</a></li>
<li><a href="los.php" <?php if ($p == "los") { echo "id=current"; } ?>>LOS</a></li>
<li><a href="bed_rate.php" <?php if ($p == "bedrate") { echo "id=current"; } ?>>อัตราการครองเตียง</a></li>
<li><a href="productivity.php" <?php if ($p == "product") { echo "id=current"; } ?>>productivity</a></li>
<li><a href="report_split_patient.php" <?php if ($p == "split") { echo "id=current"; } ?>>แยกผู้ป่วยตามสาขา</a></li>
<li><a href="power_rate.php" <?php if ($p == "power") { echo "id=current"; } ?>>การผสมผสานอัตรากำลัง</a></li>
<li><a href="hour_per_sleep.php" <?php if ($p == "hour") { echo "id=current"; } ?>>จำนวนชั่วโมงการพยาบาลต่อวันนอน</a></li>
<li><a href="pressure_rate.php" <?php if ($p == "pressure") { echo "id=current"; } ?>>รายงานอัตราการเกิดแผลกดทับ</a></li>
<li><a href="readmit_rate.php" <?php if ($p == "readmit") { echo "id=current"; } ?>>รายงานอัตราการรีแอดมิต</a></li>
</ul>
<br />
<ul>
<?php if ($_SESSION["sess_uinid"] == "") { ?>
<li><a href="login.php">เข้าสู่ระบบ</a></li>
<?php } else { ?>
<li><a href="logout.php">ออกจากระบบ</a></li>
<?php } ?>
</ul>
</div>
