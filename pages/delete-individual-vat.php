<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	$vat_id = $_REQUEST['id'];
	if($vat_id){
		$resultVatSubmission = mysqli_query($db->db_conn, "DELETE FROM vats_submission_quarters_years_and_quarters_due WHERE vat_id = " . $vat_id);
		$result = mysqli_query($db->db_conn, "DELETE FROM vats WHERE id = " . $vat_id);
		if($result){
			echo json_encode(array('status'=>'success', 'message' => 'Deleting Individual VAT ...'));
		}else{
			echo json_encode(array('status'=>'fail', 'message' => 'Individual VAT deletion error.'));
		}
	}
}/* End Session Check */
?>