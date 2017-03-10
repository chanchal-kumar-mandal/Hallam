<?php 

$current_month = date('m');
$first_day_of_current_month = date('Y-m-d', strtotime('first day of this month'));
$last_month_quarter_year = date('m-Y', strtotime('last month'));

// Vat Return Quarter -> If the current month is the VAT submission to HMRC month of the previous month
if(in_array($current_month, array('01','04','07','10'))){
    $vat_return_quarter = 'March/June/Sep/Dec';
}elseif(in_array($current_month, array('02','05','08','11'))){
    $vat_return_quarter = 'Jan/April/July/Oct';
}elseif(in_array($current_month, array('03','06','09','12'))){
    $vat_return_quarter = 'Feb/May/Aug/Nov';
}else {
    $vat_return_quarter = '';
}

$resultCompaniesVatsPending = mysqli_query($db->db_conn, "SELECT * FROM vats WHERE company_id IS NOT NULL AND vat_return_quarter = '$vat_return_quarter' AND vat_registered_date < '$first_day_of_current_month' AND id NOT IN (SELECT vats.id as id FROM vats INNER JOIN vats_submission_quarters_years_and_quarters_due ON vats.id = vats_submission_quarters_years_and_quarters_due.vat_id WHERE vats_submission_quarters_years_and_quarters_due.quarter_year = '$last_month_quarter_year' AND vats_submission_quarters_years_and_quarters_due.is_submitted_to_hmrc = 'Yes')");
$no_of_companies_vats_pending = $resultCompaniesVatsPending->num_rows;

?>            