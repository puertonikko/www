<?php
include_once "dbConnect.php";
include_once "getProfile.php";
include_once "loginVerification.php";

$connect = new dbConnect();
$connect->connect();

class Insert{

	function insertUser($firstName, $lastName, $email, $password, $displayName, $mobile){
		
		$memberDate = date('mdy g:i:s A');
		$mmddyyyy = date('mdy');
		
		$sql = mysql_query("INSERT INTO user (user_ID, first_Name, last_Name, email, password, memberDate, mmddyyyy)
		VALUES ('null', '$firstName', '$lastName', '$email', '$password', '$memberDate', '$mmddyyyy')");
		
		$id = mysql_insert_id();
		
		$sql2 = mysql_query("INSERT INTO `profile`(`profileID`, `userID`, `displayName`, `state`, `bDate`, `comment`) 
		VALUES ('null','$id','$displayName', '','','')");
		
		mkdir(mysql_insert_id());
			
		$verify = new VerifyLogin();
	
			$result = $verify::verify($email, $password);
			if($result == 0){
				$loginError .= "Incorrect username and password combination";
			}else{
				session_start();
				$_SESSION['user'] = $email;
				
				if($mobile == 'yes'){
					header("Location:m_home.php");
				}else{
					header("Location:home.php");
				}
			}
	}
}
?>