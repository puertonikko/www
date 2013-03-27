<?php
include_once "insertClass.php";
session_start();
$insertion = new Insert();

	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	
		if($id == "register"){
		
			$fName = $_GET['fName'];
			$lName = $_GET['lName'];
			$email = $_GET['email'];
			$password = $_GET['password'];
			$mobile = $_GET['mobile'];
			
			$insertion::insertUser($fName, $lName, $email, $password, $mobile);
			
		}
?>