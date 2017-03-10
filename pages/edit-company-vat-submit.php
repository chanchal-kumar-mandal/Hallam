<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	//Fetching Values from URL
	$vat_id=$_POST['vat_id'];
	$company_id=$_POST['company_id'];
	$vat_number=$_POST['vat_number'];
	$vat_registered_date=date('Y-m-d', strtotime($_POST['vat_registered_date']));
	$vat_flat_rate=$_POST['vat_flat_rate'];
	$flat_rate_first_year=$_POST['flat_rate_first_year'];
	$flat_rate_after_first_year=$_POST['flat_rate_after_first_year'];
	$flat_rate_description=$_POST['flat_rate_description'];
	$vat_return_quarter=$_POST['vat_return_quarter'];
	if(isset($_POST['quarters_years'])){
		$quarters_years = $_POST['quarters_years'];
	}
	if(isset($_POST['quarters_years_string'])){
		$all_quarters_years = explode(",", $_POST['quarters_years_string']);
	}
	$notes=$_POST['notes'];

	if(empty($vat_id) || empty($company_id) || empty($vat_number) || empty($vat_registered_date) || empty($vat_flat_rate) || empty($flat_rate_first_year) || empty($flat_rate_after_first_year) || empty($vat_return_quarter)) {	
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{

		// Check duplicate vat number

		$resultVatNumber = mysqli_query($db->db_conn, "SELECT * FROM vats WHERE vat_number = '$vat_number' AND id != " . $vat_id);
		if($resultVatNumber->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate VAT number. Please check.'));
		}else{
			// prepare to store special character in flat_rate_description, notes  in database
			$flat_rate_description = mysqli_real_escape_string($db->db_conn, $flat_rate_description);
			$notes = mysqli_real_escape_string($db->db_conn, $notes);
					
			$result = mysqli_query($db->db_conn, "UPDATE  vats
				SET
				company_id = '$company_id',
				vat_number = '$vat_number',
				vat_registered_date = '$vat_registered_date',
				vat_flat_rate = '$vat_flat_rate',
				flat_rate_first_year = '$flat_rate_first_year',
				flat_rate_after_first_year = '$flat_rate_after_first_year',
				flat_rate_description = '$flat_rate_description',
				vat_return_quarter = '$vat_return_quarter',
				notes = '$notes'
				WHERE id = " . $vat_id);

			//  vats_submission_quarters_years_and_quarters_due table data manupulation 
			if(isset($_POST['quarters_years_string'])){

				/* Fetch Company mail id */
				$resultCompany = mysqli_query($db->db_conn, "SELECT companies.id as id, companies.company_name as company_name, emails.email as email FROM companies 
				INNER JOIN individuals ON companies.main_contact = individuals.id 
				INNER JOIN emails ON  individuals.id = emails.individual_id 
				AND companies.id = $company_id LIMIT 1");
				if($resultCompany->num_rows > 0){
					while($rowCompany = $resultCompany->fetch_array()){
						$toEmail = $rowCompany['email'];
						$company_name = $rowCompany['company_name'];
					}
				}


				foreach($all_quarters_years as $quarter_year){

					/* mail parameter declaration */

					$subject = "VAT SUBMISSION";
					$message = "";
					$datetime = date('Y-m-d h:i:s');
					$purpose = "Company VAT Submitted";

					if(isset($_POST['quarters_years'])){
						if(in_array($quarter_year, $quarters_years)){
							$is_submitted_to_hmrc = 'Yes';
						}else{
							$is_submitted_to_hmrc = 'No';	
						}
					}else{
						$is_submitted_to_hmrc = 'No';	
					}
					$quarter_due_name = "quarter_due_".$quarter_year;
					if(isset($_POST['quarters_years_string'])){
						if($_POST[$quarter_due_name] != ""){
							$quarter_due = $_POST[$quarter_due_name];
						}else{
							$quarter_due = "NULL";
						}
					}else{
						$quarter_due = "NULL";
					}

					$result1 = mysqli_query($db->db_conn, "SELECT * FROM   vats_submission_quarters_years_and_quarters_due WHERE vat_id = $vat_id  AND quarter_year = '" . $quarter_year . "'");

					/* Set variable for Check Mail send for quarter year to individual */
					$previous_mail_send_for_quarter_year = "No";

					if(mysqli_num_rows($result1) > 0){
						if(isset($_POST['quarters_years_string'])){
							/* Check Previous Mail send for quarter year to individual */
							while($row1 = $result1->fetch_array()){
								if($row1['is_submitted_to_hmrc'] == "Yes"){
									$previous_mail_send_for_quarter_year = "Yes";
								}else{
									$previous_mail_send_for_quarter_year = "No";
								}
							}

							$result2 = mysqli_query($db->db_conn, "UPDATE  vats_submission_quarters_years_and_quarters_due
								SET
								company_id = $company_id,
								quarter_due = $quarter_due,
								is_submitted_to_hmrc = '$is_submitted_to_hmrc'
								WHERE vat_id= $vat_id
								AND quarter_year = '".$quarter_year."'");
						}else{
							$result2 = mysqli_query($db->db_conn, "DELETE  FROM  vats_submission_quarters_years_and_quarters_due WHERE vat_id=".$vat_id); 
						}

					}else{
						if(isset($_POST['quarters_years_string'])){
							$result2 = mysqli_query($db->db_conn, "INSERT INTO   vats_submission_quarters_years_and_quarters_due(vat_id, company_id, quarter_year, quarter_due, is_submitted_to_hmrc) values($vat_id, $company_id, '$quarter_year', $quarter_due, '$is_submitted_to_hmrc')");
						}
					}



					/* Email send if VAT is submitted to HMRC for current quarter */

					if($is_submitted_to_hmrc == 'Yes'){
						$message = "Dear ".$company_name.", \r\n \r\n \r\n"." VAT is submitted for quarter month : " .date('F Y', strtotime('01-'.$quarter_year)). " . Thank you very much " . $company_name . ".";

						/* If mail is not send for quarter year then send mail */
						if($previous_mail_send_for_quarter_year == "No"){
							$headers = 'From: webmaster@hallamjones.co.uk' . "\r\n" .
							    'Reply-To: webmaster@hallamjones.co.uk' . "\r\n" .
							    'X-Mailer: PHP/' . phpversion();
							$flagCompanyEmailSend = mail($toEmail, $subject, $message, $headers);

							if($flagCompanyEmailSend){
								//Save Email  into  emails_sent_to_clients
								$emailCompanySaveResult = mysqli_query($db->db_conn, "INSERT INTO emails_sent_to_clients(company_id, subject, message, datetime, status, purpose ) VALUES ($company_id, '$subject', '$message', '$datetime', '1', '$purpose')");
							}else{
								//Save Email  into  emails_sent_to_clients
								$emailCompanySaveResult = mysqli_query($db->db_conn, "INSERT INTO emails_sent_to_clients(company_id, subject, message, datetime, status, purpose) VALUES ($company_id, '$subject', '$message', '$datetime', '0', '$purpose')");
							}
						}
					}

				}
			}
			
			if ($result) {
				echo json_encode(array('status'=>'success', 'message' => 'Company VAT has been successfully updated.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Company VAT updation error.'));
			}
		}
	}

}/* End Session Check */

?>