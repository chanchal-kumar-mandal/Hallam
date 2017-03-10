<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	//Fetching Values from URL	
	$note_id=$_POST['note_id'];
	if(isset($_POST['individual_id'])){
		$client_db_field = "individual_id";
		$client_id = $_POST['individual_id'];
	}else{
		$client_db_field = "company_id";
		$client_id = $_POST['company_id'];
	}
	$note=$_POST['note'];

	if( empty($note_id) || empty($client_id) || empty($note)) {
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{
		// prepare to store special character in note  in database
		$note = mysqli_real_escape_string($db->db_conn, $note);
		
		$result = mysqli_query($db->db_conn, "UPDATE  notes
			SET
			$client_db_field = '$client_id',
			note = '$note'
			WHERE id = " . $note_id);
		if ($result) {
			echo json_encode(array('status'=>'success', 'message' => 'Note  has been successfully updated.'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Note updation error.'));
		}
	}

}/* End Session Check */

?>