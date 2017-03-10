<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');

	$email_sent_to_companies_ids = $_POST['companyIds'];
	$email_sent_to_company_ids_array = explode(",", $email_sent_to_companies_ids);

	$subject = $_POST['subject'];
	$message = $_POST['message'];
	// lines are larger than 70 characters, we should use wordwrap()
	$message = wordwrap($message, 70, "\r\n");
	$datetime = $_POST['datetime'];
	$quarter_year = $_POST['quarter_year'];

	//Purpose mor email send
	$purpose = "Company VAT Pending";

	if(empty($email_sent_to_companies_ids)) {

		echo json_encode(array('status'=>'fail', 'message' => 'Please select companies.'));

	}else if(empty($subject)){

		echo json_encode(array('status'=>'fail', 'message' => 'Please insert subject.'));

	}else if(empty($message)){

		echo json_encode(array('status'=>'fail', 'message' => 'Please insert message.'));

	}else{

		$resultCompany = mysqli_query($db->db_conn, "SELECT companies.id as id, companies.company_name as company_name, individuals.email as email FROM companies INNER JOIN individuals ON companies.main_contact = individuals.id WHERE companies.vat_registered = 'Yes'");

		//Email Send To Companies ANd Also Save in database

		if($resultCompany->num_rows > 0) {			
			while($rowCompany = $resultCompany->fetch_array()){
				$change_message = $message;
				if(in_array($rowCompany['id'], $email_sent_to_company_ids_array)){
					$company_id = $rowCompany['id'];

					//Due value fatching for quarter year
					$result1 = mysqli_query($db->db_conn, "SELECT * FROM  vats_submission_quarters_years_and_quarters_due WHERE company_id = $company_id AND quarter_year = '$quarter_year'");
					if($result1->num_rows > 0){
	                    while($row1 = $result1->fetch_array()){
	                    	if($row1['quarter_due'] == ""){
	                    		$quarter_due = 0;
	                    	}else{
	                    		$quarter_due = $row1['quarter_due'];
	                    	}
	                    }
	                }else{
	                	$quarter_due = 0;
	                }
	                // Add quarter due in message
	                $change_message = "Amount due for ".date('F Y', strtotime('01-'.$quarter_year))." : ".$quarter_due."\r\n".$change_message;
	                $headers = 'From: webmaster@hallamjones.co.uk' . "\r\n" .
							    'Reply-To: webmaster@hallamjones.co.uk' . "\r\n" .
							    'X-Mailer: PHP/' . phpversion();

					$resultEmail = mysqli_query($db->db_conn, "SELECT companies.id as id, emails.email as email FROM companies 
					INNER JOIN individuals ON companies.main_contact = individuals.id 
					INNER JOIN emails ON  individuals.id = emails.individual_id 
					AND companies.id = $company_id LIMIT 1");
					if($resultEmail->num_rows > 0){
						while($rowEmail = $resultEmail->fetch_array()){
							$to_email = $rowEmail['email'];
						}
					}else{
						$to_email = "";
					}
					//Email sent to Company
					$flagCompanyEmailSend = mail($to_email, $subject, $change_message, $headers);					
					// prepare to store special character in message  in database
					$change_message = mysqli_real_escape_string($db->db_conn, $change_message);
					//Save Email  into  emails_sent_to_clients
					if($flagCompanyEmailSend){
						$emailCompanySaveResult = mysqli_query($db->db_conn, "INSERT INTO emails_sent_to_clients(company_id, subject, message, datetime, status, purpose) VALUES ($company_id, '$subject', '$change_message', '$datetime', '1', '$purpose')");
					}else{
						$emailCompanySaveResult = mysqli_query($db->db_conn, "INSERT INTO emails_sent_to_clients(company_id, subject, message, datetime, status, purpose) VALUES ($company_id, '$subject', '$change_message', '$datetime', '0', '$purpose')");
					}

				}
			}
		}		


		if(isset($emailCompanySaveResult)){
			echo json_encode(array('status'=>'success', 'message' => 'Email has been successfully sent and saved.'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Email sending error.'));
		}
	}

}/* End Session Check */

?>