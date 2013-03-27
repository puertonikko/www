<?php
include_once "dbConnect.php";

$connect = new dbConnect();
$connect->connect();

class Profile{

var $profileID, $displayName, $firstName, $state, $bDate, $userComment;

	function updateProfile($userID, $dName, $state, $bDate, $uComment){
	
	$sql = mysql_query("UPDATE profile SET profileID = '$userID', userID = '$userID', displayName = '$dName', 
		state = '$state', bDate = '$bDate', comment = '$uComment' WHERE userID = '$userID'");
		
		header("Location:MyProfile.php");	
	}
	function getProfile($userID){
		$sql = mysql_query("SELECT * FROM profile WHERE userID = '$userID'");
		$sql2 = mysql_query("SELECT first_Name FROM user WHERE user_ID = '$userID' ");
		
		$row2 = mysql_fetch_array($sql2);
		$this->firstName = $row2['first_Name'];
		
		while($rows = mysql_fetch_array($sql)){
			$this->profileID = $rows['profileID'];
			$this->displayName = $rows['displayName'];
			$this->state = $rows['state'];
			$this->bDate = $rows['bDate'];
			$this->userComment = $rows['comment'];
		}
	}
	function getProfileImage($userID){
		$dir = $userID;
		$fileName = $dir."/default.jpeg";
		
		if(file_exists($fileName)){
			return $fileName;
		}else{
			return "defaultImage.jpeg";
		}
	}
	function getDisplayName($user){
		$sql = mysql_query("SELECT displayName FROM profile WHERE userID = '$user'");
		$rows = mysql_fetch_array($sql);
		
		return $rows['displayName'];
	}
	function getProfilePosts($user){
		$sql = mysql_query("SELECT * FROM posting WHERE postUserID = '$user'");
		$chk = mysql_num_rows($sql);
	
	$profile = new Profile();
	
	//view contains the initial table tag that has the display css to show or not show given whether the post
	//is anonymous or not.
	
	if($chk == 0){
		echo "<p style = 'margin-top:10px;font-size:24px;'>I am sorry, this user does not have any posts.</p>";
	}else{
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
		$view = "<table class = 'post' style = 'display:none;'>";
		$endview = "</table></a>";
	}else{
		$postLink = "Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
		$view = "<table class = 'post' style = 'display:block;'>";
		$endview = "</table><br /></a>";
	}
	
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['post_ID']."'>
		".$view."
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
					</tr>
					<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$rows['post']."</td>
					</tr>
				</table>
				</td></tr>
				</td></tr>
			".$endview."";
	}
	}
	}
	function getProfilePostsMobile($user){
		$sql = mysql_query("SELECT * FROM posting WHERE postUserID = '$user'");
		$chk = mysql_num_rows($sql);
	
	$profile = new Profile();
	
	//view contains the initial table tag that has the display css to show or not show given whether the post
	//is anonymous or not.
	
	if($chk == 0){
		echo "<p style = 'margin-top:10px;font-size:24px;'>I am sorry, this user does not have any posts.</p>";
	}else{
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
		$view = "<table class = 'post' style = 'display:none;'>";
		$endview = "</table></a>";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
		$view = "<table class = 'post' style = 'display:block;'>";
		$endview = "</table><br /></a>";
	}
	
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'm_PostView.php?id=".$rows['post_ID']."'>
		".$view."
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
					</tr>
				</table>
				</td></tr>
				<tr>
					<td>Post</td>
				</tr>
				<tr>
					<td>".$rows['post']."</td>
				</tr>
			".$endview."";
	}
	}
	}
	function getProfileReplies($user){
		$sql = mysql_query("SELECT * FROM reply WHERE replyFromID = '$user'");
		
		$profile = new Profile();
	
	//view contains the initial table tag that has the display css to show or not show given whether the post
	//is anonymous or not.
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
		$view = "<table class = 'post' style = 'display:none;'>";
		$endview = "</table></a>";
	}else{
		$postLink = "Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
		$view = "<table class = 'post' style = 'display:block;'>";
		$endview = "</table><br /></a>";
	}
	
	$imagePost = $rows['replyFromID']."/".$rows['replyFromID']."-".$rows['replyID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['replyToID']."#".$rows['replyID']."'>
		".$view."
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
					</tr>
					<tr>
						<td>Reply</td>
					</tr>
					<tr>
						<td>".$rows['reply']."</td>
					</tr>
				</table>
				</td></tr>
				</td></tr>
			".$endview."";
	}
	}
	function getProfileRepliesMobile($user){
		$sql = mysql_query("SELECT * FROM reply WHERE replyFromID = '$user'");
		
		$profile = new Profile();
	
	//view contains the initial table tag that has the display css to show or not show given whether the post
	//is anonymous or not.
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
		$view = "<table class = 'post' style = 'display:none;'>";
		$endview = "</table></a>";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
		$view = "<table class = 'post' style = 'display:block;'>";
		$endview = "</table><br /></a>";
	}
	
	$imagePost = $rows['replyFromID']."/".$rows['replyFromID']."-".$rows['replyID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'm_PostView.php?id=".$rows['replyToID']."#".$rows['replyID']."'>
		".$view."
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
					</tr>
				</table>
				</td></tr>
				<tr>
						<td>Reply</td>
				</tr>
				<tr>
					<td>".$rows['reply']."</td>
				</tr>
			".$endview."";
	}
	}
	function getProfileFriends($user_ID){
		$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.following WHERE followee = '$user_ID'");
	
	while($rows = mysql_fetch_array($sql)){
		
		echo "<div id = 'friendList'><table style = 'float:left;height:80px;width:50%;'>
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
				<td align = 'right'><a href = 'Profile.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'View'></a></td>
			</tr>
		</table></div>";
	}
	}
	function getProfileFriendsMobile($user_ID){
		$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.following WHERE followee = '$user_ID'");
	
	while($rows = mysql_fetch_array($sql)){
		
		echo "<div id = 'friendList'><table style = 'float:left;height:80px;width:50%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:20px;'
			href = 'm_Profile.php?pID=".$rows['userID']."'>".$rows['displayName']."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:80px;width:40%;'>
			<tr>
				<td align = 'right'><a href = 'm_Profile.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'View'></a></td>
			</tr>
		</table></div>";
	}
	}
	function getProfileFollowers($user_ID){
		$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.followee WHERE following = '$user_ID'");
	
	while($rows = mysql_fetch_array($sql)){
		
		echo "<div id = 'friendList'><table style = 'float:left;height:80px;width:50%;'>
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
				<td align = 'right'><a href = 'Profile.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'View'></a></td>
			</tr>
		</table></div>";
	}
	}
	function getProfileFollowersMobile($user_ID){
		$profile = new Profile();
	
	$sql = mysql_query("SELECT p.displayName, p.userID FROM friends f INNER JOIN profile p ON p.userID = f.followee WHERE following = '$user_ID'");
	
	while($rows = mysql_fetch_array($sql)){
		
		echo "<div id = 'friendList'><table style = 'float:left;height:80px;width:50%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:20px;'
			href = 'm_Profile.php?pID=".$rows['userID']."'>".$rows['displayName']."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:80px;width:40%;'>
			<tr>
				<td align = 'right'><a href = 'm_Profile.php?pID=".$user_ID."'><input class = 'button' type = 'Submit' value = 'View'></a></td>
			</tr>
		</table></div>";
	}
	}
}
?>