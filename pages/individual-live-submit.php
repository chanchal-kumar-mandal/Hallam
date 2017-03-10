<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
	echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{

	//header('Content-type: application/json');
	require_once('dbconnection.php');
	//Fetching Values from URL
	$individul_id = $_REQUEST['id'];

	if(empty($individul_id)) {	
		echo json_encode(array('status'=>'fail', 'message' => 'No Individual found.'));
	}else{
		$result = mysqli_query($db->db_conn, "UPDATE individuals
			SET 
			requires_tax_return = 'No',
			on_stop = 'No'
			WHERE id =". $individul_id);
		if ($result) {
			echo json_encode(array('status'=>'success', 'message' => 'living Individual ...'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Individual updation error.'));
		}
	}
}/* End Session Check */

?>