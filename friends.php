<?php
include_once "dbConnect.php";
include_once "getProfile.php";

$connect = new dbConnect();
$connect->connect();

class Friends{

var $follower, $followee;

function verifyFriend($profileID, $userID){
	
	$sql = mysql_query("SELECT rel_ID FROM friends WHERE followee = '$profileID' AND following = '$userID'");
	$count = mysql_num_rows($sql);
	
	$sql2 = mysql_query("SELECT rel_ID FROM friends WHERE following = '$profileID' AND followee = '$userID'");
	$count2 = mysql_num_rows($sql2);
	
	if($count == 1 && $count2 == 0){
		return 1;
	}else if($count2 == 1 && $count == 0){
		return 2;
	}else if($count == 1 && $count2 == 1){
		return 3;
	}else{
		return 0;
	}
}
function getYourFollowing($user_ID){
	
	$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.following WHERE followee = '$user_ID'");
	$chk = mysql_num_rows($sql);
	
	if($chk == 0){
		return "<p style = 'margin-top:10px;margin-bottom:10px;font-size:20px;'>I am sorry, you are not Following anyone.</p>";
	}else{
	
	while($rows = mysql_fetch_array($sql)){
		
		echo "<div id = 'friendList'><table style = 'float:left;height:80px;width:40%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:10px;'
			href = 'Profile.php?pID=".$rows['userID']."'>".$rows['displayName']."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:80px;width:50%;'>
			<tr>
				<td align = 'right'><a href = 'unfollowSubmit.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'Unfollow'></a></td>
			</tr>
		</table></div>";
	}
	}
}
function getYourFollowingMobile($user_ID){
	
	$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.following WHERE followee = '$user_ID'");
	
	while($rows = mysql_fetch_array($sql)){
		
		if(strlen($rows['displayName']) > 10){
			$dispName = substr($rows['displayName'], 0, 7);
			$dispName .= "...";
		}else{
			$dispName = $rows['displayName'];
		}
	
		echo "<div id = 'friendList'><table style = 'float:left;height:60px;width:50%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:30px;white-space:nowrap;'
			href = 'm_Profile.php?pID=".$rows['userID']."'>".$dispName."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:60px;width:40%;'>
			<tr>
				<td align = 'right'><a href = 'unfollowSubmit.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'Unfollow'></a></td>
			</tr>
		</table></div>";
	}
}
function getFollowers($user_ID){
	
	$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.followee WHERE following = '$user_ID'");
	$chk = mysql_num_rows($sql);
	
	if($chk == 0){
		return "<p style = 'margin-top:10px;margin-bottom:10px;font-size:20px;'>I am sorry, you are not Following anyone.</p>";
	}else{
	
	while($rows = mysql_fetch_array($sql)){
		
		echo "<div id = 'friendList'><table style = 'float:left;height:80px;width:40%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:10px;'
			href = 'Profile.php?pID=".$rows['userID']."'>".$rows['displayName']."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:80px;width:50%;'>
			<tr>
				<td align = 'right'><a href = 'unfollowSubmit.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'Unfollow'></a></td>
			</tr>
		</table></div>";
	}
	}
}
function getFollowersMobile($user_ID){
	
	$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.followee WHERE following = '$user_ID'");
	
	while($rows = mysql_fetch_array($sql)){
	
	if(strlen($rows['displayName']) > 10){
			$dispName = substr($rows['displayName'], 0, 7);
			$dispName .= "...";
		}else{
			$dispName = $rows['displayName'];
		}
		
		echo "<div id = 'friendList'><table style = 'float:left;height:60px;width:50%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:30px;white-space:nowrap;'
			href = 'm_Profile.php?pID=".$rows['userID']."'>".$dispName."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:60px;width:40%;'>
			<tr>
				<td align = 'right'><a href = 'unfollowSubmit.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'Unfollow'></a></td>
			</tr>
		</table></div>";
	}
}
function follow($userID, $profileID, $mobile){

	$sql = mysql_query("INSERT INTO friends (rel_ID, following, followee, rel_Action)
	VALUES('null','$profileID','$userID','yes')");
	
	if($mobile == 'yes'){
		header("Location:m_Profile.php?pID=".$profileID."");
	}else{
		header("Location:Profile.php?pID=".$profileID."");
	}
}
function unFollow($userID, $profileID){
	$sql = mysql_query("DELETE FROM friends WHERE following = '$profileID' AND followee = '$userID'");
	
	if($mobile == 'yes'){
		header("Location:m_Profile.php?pID=".$profileID."");
	}else{
		header("Location:Profile.php?pID=".$profileID."");
	}
}
function getFollowees($user_ID){

}
function getNumFollowing($user_ID){

}
function getNumFollowers($user_ID){

}
}
?>