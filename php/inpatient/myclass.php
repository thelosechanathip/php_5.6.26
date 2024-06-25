<?php
function FormatDateSlash($strDate) {
	list($year, $month, $day) = split('[/.-]', $strDate);
	return $day."/".$month."/".($year + 543);
}
function FormatDateDefault($strDate) {
	list($day, $month, $year) = split('[/.-]', $strDate);
	return ($year - 543)."-".$month."-".$day;
}
function FormatDateShort($strDate) {
	list($year, $month, $day) = split('[/.-]', $strDate);
	switch($month) {
		case "01":
			$ms = "ม.ค.";
			break;
		case "02":
			$ms = "ก.พ.";
			break;
		case "03":
			$ms = "มี.ค.";
			break;
		case "04":
			$ms = "เม.ย.";
			break;
		case "05":
			$ms = "พ.ค.";
			break;
		case "06":
			$ms = "มิ.ย.";
			break;
		case "07":
			$ms = "ก.ค.";
			break;
		case "08":
			$ms = "ส.ค.";
			break;
		case "09":
			$ms = "ก.ย.";
			break;
		case "10":
			$ms = "ต.ค.";
			break;
		case "11":
			$ms = "พ.ย.";
			break;
		case "12":
			$ms = "ธ.ค.";
			break;
	}
	return $day." ".$ms." ".($year + 543);
}
function FormatDateFull($strDate) {
	list($year, $month, $day) = split('[/.-]', $strDate);
	switch($month) {
		case "01":
			$ms = "มกราคม";
			break;
		case "02":
			$ms = "กุมภาพันธ์";
			break;
		case "03":
			$ms = "มีนาคม";
			break;
		case "04":
			$ms = "เมษายน";
			break;
		case "05":
			$ms = "พฤษภาคม";
			break;
		case "06":
			$ms = "มิถุนายน";
			break;
		case "07":
			$ms = "กรกฎาคม";
			break;
		case "08":
			$ms = "สิงหาคม";
			break;
		case "09":
			$ms = "กันยายน";
			break;
		case "10":
			$ms = "ตุลาคม";
			break;
		case "11":
			$ms = "พฤศจิกายน";
			break;
		case "12":
			$ms = "ธันวาคม";
			break;
	}
	return $day." ".$ms." ".($year + 543);
}
function MonthInDays($someMonth, $someYear) {
	return date("t", strtotime($someYear . "-" . $someMonth . "-01"));
}
?>