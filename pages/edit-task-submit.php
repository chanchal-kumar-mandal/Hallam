<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	//Fetching Values from URL	
	$task_id=$_POST['task_id'];
	if(isset($_POST['individual_id'])){
		$client_db_field = "individual_id";
		$client_id = $_POST['individual_id'];
	}else{
		$client_db_field = "company_id";
		$client_id = $_POST['company_id'];
	}
	$task=$_POST['task'];
	$task_title=$_POST['task_title'];
	$task_action_date=date('Y-m-d', strtotime($_POST['task_action_date']));
	$allocated_staff=$_POST['allocated_staff'];	
	$is_task_completed=$_POST['is_task_completed'];

	if( empty($task_id) || empty($client_id) || empty($task_title)  || empty($task) || empty($task_action_date) || empty($allocated_staff)) {
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{
		// prepare to store special character in task  in database
		$task = mysqli_real_escape_string($db->db_conn, $task);
		
		$result = mysqli_query($db->db_conn, "UPDATE  tasks
			SET
			$client_db_field = '$client_id',
			task_title = '$task_title',
			task = '$task',
			task_action_date = '$task_action_date',
			allocated_staff = '$allocated_staff',
			is_task_completed = '$is_task_completed'
			WHERE id = " . $task_id);
		if ($result) {
			echo json_encode(array('status'=>'success', 'message' => 'Task  has been successfully updated.'));
		} else {
			echo json_encode(array('status'=>'fail', 'message' => 'Task updation error.'));
		}
	}

}/* End Session Check */

?>