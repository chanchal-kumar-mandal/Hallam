<?php
session_start();
header('Content-type: application/json');
require_once('dbconnection.php');
//Fetching Values from URL
$username=$_POST['username'];
$password=$_POST['password'];
/*if(isset($_POST['remember'])){
	echo $remember=$_POST['remember'];	
}*/

if(empty($username) || empty($password)){
	echo json_encode(array('status'=>'fail', 'message' => 'Please insert both username and password.'));	
}else{
	$hash_pass = md5($password);
	$result = mysqli_query($db->db_conn, "SELECT * FROM users WHERE username = '$username' AND password = '$hash_pass'");
	if ( $result->num_rows > 0 ) {
		$_SESSION["username"] = $username;
		echo json_encode(array('status'=>'success', 'message' => 'Successfully login ...'));
	} else {
		$resultForPassword = mysqli_query($db->db_conn, "SELECT * FROM users WHERE username = '$username'");
		if($resultForPassword->num_rows > 0 ){
			echo json_encode(array('status'=>'fail', 'message' => 'Wrong password. Please check.'));
		}else{
		    echo json_encode(array('status'=>'fail', 'message' => 'Wrong username. Please check.'));
		}
	}
	
}
?>