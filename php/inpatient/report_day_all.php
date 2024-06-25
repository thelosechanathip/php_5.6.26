<?php
include "sess_uin.php";
$p = "reportday_all";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานประจำวัน</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
$idate = $_POST['idate'];
if ($idate == "") {
	$dm = date("d/m/");
	$y = date("Y") + 543;
	$dmy = $dm.$y;
} else {
	$dmy = $idate;
}
$wage_type = $_POST['wage_type'];
if ($wage_type == "") {
	$wage_type = "0";
}
include "myclass.php";
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">รายงานประจำวัน รวมทุกตึก</td>
          </tr
          ><tr>
            <td height="25" align="left"><form method="post" name="frm1" action="<?php echo "$PHP_SELF"; ?>"><table width="580" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="74" height="25" align="left">ประจำวันที่</td>
                <td width="145" height="25" align="left">
                  <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />
                  <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
                  <script type="text/javascript" src="js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
                  <script type="text/javascript" src="js/dp.js"></script>
                  <style type="text/css">
			/*demo page css
			body{ font: 80% "Trebuchet MS", sans-serif; margin: 50px;}*/
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		      </style>
                  <input name="idate" type="text" id="datepicker-th-1" size="15" maxlength="30" readonly="readonly" value="<?php echo $dmy; ?>" /></td>
                <td width="169" height="25" align="left">&nbsp;</td>
                <td width="192" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="left">เวร</td>
                <td height="25" align="left"><select name="wage_type" id="wage_type">
                <!--<option value="0" selected="selected">--ทั้งหมด--</option>-->
                  <?php
$sqlwt = "SELECT wage_type_id, wage_type_name FROM wage_type ORDER BY wage_type_id";
$resultwt = $conn->query($sqlwt);
while ($rwt = $resultwt->fetch_array()) {
	if ($wage_type == $rwt['wage_type_id']) {
		echo "<option value='$rwt[wage_type_id]' selected>$rwt[wage_type_name]</optioin>";
	} else {
		echo "<option value='$rwt[wage_type_id]'>$rwt[wage_type_name]</optioin>";
	}
}
?>
                </select></td>
                <td height="25" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
                <td align="left">&nbsp;</td>
              </tr>
            </table></form></td>
          </tr>
          <tr>
            <td height="25"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/report_day_all_r.php?dmy=<?php echo $dmy; ?>&wage_type=<?php echo $wage_type; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/report_day_all_r.php?dmy=<?php echo $dmy; ?>&wage_type=<?php echo $wage_type; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
          <tr>
            <td> ประจำวันที่ <?php echo FormatDateFull(FormatDateDefault($dmy)); ?></td>
          </tr>
          <?php if ($wage_type != "0") { //เลือกเวรเดียว ?>
          <tr>
            <td align="left"><table width="1000" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="121" rowspan="3" align="center">หน่วยงาน</td>
                <td height="25" colspan="6" align="center">จำนวนผู้ป่วย</td>
                <td width="65" rowspan="3" align="center">รวม<br />
                  ให้การ<br />
                  พยาบาล</td>
                <td colspan="5" rowspan="2" align="center">ประเภทผู้ป่วย</td>
                <td colspan="2" rowspan="2" align="center">คง<br />
                  พยาบาล</td>
                <td colspan="5" rowspan="2" align="center">อัตรากำลังเจ้าหน้าที่</td>
                <td width="80" rowspan="3" align="center">Productivity</td>
              </tr>
              <tr>
                <td height="25" colspan="2" align="center">ยกมา</td>
                <td colspan="2" align="center">รับใหม่+รับย้าย</td>
                <td colspan="2" align="center">จำหน่าย+ย้ายตึก</td>
                </tr>
              <tr>
                <td width="35" height="25" align="center">PT</td>
                <td width="38" align="center">NB</td>
                <td width="39" align="center">PT</td>
                <td width="41" align="center">NB</td>
                <td width="39" align="center">PT</td>
                <td width="49" align="center">NB</td>
                <td width="35" align="center">วิกฤต</td>
                <td width="32" align="center">4</td>
                <td width="33" align="center">3</td>
                <td width="33" align="center">2</td>
                <td width="37" align="center">1</td>
                <td width="36" align="center">PT</td>
                <td width="33" align="center">NB</td>
                <td width="42" align="center">HN</td>
                <td width="37" align="center">RN</td>
                <td width="42" align="center">TN</td>
                <td width="43" align="center">PN</td>
                <td width="46" align="center">AID</td>
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
              <tr onmouseover=this.style.backgroundColor="#B9D5FF" onmouseout=this.style.backgroundColor="">
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
          <?php } //end เวรเดียว ?>
          <tr>
            <td align="left">หากไม่มีรายชื่อตึก แสดงว่าในวันดังกล่าว ตึกยังไม่มีการบันทึกข้อมูล</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
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