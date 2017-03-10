<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	$task_id = $_REQUEST['id'];
	if($task_id){
		$result = mysqli_query($db->db_conn, "DELETE FROM tasks WHERE id = " . $task_id);
		if($result){
				echo json_encode(array('status'=>'success', 'message' => 'Deleting Task ...'));
		}else{
    		echo json_encode(array('status'=>'fail', 'message' => 'Task deletion error.'));	
		}
	}
}/* End Session Check */
?>