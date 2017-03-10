<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	$country_id=$_POST['country_id'];
	$name=$_POST['name'];

	if( empty($country_id) || empty($name)) {
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{
		// Check duplicate country name
		$resultDuplicateCountry = mysqli_query($db->db_conn, "SELECT * FROM countries WHERE name = '$name' AND id != " . $country_id);
		
		if($resultDuplicateCountry->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate Country Name. Please check.'));
		}else{
			$result = mysqli_query($db->db_conn, "UPDATE countries
				SET
				name = '$name'
				WHERE id = " . $country_id);
			if ($result) {
				echo json_encode(array('status'=>'success', 'message' => 'Country  has been successfully updated.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Country updation error.'));
			}
		}
	}

}/* End Session Check */

?>