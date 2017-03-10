<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	$individual_id = $_REQUEST['id'];
	if($individual_id){
		$resultForCompanyMainContact = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE main_contact = " . $individual_id);
		$resultForCompanyDirector = mysqli_query($db->db_conn, "SELECT * FROM companies_directors WHERE individual_id = " . $individual_id);
		if($resultForCompanyMainContact->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'You can not delete an individual who belongs to a company main contact.'));
		}else if($resultForCompanyDirector->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'You can not delete an individual who belongs to a company director.'));
		}else{
			/* Delete From vats table */
			$resultVat = mysqli_query($db->db_conn, "DELETE FROM vats WHERE individual_id = " . $individual_id);
			/* Delete From vats_submission_quarters_years_and_quarters_due table */
			$resultVat = mysqli_query($db->db_conn, "DELETE FROM vats_submission_quarters_years_and_quarters_due WHERE individual_id = " . $individual_id);
			/* Delete From tasks table */
			$resultTask = mysqli_query($db->db_conn, "DELETE FROM tasks WHERE individual_id = " . $individual_id);
			/* Delete From addresses table */
			$resultNote = mysqli_query($db->db_conn, "DELETE FROM addresses WHERE individual_id = " . $individual_id);
			/* Delete From emails table */
			$resultNote = mysqli_query($db->db_conn, "DELETE FROM emails WHERE individual_id = " . $individual_id);
			/* Delete From telephones table */
			$resultNote = mysqli_query($db->db_conn, "DELETE FROM telephones WHERE individual_id = " . $individual_id);
			/* Delete From notes table */
			$resultNote = mysqli_query($db->db_conn, "DELETE FROM notes WHERE individual_id = " . $individual_id);
			/* Delete From individuals_tax_return_years table */
			$resultTaxReturn =  mysqli_query($db->db_conn, "DELETE FROM individuals_tax_return_years WHERE individual_id = " . $individual_id);
			/* Delete From individuals_tax_return_years_french table */
			$resultTaxReturn =  mysqli_query($db->db_conn, "DELETE FROM individuals_tax_return_years_french WHERE individual_id = " . $individual_id);
			/* Delete From individuals table */
			$result =  mysqli_query($db->db_conn, "DELETE FROM individuals WHERE id = " . $individual_id);
			if($result){
				echo json_encode(array('status'=>'success', 'message' => 'Deleting Individual ...'));
			}else{
				echo json_encode(array('status'=>'fail', 'message' => 'Individual deletion error.'));
			}		
		}
	}
}/* End Session Check */
?>