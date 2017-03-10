<?php 

$last_month= date('M-Y', strtotime('last month'));
$eight_months_before_last_month = date('M-Y', strtotime('-7 months', strtotime($last_month)));

// String Generation With Last Date Of Last Eight Months 
$actual_last_day_last_month= date('Y-m-d', strtotime('last day of last month'));
$last_day_last_month= date('d-m-Y', strtotime('last day of last month'));
$regexp_string_for_last_eight_months = $last_day_last_month ;
for($j=2; $j<=8; $j++){
    $last_day_last_month = date('d-m-Y', strtotime('last day of -'.$j.' month'));
    $regexp_string_for_last_eight_months = $regexp_string_for_last_eight_months.'|'.$last_day_last_month;
}

$resultCompaniesPending = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE year_end < '$fist_day_of_current_month' AND id NOT IN (SELECT companies.id as id FROM companies INNER JOIN companies_account_submission_years ON companies.id = companies_account_submission_years.company_id WHERE (companies_account_submission_years.account_submitted_to_hmrc_years REGEXP '$regexp_string_for_last_eight_months') AND (companies_account_submission_years.account_submitted_to_companies_house_years REGEXP '$regexp_string_for_last_eight_months'))");
$no_of_companies_pending = $resultCompaniesPending->num_rows;

?>      