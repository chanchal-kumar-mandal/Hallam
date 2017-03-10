<?php

/* No of elements for Dashboard */

$no_of_elements = 6;

/*  Marital Status Array Generation */

$marital_status = array('Single', 'Married', 'Cohabiting', 'Divorced', 'Widowed', 'Separated', 'Not disclosed');

/* Months Array generation */

$months = array('01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');

/* First Day Of Current Month */

$fist_day_of_current_month = date('Y-m-d', strtotime('first day of this month'));

/* Tax Years Array Generation */

$date_first = "2010-04-05";// 5th April, 2010
$current_date = date('Y-m-d'); // Current date or today
$date_last = date('Y')."-04-05";// 5th April, Current Year

if($current_date > $date_last){
	$date_last = $date_last;
}else{
	$date_last = (date('Y') - 1)."-04-05";
}

$diff = abs(strtotime($date_last) - strtotime($date_first));
$no_of_tax_years = floor($diff / (365*60*60*24));
$tax_years = array();
for($i=0; $i<= $no_of_tax_years; $i++){

    $year = strtotime("+".$i." year", strtotime($date_first));
    $next_year = strtotime("+".($i + 1)." year", strtotime($date_first));
    /*$tax_years[] = date("Y", $year).'/'.date("y", $next_year);*/
    $tax_years[] = date("Y", $year);

}

/* Current Tax Year */
/*$current_tax_year = date("Y", $year).'/'.date("y", $next_year);*/
$current_tax_year = date("Y", $year);

/* Returnable Tax Years Array Generation */
$date_next = (date('Y') + 1)."-02-01"; // 1st February Of Next Year

if($current_date < $date_next){
	$returnable_tax_years = $tax_years;
	array_pop($returnable_tax_years); // Remove Last array Element
}else{
	$returnable_tax_years = $tax_years;
}


if($current_date < $date_next){
	$french_returnable_tax_years = $tax_years;
	array_pop($french_returnable_tax_years); // Remove Last array Element
}else{
	$french_returnable_tax_years = $tax_years;
}

/* Latest Tax Year */
$latest_tax_year = end($returnable_tax_years);

/* Latest French Tax Year */
$latest_french_tax_year = end($french_returnable_tax_years);

/* Vat Return Quaters Array Generation */
$vat_return_quaters_array = array('Jan/April/July/Oct', 'Feb/May/Aug/Nov', 'March/June/Sep/Dec');
?>