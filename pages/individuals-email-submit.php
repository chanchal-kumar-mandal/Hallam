<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');

	$emailSentToindividualIds = $_POST['individualIds'];
	$emailSentToindividualIdsArray = explode(",", $emailSentToindividualIds);

	$subject = $_POST['subject'];
	$message = $_POST['message'];
	// lines are larger than 70 characters, we should use wordwrap()
	$message = wordwrap($message, 70, "\r\n");
	$datetime = $_POST['datetime'];

	//Purpose mor email send
	$purpose = "Individual Work Pending";

	if(empty($emailSentToindividualIds)) {

		echo json_encode(array('status'=>'fail', 'message' => 'Please select individuals.'));

	}else if(empty($subject)){

		echo json_encode(array('status'=>'fail', 'message' => 'Please insert subject.'));

	}else if(empty($message)){

		echo json_encode(array('status'=>'fail', 'message' => 'Please insert message.'));

	}else{

		foreach($emailSentToindividualIdsArray as $individulId){

			$result = mysqli_query($db->db_conn, "SELECT individuals.id as id, individuals.firstname as firstname, individuals.surname as surname,  emails.email as email FROM individuals INNER JOIN emails ON individuals.id  = emails.individual_id AND individuals.id = $individulId LIMIT 1");

			if($result->num_rows > 0){			
				while($row = $result->fetch_array()){
					$change_message = $message;
					$individual_id = $row['id'];
					$headers = 'From: webmaster@hallamjones.co.uk' . "\r\n" .
							    'Reply-To: webmaster@hallamjones.co.uk' . "\r\n" .
							    'X-Mailer: PHP/' . phpversion();
					//Email sent to Individual
					$flagEmailSend = mail($row['email'], $subject, $message, $headers);
					// prepare to store special character in message  in database
					$change_message = mysqli_real_escape_string($db->db_conn, $message);
					//Save Email  into  emails_sent_to_clients
					if($flagEmailSend){
						$emailSaveResult = mysqli_query($db->db_conn, "INSERT INTO emails_sent_to_clients(individual_id, subject, message, datetime, status, purpose) VALUES ($individual_id, '$subject', '$change_message', '$datetime', '1', '$purpose')");
					}else{
						$emailSaveResult = mysqli_query($db->db_conn, "INSERT INTO emails_sent_to_clients(individual_id, subject, message, datetime, status, purpose) VALUES ($individual_id, '$subject', '$change_message', '$datetime', '0', '$purpose')");
					}
				}
			}
		}
		if($emailSaveResult){
			echo json_encode(array('status'=>'success', 'message' => 'Email has been successfully sent and saved.'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Email sending error.'));
		}
	}

}/* End Session Check */

?>