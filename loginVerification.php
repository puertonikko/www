<?php
include_once "dbConnect.php";
$connect = new dbConnect();
$connect->connect();

class VerifyLogin{

	function verify($email, $pass){
		session_start();
		
		$sql = mysql_query("SELECT user_ID FROM user WHERE email = '$email' AND password = '$pass'");
		$rows = mysql_num_rows($sql);
			
		if($rows != ""){
			$_SESSION['user_ID'] = mysql_result($sql, 0);	
			return $rows;
		}else{
			return 0;
		}
	}
}
?>