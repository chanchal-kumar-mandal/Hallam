<?php
header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');

	$company_id=$_POST['company_id'];
	//General Section Values
	$company_name= $_POST['company_name'];
	$registration_number=$_POST['registration_number'];
	$registration_date=date('Y-m-d', strtotime($_POST['registration_date']));
	$authentication_code=$_POST['authentication_code'];
	$trade_description=$_POST['trade_description'];
	$registered_address=$_POST['registered_address'];
	$utr=$_POST['utr'];
	$year_end=date('Y-m-d', strtotime("last day of this month", strtotime("01-".$_POST['year_end']))); /* Last Day Of Selected Month*/
	if(isset($_POST['account_submitted_to_hmrc_years'])){
		$account_submitted_to_hmrc_years = $_POST['account_submitted_to_hmrc_years'];
		$account_submitted_to_hmrc_years_string = implode(",", $account_submitted_to_hmrc_years);	
	}else{
		$account_submitted_to_hmrc_years_string = '';
	}
	if(isset($_POST['account_submitted_to_companies_house_years'])){
		$account_submitted_to_companies_house_years = $_POST['account_submitted_to_companies_house_years'];
		$account_submitted_to_companies_house_years_string = implode(",", $account_submitted_to_companies_house_years);	
	}else{
		$account_submitted_to_companies_house_years_string = '';
	}
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

	if(empty($company_id) ||empty($company_name) || empty($registration_number) || empty($registration_date) || empty($authentication_code) || empty($registered_address) || empty($utr) || empty($year_end) || empty($vat_registered) || empty($main_contact) || empty($annual_return_date) || empty($accountancy_fee) || empty($no_of_shareholder)) {	
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

		/* Check duplicate registration number */

		$resultRegistration = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE registration_number = $registration_number AND id != ". $company_id);
		if($resultRegistration->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate registration number. Please check.'));
		}else{	

			/* Update company */
			$result = mysqli_query($db->db_conn, "UPDATE companies
				SET 
				company_name = '$company_name',
				registration_number = '$registration_number',
				registration_date = '$registration_date',
				authentication_code = '$authentication_code',
				trade_description = '$trade_description',
				utr = '$utr',
				year_end = '$year_end',
				no_of_shares = '$no_of_shares',
				aggregate_nominal_value = '$aggregate_nominal_value',
				share_class = '$share_class',
				shares_issued = '$shares_issued',
				amount_paid = '$amount_paid',
				amount_unpaid = '$amount_unpaid',
				total_aggregate_value = '$total_aggregate_value',
				paye_office_code = '$paye_office_code',
				paye_reference = '$paye_reference',
				vat_registered = '$vat_registered',
				main_contact = '$main_contact',
				reference = '$reference',
				annual_return_date = '$annual_return_date',
				accountancy_fee = '$accountancy_fee',
				registered_office_charge = '$registered_office_charge',
				registered_office_charge_fee = '$registered_office_charge_fee',
				payroll_charge = '$payroll_charge',
				payroll_charge_fee = '$payroll_charge_fee',
				payroll_required = '$payroll_required',
				no_of_shareholder = '$exact_no_of_shareholder',
				no_of_note = '$exact_no_of_note'
				WHERE id =". $company_id);

				/* Update companies_directors table */
				if(isset($_POST['directorIds'])){
					if(count($directors_ids_array) > 0){						
						$resultDirectors = mysqli_query($db->db_conn, "DELETE FROM  companies_directors WHERE company_id = " . $company_id);
						foreach ($directors_ids_array as $directors_id) {
							$individual_id = $directors_id;
							$resultDirectors = mysqli_query($db->db_conn, "INSERT INTO companies_directors(company_id, individual_id) VALUES('$company_id', '$individual_id')");
						}
					}else{
						$resultDirectors = mysqli_query($db->db_conn, "DELETE FROM  companies_directors WHERE company_id = " . $company_id);
					}
				}else{
					$resultDirectors = mysqli_query($db->db_conn, "DELETE FROM  companies_directors WHERE company_id = " . $company_id);
				}	
			
				/* Update shareholders tableor insert into shareholders table */
				for($i=1; $i <= $no_of_shareholder; $i++ ){
					$shareholder_exist_id = "shareholder_id".$i;
					if(array_key_exists($shareholder_exist_id, $_POST)){
						$shareholder_id = $_POST["shareholder_id".$i];
					}
					$shareholder_name = $_POST["shareholder_name".$i];
					$shares_held = $_POST["shares_held".$i];
					if($_POST["shares_disposed_date".$i] == ""){
						$shares_disposed_date = date('Y-m-d');
					}else{
						$shares_disposed_date = date('Y-m-d', strtotime($_POST["shares_disposed_date".$i]));
					}
					if(isset($_POST["shareholder_id".$i])){
						if($_POST["is-exist-shareholder".$i] == 1){
							$result1 = mysqli_query($db->db_conn, "UPDATE shareholders
								SET
									shareholder_name = '$shareholder_name',
									shares_held = '$shares_held',
									shares_disposed_date = '$shares_disposed_date'
								WHERE id =". $shareholder_id);
						}else{
							$result1 = mysqli_query($db->db_conn, "DELETE FROM  shareholders WHERE id = " . $shareholder_id);
						}
					}else{
						if($_POST["is-exist-shareholder".$i] == 1){
							$result1 = mysqli_query($db->db_conn, "INSERT INTO  shareholders(shareholder_name,shares_held,shares_disposed_date,company_id) values('$shareholder_name','$shares_held','$shares_disposed_date','$company_id')");
						}
					}
				}

				/* companies_account_submission_years table data manupulation */
				$result2 = mysqli_query($db->db_conn, "SELECT * FROM  companies_account_submission_years WHERE company_id = ". $company_id);
				if(mysqli_num_rows($result2) > 0){
					if(isset($_POST['account_submitted_to_hmrc_years']) || isset($_POST['account_submitted_to_companies_house_years'])){
						$result3 = mysqli_query($db->db_conn, "UPDATE  companies_account_submission_years
							SET
							account_submitted_to_hmrc_years = '$account_submitted_to_hmrc_years_string',
							account_submitted_to_companies_house_years = '$account_submitted_to_companies_house_years_string'
							WHERE company_id=".$company_id);
					}else{
						$result3 = mysqli_query($db->db_conn, "DELETE  FROM companies_account_submission_years WHERE company_id=".$company_id); 
					}

				}else{
					if(($account_submitted_to_hmrc_years_string != '') || ($account_submitted_to_companies_house_years_string != '')){
						$result3 = mysqli_query($db->db_conn, "INSERT INTO  companies_account_submission_years(company_id,account_submitted_to_hmrc_years,account_submitted_to_companies_house_years) values($company_id, '$account_submitted_to_hmrc_years_string', '$account_submitted_to_companies_house_years_string')");
					}
				}

				/* Update notes table */
				for($n=1; $n <= $no_of_note; $n++ ){
					$note_exist_id = "note_id".$n;
					if(array_key_exists($note_exist_id, $_POST)){
						$note_id = $_POST["note_id".$n];
					}
					$note = $_POST["note".$n];
					
					// prepare to store special character in note  in database
					$note = mysqli_real_escape_string($db->db_conn, $note);

					if(isset($_POST["note_id".$n])){
						if($_POST["is-exist-note".$n] == 1){
							$resultNote = mysqli_query($db->db_conn, "UPDATE notes
								SET
									note = '$note'
								WHERE 
									company_id = '$company_id' AND id =". $note_id);
						}else{
							$resultNote = mysqli_query($db->db_conn, "DELETE FROM  notes 
								WHERE company_id = $company_id AND id = " . $note_id);
						}
					}else{
						if($_POST["is-exist-note".$n] == 1){						

							$note_creation_date = date('Y-m-d', strtotime($_POST["note_creation_date".$n]));

							$resultNote = mysqli_query($db->db_conn, "INSERT INTO  notes(company_id,note,note_creation_date) values('$company_id','$note','$note_creation_date')");
						}
					}
				}

			if ($result) {
				echo json_encode(array('status'=>'success', 'message' => 'Company has been successfully updated.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Company updation error.'));
			}
		}
	}

}/* End Session Check */

?>