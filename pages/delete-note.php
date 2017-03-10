<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	//Fetching Values from URL
	$note_id = $_POST['id'];

	if(empty($note_id)) {	
		echo json_encode(array('status'=>'fail', 'message' => 'Please select note id.'));
	}else{
		$result = mysqli_query($db->db_conn, "DELETE FROM notes 
			WHERE id =". $note_id);
		if ($result) {
			echo json_encode(array('status'=>'success', 'message' => 'Deleting Note ...'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Note deletion error.'));
		}
	}
}/* End Session Check */

?>