<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	$country_id = $_REQUEST['id'];
	if($country_id){
		$resultForIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE country_id = $country_id OR p_country_id = " . $country_id);
		if($resultForIndividual->num_rows > 0){
    		echo json_encode(array('status'=>'fail', 'message' => 'You can not delete this country which alocated to individual(s).'));
		}else{
			/* Delete From countries table */
			$result = mysqli_query($db->db_conn, "DELETE FROM countries WHERE id = " . $country_id);
			if($result){
				echo json_encode(array('status'=>'success', 'message' => 'Deleting Country ...'));
			}else{
    			echo json_encode(array('status'=>'fail', 'message' => 'Country deletion error.'));	
			}		
		}
	}
}/* End Session Check */
?>