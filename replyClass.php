<?php
include_once "dbConnect.php";
include_once "getProfile.php";

$connect = new dbConnect();
$connect->connect();

class Reply{

function getReplies($postID){
	
}
function replyBack($postID, $user, $reply, $category, $anonymous, $mobile){
	$date = date('mdy g:i:s A');
	$dateView = date('m/d/y');

	$sql = mysql_query("INSERT INTO reply (replyID, replyToID, replyFromID, date, reply, category, anonymous, mmddyyyy, replyCountPlus)
		VALUES('null', '$postID', '$user', '$date', '$reply', '$category', '$anonymous', '$dateView', '0')");
	
	$sql= mysql_query("UPDATE posting SET postCount = postCount + 1 WHERE post_ID = '$postID'");
	
	if($mobile == 'yes'){
		header("Location:m_PostView.php?id=".$postID."");
	}else{
		header("Location:PostView.php?id=".$postID."");
	}
}
function getFriendsReplies($user){
	$sql = mysql_query("SELECT * FROM reply r INNER JOIN friends f ON r.replyFromID = f.following WHERE followee = '$user'");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
	}
	
	$imagePost = $rows['replyFromID']."/".$rows['replyFromID']."-".$rows['replyID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['replyToID']."#".$rows['replyID']."'><table class = 'post'>
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
							<td>Category: ".$rows['category']."<td>
						</tr>
					</table>
					<table style = 'float:right;'>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
					</table>
				</div>
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
			</table><br /></a>";
	}
}
function getFriendsRepliesMobile($user){
	$sql = mysql_query("SELECT * FROM reply r INNER JOIN friends f ON r.replyFromID = f.following WHERE followee = '$user'");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
	}
	
	$imagePost = $rows['replyFromID']."/".$rows['replyFromID']."-".$rows['replyID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'm_PostView.php?id=".$rows['replyToID']."#".$rows['replyID']."'><table class = 'post'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
					<table style = 'float:right;width:60%;'>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
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
			</table><br /></a>";
	}
}
function getMyReplies($user){
	$sql = mysql_query("SELECT * FROM reply WHERE replyFromID = '$user'");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
	}
	
	$imagePost = $rows['replyFromID']."/".$rows['replyFromID']."-".$rows['replyID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['replyToID']."#".$rows['replyID']."'><table class = 'post'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
				<div style = 'float:right;width:70%;'>
					<table style = 'float:left;'>
						<tr>
							<td>Cateogry: ".$rows['category']."<td>
						</tr>
					</table>
					<table style = 'float:right;'>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
					</table>
				</div>
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
			</table><br /></a>";
	}
}
function getMyRepliesMobile($user){
	$sql = mysql_query("SELECT * FROM reply WHERE replyFromID = '$user'");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
	}
	
	$imagePost = $rows['replyFromID']."/".$rows['replyFromID']."-".$rows['replyID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'm_PostView.php?id=".$rows['replyToID']."#".$rows['replyID']."'><table class = 'post'> <tr><td> <table style = 'float:left;width:30%;'> <tr> <td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td> </tr> <tr> <td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td> </tr> </table> <table style = 'float:right;width:60%;'> <tr> <td>Date: ".$rows['mmddyyyy']."<td> 						</tr> </table> <table style = 'float:right;width:70%;'> <tr> <td>".$image."</td> </tr> </table> </td></tr> <tr> <td>Reply</td> </tr> 				<tr> <td>".$rows['reply']."</td> </tr> </table><br /></a>";
	}
}
function getReplyByPost($postID){
	$sql = mysql_query("SELECT * FROM reply WHERE replyToID = '$postID'");
	
	$profile = new Profile();
	$style = "";
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
	}
	
	if($rows['replyFromID'] == $rows['replyToID']){
		if($rows['anonymous'] == "No" ){
			$style = "float:left;'";
		}else{
			$style = "float:right;'";
		}
	}else{
		$style = "float:right;'";
	}
		
		echo "<div style = 'margin-top:10px;width:70%;".$style."clear:both;'>
			<table class = 'post' id = '".$rows['replyID']."'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
				<div style = 'float:right;width:70%;'>
					<table style = 'float:right;'>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
					</table>
				</div>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>Reply</td>
					</tr>
					<tr>
						<td>".$rows['reply']."</td>
					</tr>
				</table>
				</td></tr>
				</td></tr>
			</table><br /></div>";
		}
	}
	function getReplyByPostMobile($postID){
	$sql = mysql_query("SELECT * FROM reply WHERE replyToID = '$postID'");
	
	$profile = new Profile();
	$style = "";
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['replyFromID'];
		$displayName = $profile->getDisplayName($rows['replyFromID']);
		$profileImage = $profile->getProfileImage($rows['replyFromID']);
	}
	
	if($rows['replyFromID'] == $rows['replyToID']){
		if($rows['anonymous'] == "No" ){
			$style = "float:left;'";
		}else{
			$style = "float:right;'";
		}
	}else{
		$style = "float:right;'";
	}
		
		echo "<div style = 'margin-top:10px;width:70%;".$style."clear:both;'>
			<table class = 'post' id = '".$rows['replyID']."'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
				</td></tr>
					<tr>
						<td>Reply</td>
					</tr>
					<tr>
						<td>".$rows['reply']."</td>
					</tr>
			</table><br /></div>";
		}
	}
}
?>