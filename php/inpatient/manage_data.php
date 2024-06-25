<?php
// date_default_timezone_set('Asia/Bangkok');
include "sess_uin.php";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
$st = $_POST['st'];
$idate = $_POST['idate'];
$wage_type = $_POST['wage_type'];
$on_pt = $_POST['on_pt'];
$on_nb = $_POST['on_nb'];
$in_pt = $_POST['in_pt'];
$in_nb = $_POST['in_nb'];
$move_pt = $_POST['move_pt'];
$move_nb = $_POST['move_nb'];
$home_pt = $_POST['home_pt'];
$home_nb = $_POST['home_nb'];
$move_b_pt = $_POST['move_b_pt'];
$move_b_nb = $_POST['move_b_nb'];
$send_pt = $_POST['send_pt'];
$send_nb = $_POST['send_nb'];
$dead_pt = $_POST['dead_pt'];
$dead_nb = $_POST['dead_nb'];
$non_voluntary_pt = $_POST['non_voluntary_pt'];
$non_voluntary_nb = $_POST['non_voluntary_nb'];
$ad_pt = $_POST['ad_pt'];
$ad_nb = $_POST['ad_nb'];
$patient_type5 = $_POST['patient_type5'];
$patient_type4 = $_POST['patient_type4'];
$patient_type3 = $_POST['patient_type3'];
$patient_type2 = $_POST['patient_type2'];
$patient_type1 = $_POST['patient_type1'];
$amount_bed = $_POST['amount_bed'];
$em_hn = $_POST['em_hn'];
$em_rn = $_POST['em_rn'];
$em_tn = $_POST['em_tn'];
$em_pn = $_POST['em_pn'];
$em_aid = $_POST['em_aid'];
if ($wage_type == "3") { //ถ้าเป็นเวรบ่าย
	//ห้องสามัญ
	$obs_n = $_POST['obs_n'];
	$nb_n = $_POST['nb_n'];
	$gyn_n = $_POST['gyn_ n'];
	$surg_n = $_POST['surg_n'];
	$med_n = $_POST['med_n'];
	$psych_n = $_POST['psych_n'];
	$skin_n = $_POST['skin_n'];
	$ped_n = $_POST['ped_n'];
	$ortho_n = $_POST['ortho_n'];
	$eye_n = $_POST['eye_n'];
	$ent_n = $_POST['ent_n'];
	$dent_n = $_POST['dent_n'];
	$neuro_surg_n = $_POST['neuro_surg_n'];
	//ห้องพิเศษ
	$obs_s = $_POST['obs_s'];
	$nb_s = $_POST['nb_s'];
	$gyn_s = $_POST['gys_s'];
	$surg_s = $_POST['surg_s'];
	$med_s = $_POST['med_s'];
	$psych_s = $_POST['psych_s'];
	$skin_s = $_POST['skin_s'];
	$ped_s = $_POST['ped_s'];
	$ortho_s = $_POST['ortho_s'];
	$eye_s = $_POST['eye_s'];
	$ent_s = $_POST['ent_s'];
	$dent_s = $_POST['dent_s'];
	$neuro_surg_s = $_POST['neuro_surg_s'];
	//แผลกดทับ
	$do_pressure = $_POST['do_pressure'];
	$risk_pressure = $_POST['risk_pressure'];
}
$readmit_amount = $_POST['readmit_amount'];
$discharge_amount = $_POST['discharge_amount'];
if ($idate == "" || $wage_type == "") {
	echo "<center><br><br>Error! no data...</center>";
	exit();
}
$ymdnow = date("Y-m-d H:i:s");
include "connect.php";
include "myclass.php";
$idate = FormatDateDefault($idate);
if ($st == "save") { //เพิ่มข้อมูลใหม่
	$sql = "INSERT INTO data_all(ward, idate, wage_type_id, on_pt, on_nb, in_pt, in_nb, move_pt, move_nb, home_pt, home_nb, move_b_pt, move_b_nb, send_pt, send_nb, dead_pt, dead_nb, non_voluntary_pt, non_voluntary_nb, ad_pt, ad_nb, patient_type5, patient_type4, patient_type3, patient_type2, patient_type1, amount_bed, em_hn, em_rn, em_tn, em_pn, em_aid, i_status, last_date, user_update) VALUES('$_SESSION[sess_ward]', '$idate', '$wage_type', '$on_pt', '$on_nb', '$in_pt', '$in_nb', '$move_pt', '$move_nb', '$home_pt', '$home_nb', '$move_b_pt', '$move_b_nb', '$send_pt', '$send_nb', '$dead_pt', '$dead_nb', '$non_voluntary_pt', '$non_voluntary_nb', '$ad_pt', '$ad_nb', '$patient_type5', '$patient_type4', '$patient_type3', '$patient_type2', '$patient_type1', '$amount_bed', '$em_hn', '$em_rn', '$em_tn', '$em_pn', '$em_aid', 0, '$ymdnow', '$_SESSION[sess_uinid]')";
	if ($wage_type == "3") { //ถ้าเป็นเวรบ่าย
		$sql2 = "INSERT INTO data_split_patient(ward, idate, obs_n, nb_n, gyn_n, surg_n, med_n, psych_n, skin_n, ped_n, ortho_n, eye_n, ent_n, dent_n, neuro_surg_n, obs_s, nb_s, gyn_s, surg_s, med_s, psych_s, skin_s, ped_s, ortho_s, eye_s, ent_s, dent_s, neuro_surg_s) VALUES('$_SESSION[sess_ward]', '$idate', '$obs_n', '$nb_n', '$gyn_n', '$surg_n', '$med_n', '$psych_n', '$skin_s', '$ped_n', '$ortho_n', '$eye_n', '$ent_n', '$dent_n', '$neuro_surg_n', '$obs_s', '$nb_s', '$gyn_s', '$surg_s', '$med_s', '$psych_s', '$skin_s', '$ped_s', '$ortho_s', '$eye_s', '$ent_s', '$dent_s', '$neuro_surg_s')";
		$result2 = $conn->query($sql2);
		//แผลกดทับ
		$sql3 = "REPLACE INTO pressure(ward, idate, do_pressure, risk_pressure) values(\"$_SESSION[sess_ward]\", \"$idate\", \"$do_pressure\", \"$risk_pressure\")";
		$result3 = $conn->query($sql3);
	}
	//Readmit
	$re_date = substr($idate, 0, 7);
	$sql4 = "REPLACE INTO readmit(ward, month1, idate, readmit_amount, discharge_amount) values(\"$_SESSION[sess_ward]\", \"$re_date\", \"$idate\", \"$readmit_amount\", \"$discharge_amount\")";
	$result4 = $conn->query($sql4);
}
if ($st == "edit") { //แก้ไขข้อมูล
	$sql = "UPDATE data_all SET on_pt = '$on_pt', on_nb = '$on_nb', in_pt = '$in_pt', in_nb = '$in_nb', move_pt = '$move_pt', move_nb = '$move_nb', home_pt = '$home_pt', home_nb = '$home_nb', move_b_pt = '$move_b_pt', move_b_nb = '$move_b_nb', send_pt = '$send_pt', send_nb = '$send_nb', dead_pt = '$dead_pt', dead_nb = '$dead_nb', non_voluntary_pt = '$non_voluntary_pt', non_voluntary_nb = '$non_voluntary_nb', ad_pt = '$ad_pt', ad_nb = '$ad_nb', patient_type5 = '$patient_type5', patient_type4 = '$patient_type4', patient_type3 = '$patient_type3', patient_type2 = '$patient_type2', patient_type1 = '$patient_type1', amount_bed = '$amount_bed', em_hn = '$em_hn', em_rn = '$em_rn', em_tn = '$em_tn', em_pn = '$em_pn', em_aid = '$em_aid', last_date = '$ymdnow', user_update = '$_SESSION[sess_uinid]' WHERE idate = '$idate' AND wage_type_id = '$wage_type' AND ward = '$_SESSION[sess_ward]'";
	if ($wage_type == "3") { //ถ้าเป็นเวรบ่าย
		$sql2 = "UPDATE data_split_patient SET obs_n = '$obs_n', nb_n = '$nb_n', gyn_n = '$gyn_n', surg_n = '$surg_n', med_n = '$med_n', psych_n = '$psych_n', skin_n = '$skin_n', ped_n = '$ped_n', ortho_n = '$ortho_n', eye_n = '$eye_n', ent_n = '$ent_n', dent_n = '$dent_n', neuro_surg_n = '$neuro_surg_n', obs_s = '$obs_s', nb_s = '$nb_s', gyn_s = '$gyn_s', surg_s = '$surg_s', med_s = '$med_s', psych_s = '$psych_s', skin_s = '$skin_s', ped_s = '$ped_s', ortho_s = '$ortho_s', eye_s = '$eye_s', ent_s = '$ent_s', dent_s = '$dent_s', neuro_surg_s = '$neuro_surg_s' WHERE ward = '$_SESSION[sess_ward]' AND idate = '$idate'";
		$result2 = $conn->query($sql2);
		//แผลกดทับ
		$sql3 = "replace into pressure(ward, idate, do_pressure, risk_pressure) values(\"$_SESSION[sess_ward]\", \"$idate\", \"$do_pressure\", \"$risk_pressure\")";
		//$sql3 = "replace into pressure set do_pressure = \"$do_pressure\", risk_pressure = \"$risk_pressure\" where ward = \"$_SESSION[sess_ward]\" and idate = \"$idate\"";
		$result3 = $conn->query($sql3);
	}
	//Readmit
	$re_date = substr($idate, 0, 7);
	$sql4 = "replace into readmit(ward, month1, idate, readmit_amount, discharge_amount) values(\"$_SESSION[sess_ward]\", \"$re_date\", \"$idate\", \"$readmit_amount\", \"$discharge_amount\")";
	$result4 = $conn->query($sql4);
}
$result = $conn->query($sql);
if ($result) {
	echo "<meta http-equiv='refresh' content='0;url=report_day.php'>";
}
?>