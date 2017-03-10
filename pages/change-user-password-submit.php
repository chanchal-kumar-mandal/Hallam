<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');
	//Fetching Values from URL
	$old_password=$_POST['old_password'];
	$new_password=$_POST['new_password'];
	$confirm_password=$_POST['confirm_password'];

	if(empty($old_password) || empty($new_password) || empty($confirm_password)){
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));	
	}else{
		$hash_old_password = md5($old_password);
		$hash_new_password = md5($new_password);
		$hash_confirm_password = md5($confirm_password);

		$resultUser = mysqli_query($db->db_conn, "SELECT * FROM users WHERE password = '$hash_old_password'");
		if ( $resultUser->num_rows == 0 ) {
			echo json_encode(array('status'=>'fail', 'message' => 'Wrong old password. Please check.'));
		}else if( $hash_new_password != $hash_confirm_password){
			echo json_encode(array('status'=>'fail', 'message' => 'New password does not match with confirm password. Please check.'));	
		}else{
			while($rowUser = $resultUser->fetch_array()){
				$user_id = $rowUser['id'];
			}
			$resultPasswordChange = mysqli_query($db->db_conn, "UPDATE users SET
				password = '$hash_new_password'
				WHERE id = " . $user_id);
			if($resultPasswordChange){
				echo json_encode(array('status'=>'success', 'message' => 'Password has beeen successfully changed.'));
			}else{
			    echo json_encode(array('status'=>'fail', 'message' => 'Password updation error.'));
			}
		}
		
	}

}/* End Session Check */

?>