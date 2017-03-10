<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');	

	//General Section Values
	$company_name=$_POST['company_name'];
	$client_id=$_POST['client_id'];
	$registration_number=$_POST['registration_number'];
	$registration_date=date('Y-m-d', strtotime($_POST['registration_date']));
	$authentication_code=$_POST['authentication_code'];
	$trade_description=$_POST['trade_description'];
	$registered_address=$_POST['registered_address'];
	$utr=$_POST['utr'];
	$year_end=date('Y-m-d', strtotime("last day of this month", strtotime("01-".$_POST['year_end']))); /* Last Day Of Selected Month */
	if(isset($_POST['directorIds'])){
		$directorIds = $_POST['directorIds'];
		if($directorIds != ""){
			$directors_ids_array = explode(",", $directorIds);
		}else{
			$directors_ids_array = array();
		}
	}
	$no_of_shares=$_POST['no_of_shares'];
	$aggregate_nominal_value=$_POST['aggregate_nominal_value'];
	$share_class=$_POST['share_class'];
	$shares_issued=$_POST['shares_issued'];
	$amount_paid=$_POST['amount_paid'];
	$amount_unpaid=$_POST['amount_unpaid'];
	$total_aggregate_value=$_POST['total_aggregate_value'];
	if(isset($_POST['paye_office_code'])){
		$paye_office_code=$_POST['paye_office_code'];
	}else{
		$paye_office_code = "";
	}
	if(isset($_POST['paye_reference'])){
		$paye_reference=$_POST['paye_reference'];
	}else{
		$paye_reference = "";
	}
	$vat_registered=$_POST['vat_registered'];
	$main_contact=$_POST['main_contact'];
	$reference=$_POST['reference'];
	$annual_return_date=date('Y-m-d', strtotime($_POST['annual_return_date']));
	$accountancy_fee=$_POST['accountancy_fee'];
	$registered_office_charge=$_POST['registered_office_charge'];
	$registered_office_charge_fee=$_POST['registered_office_charge_fee'];
	$payroll_charge=$_POST['payroll_charge'];
	$payroll_charge_fee=$_POST['payroll_charge_fee'];
	$payroll_required=$_POST['payroll_required'];
	$exact_no_of_shareholder = $no_of_shareholder=$_POST['no_of_shareholder'];

	// Notes Section Values
	$exact_no_of_note = $no_of_note = $_POST['no_of_note'];

	if(empty($company_name) || empty($client_id) || empty($registration_number) || empty($registration_date) || empty($authentication_code) || empty($registered_address) || empty($utr) || empty($year_end) || empty($vat_registered) || empty($main_contact) || empty($annual_return_date) || empty($accountancy_fee) || empty($no_of_shareholder)) {	
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{

		/* Exact No of Shareholder */
		for($i=1; $i <= $no_of_shareholder; $i++ ){
			if($_POST["is-exist-shareholder".$i] == 0){
				$exact_no_of_shareholder = $exact_no_of_shareholder - 1;
			}
		}

		/* Exact No. of Note */
		for($i=1; $i <= $no_of_note; $i++ ){
			if($_POST["is-exist-note".$i] == 0){
				$exact_no_of_note = $exact_no_of_note - 1;
			}
		}
		
		/* Check duplicate client id, registration number */

		$resultClientId = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE  client_id = '$client_id'");

		$resultRegistration = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE registration_number = ". $registration_number);

		if($resultClientId->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate client id. Please check.'));
		}elseif($resultRegistration->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate registration number. Please check.'));
		}else{

			/* Insert into companies table */
			$result = mysqli_query($db->db_conn, "INSERT INTO  companies(client_id,company_name,registration_number,registration_date,authentication_code,trade_description,registered_address,utr,year_end,no_of_shares,aggregate_nominal_value,share_class,shares_issued,amount_paid,amount_unpaid,total_aggregate_value,paye_office_code,paye_reference,vat_registered,main_contact,reference,annual_return_date,accountancy_fee,registered_office_charge,registered_office_charge_fee,payroll_charge,payroll_charge_fee,payroll_required,no_of_shareholder,no_of_note) values('$client_id','$company_name','$registration_number','$registration_date','$authentication_code','$trade_description','$registered_address','$utr','$year_end','$no_of_shares','$aggregate_nominal_value','$share_class','$shares_issued','$amount_paid','$amount_unpaid','$total_aggregate_value','$paye_office_code','$paye_reference','$vat_registered','$main_contact','$reference','$annual_return_date','$accountancy_fee','$registered_office_charge','$registered_office_charge_fee','$payroll_charge','$payroll_charge_fee','$payroll_required','$exact_no_of_shareholder','$exact_no_of_note')");
			
			

			$resultOfLastCompany = mysqli_query($db->db_conn, "SELECT max(id) AS id FROM companies");
			while($row = $resultOfLastCompany->fetch_array()){
				$company_id = $row['id'];
			}

			if ($result) {	

				/* Insert into companies_directors table */
				if(isset($_POST['directorIds'])){
					if(count($directors_ids_array) > 0){
						foreach ($directors_ids_array as $directors_id) {
							$individual_id = $directors_id;
							$resultDirector = mysqli_query($db->db_conn, "INSERT INTO companies_directors(company_id, individual_id) VALUES('$company_id', '$individual_id')");
						}
					}
				}	

				/* Insert in shareholders table */
				for($i=1; $i <= $no_of_shareholder; $i++ ){
					$shareholder_name = $_POST["shareholder_name".$i];
					$shares_held = $_POST["shares_held".$i];
					if($_POST["shares_disposed_date".$i] == ""){
						$shares_disposed_date = date('Y-m-d');
					}else{
						$shares_disposed_date = date('Y-m-d', strtotime($_POST["shares_disposed_date".$i]));
					}
					if($_POST["is-exist-shareholder".$i] == 1){
						$result1 = mysqli_query($db->db_conn, "INSERT INTO  shareholders(shareholder_name,shares_held,shares_disposed_date,company_id) values('$shareholder_name','$shares_held','$shares_disposed_date','$company_id')");
						/*if (!$result1) {
							echo json_encode(array('status'=>'fail', 'message' => 'Shareholder insertion error.'));
						}*/
					}
				}	

				/* Insert in notes table */
				for($n=1; $n <= $no_of_note; $n++ ){
					$note_title = $_POST["note_title".$n];
					$note = $_POST["note".$n];

					// prepare to store special character in note  in database
					$note = mysqli_real_escape_string($db->db_conn, $note);

					$note_creation_date = date('Y-m-d', strtotime($_POST["note_creation_date".$n]));
					if($_POST["is-exist-note".$n] == 1){
						$resultNote = mysqli_query($db->db_conn, "INSERT INTO  notes(company_id,note_title,note,note_creation_date) values('$company_id','$note_title','$note','$note_creation_date')");
					}
				}

				echo json_encode(array('status'=>'success', 'message' => 'Company has been successfully added.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Company insertion error.'));
			}
		}
	}

}/* End Session Check */

?>