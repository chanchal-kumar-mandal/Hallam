<?php


if(isset($_REQUEST['annual_return_month'])){
    $annual_return_month = $_REQUEST['annual_return_month'];
}else{
    $annual_return_month = date('m');
}

$resultCompaniesAnnual = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE annual_return_date LIKE '%-".$annual_return_month."-%'");
$no_of_companies_annual = $resultCompaniesAnnual->num_rows;

?>