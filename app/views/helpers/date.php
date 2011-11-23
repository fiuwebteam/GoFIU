<?php
class DateHelper extends AppHelper {
	//---------------------------------------------------------------------------------
	function date_diff($d1, $d2){
		$d1 = explode(" " , $d1);
		$d1 = explode("-" , $d1[0]);
		$date1 = mktime(0, 0, 0, $d1[1], $d1[2], $d1[0]);
		
		$d2 = explode(" " , $d2);
		$d2 = explode("-" , $d2[0]);
		$date2 = mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]);
		
		$dateDiff = $date1 - $date2;
		$fullDays = floor($dateDiff/(60*60*24));
		
		return $fullDays;
		
		//$date1 = mktime(hr, min, sec, mon, day, year);
		/*
		$dateDiff = $date1 - $date2;		
		$fullDays = floor($dateDiff/(60*60*24));		
		$fullHours = floor(($dateDiff-($fullDays*60*60*24))/(60*60));		
		$fullMinutes = floor(($dateDiff-($fullDays*60*60*24)-($fullHours*60*60))/60);		
		echo "Differernce is $fullDays days, $fullHours hours and $fullMinutes minutes.";
		*/

	}
	//---------------------------------------------------------------------------------
}

?>