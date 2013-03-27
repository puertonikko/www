<?php
include_once "dbConnect.php";
include_once "getProfile.php";

$connect = new dbConnect();
$connect->connect();

class Retrieve{

	var $userID, $fName, $lName, $email, $pass;
	
	function getUser($userID){
		$sql = mysql_query("SELECT * FROM user WHERE user_ID = '$userID'");
		
		while($rows = mysql_fetch_array($sql)){
			$this->fName = $rows['first_Name'];
			$this->lName = $rows['last_Name'];
			$this->email = $rows['email'];
			$this->pass = $rows['password'];
		}
	}
	function getfName(){
		return $this->fName;
	}
	function getNewUsers(){
	
	$profile = new Profile();
	$sql = mysql_query("SELECT p.displayName, p.userID FROM user u INNER JOIN profile p ON p.userID = u.user_ID");
	
	while($rows = mysql_fetch_array($sql)){
		echo "<div id = 'newUser'><table style = 'float:left;height:80px;width:40%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:40px;'
			href = 'Profile.php?pID=".$rows['userID']."'>".$rows['displayName']."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:80px;width:50%;'>
			<tr>
				<td align = 'right'><a style = 'margin-right:10px;' href = 'Profile.php?pID=".$rows['userID']."'>
				<input class = 'button' type = 'Submit' value = 'View Profile'></a></td>
			</tr>
		</table></div>";
	}
	}
	function getNewUsersMobile(){
	
	$profile = new Profile();
	$sql = mysql_query("SELECT p.displayName, p.userID FROM user u INNER JOIN profile p ON p.userID = u.user_ID ORDER BY memberDate DESC");
	
	while($rows = mysql_fetch_array($sql)){
	
	if(strlen($rows['displayName']) > 10){
		$dispName = substr($rows['displayName'], 0, 7);
		$dispName .= "...";
	}else{
		$dispName = $rows['displayName'];
	}
		
		echo "<td><table style = 'float:left;height:80px;'>
		<tr>
			<td align = 'center'>
			<a class = 'displayLink' style = 'white-space:nowrap;'
			href = 'm_Profile.php?pID=".$rows['userID']."'>".$dispName."</a>
		</td>
		</tr>
		<tr><td align = 'center'>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		</tr>
		</table></td>";
	}
	}
	function getNotification($user, $postID){
		
		$sql = mysql_query("SELECT postCount, replyCountPlus FROM posting WHERE post_ID = '$postID' AND postUserID = '$user'");
		
		$rows = mysql_fetch_array($sql);
		$notifierNum = $rows['postCount'] - $rows['replyCountPlus'];
		
		return $notifierNum;
	}
	function clearPostNotifier($user, $postID){
		
		$sql = mysql_query("SELECT postCount, postUserID FROM posting WHERE post_ID = '$postID'");
		$rows = mysql_fetch_array($sql);
		$postCount = $rows['postCount'];
		
		if($user == $rows['postUserID']){
			$sql2 = mysql_query("UPDATE posting SET replyCountPlus = '$postCount' 
			WHERE post_ID = '$postID'");
		}
	}
}