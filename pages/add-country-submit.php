<?php

header('Country-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	$name=$_POST['name'];

	if(empty($name)) {
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{
		// Check duplicate country name
		$resultDuplicateCountry = mysqli_query($db->db_conn, "SELECT * FROM countries WHERE name = '$name'");

		if($resultDuplicateCountry->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate Country Name. Please check.'));
		}else{
			$result = mysqli_query($db->db_conn, "INSERT INTO countries(name) values('$name')");
			if ($result) {
				echo json_encode(array('status'=>'success', 'message' => 'Country has been successfully added.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Country insertion error.'));
			}
		}
	}

}/* End Session Check */

?>