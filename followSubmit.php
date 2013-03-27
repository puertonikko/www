<?php
session_start();
include_once "friends.php";

if(isset($_GET['mobile'])){
	$mobile = $_GET['mobile'];
}else{
	$mobile = 'no';
}

$friend = new Friends();
$friend->follow($_SESSION['user_ID'], $_GET['pID'], $mobile);
?>