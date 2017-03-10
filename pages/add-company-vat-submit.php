<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	//Fetching Values from URL
	$company_id=$_POST['company_id'];
	$vat_number=$_POST['vat_number'];
	$vat_registered_date=date('Y-m-d', strtotime($_POST['vat_registered_date']));
	$vat_flat_rate=$_POST['vat_flat_rate'];
	$flat_rate_first_year=$_POST['flat_rate_first_year'];
	$flat_rate_after_first_year=$_POST['flat_rate_after_first_year'];
	$flat_rate_description=$_POST['flat_rate_description'];
	$vat_return_quarter=$_POST['vat_return_quarter'];
	$notes=$_POST['notes'];

	if(empty($company_id) || empty($vat_number) || empty($vat_registered_date) || empty($vat_flat_rate) || empty($flat_rate_first_year) || empty($flat_rate_after_first_year) || empty($vat_return_quarter)) {	
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{

		// Check duplicate vat number

		$resultVatNumber = mysqli_query($db->db_conn, "SELECT * FROM vats WHERE vat_number = '$vat_number'");
		if($resultVatNumber->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate VAT Number. Please check.'));
		}else{
			// prepare to store special character in flat_rate_description, notes  in database
			$flat_rate_description = mysqli_real_escape_string($db->db_conn, $flat_rate_description);
			$notes = mysqli_real_escape_string($db->db_conn, $notes);
			
			$result = mysqli_query($db->db_conn, "INSERT INTO  vats(company_id,vat_number,vat_registered_date,vat_flat_rate,flat_rate_first_year,flat_rate_after_first_year,flat_rate_description,vat_return_quarter,notes) values('$company_id','$vat_number','$vat_registered_date','$vat_flat_rate','$flat_rate_first_year','$flat_rate_after_first_year','$flat_rate_description','$vat_return_quarter','$notes')");
			if ($result) {
				echo json_encode(array('status'=>'success', 'message' => 'Company VAT has been successfully added.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Company VAT insertion error.'));
			}
		}
	}

}/* End Session Check */

?>