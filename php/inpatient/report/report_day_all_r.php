<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="report-day-all.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานประจำวัน รวมทุกตึก :: Report</title>
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
$dmy = $_GET['dmy'];
$wage_type = $_GET['wage_type'];
include "../myclass.php";
include "../connect.php";
//เวร
$sqlw = "SELECT wage_type_name FROM wage_type WHERE wage_type_id = '$wage_type'";
$resultw = $conn->query($sqlw);
$rw = $resultw->fetch_row();
?>
<table width="1020" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="center"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr class="tData">
        <td width="33" align="left">วันที่</td>
        <td width="162" align="center" valign="baseline" style="border-bottom:1px dotted #CCC;"><?php echo FormatDateFull(FormatDateDefault($dmy)); ?></td>
        <td width="48" align="center">เวร</td>
        <td width="65" align="center" style="border-bottom:1px dotted #CCC;"><?php echo $rw[0]; ?></td>
        <td width="692" align="left">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr align="center">
    <td height="25"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr class="tData">
        <td width="61" align="left">แพทย์เวร</td>
        <td width="939" align="center" valign="baseline" style="border-bottom:1px dotted #CCC;">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25" align="center"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr class="tData">
        <td width="118" align="left">พยาบาลเวรตรวจการ</td>
        <td width="882" align="center" valign="baseline" style="border-bottom:1px dotted #CCC;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="1000" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td width="121" rowspan="3" align="center"><span class="tData">หน่วยงาน</span></td>
        <td height="25" colspan="6" align="center"><span class="tData">จำนวนผู้ป่วย</span></td>
        <td width="65" rowspan="3" align="center"><span class="tData">รวม<br />
          ให้การ<br />
          พยาบาล</span></td>
        <td colspan="5" rowspan="2" align="center"><span class="tData">ประเภทผู้ป่วย</span></td>
        <td colspan="2" rowspan="2" align="center"><span class="tData">คง<br />
          พยาบาล</span></td>
        <td colspan="5" rowspan="2" align="center"><span class="tData">อัตรากำลังเจ้าหน้าที่</span></td>
        <td width="80" rowspan="3" align="center"><span class="tData">Productivity</span></td>
      </tr>
      <tr>
        <td height="25" colspan="2" align="center"><span class="tData">ยกมา</span></td>
        <td colspan="2" align="center"><span class="tData">รับใหม่+รับย้าย</span></td>
        <td colspan="2" align="center"><span class="tData">จำหน่าย+ย้ายตึก</span></td>
      </tr>
      <tr>
        <td width="35" height="25" align="center"><span class="tData">PT</span></td>
        <td width="38" align="center"><span class="tData">NB</span></td>
        <td width="39" align="center"><span class="tData">PT</span></td>
        <td width="41" align="center"><span class="tData">NB</span></td>
        <td width="39" align="center"><span class="tData">PT</span></td>
        <td width="49" align="center"><span class="tData">NB</span></td>
        <td width="35" align="center"><span class="tData">วิกฤต</span></td>
        <td width="32" align="center"><span class="tData">4</span></td>
        <td width="33" align="center"><span class="tData">3</span></td>
        <td width="33" align="center"><span class="tData">2</span></td>
        <td width="37" align="center"><span class="tData">1</span></td>
        <td width="36" align="center"><span class="tData">PT</span></td>
        <td width="33" align="center"><span class="tData">NB</span></td>
        <td width="42" align="center"><span class="tData">HN</span></td>
        <td width="37" align="center"><span class="tData">RN</span></td>
        <td width="42" align="center"><span class="tData">TN</span></td>
        <td width="43" align="center"><span class="tData">PN</span></td>
        <td width="46" align="center"><span class="tData">AID</span></td>
      </tr>
      <?php
$sqld = "SELECT ward.shortname, da.on_pt, da.on_nb
, (da.in_pt + da.move_pt) AS total_in_pt
, (da.in_nb + da.move_nb) AS total_in_nb
, (da.home_pt + da.move_b_pt + da.send_pt + da.dead_pt + da.non_voluntary_pt) AS total_out_pt
, (da.home_nb + da.move_b_nb + da.send_nb + da.dead_nb + da.non_voluntary_nb) AS total_out_nb
, (da.on_pt + da.in_pt + da.move_pt) AS sum_for_nurse
, da.patient_type5, da.patient_type4, da.patient_type3, da.patient_type2, da.patient_type1
, ((da.on_pt + da.in_pt + da.move_pt) - (da.home_pt + da.move_b_pt + da.send_pt + da.dead_pt + da.non_voluntary_pt)) AS fix_nurse_pt
, ((da.on_nb + da.in_nb + da.move_nb) - (da.home_nb + da.move_b_nb + da.send_nb + da.dead_nb + da.non_voluntary_nb)) AS fix_nurse_nb
, da.em_hn, da.em_rn, da.em_tn, da.em_pn, da.em_aid
FROM data_all AS da INNER JOIN ward ON da.ward = ward.ward WHERE da.idate = '".FormatDateDefault($dmy)."' AND da.wage_type_id = '$wage_type' ORDER BY ward.ordering";
$resultd = $conn->query($sqld);
while ($rd = $resultd->fetch_array()) {
?>
      <tr class="tData">
        <td height="25"><?php echo $rd['shortname']; ?></td>
        <td align="center"><?php echo $rd['on_pt']; ?></td>
        <td align="center"><?php echo $rd['on_nb']; ?></td>
        <td align="center"><?php echo $rd['total_in_pt']; ?></td>
        <td align="center"><?php echo $rd['total_in_nb']; ?></td>
        <td align="center"><?php echo $rd['total_out_pt']; ?></td>
        <td align="center"><?php echo $rd['total_out_nb']; ?></td>
        <td align="center"><?php echo $rd['sum_for_nurse']; ?></td>
        <td align="center"><?php echo $rd['patient_type5']; ?></td>
        <td align="center"><?php echo $rd['patient_type4']; ?></td>
        <td align="center"><?php echo $rd['patient_type3']; ?></td>
        <td align="center"><?php echo $rd['patient_type2']; ?></td>
        <td align="center"><?php echo $rd['patient_type1']; ?></td>
        <td align="center"><?php echo $rd['fix_nurse_pt']; ?></td>
        <td align="center"><?php echo $rd['fix_nurse_nb']; ?></td>
        <td align="center"><?php echo $rd['em_hn']; ?></td>
        <td align="center"><?php echo $rd['em_rn']; ?></td>
        <td align="center"><?php echo $rd['em_tn']; ?></td>
        <td align="center"><?php echo $rd['em_pn']; ?></td>
        <td align="center"><?php echo $rd['em_aid']; ?></td>
        <td align="center">&nbsp;</td>
      </tr>
      <?php } //end while ?>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="tData">หากไม่มีรายชื่อตึก แสดงว่าในวันดังกล่าว ตึกยังไม่มีการบันทึกข้อมูล</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="tData">วันที่พิมพ์ <?php echo FormatDateShort(date("Y-m-d")). "&nbsp;".date("H:i:s"); ?></td>
  </tr>
</table>
</body>
</html>