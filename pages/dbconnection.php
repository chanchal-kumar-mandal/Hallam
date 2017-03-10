<?php
class Dbconnection{

	protected $db_name = "hallam";
	protected $db_user = "root";
	protected $db_pass = "";
	protected $db_host = "localhost";
	public $db_conn;
	public function connect(){

		$this->db_conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
		if(mysqli_connect_error()){
			echo "Database connection failed : " . mysqli_connect_error();
			exit();
		}
		//echo "Database connection successfull.";
		return true;
	}
}
$db=new Dbconnection();
$db->connect();
?>