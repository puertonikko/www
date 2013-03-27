<?php
include_once "dbConnect.php";
include_once "replyClass.php";
include_once "getProfile.php";

$connect = new dbConnect();
$connect->connect();

class Post{

var $postID, 
	$dateSort, 
	$subject, 
	$post, 
	$postCount, 
	$category, 
	$anonymous, 
	$mmddyyyy;

function insertPost($user, $category, $subject, $post, $date, $anonymous, $image){
	
	$mmddyyyy = date('m/d/y');
	
	$sql = mysql_query("INSERT INTO posting (post_ID, postUserID, date, subject, post, postCount, category, anonymous, mmddyyyy)
	VALUES('NULL','$user', '$date', '$subject', '$post', '0', '$category', '$anonymous','$mmddyyyy')");
	$id = mysql_insert_id();
	
	$pidExt = $user."-".$id.".jpeg";
		
	if($image) {
		
		$folder = $_SESSION['user_ID']."/";
		$filename = $folder . $pidExt;
		$copied = copy($_FILES['upload']['tmp_name'], $filename);

	}
}
function getPostSubject($postID){
	$sql = mysql_query("SELECT subject FROM posting WHERE post_ID = '$postID'");
	
	while($rows = mysql_fetch_array($sql)){
		echo $rows['subject'];
	}
}
function getPostByID($postID){
	$sql = mysql_query("SELECT * FROM posting WHERE post_ID = '$postID'");
	$profile = new Profile();
	
	$rows = mysql_fetch_array($sql);
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['post_ID']."'><table class = 'post'>
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
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
					</table>
					<table style = 'float:right;'>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				</div>
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
			</table><br /></a>";
			$this->subject= $rows['subject'];
}
function getPostByIDMobile($postID){
	$sql = mysql_query("SELECT * FROM posting WHERE post_ID = '$postID'");
	$profile = new Profile();
	
	$rows = mysql_fetch_array($sql);
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'm_PostView.php?id=".$rows['post_ID']."'><table class = 'post'>
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
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				</div>
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
			</table><br /></a>";
			$this->subject= $rows['subject'];
}
function getFriendsPost($user){
	$sql = mysql_query("SELECT * FROM posting p INNER JOIN friends f ON p.postUserID = f.following WHERE followee = '$user'");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['post_ID']."'><table class = 'post'>
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
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
					</table>
					<table style = 'float:right;'>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				</div>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
						<td><a href = 'PostView.php?id=".$rows['post_ID']."'><input class = 'button' type = 'button'
						value = 'View More'></a></td>
					</tr>
					<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
				</table>
				</td></tr>
				</td></tr>
			</table><br /></a>";
	}
}
function getFriendsPostMobile($user){
	$sql = mysql_query("SELECT * FROM posting p INNER JOIN friends f ON p.postUserID = f.following WHERE followee = '$user'");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<table class = 'post'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
					<table style = 'float:right;width:60%;padding-top:20px;'>
						<tr>
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				<table style = 'width:100%;'>
					<tr>
						<td>".$image."</td>
						<td><a href = 'm_PostView.php?id=".$rows['post_ID']."'><input class = 'button' type = 'button'
						value = 'View More' style = 'float:right;'></a></td>
					</tr>
				</table>
				<table style = 'width:100%;'>
					<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
				</td></tr>
				</table>
				</td></tr>
			</table>";
	}
}
function getAllPostsByUser($user){
	
	$sql = mysql_query("SELECT * FROM posting WHERE postUserID = '$user'");
	$chk = mysql_num_rows($sql);
	
	$profile = new Profile();
	$retrieve = new Retrieve();
	
	if($chk == 0){
		echo "<p style = 'margin-top:10px;font-size:24px;'>I am sorry, you do not have any posts.</p>
		<p style = 'margin-top:10px;font-size:24px;'>Go ahead and post in any category.</p>";
	}else{
	
	while($rows = mysql_fetch_array($sql)){
	
	$notifierNum = $retrieve->getNotification($user, $rows['post_ID']);
	
	if($notifierNum > 0){
		$new = "<label style = 'color:red;'>New!</label>";
	}else{
		$new = "";
	}
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['post_ID']."'><table class = 'post'>
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
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
					</table>
					<table style = 'float:right;'>
						<tr>
							<td>".$new."<td>
						</tr>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				</div>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
						<td><a href = 'PostView.php?id=".$rows['post_ID']."'><input class = 'button' type = 'button'
						value = 'View More'></a></td>
					</tr>
					<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
				</table>
				</td></tr>
				</td></tr>
			</table><br /></a>";
	}
	}
}
function getAllPostsByUserMobile($user){
	
	$sql = mysql_query("SELECT * FROM posting WHERE postUserID = '$user'");
	$chk = mysql_num_rows($sql);
	
	$profile = new Profile();
	$retrieve = new Retrieve();
	
	if($chk == 0){
		echo "<p style = 'margin-top:10px;font-size:24px;'>I am sorry, you do not have any posts.</p>
		<p style = 'margin-top:10px;font-size:24px;'>Go ahead and post in any category.</p>";
	}else{
	
	while($rows = mysql_fetch_array($sql)){
	
	$notifierNum = $retrieve->getNotification($user, $rows['post_ID']);
	
	if($notifierNum > 0){
		$new = "<label style = 'color:red;'>New!</label>";
	}else{
		$new = "";
	}
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<table class = 'post'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
					<table style = 'float:right;width:60%;padding-top:20px;'>
						<tr>
							<td>".$new."<td>
						</tr>
						<tr>
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				<table style = 'width:100%;'>
					<tr>
						<td>".$image."</td>
						<td><a href = 'm_PostView.php?id=".$rows['post_ID']."'><input class = 'button' type = 'button'
						value = 'View More' style = 'float:right;'></a></td>
					</tr>
				</table>
				<table style = 'width:100%;'>
					<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
				</td></tr>
				</table>
				</td></tr>
			</table>";
	}
	}
}
function getAllPopular(){
	$sql = mysql_query("SELECT * FROM posting ORDER BY postCount DESC");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
		
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<table class = 'post'>
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
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
					</table>
					<table style = 'float:right;'>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				</div>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
						<td><a href = 'PostView.php?id=".$rows['post_ID']."'><input class = 'button' type = 'button'
						value = 'View More'></a></td>
					</tr>
					<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
				</table>
				</td></tr>
				</td></tr>
			</table><br />";
	}
}
function getAllPopularMobile(){
	$sql = mysql_query("SELECT * FROM posting ORDER BY postCount DESC");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
		
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'm_PostView.php?id=".$rows['post_ID']."' style = 'text-decoration:none;color:black;'><table class = 'post'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100%'/></td>
					</tr>
				</table>
					<table style = 'float:right;width:70%;padding-left:15px;'>
						<tr>
							<td>Category: ".$rows['category']."<td>
						</tr>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				</div>
				<table style = 'float:right;width:68%;'>
					<tr>
						<td>".$image."</td>
					</tr>
				</table>
				</td></tr>
				<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
			</table><br /></a>";
	}
}
function getPostByCat($category){
	$sql = mysql_query("SELECT * FROM posting WHERE category = '$category' ORDER BY date DESC");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'PostView.php?id=".$rows['post_ID']."'><table class = 'post'>
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
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				</div>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
						<td><a href = 'PostView.php?id=".$rows['post_ID']."'><input class = 'button' type = 'button'
						value = 'View More'></a></td>
					</tr>
					<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
				</table>
				</td></tr>
				</td></tr>
			</table><br /></a>";
	}
}
function getPostByCatMobile($category){
	$sql = mysql_query("SELECT * FROM posting WHERE category = '$category' ORDER BY date DESC");
	
	$profile = new Profile();
	
	while($rows = mysql_fetch_array($sql)){
	
	if($rows['anonymous']== 'Yes'){
		$postLink = '#';
		$displayName = 'Anonymous';
		$profileImage = "defaultImage.jpeg";
	}else{
		$postLink = "m_Profile.php?pID=".$rows['postUserID'];
		$displayName = $profile->getDisplayName($rows['postUserID']);
		$profileImage = $profile->getProfileImage($rows['postUserID']);
	}
	$post = substr($rows['post'], 0, 200);
	$imagePost = $rows['postUserID']."/".$rows['postUserID']."-".$rows['post_ID'].".jpeg";
	
	if(file_exists($imagePost)){
		$image = "<img src = '".$imagePost."' height = '200' width = '200'/>";
	}else{
		$image = "";
	}
		
		echo "<a href = 'm_PostView.php?id=".$rows['post_ID']."'><table class = 'post'>
				<tr><td>
				<table style = 'float:left;width:30%;'>
					<tr>
						<td><a class = 'displayLink' href = '".$postLink."'>".$displayName."</a></td>
					</tr>
					<tr>
						<td><img class = 'image' src = '".$profileImage."' height = '80' width = '100'/></td>
					</tr>
				</table>
					<table style = 'float:right;width:60%;padding-left:10px;'>
						<tr>
							<td>Subject: ".$rows['subject']."<td>
						</tr>
						<tr>
							<td>Date: ".$rows['mmddyyyy']."<td>
						</tr>
						<tr>
							<td>Replies: (".$rows['postCount'].")<td>
						</tr>
					</table>
				<table style = 'float:right;width:70%;'>
					<tr>
						<td>".$image."</td>
						<td><a href = 'm_PostView.php?id=".$rows['post_ID']."'><input class = 'button' type = 'button'
						value = 'View More' style = 'float:right;'></a></td>
					</tr>
				</table>
				</td></tr>
				<tr>
						<td>Post</td>
					</tr>
					<tr>
						<td>".$post."...<a href = 'm_PostView.php?id=".$rows['post_ID']."'>Read More</a></td>
					</tr>
			</table><br /></a>";
	}
}
function getCatbyPost($postID){
	$sql = mysql_query("SELECT category FROM posting WHERE post_ID = '$postID'");
	$rows = mysql_fetch_array($sql);
	
	return $rows['category'];
}
}
?>