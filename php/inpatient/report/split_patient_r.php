<?php
$ac = $_GET['ac'];
if ($ac == "e") {
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="split-patient.xls"');#ชื่อไฟล์
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bed Turn Overrate :: Report</title>
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
$ward = $_GET['ward'];
$month1 = $_GET['month1'];
$year1= $_GET['year1'];
$month2 = $_GET['month2'];
$year2 = $_GET['year2'];
$i_status = $_GET['i_status'];
include "../connect.php";
include "../myarray.php";
include "../myclass.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php
          if ($month1 == $month2 && $year1 == $year2) { //ถ้าเป็นเดือนและปีเดียวกัน
			  //$num_day = cal_days_in_month(CAL_GREGORIAN, $month1, ($year1 - 543)); //จำนวนวันในเดือน
			  $num_day = MonthInDays($month1, ($year1 - 543));
		  ?>
  <tr>
    <td align="left"><span class="tHead">การให้บริการผู้ป่วยในแต่ละสาขา<?php
			echo "&nbsp;ประจำเดือน $month_r[$month1] พ.ศ. $year1";
			if ($ward != "0") {
				$sqlw = "SELECT name FROM ward WHERE ward = '$ward'";
				$resultw = $conn->query($sqlw);
				$rw = $resultw->fetch_row();
				echo "&nbsp;ตึกผู้ป่วย $rw[0]";
			}
			?></span><br /><table width="800" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="39" rowspan="2" align="center" bgcolor="#FFE1D2" class="tData" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;">วันที่</td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;">Patient Day</td>
                <td height="25" colspan="12" align="center" bgcolor="#B9FFFF" class="tData" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;">แยกแผนกผู้ป่วย (ห้องสามัญ)</td>
                </tr>
              <tr class="tData">
                <td width="43" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;">PT</td>
                <td width="47" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;">NB</td>
                <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">OBS</td>
                <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">NB</td>
                <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">GYN</td>
                <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">SURG</td>
                <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">MED</td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">PSYCH</td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">SKIN</td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">PED</td>
                <td width="54" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">ORTHO</td>
                <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">EYE</td>
                <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">ENT</td>
                <td width="62" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;">DENT</td>
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
			  $sqlsplit = "SELECT obs_n, nb_n, gyn_n, surg_n, med_n, psych_n, skin_n, ped_n, ortho_n, eye_n, ent_n, dent_n FROM data_split_patient WHERE idate = '$ymdsearch'";
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
			  ?>
              <tr>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $i; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_pt; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_nb; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['obs_n'] != "0") { echo $rsplit['obs_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['nb_n'] != "0") { echo $rsplit['nb_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['gyn_n'] != "0") { echo $rsplit['gyn_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['surg_n'] != "0") { echo $rsplit['surg_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['med_n'] != "0") { echo $rsplit['med_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['psych_n'] != "0") { echo $rsplit['psych_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['skin_n'] != "0") { echo $rsplit['skin_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ped_n'] != "0") { echo $rsplit['ped_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ortho_n'] != "0") { echo $rsplit['ortho_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['eye_n'] != "0") { echo $rsplit['eye_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ent_n'] != "0") { echo $rsplit['ent_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['dent_n'] != "0") { echo $rsplit['dent_n']; } ?>
                </span></td>
              </tr>
              <?php } //end for ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_obs; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_gyn; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_surg; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_med; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_psych; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_skin; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ped; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ortho; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_eye; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ent; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dent; ?></span></td>
  </tr>
            </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="39" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">วันที่</span></td>
        <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">Patient Day</span></td>
        <td height="25" colspan="12" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">แยกแผนกผู้ป่วย (ห้องพิเศษ)</span></td>
      </tr>
      <tr>
        <td width="43" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
        <td width="47" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
        <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">OBS</span></td>
        <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
        <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">GYN</span></td>
        <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">SURG</span></td>
        <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">MED</span></td>
        <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PSYCH</span></td>
        <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">SKIN</span></td>
        <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PED</span></td>
        <td width="54" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ORTHO</span></td>
        <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">EYE</span></td>
        <td width="57" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ENT</span></td>
        <td width="62" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">DENT</span></td>
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
			  $sqlsplit = "SELECT obs_s, nb_s, gyn_s, surg_s, med_s, psych_s, skin_s, ped_s, ortho_s, eye_s, ent_s, dent_s FROM data_split_patient WHERE idate = '$ymdsearch'";
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
			  ?>
      <tr>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $i; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_pt; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_nb; ?></span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['obs_s'] != "0") { echo $rsplit['obs_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['nb_s'] != "0") { echo $rsplit['nb_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['gyn_s'] != "0") { echo $rsplit['gyn_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['surg_s'] != "0") { echo $rsplit['surg_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['med_s'] != "0") { echo $rsplit['med_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['psych_s'] != "0") { echo $rsplit['psych_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['skin_s'] != "0") { echo $rsplit['skin_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['ped_s'] != "0") { echo $rsplit['ped_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['ortho_s'] != "0") { echo $rsplit['ortho_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['eye_s'] != "0") { echo $rsplit['eye_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['ent_s'] != "0") { echo $rsplit['ent_s']; } ?>
        </span></td>
        <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
          <?php if ($rsplit['dent_s'] != "0") { echo $rsplit['dent_s']; } ?>
        </span></td>
      </tr>
      <?php } //end for ?>
      <tr>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_obs; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_gyn; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_surg; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_med; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_psych; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_skin; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ped; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ortho; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_eye; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ent; ?></span></td>
        <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dent; ?></span></td>
      </tr>
    </table></td>
  </tr>
  <?php } //end เดือนเดียวกัน ?>
  <?php if ($month1 != $month2 || $year1 != $year2) { //ถ้าเป็นการเลือกดูข้อมูลระหว่างเดือน ?>
  <tr>
    <td align="left"><span class="tHead">การให้บริการผู้ป่วยในแต่ละสาขา<?php
			echo "&nbsp;ระหว่างเดือน $month_r[$month1] พ.ศ. $year1&nbsp;ถึงเดือน $month_r[$month2] พ.ศ. $year2";
			if ($ward != "0") {
				$sqlw = "SELECT name FROM ward WHERE ward = '$ward'";
				$resultw = $conn->query($sqlw);
				$rw = $resultw->fetch_row();
				echo "&nbsp;ตึกผู้ป่วย $rw[0]";
			}
			?></span><br /><table width="800" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="67" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">เดือน</span></td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">Patient Day</span></td>
                <td height="25" colspan="12" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">แยกแผนกผู้ป่วย (ห้องสามัญ)</span></td>
              </tr>
              <tr>
                <td width="54" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="52" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">OBS</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">GYN</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">SURG</span></td>
                <td width="53" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">MED</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PSYCH</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">SKIN</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PED</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ORTHO</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">EYE</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ENT</span></td>
                <td width="54" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">DENT</span></td>
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
			  $sqlsplit = "SELECT SUM(obs_n) AS obs_n, SUM(nb_n) AS nb_n, SUM(gyn_n) AS gyn_n, SUM(surg_n) AS surg_n, SUM(med_n) AS med_n, SUM(psych_n) AS psych_n, SUM(skin_n) AS skin_n, SUM(ped_n) AS ped_n, SUM(ortho_n) AS ortho_n, SUM(eye_n) AS eye_n, SUM(ent_n) AS ent_n, SUM(dent_n) AS dent_n FROM data_split_patient WHERE idate LIKE '$rm[ym]%'";
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
			  ?>
              <tr>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $month_rs[$yma[1]]."&nbsp;".substr(($yma[0] + 543), 2, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_pt; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_nb; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['obs_n'] != "0") { echo $rsplit['obs_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['nb_n'] != "0") { echo $rsplit['nb_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['gyn_n'] != "0") { echo $rsplit['gyn_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['surg_n'] != "0") { echo $rsplit['surg_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['med_n'] != "0") { echo $rsplit['med_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['psych_n'] != "0") { echo $rsplit['psych_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['skin_n'] != "0") { echo $rsplit['skin_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ped_n'] != "0") { echo $rsplit['ped_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ortho_n'] != "0") { echo $rsplit['ortho_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['eye_n'] != "0") { echo $rsplit['eye_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ent_n'] != "0") { echo $rsplit['ent_n']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['dent_n'] != "0") { echo $rsplit['dent_n']; } ?>
                </span></td>
              </tr>
              <?php } //end while เดือน ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_obs; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_gyn; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_surg; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_med; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_psych; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_skin; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ped; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ortho; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_eye; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ent; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dent; ?></span></td>
              </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table width="800" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="67" rowspan="2" align="center" bgcolor="#FFE1D2" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">เดือน</span></td>
                <td height="25" colspan="2" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">Patient Day</span></td>
                <td height="25" colspan="12" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000; border-top:1px solid #000;"><span class="tData">แยกแผนกผู้ป่วย (ห้องพิเศษ)</span></td>
              </tr>
              <tr>
                <td width="54" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PT</span></td>
                <td width="52" height="25" align="center" bgcolor="#CCFFE6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">OBS</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">NB</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">GYN</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">SURG</span></td>
                <td width="53" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">MED</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PSYCH</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">SKIN</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">PED</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ORTHO</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">EYE</span></td>
                <td width="52" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">ENT</span></td>
                <td width="54" height="25" align="center" bgcolor="#B9FFFF" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">DENT</span></td>
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
			  $sqlsplit = "SELECT SUM(obs_s) AS obs_s, SUM(nb_s) AS nb_s, SUM(gyn_s) AS gyn_s, SUM(surg_s) AS surg_s, SUM(med_s) AS med_s, SUM(psych_s) AS psych_s, SUM(skin_s) AS skin_s, SUM(ped_s) AS ped_s, SUM(ortho_s) AS ortho_s, SUM(eye_s) AS eye_s, SUM(ent_s) AS ent_s, SUM(dent_s) AS dent_s FROM data_split_patient WHERE idate LIKE '$rm[ym]%'";
			  if ($ward != "0") {
				  $sqlsplit .= " AND ward = '$ward'";
			  }
			  $resultsplit = $conn->query($sqlsplit);
			  $rsplit = $resultspli->fetch_array();
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
			  ?>
              <tr>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData"><?php echo $month_rs[$yma[1]]."&nbsp;".substr(($yma[0] + 543), 2, 2); ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_pt; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $on_nb; ?></span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['obs_s'] != "0") { echo $rsplit['obs_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['nb_s'] != "0") { echo $rsplit['nb_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['gyn_s'] != "0") { echo $rsplit['gyn_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['surg_s'] != "0") { echo $rsplit['surg_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['med_s'] != "0") { echo $rsplit['med_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['psych_s'] != "0") { echo $rsplit['psych_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['skin_s'] != "0") { echo $rsplit['skin_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ped_s'] != "0") { echo $rsplit['ped_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ortho_s'] != "0") { echo $rsplit['ortho_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['eye_s'] != "0") { echo $rsplit['eye_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['ent_s'] != "0") { echo $rsplit['ent_s']; } ?>
                </span></td>
                <td height="25" align="center" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData">
                <?php if ($rsplit['dent_s'] != "0") { echo $rsplit['dent_s']; } ?>
                </span></td>
              </tr>
              <?php } //end while เดือน ?>
              <tr>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-left:1px solid #000; border-right:1px solid #000;"><span class="tData">รวม</span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_pt; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_on_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_obs; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_nb; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_gyn; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_surg; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_med; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_psych; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_skin; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6"style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ped; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ortho; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_eye; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_ent; ?></span></td>
                <td height="25" align="center" bgcolor="#FFF3C6" style="border-bottom:1px solid #333; border-right:1px solid #000;"><span class="tData"><?php echo $total_dent; ?></span></td>
              </tr>
    </table></td>
  </tr>
  <?php } //end if เลือกข้อมูลระหว่างเดือน ?>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
</table>
</body>
</html>