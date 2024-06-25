<?php
include "sess_uin.php";
$p = "split";
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>การให้บริการผู้ป่วยในแต่ละสาขา</title>
<link rel="stylesheet" type="text/css" href="css/mycss.css"/>
</head>

<body>
<?php
include "myarray.php";
include "myclass.php";
$ynow = date("Y") + 543;
$ward = $_POST['ward'];
if ($ward == "") {
	$ward = "0";
}
$month1 = $_POST['month1'];
if ($month1 == "") {
	$month1 = date("m");
}
$year1= $_POST['year1'];
if ($year1 == "") {
	$year1 = $ynow;
}
$month2 = $_POST['month2'];
if ($month2 == "") {
	$month2 = date("m");
}
$year2 = $_POST['year2'];
if ($year2 == "") {
	$year2 = $ynow;
}
$button = $_POST['button'];
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
            <td height="25" class="textBlackBold" bgcolor="#FAE9F1" style="border-bottom:1px solid #F3CDDF; border-top:1px solid #F3CDDF;">รายงานแยกผู้ป่วยตามสาขา</td>
          </tr>
          <tr>
            <td align="left"><table width="780" border="0" cellspacing="0" cellpadding="0">
              <form method="post" action="report_split_patient.php">
              <tr>
                <td width="82" height="25" align="left">Ward</td>
                <td width="119" height="25" align="left"><select name="ward" id="ward">
                <?php if ($kk == "1") { ?>
                  <option value="0" selected="selected">--ทั้งหมด--</option>
                  <?php } ?>
                  <?php
				  $sqlw = "SELECT ward, shortname FROM ward WHERE ward_group != '' ORDER BY ward";
				  $resultw = $conn->query($sqlw);
				  while ($rw = $resultw->fetch_array()) {
					  if ($ward == $rw['ward']) {
						echo "<option value='$rw[ward]' selected>$rw[shortname]</option>";
					  } else {
					  	echo "<option value='$rw[ward]'>$rw[shortname]</option>";
					  }
				  }
				  ?>
                </select></td>
                <td width="384" height="25" align="left">&nbsp;</td>
                <td width="195" height="25" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="left">จากเดือน</td>
                <td height="25" align="left"><select name="month1" id="month1">
                  <?php
			foreach($month_r as $key => $val) {
				if ($month1 == $key) {
					echo "<option value='$key' selected>$val</option>";
				} else {
					echo "<option value='$key'>$val</option>";
				}
			}
			?>
                </select></td>
                <td height="25" align="left"><select name="year1" id="year1">
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
                <td height="25" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="left">ถึงเดือน</td>
                <td height="25" align="left"><select name="month2" id="month2">
                  <?php
			foreach($month_r as $key => $val) {
				if ($month2 == $key) {
					echo "<option value='$key' selected>$val</option>";
				} else {
					echo "<option value='$key'>$val</option>";
				}
			}
			?>
                </select></td>
                <td height="25" align="left"><select name="year2" id="year2">
                  <?php
			for ($i = $ynow; $i >= 2553; $i--) {
				if ($year2 == $i) {
					echo "<option value='$i' selected>$i</option>";
				} else {
					echo "<option value='$i'>$i</option>";
				}
			}
			?>
                </select></td>
                <td height="25" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="left">&nbsp;</td>
                <td height="25" align="left"><input type="submit" name="button" id="button" value="  ตกลง  " /></td>
                <td height="25" align="left">&nbsp;</td>
                <td height="25" align="left">&nbsp;</td>
              </tr>
              </form>
            </table></td>
          </tr>
          <tr>
            <td height="25" align="left"><img src="images/printer.png" width="23" height="23" border="0" align="absmiddle" /> <a href="report/split_patient_r.php?ward=<?php echo $ward; ?>&month1=<?php echo $month1; ?>&year1=<?php echo $year1; ?>&month2=<?php echo $month2; ?>&year2=<?php echo $year2; ?>&i_status=<?php echo $i_status; ?>&ac=p" target="_blank" id="k1">พิมพ์</a>&nbsp;&nbsp;&nbsp;<img src="images/excel.png" width="25" height="25" align="absmiddle" /> <a href="report/split_patient_r.php?ward=<?php echo $ward; ?>&month1=<?php echo $month1; ?>&year1=<?php echo $year1; ?>&month2=<?php echo $month2; ?>&year2=<?php echo $year2; ?>&i_status=<?php echo $i_status; ?>&ac=e" target="_blank" id="k1">ส่งออกเป็น Excel</a></td>
          </tr>
          <?php
          if ($month1 == $month2 && $year1 == $year2) { //ถ้าเป็นเดือนและปีเดียวกัน
			  //$num_day = cal_days_in_month(CAL_GREGORIAN, $month1, ($year1 - 543)); //จำนวนวันในเดือน
			  $num_day = MonthInDays($month1, ($year1 - 543));
		  ?>
          <tr>
            <td height="25" align="left">การให้บริการผู้ป่วยในแต่ละสาขา<?php
			echo "&nbsp;ประจำเดือน $month_r[$month1] พ.ศ. $year1";
			if ($ward != "0") {
				$sqlw = "SELECT name FROM ward WHERE ward = '$ward'";
				$resultw = $conn->query($sqlw);
				$rw = $resultw->fetch_row();
				echo "&nbsp;ตึกผู้ป่วย $rw[0]";
			}
			?><br />
<table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="31" rowspan="2" align="center" bgcolor="#FFE1D2">วันที่</td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">Patient Day</td>
                <td height="25" colspan="13" align="center" bgcolor="#B9FFFF">แยกแผนกผู้ป่วย (ห้องสามัญ)</td>
                </tr>
              <tr>
                <td width="43" height="25" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="43" height="25" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="49" height="25" align="center" bgcolor="#B9FFFF">OBS</td>
                <td width="46" height="25" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="50" height="25" align="center" bgcolor="#B9FFFF">GYN</td>
                <td width="55" height="25" align="center" bgcolor="#B9FFFF">SURG</td>
                <td width="51" height="25" align="center" bgcolor="#B9FFFF">MED</td>
                <td width="56" height="25" align="center" bgcolor="#B9FFFF">PSYCH</td>
                <td width="42" height="25" align="center" bgcolor="#B9FFFF">SKIN</td>
                <td width="45" height="25" align="center" bgcolor="#B9FFFF">PED</td>
                <td width="56" height="25" align="center" bgcolor="#B9FFFF">ORTHO</td>
                <td width="43" height="25" align="center" bgcolor="#B9FFFF">EYE</td>
                <td width="47" height="25" align="center" bgcolor="#B9FFFF">ENT</td>
                <td width="51" height="25" align="center" bgcolor="#B9FFFF">DENT</td>
                <td width="58" align="center" bgcolor="#B9FFFF">NEURO SURG</td>
              </tr>
              <?php
			  //ห้องสามัญ
			  $total_on_pt = 0;
			  $total_on_nb = 0;
			  $total_obs = 0;
			  $total_nb = 0;
			  $total_gyn = 0;
			  $total_surg = 0;
			  $total_med = 0;
			  $total_psych = 0;
			  $total_skin = 0;
			  $total_ped = 0;
			  $total_ortho = 0;
			  $total_eye = 0;
			  $total_ent = 0;
			  $total_dent = 0;
			  $total_neuro_surg = 0;
              for ($i = 1; $i <= $num_day; $i++) { //วนรอบตามจำนวนวันในเดือนที่เลือก
			  $ymdsearch = ($year1 - 543)."-".$month1."-".$i;
			  if ($ward == "0") {
				   $resultw = $conn->query($sqlw);
				   $on_pt = 0;
				   $on_nb = 0;
				   while ($rw = $resultw->fetch_array()) {
					   $sqlon = "SELECT on_pt, on_nb, in_pt, in_nb, move_pt, move_nb, home_pt, home_nb, move_b_pt, move_b_nb, send_pt, send_nb, dead_pt, dead_nb, non_voluntary_pt, non_voluntary_nb, ad_pt, ad_nb FROM data_all WHERE idate = '$ymdsearch' AND ward = '$rw[ward]' ORDER BY wage_type_id DESC LIMIT 0, 1";
					   $resulton = $conn->query($sqlon);
					  $ron = $resulton->fetch_array();
					  $sum_on_pt = $ron['on_pt'] + $ron['in_pt'] + $ron['move_pt'];
					  $sum_paid_pt = $ron['home_pt'] + $ron['move_b_pt'] + $ron['send_pt'] + $ron['dead_pt'] + $ron['non_voluntary_pt'];
					  $on_pt += $sum_on_pt - $sum_paid_pt;
					  $sum_on_nb = $ron['on_nb'] + $ron['in_nb'] + $ron['move_nb'];
					  $sum_paid_nb = $ron['home_nb'] + $ron['move_b_nb'] + $ron['send_nb'] + $ron['dead_nb'] + $ron['non_voluntary_nb'];
					  $on_nb += $sum_on_nb - $sum_paid_nb;
					  //ข้อมูลแยกผู้ป่วย
					  $sqlsplit = "SELECT obs_n, nb_n, gyn_n, surg_n, med_n, psych_n, skin_n, ped_n, ortho_n, eye_n, ent_n, dent_n, neuro_surg_n FROM data_split_patient WHERE idate = '$ymdsearch' AND ward = '$rw[ward]'";
					  $resultsplit = $conn->query($sqlsplit);
					  $rsplit = $resultsplit->fetch_array();
					  $total_obs += $rsplit['obs_n'];
		     		  $total_nb += $rsplit['nb_n'];
					  $total_gyn += $rsplit['gyn_n'];
					  $total_surg += $rsplit['surg_n'];
					  $total_med += $rsplit['med_n'];
					  $total_psych += $rsplit['psych_n'];
					  $total_skin += $rsplit['skin_n'];
					  $total_ped += $rsplit['ped_n'];
					  $total_ortho += $rsplit['ortho_n'];
					  $total_eye += $rsplit['eye_n'];
					  $total_ent += $rsplit['ent_n'];
					  $total_dent += $rsplit['dent_n'];
					  $total_neuro_surg += $rsplit['neuro_surg_n'];
					} //end while ward
				   $total_on_pt += $on_pt;
				   $total_on_nb += $on_nb;
			  } else { //end ward 0
				  $sqlon = "SELECT on_pt, on_nb, in_pt, in_nb, move_pt, move_nb, home_pt, home_nb, move_b_pt, move_b_nb, send_pt, send_nb, dead_pt, dead_nb, non_voluntary_pt, non_voluntary_nb, ad_pt, ad_nb FROM data_all WHERE idate = '$ymdsearch'";
				  if ($ward != "0") {
					  $sqlon .= " AND ward = '$ward'";
				  }
				  $sqlon .= " ORDER BY wage_type_id DESC LIMIT 0, 1";
				  $resulton = $conn->query($sqlon);
				  $ron = $resulton->fetch_array();
				  $sum_on_pt = $ron['on_pt'] + $ron['in_pt'] + $ron['move_pt'];
				  $sum_paid_pt = $ron['home_pt'] + $ron['move_b_pt'] + $ron['send_pt'] + $ron['dead_pt'] + $ron['non_voluntary_pt'];
				  $on_pt = $sum_on_pt - $sum_paid_pt;
				  $total_on_pt += $on_pt;
				  $sum_on_nb = $ron['on_nb'] + $ron['in_nb'] + $ron['move_nb'];
				  $sum_paid_nb = $ron['home_nb'] + $ron['move_b_nb'] + $ron['send_nb'] + $ron['dead_nb'] + $ron['non_voluntary_nb'];
				  $on_nb = $sum_on_nb - $sum_paid_nb;
				  $total_on_nb += $on_nb;
				  //ข้อมูลแยกผู้ป่วย
				  $sqlsplit = "SELECT obs_n, nb_n, gyn_n, surg_n, med_n, psych_n, skin_n, ped_n, ortho_n, eye_n, ent_n, dent_n, neuro_surg_n FROM data_split_patient WHERE idate = '$ymdsearch' AND ward = '$ward'";
				  $resultsplit = $conn->query($sqlsplit);
				  $rsplit = $resultsplit->fetch_array();
				  $total_obs += $rsplit['obs_n'];
				  $total_nb += $rsplit['nb_n'];
				  $total_gyn += $rsplit['gyn_n'];
				  $total_surg += $rsplit['surg_n'];
				  $total_med += $rsplit['med_n'];
				  $total_psych += $rsplit['psych_n'];
				  $total_skin += $rsplit['skin_n'];
				  $total_ped += $rsplit['ped_n'];
				  $total_ortho += $rsplit['ortho_n'];
				  $total_eye += $rsplit['eye_n'];
				  $total_ent += $rsplit['ent_n'];
				  $total_dent += $rsplit['dent_n'];
				  $total_neuro_surg += $rsplit['neuro_surg_n'];
			  }
			  //ข้อมูลแยกผู้ป่วย
			  /*$sqlsplit = "SELECT obs_n, nb_n, gyn_n, surg_n, med_n, psych_n, skin_n, ped_n, ortho_n, eye_n, ent_n, dent_n FROM data_split_patient WHERE idate = '$ymdsearch'";
			  if ($ward != "0") {
				  $sqlsplit .= " AND ward = '$ward'";
			  }
			  $resultsplit = $conn->query($sqlsplit);
			  $rsplit = mysql_fetch_array($resultsplit);
			  $total_obs += $rsplit['obs_n'];
		      $total_nb += $rsplit['nb_n'];
				  $total_gyn += $rsplit['gyn_n'];
				  $total_surg += $rsplit['surg_n'];
				  $total_med += $rsplit['med_n'];
				  $total_psych += $rsplit['psych_n'];
				  $total_skin += $rsplit['skin_n'];
				  $total_ped += $rsplit['ped_n'];
				  $total_ortho += $rsplit['ortho_n'];
				  $total_eye += $rsplit['eye_n'];
				  $total_ent += $rsplit['ent_n'];
				  $total_dent += $rsplit['dent_n'];*/
			  ?>
              <tr>
                <td height="25" align="center"><?php echo $i; ?></td>
                <td height="25" align="center"><?php echo $on_pt; ?></td>
                <td height="25" align="center"><?php echo $on_nb; ?></td>
                <td height="25" align="center"><?php if ($rsplit['obs_n'] != "0" && $rsplit['obs_n'] != '') { echo $rsplit['obs_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['nb_n'] != "0" && $rsplit['nb_n'] != "") { echo $rsplit['nb_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['gyn_n'] != "0" && $rsplit['gyn_n'] != "") { echo $rsplit['gyn_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['surg_n'] != "0" && $rsplit['surg_n'] != "") { echo $rsplit['surg_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['med_n'] != "0" && $rsplit['med_n'] != "") { echo $rsplit['med_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['psych_n'] != "0" && $rsplit['psych_n'] != "") { echo $rsplit['psych_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['skin_n'] != "0" && $rsplit['skin_n'] != "") { echo $rsplit['skin_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ped_n'] != "0" && $rsplit['ped_n'] != "") { echo $rsplit['ped_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ortho_n'] != "0" && $rsplit['ortho_n'] != "") { echo $rsplit['ortho_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['eye_n'] != "0" && $rsplit['eye_n'] != "") { echo $rsplit['eye_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ent_n'] != "0" && $rsplit['ent_n'] != "") { echo $rsplit['ent_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['dent_n'] != "0" && $rsplit['dent_n'] != "") { echo $rsplit['dent_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['neuro_surg_n'] != "0" && $rsplit['neuro_surg_n'] != "") { echo $rsplit['neuro_surg_n']; } else { echo "&nbsp;"; } ?></td>
              </tr>
              <?php } //end for ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo number_format($total_on_pt, 0); ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo number_format($total_on_nb, 0); ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_obs; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_nb; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_gyn; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_surg; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_med; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_psych; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_skin; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ped; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ortho; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_eye; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_dent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_neuro_surg; ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            </tr>
          <tr>
            <td align="left"><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="31" rowspan="2" align="center" bgcolor="#FFE1D2">วันที่</td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">Patient Day</td>
                <td height="25" colspan="13" align="center" bgcolor="#B9FFFF">แยกแผนกผู้ป่วย (ห้องพิเศษ)</td>
              </tr>
              <tr>
                <td width="43" height="25" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="43" height="25" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="49" height="25" align="center" bgcolor="#B9FFFF">OBS</td>
                <td width="46" height="25" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="50" height="25" align="center" bgcolor="#B9FFFF">GYN</td>
                <td width="55" height="25" align="center" bgcolor="#B9FFFF">SURG</td>
                <td width="51" height="25" align="center" bgcolor="#B9FFFF">MED</td>
                <td width="56" height="25" align="center" bgcolor="#B9FFFF">PSYCH</td>
                <td width="42" height="25" align="center" bgcolor="#B9FFFF">SKIN</td>
                <td width="45" height="25" align="center" bgcolor="#B9FFFF">PED</td>
                <td width="56" height="25" align="center" bgcolor="#B9FFFF">ORTHO</td>
                <td width="43" height="25" align="center" bgcolor="#B9FFFF">EYE</td>
                <td width="47" height="25" align="center" bgcolor="#B9FFFF">ENT</td>
                <td width="51" height="25" align="center" bgcolor="#B9FFFF">DENT</td>
                <td width="58" align="center" bgcolor="#B9FFFF">NEURO SURG</td>
              </tr>
              <?php
			  //ห้องพิเศษ
			  $total_on_pt = 0;
			  $total_on_nb = 0;
			  $total_obs = 0;
			  $total_nb = 0;
			  $total_gyn = 0;
			  $total_surg = 0;
			  $total_med = 0;
			  $total_psych = 0;
			  $total_skin = 0;
			  $total_ped = 0;
			  $total_ortho = 0;
			  $total_eye = 0;
			  $total_ent = 0;
			  $total_dent = 0;
			  $total_neuro_surg = 0;
              for ($i = 1; $i <= $num_day; $i++) { //วนรอบตามจำนวนวันในเดือนที่เลือก
			  $ymdsearch = ($year1 - 543)."-".$month1."-".$i;
			  $sqlon = "SELECT on_pt, on_nb, in_pt, in_nb, move_pt, move_nb, home_pt, home_nb, move_b_pt, move_b_nb, send_pt, send_nb, dead_pt, dead_nb, non_voluntary_pt, non_voluntary_nb, ad_pt, ad_nb FROM data_all WHERE idate = '$ymdsearch'";
			  if ($ward != "0") {
				  $sqlon .= " AND ward = '$ward'";
			  }
			  $sqlon .= " ORDER BY wage_type_id DESC LIMIT 0, 1";
			  $resulton = $conn->query($sqlon);
			  $ron = $resulton->fetch_array();
			  $sum_on_pt = $ron['on_pt'] + $ron['in_pt'] + $ron['move_pt'];
			  $sum_paid_pt = $ron['home_pt'] + $ron['move_b_pt'] + $ron['send_pt'] + $ron['dead_pt'] + $ron['non_voluntary_pt'];
			  $on_pt = $sum_on_pt - $sum_paid_pt;
			  $total_on_pt += $on_pt;
			  $sum_on_nb = $ron['on_nb'] + $ron['in_nb'] + $ron['move_nb'];
			  $sum_paid_nb = $ron['home_nb'] + $ron['move_b_nb'] + $ron['send_nb'] + $ron['dead_nb'] + $ron['non_voluntary_nb'];
			  $on_nb = $sum_on_nb - $sum_paid_nb;
			  $total_on_nb += $on_nb;
			  //ข้อมูลแยกผู้ป่วย
			  $sqlsplit = "SELECT obs_s, nb_s, gyn_s, surg_s, med_s, psych_s, skin_s, ped_s, ortho_s, eye_s, ent_s, dent_s, neuro_surg_s FROM data_split_patient WHERE idate = '$ymdsearch'";
			  if ($ward != "0") {
				  $sqlsplit .= " AND ward = '$ward'";
			  }
			  $resultsplit = $conn->query($sqlsplit);
			  $rsplit = $resultsplit->fetch_array();
			  $total_obs += $rsplit['obs_s'];
			  $total_nb += $rsplit['nb_s'];
			  $total_gyn += $rsplit['gyn_s'];
			  $total_surg += $rsplit['surg_s'];
			  $total_med += $rsplit['med_s'];
			  $total_psych += $rsplit['psych_s'];
			  $total_skin += $rsplit['skin_s'];
			  $total_ped += $rsplit['ped_s'];
			  $total_ortho += $rsplit['ortho_s'];
			  $total_eye += $rsplit['eye_s'];
			  $total_ent += $rsplit['ent_s'];
			  $total_dent += $rsplit['dent_s'];
			  $total_neuro_surg += $rsplit['neuro_surg_s'];
			  ?>
              <tr>
                <td height="25" align="center"><?php echo $i; ?></td>
                <td height="25" align="center"><?php echo $on_pt; ?></td>
                <td height="25" align="center"><?php echo $on_nb; ?></td>
                <td height="25" align="center"><?php if ($rsplit['obs_s'] != "0" && $rsplit['obs_s'] != "") { echo $rsplit['obs_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['nb_s'] != "0" && $rsplit['nb_s'] != "") { echo $rsplit['nb_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['gyn_s'] != "0" && $rsplit['gyn_s'] != "") { echo $rsplit['gyn_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['surg_s'] != "0" && $rsplit['surg_s'] != "") { echo $rsplit['surg_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['med_s'] != "0" && $rsplit['med_s'] != "") { echo $rsplit['med_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['psych_s'] != "0" && $rsplit['psych_s'] != "") { echo $rsplit['psych_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['skin_s'] != "0" && $rsplit['skin_s'] != "") { echo $rsplit['skin_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ped_s'] != "0" && $rsplit['ped_s'] != "") { echo $rsplit['ped_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ortho_s'] != "0" && $rsplit['ortho_s'] != "") { echo $rsplit['ortho_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['eye_s'] != "0" && $rsplit['eye_s'] != "") { echo $rsplit['eye_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ent_s'] != "0" && $rsplit['ent_s'] != "") { echo $rsplit['ent_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['dent_s'] != "0" && $rsplit['dent_s'] != "") { echo $rsplit['dent_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['neuro_surg_s'] != "0" && $rsplit['neuro_surg_s'] != "") { echo $rsplit['neuro_surg_s']; } else { echo "&nbsp;"; } ?></td>
              </tr>
              <?php } //end for ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_on_pt; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_on_nb; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_obs; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_nb; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_gyn; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_surg; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_med; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_psych; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_skin; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ped; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ortho; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_eye; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_dent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_neuro_surg; ?></td>
              </tr>
            </table></td>
          </tr>
          <?php } //end เดือนเดียวกัน ?>
          <?php if ($month1 != $month2 || $year1 != $year2) { //ถ้าเป็นการเลือกดูข้อมูลระหว่างเดือน ?>
          <tr>
            <td>การให้บริการผู้ป่วยในแต่ละสาขา<?php
			echo "&nbsp;ระหว่างเดือน $month_r[$month1] พ.ศ. $year1&nbsp;ถึงเดือน $month_r[$month2] พ.ศ. $year2";
			if ($ward != "0") {
				$sqlw = "SELECT name FROM ward WHERE ward = '$ward'";
				$resultw = $conn->query($sqlw);
				$rw = $resultw->fetch_row();
				echo "&nbsp;ตึกผู้ป่วย $rw[0]";
			}
			?><br /><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="59" rowspan="2" align="center" bgcolor="#FFE1D2">เดือน</td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">Patient Day</td>
                <td height="25" colspan="13" align="center" bgcolor="#B9FFFF">แยกแผนกผู้ป่วย (ห้องสามัญ)</td>
              </tr>
              <tr>
                <td width="45" height="25" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="47" height="25" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="43" height="25" align="center" bgcolor="#B9FFFF">OBS</td>
                <td width="44" height="25" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="48" height="25" align="center" bgcolor="#B9FFFF">GYN</td>
                <td width="48" height="25" align="center" bgcolor="#B9FFFF">SURG</td>
                <td width="46" height="25" align="center" bgcolor="#B9FFFF">MED</td>
                <td width="53" height="25" align="center" bgcolor="#B9FFFF">PSYCH</td>
                <td width="44" height="25" align="center" bgcolor="#B9FFFF">SKIN</td>
                <td width="50" height="25" align="center" bgcolor="#B9FFFF">PED</td>
                <td width="53" height="25" align="center" bgcolor="#B9FFFF">ORTHO</td>
                <td width="42" height="25" align="center" bgcolor="#B9FFFF">EYE</td>
                <td width="45" height="25" align="center" bgcolor="#B9FFFF">ENT</td>
                <td width="41" height="25" align="center" bgcolor="#B9FFFF">DENT</td>
                <td width="58" align="center" bgcolor="#B9FFFF">NEURO SURG</td>
              </tr>
              <?php
			  //ห้องสามัญ
			  $total_on_pt = 0;
			  $total_on_nb = 0;
			  $total_obs = 0;
			  $total_nb = 0;
			  $total_gyn = 0;
			  $total_surg = 0;
			  $total_med = 0;
			  $total_psych = 0;
			  $total_skin = 0;
			  $total_ped = 0;
			  $total_ortho = 0;
			  $total_eye = 0;
			  $total_ent = 0;
			  $total_dent = 0;
			  $total_neuro_surg = 0;
			  $ymsearch1 = ($year1 - 543).$month1;
			  $ymsearch2 = ($year2 - 543).$month2;
			  $sqlm = "SELECT DISTINCT MID(idate, 1, 7) AS ym FROM data_split_patient WHERE MID(replace(idate, '-', ''), 1, 6) BETWEEN '$ymsearch1' AND '$ymsearch2'";
			  if ($ward != "0") {
				  $sqlm .= " AND ward = '$ward'";
			  }
			  $sqlm .= " ORDER BY ym";
			  $resultm = $conn->query($sqlm);
			  while ($rm = $resultm->fetch_array()) { //วนรอบเดือน
				  $yma = explode("-", $rm['ym']);
			  $sqlon = "SELECT wage_type_id, on_pt, on_nb, in_pt, in_nb, move_pt, move_nb, home_pt, home_nb, move_b_pt, move_b_nb, send_pt, send_nb, dead_pt, dead_nb, non_voluntary_pt, non_voluntary_nb, ad_pt, ad_nb FROM data_all WHERE idate LIKE '$rm[ym]%'";
			  if ($ward != "0") {
				  $sqlon .= " AND ward = '$ward'";
			  }
			  $sqlon .= " ORDER BY wage_type_id DESC";
			  $resulton = $conn->query($sqlon);
			  $on_pt = 0;
			  $on_nb = 0;
			  while ($ron = $resulton->fetch_array()) { //วนรอบข้อมูล
				  if ($ron['wage_type_id'] == "3") {
					  $sum_on_pt = $ron['on_pt'] + $ron['in_pt'] + $ron['move_pt'];
					  $sum_paid_pt = $ron['home_pt'] + $ron['move_b_pt'] + $ron['send_pt'] + $ron['dead_pt'] + $ron['non_voluntary_pt'];
					  $on_pt += $sum_on_pt - $sum_paid_pt;
					  $sum_on_nb = $ron['on_nb'] + $ron['in_nb'] + $ron['move_nb'];
					  $sum_paid_nb = $ron['home_nb'] + $ron['move_b_nb'] + $ron['send_nb'] + $ron['dead_nb'] + $ron['non_voluntary_nb'];
					  $on_nb += $sum_on_nb - $sum_paid_nb;
				  }
			  } //end while on_pt
			  $total_on_pt += $on_pt;
			  $total_on_nb += $on_nb;
			  //ข้อมูลแยกผู้ป่วย
			  $sqlsplit = "SELECT SUM(obs_n) AS obs_n, SUM(nb_n) AS nb_n, SUM(gyn_n) AS gyn_n, SUM(surg_n) AS surg_n, SUM(med_n) AS med_n, SUM(psych_n) AS psych_n, SUM(skin_n) AS skin_n, SUM(ped_n) AS ped_n, SUM(ortho_n) AS ortho_n, SUM(eye_n) AS eye_n, SUM(ent_n) AS ent_n, SUM(dent_n) AS dent_n, SUM(neuro_surg_n) AS neuro_surg_n FROM data_split_patient WHERE idate LIKE '$rm[ym]%'";
			  if ($ward != "0") {
				  $sqlsplit .= " AND ward = '$ward'";
			  }
			  $resultsplit = $conn->query($sqlsplit);
			  $rsplit = $resultsplit->fetch_array();
			  $total_obs += $rsplit['obs_n'];
			  $total_nb += $rsplit['nb_n'];
			  $total_gyn += $rsplit['gyn_n'];
			  $total_surg += $rsplit['surg_n'];
			  $total_med += $rsplit['med_n'];
			  $total_psych += $rsplit['psych_n'];
			  $total_skin += $rsplit['skin_n'];
			  $total_ped += $rsplit['ped_n'];
			  $total_ortho += $rsplit['ortho_n'];
			  $total_eye += $rsplit['eye_n'];
			  $total_ent += $rsplit['ent_n'];
			  $total_dent += $rsplit['dent_n'];
			  $total_neuro_surg += $rsplit['neuro_surg_n'];
			  ?>
              <tr>
                <td height="25" align="center"><?php echo $month_rs[$yma[1]]."&nbsp;".substr(($yma[0] + 543), 2, 2); ?></td>
                <td height="25" align="center"><?php echo $on_pt; ?></td>
                <td height="25" align="center"><?php echo $on_nb; ?></td>
                <td height="25" align="center"><?php if ($rsplit['obs_n'] != "0") { echo $rsplit['obs_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['nb_n'] != "0") { echo $rsplit['nb_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['gyn_n'] != "0") { echo $rsplit['gyn_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['surg_n'] != "0") { echo $rsplit['surg_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['med_n'] != "0") { echo $rsplit['med_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['psych_n'] != "0") { echo $rsplit['psych_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['skin_n'] != "0") { echo $rsplit['skin_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ped_n'] != "0") { echo $rsplit['ped_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ortho_n'] != "0") { echo $rsplit['ortho_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['eye_n'] != "0") { echo $rsplit['eye_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ent_n'] != "0") { echo $rsplit['ent_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['dent_n'] != "0") { echo $rsplit['dent_n']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['neuro_surg_n'] != "0") { echo $rsplit['neuro_surg_n']; } else { echo "&nbsp;"; } ?></td>
              </tr>
              <?php } //end while เดือน ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_on_pt; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_on_nb; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_obs; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_nb; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_gyn; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_surg; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_med; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_psych; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_skin; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ped; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ortho; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_eye; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_dent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_neuro_surg; ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="800" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="59" rowspan="2" align="center" bgcolor="#FFE1D2">เดือน</td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6">Patient Day</td>
                <td height="25" colspan="13" align="center" bgcolor="#B9FFFF">แยกแผนกผู้ป่วย (ห้องพิเศษ)</td>
              </tr>
              <tr>
                <td width="45" height="25" align="center" bgcolor="#CCFFE6">PT</td>
                <td width="47" height="25" align="center" bgcolor="#CCFFE6">NB</td>
                <td width="43" height="25" align="center" bgcolor="#B9FFFF">OBS</td>
                <td width="44" height="25" align="center" bgcolor="#B9FFFF">NB</td>
                <td width="48" height="25" align="center" bgcolor="#B9FFFF">GYN</td>
                <td width="48" height="25" align="center" bgcolor="#B9FFFF">SURG</td>
                <td width="46" height="25" align="center" bgcolor="#B9FFFF">MED</td>
                <td width="53" height="25" align="center" bgcolor="#B9FFFF">PSYCH</td>
                <td width="44" height="25" align="center" bgcolor="#B9FFFF">SKIN</td>
                <td width="50" height="25" align="center" bgcolor="#B9FFFF">PED</td>
                <td width="53" height="25" align="center" bgcolor="#B9FFFF">ORTHO</td>
                <td width="42" height="25" align="center" bgcolor="#B9FFFF">EYE</td>
                <td width="45" height="25" align="center" bgcolor="#B9FFFF">ENT</td>
                <td width="41" height="25" align="center" bgcolor="#B9FFFF">DENT</td>
                <td width="58" align="center" bgcolor="#B9FFFF">NEURO SURG</td>
              </tr>
              <?php
			  //ห้องพิเศษ
			  $total_on_pt = 0;
			  $total_on_nb = 0;
			  $total_obs = 0;
			  $total_nb = 0;
			  $total_gyn = 0;
			  $total_surg = 0;
			  $total_med = 0;
			  $total_psych = 0;
			  $total_skin = 0;
			  $total_ped = 0;
			  $total_ortho = 0;
			  $total_eye = 0;
			  $total_ent = 0;
			  $total_dent = 0;
			  $total_neuro_surg = 0;
			  $ymsearch1 = ($year1 - 543).$month1;
			  $ymsearch2 = ($year2 - 543).$month2;
			  $sqlm = "SELECT DISTINCT MID(idate, 1, 7) AS ym FROM data_split_patient WHERE MID(replace(idate, '-', ''), 1, 6) BETWEEN '$ymsearch1' AND '$ymsearch2'";
			  if ($ward != "0") {
				  $sqlm .= " AND ward = '$ward'";
			  }
			  $sqlm .= " ORDER BY ym";
			  $resultm = $conn->query($sqlm);
			  while ($rm = $resultm->fetch_array()) { //วนรอบเดือน
				  $yma = explode("-", $rm['ym']);
			  $sqlon = "SELECT wage_type_id, on_pt, on_nb, in_pt, in_nb, move_pt, move_nb, home_pt, home_nb, move_b_pt, move_b_nb, send_pt, send_nb, dead_pt, dead_nb, non_voluntary_pt, non_voluntary_nb, ad_pt, ad_nb FROM data_all WHERE idate LIKE '$rm[ym]%'";
			  if ($ward != "0") {
				  $sqlon .= " AND ward = '$ward'";
			  }
			  $sqlon .= " ORDER BY wage_type_id DESC";
			  $resulton = $conn->query($sqlon);
			  $on_pt = 0;
			  $on_nb = 0;
			  while ($ron = $resulton->fetch_array()) { //วนรอบข้อมูล
				  if ($ron['wage_type_id'] == "3") {
					  $sum_on_pt = $ron['on_pt'] + $ron['in_pt'] + $ron['move_pt'];
					  $sum_paid_pt = $ron['home_pt'] + $ron['move_b_pt'] + $ron['send_pt'] + $ron['dead_pt'] + $ron['non_voluntary_pt'];
					  $on_pt += $sum_on_pt - $sum_paid_pt;
					  $sum_on_nb = $ron['on_nb'] + $ron['in_nb'] + $ron['move_nb'];
					  $sum_paid_nb = $ron['home_nb'] + $ron['move_b_nb'] + $ron['send_nb'] + $ron['dead_nb'] + $ron['non_voluntary_nb'];
					  $on_nb += $sum_on_nb - $sum_paid_nb;
				  }
			  } //end while on_pt
			  $total_on_pt += $on_pt;
			  $total_on_nb += $on_nb;
			  //ข้อมูลแยกผู้ป่วย
			  $sqlsplit = "SELECT SUM(obs_s) AS obs_s, SUM(nb_s) AS nb_s, SUM(gyn_s) AS gyn_s, SUM(surg_s) AS surg_s, SUM(med_s) AS med_s, SUM(psych_s) AS psych_s, SUM(skin_s) AS skin_s, SUM(ped_s) AS ped_s, SUM(ortho_s) AS ortho_s, SUM(eye_s) AS eye_s, SUM(ent_s) AS ent_s, SUM(dent_s) AS dent_s, SUM(neuro_surg_s) AS neuro_surg_s FROM data_split_patient WHERE idate LIKE '$rm[ym]%'";
			  if ($ward != "0") {
				  $sqlsplit .= " AND ward = '$ward'";
			  }
			  $resultsplit = $conn->query($sqlsplit);
			  $rsplit = $resultsplit->fetch_array();
			  $total_obs += $rsplit['obs_s'];
			  $total_nb += $rsplit['nb_s'];
			  $total_gyn += $rsplit['gyn_s'];
			  $total_surg += $rsplit['surg_s'];
			  $total_med += $rsplit['med_s'];
			  $total_psych += $rsplit['psych_s'];
			  $total_skin += $rsplit['skin_s'];
			  $total_ped += $rsplit['ped_s'];
			  $total_ortho += $rsplit['ortho_s'];
			  $total_eye += $rsplit['eye_s'];
			  $total_ent += $rsplit['ent_s'];
			  $total_dent += $rsplit['dent_s'];
			  $total_neuro_surg += $rsplit['neuro_surg_s'];
			  ?>
              <tr>
                <td height="25" align="center"><?php echo $month_rs[$yma[1]]."&nbsp;".substr(($yma[0] + 543), 2, 2); ?></td>
                <td height="25" align="center"><?php echo $on_pt; ?></td>
                <td height="25" align="center"><?php echo $on_nb; ?></td>
                <td height="25" align="center"><?php if ($rsplit['obs_s'] != "0") { echo $rsplit['obs_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['nb_s'] != "0") { echo $rsplit['nb_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['gyn_s'] != "0") { echo $rsplit['gyn_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['surg_s'] != "0") { echo $rsplit['surg_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['med_s'] != "0") { echo $rsplit['med_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['psych_s'] != "0") { echo $rsplit['psych_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['skin_s'] != "0") { echo $rsplit['skin_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ped_s'] != "0") { echo $rsplit['ped_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ortho_s'] != "0") { echo $rsplit['ortho_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['eye_s'] != "0") { echo $rsplit['eye_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['ent_s'] != "0") { echo $rsplit['ent_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['dent_s'] != "0") { echo $rsplit['dent_s']; } else { echo "&nbsp;"; } ?></td>
                <td height="25" align="center"><?php if ($rsplit['neuro_surg_s'] != "0") { echo $rsplit['neuro_surg_s']; } else { echo "&nbsp;"; } ?></td>
              </tr>
              <?php } //end while เดือน ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6">รวม</td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_on_pt; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_on_nb; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_obs; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_nb; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_gyn; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_surg; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_med; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_psych; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_skin; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ped; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ortho; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_eye; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_ent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_dent; ?></td>
                <td height="25" align="center" bgcolor="#FFF3C6"><?php echo $total_neuro_surg; ?></td>
              </tr>
            </table></td>
          </tr>
          <?php } //end if เลือกข้อมูลระหว่างเดือน ?>
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