<?php

header('note-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	//Fetching Values from URL
	$individual_id=$_POST['individual_id'];
	$company_id=$_POST['company_id'];
	if($individual_id != ""){
		$client_db_field = "individual_id";
		$client_id = $individual_id;
	}else{
		$client_db_field = "company_id";
		$client_id = $company_id;
	}
	$note=$_POST['note'];
	$note_creation_date= $_POST['note_creation_date'];

	if( empty($client_id) || empty($note)) {
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{
		// prepare to store special character in note  in database
		$note = mysqli_real_escape_string($db->db_conn, $note);
		
		$result = mysqli_query($db->db_conn, "INSERT INTO  notes($client_db_field,note,note_creation_date) values('$client_id','$note','$note_creation_date')");
		if ($result) {
			echo json_encode(array('status'=>'success', 'message' => 'Note  has been successfully added.'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Note insertion error.'));
		}
	}

}/* End Session Check */

?>