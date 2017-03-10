<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	$company_id = $_REQUEST['id'];
	if($company_id){
		$resultForIndividual = mysqli_query($db->db_conn, "SELECT * FROM companies_directors WHERE company_id = " . $company_id);
		if($resultForIndividual->num_rows > 0){
    		echo json_encode(array('status'=>'fail', 'message' => 'You can not delete this company which has director(s).'));
		}else{
			/* Delete From vats table */
			$resultVat = mysqli_query($db->db_conn, "DELETE FROM vats WHERE company_id = " . $company_id);
			/* Delete From vats_submission_quarters_years_and_quarters_due table */
			$resultVat = mysqli_query($db->db_conn, "DELETE FROM vats_submission_quarters_years_and_quarters_due WHERE company_id = " . $company_id);
			/* Delete From tasks table */
			$resultTask = mysqli_query($db->db_conn, "DELETE FROM tasks WHERE company_id = " . $company_id);
			/* Delete From notes table */
			$resultNote = mysqli_query($db->db_conn, "DELETE FROM notes WHERE company_id = " . $company_id);
			/* Delete From shareholders table */
			$resultShareholder = mysqli_query($db->db_conn, "DELETE FROM shareholders WHERE company_id = " . $company_id);
			/* Delete From companies_account_submission_years table */
			$resultAccountSubmission = mysqli_query($db->db_conn, "DELETE FROM companies_account_submission_years WHERE company_id = " . $company_id);
			/* Delete From companies table */
			$result = mysqli_query($db->db_conn, "DELETE FROM companies WHERE id = " . $company_id);
			if($result){
				echo json_encode(array('status'=>'success', 'message' => 'Deleting Company ...'));
			}else{
    			echo json_encode(array('status'=>'fail', 'message' => 'Company deletion error.'));	
			}		
		}
	}
}/* End Session Check */
?>