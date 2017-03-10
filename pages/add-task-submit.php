<?php

header('Content-type: application/json');

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
	$task_title=$_POST['task_title'];
	$task=$_POST['task'];
	$task_action_date=date('Y-m-d', strtotime($_POST['task_action_date']));
	$allocated_staff=$_POST['allocated_staff'];	
	$task_creation_date=date('Y-m-d', strtotime($_POST['task_creation_date']));

	if( empty($client_id) || empty($task_title) || empty($task) || empty($task_action_date) || empty($allocated_staff)) {
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{
		// prepare to store special character in task  in database
		$task = mysqli_real_escape_string($db->db_conn, $task);
		
		$result = mysqli_query($db->db_conn, "INSERT INTO  tasks($client_db_field,task_title,task,task_action_date,allocated_staff,task_creation_date) values('$client_id','$task_title','$task','$task_action_date','$allocated_staff','$task_creation_date')");
		if ($result) {
			echo json_encode(array('status'=>'success', 'message' => 'Task  has been successfully added.'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Task insertion error.'));
		}
	}

}/* End Session Check */

?>