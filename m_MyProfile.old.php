<?php
session_start();
include_once "retrieveClass.php";
include_once "getProfile.php";
include_once "friends.php";
include_once "postClass.php";
include_once "replyClass.php";

$reply = new Reply();
$post = new Post();
$retrieve = new Retrieve();
$retrieve->getUser($_SESSION['user_ID']);

$profile = new Profile();
$profile->getProfile($_SESSION['user_ID']);

$friends = new Friends();

$error = "";

if(isset($_POST['dispName'])){
	$profile->updateProfile($_SESSION['user_ID'], $_POST['dispName'],$_POST['state'],$_POST['bDate'],$_POST['uComm']);
}else{
	$error .= "You Must Enter your Display Name.";
}

if(isset($_FILES['upload']['name'])){
	$image = $_FILES['upload']['name'];
	$pidExt = "default.jpeg";
		
	if($image) {
		
		$folder = $_SESSION['user_ID']."/";
		$filename = $folder . $pidExt;
		$copied = copy($_FILES['upload']['tmp_name'], $filename);

	}
}
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" 
"http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WomansBF (Mobile)</title>
<meta http-equiv="content-type" content="application/xhtml+xml" />
<meta http-equiv="cache-control" content="max-age=300" />
<meta name="viewport" content="width=device-width;
 initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> 
<link rel="stylesheet" type="text/css" href="mobileStyle.css" />
<script type = "text/javascript">
function dropMenu(){
	var profileMenu = document.getElementById('profileMenu');
	
	if(profileMenu.style.display == "none"){
		profileMenu.style.display = "block";
	}else{
		profileMenu.style.display = "none";
	}
}	
function friendMenu(){
	var friendMenu = document.getElementById('friendMenu');
	
	if(friendMenu.style.display == "none"){
		friendMenu.style.display = "block";
	}else{
		friendMenu.style.display = "none";
	}
}
function screenChange(num){
	
var profileMenu = document.getElementById('profileMenu');
var friendMenu = document.getElementById('friendMenu');
	
if(num == 1){	
	if(following.style.display == "none"){
		followers.style.display = "none";
		following.style.display = "block";
		myProfile.style.display = "none";
		myPosts.style.display = "none";
		myReplies.style.display = "none";
		myReplies.style.display = "none";
		friendsPosts.style.display = "none";
		friendsReplies.style.display = "none";
		profileMenu.style.display = "none";
		friendMenu.style.display = "none";
	}
}
if(num == 2){	
	if(followers.style.display == "none"){
		followers.style.display = "block";
		following.style.display = "none";
		myProfile.style.display = "none";
		myPosts.style.display = "none";
		myReplies.style.display = "none";
		myReplies.style.display = "none";
		friendsPosts.style.display = "none";
		friendsReplies.style.display = "none";
		profileMenu.style.display = "none";
		friendMenu.style.display = "none";
	}
}
if(num == 3){	
	if(myProfile.style.display == "none"){
		followers.style.display = "none";
		following.style.display = "none";
		myPosts.style.display = "none";
		myProfile.style.display = "block";
		myReplies.style.display = "none";
		myReplies.style.display = "none";
		friendsPosts.style.display = "none";
		friendsReplies.style.display = "none";
		profileMenu.style.display = "none";
		friendMenu.style.display = "none";
	}
}
if(num == 4){	
	if(myPosts.style.display == "none"){
		followers.style.display = "none";
		following.style.display = "none";
		myPosts.style.display = "block";
		myProfile.style.display = "none";
		myReplies.style.display = "none";
		friendsPosts.style.display = "none";
		friendsReplies.style.display = "none";
		profileMenu.style.display = "none";
		friendMenu.style.display = "none";
	}
}
if(num == 5){	
	if(myReplies.style.display == "none"){
		followers.style.display = "none";
		following.style.display = "none";
		myPosts.style.display = "none";
		myProfile.style.display = "none";
		myReplies.style.display = "block";
		friendsPosts.style.display = "none";
		friendsReplies.style.display = "none";
		profileMenu.style.display = "none";
		friendMenu.style.display = "none";
	}
}
if(num == 6){	
	if(friendsPosts.style.display == "none"){
		followers.style.display = "none";
		following.style.display = "none";
		myPosts.style.display = "none";
		myProfile.style.display = "none";
		myReplies.style.display = "none";
		friendsPosts.style.display = "block";
		friendsReplies.style.display = "none";
		profileMenu.style.display = "none";
		friendMenu.style.display = "none";
	}
}
if(num == 7){	
	if(friendsReplies.style.display == "none"){
		followers.style.display = "none";
		following.style.display = "none";
		myPosts.style.display = "none";
		myProfile.style.display = "none";
		myReplies.style.display = "none";
		friendsPosts.style.display = "none";
		friendsReplies.style.display = "block";
		profileMenu.style.display = "none";
		friendMenu.style.display = "none";
	}
}
}	
</script>
</head>
<body>
<?php

$GLOBALS['google']['client']='ca-mb-pub-8378891340110669';
$GLOBALS['google']['https']=read_global('HTTPS');
$GLOBALS['google']['ip']=read_global('REMOTE_ADDR');
$GLOBALS['google']['markup']='xhtml';
$GLOBALS['google']['output']='xhtml';
$GLOBALS['google']['ref']=read_global('HTTP_REFERER');
$GLOBALS['google']['slotname']='4204346757';
$GLOBALS['google']['url']=read_global('HTTP_HOST') . read_global('REQUEST_URI');
$GLOBALS['google']['useragent']=read_global('HTTP_USER_AGENT');
$google_dt = time();
google_set_screen_res();
google_set_muid();
google_set_via_and_accept();
function read_global($var) {
  return isset($_SERVER[$var]) ? $_SERVER[$var]: '';
}

function google_append_url(&$url, $param, $value) {
  $url .= '&' . $param . '=' . urlencode($value);
}

function google_append_globals(&$url, $param) {
  google_append_url($url, $param, $GLOBALS['google'][$param]);
}

function google_append_color(&$url, $param) {
  global $google_dt;
  $color_array = explode(',', $GLOBALS['google'][$param]);
  google_append_url($url, $param,
                    $color_array[$google_dt % count($color_array)]);
}

function google_set_screen_res() {
  $screen_res = read_global('HTTP_UA_PIXELS');
  if ($screen_res == '') {
    $screen_res = read_global('HTTP_X_UP_DEVCAP_SCREENPIXELS');
  }
  if ($screen_res == '') {
    $screen_res = read_global('HTTP_X_JPHONE_DISPLAY');
  }
  $res_array = preg_split('/[x,*]/', $screen_res);
  if (count($res_array) == 2) {
    $GLOBALS['google']['u_w']=$res_array[0];
    $GLOBALS['google']['u_h']=$res_array[1];
  }
}

function google_set_muid() {
  $muid = read_global('HTTP_X_DCMGUID');
  if ($muid != '') {
    $GLOBALS['google']['muid']=$muid;
     return;
  }
  $muid = read_global('HTTP_X_UP_SUBNO');
  if ($muid != '') {
    $GLOBALS['google']['muid']=$muid;
     return;
  }
  $muid = read_global('HTTP_X_JPHONE_UID');
  if ($muid != '') {
    $GLOBALS['google']['muid']=$muid;
     return;
  }
  $muid = read_global('HTTP_X_EM_UID');
  if ($muid != '') {
    $GLOBALS['google']['muid']=$muid;
     return;
  }
}

function google_set_via_and_accept() {
  $ua = read_global('HTTP_USER_AGENT');
  if ($ua == '') {
    $GLOBALS['google']['via']=read_global('HTTP_VIA');
    $GLOBALS['google']['accept']=read_global('HTTP_ACCEPT');
  }
}

function google_get_ad_url() {
  $google_ad_url = 'http://pagead2.googlesyndication.com/pagead/ads?';
  google_append_url($google_ad_url, 'dt',
                    round(1000 * array_sum(explode(' ', microtime()))));
  foreach ($GLOBALS['google'] as $param => $value) {
    if (strpos($param, 'color_') === 0) {
      google_append_color($google_ad_url, $param);
    } else if (strpos($param, 'url') === 0) {
      $google_scheme = ($GLOBALS['google']['https'] == 'on')
          ? 'https://' : 'http://';
      google_append_url($google_ad_url, $param,
                        $google_scheme . $GLOBALS['google'][$param]);
    } else {
      google_append_globals($google_ad_url, $param);
    }
  }
  return $google_ad_url;
}

$google_ad_handle = @fopen(google_get_ad_url(), 'r');
if ($google_ad_handle) {
  while (!feof($google_ad_handle)) {
    echo fread($google_ad_handle, 8192);
  }
  fclose($google_ad_handle);
}

?>
<header style = "height:80px;width:100%;background-image:url('mobileImages/headerBackMobile.png');">
<a href = "m_home.php" style = 'margin:0px auto;color:white;'>Home</a>
</header>
<div id = "mobile_container">
<div id = "menu" style = "width:100%;background-color:black;height:50px;">
<div style = 'float:left;width:50%;background-color:black;'>
<table style = 'margin:0px auto;margin-top:10px;'>
	<tr>
		<td><label style = 'margin:0px auto;color:white;' onclick = 'friendMenu();'>Followers</label></td>
	</tr>
</table>
<table id = 'friendMenu' style = 'color:white;margin:0px auto;margin-top:10px;display:none;z-index:2;
	position:absolute;background-color:black;margin-left:30px;'>
	<tr>
		<td><label onclick = 'screenChange(1);'>&nbsp;&nbsp;Following&nbsp;&nbsp;</label></td>
	</tr>
	<tr>
		<td><label onclick = 'screenChange(2);'>&nbsp;&nbsp;Followers&nbsp;&nbsp;</label></td>
	</tr>
	</table>
</div>
<div style = 'float:right;width:50%;'>
<table style = 'margin:0px auto;margin-top:10px;'>
	<tr>
		<td><label style = 'margin:0px auto;color:white;' onclick = 'dropMenu();' >Menu</label></td>
	</tr>
</table>
	<table id = 'profileMenu' style = 'color:white;margin:0px auto;margin-top:10px;display:none;z-index:2;
	position:absolute;background-color:black;margin-left:30px;'>
	<tr>
		<td><label onclick = 'screenChange(3);'>My Profile</label></td>
	</tr>
	<tr>
		<td><label onclick = 'screenChange(4);'>My Posts</label></td>
	</tr>
	<tr>
		<td><label onclick = 'screenChange(5);'>My Replies</label></td>
	</tr>
	<tr>
		<td><label onclick = 'screenChange(6);'>Friend Posts</label></td>
	</tr>
	<tr>
		<td><label onclick = 'screenChange(7);'>Friend Replies</label></td>
	</tr>
	</table>
</div>
</div>
<div id = "myProfile">
<div style = "width:100%">
<br/>
<div style = "float:left;width:40%;">
<img src = "<?php echo $profile->getProfileImage($_SESSION['user_ID']);?>" class = "image" height = "100px" width = "100px"/>
</div>
<div style = "float:right;width:60%;">
<form method = "post" action = "m_MyProfile.php" enctype = "multipart/form-data">
<br />
<table>
	<tr>
		<td>Change Image:</td>
	</tr>
	<tr>
		<td><input type = "file" name = "upload" id = "upload" value = "browse"></td>
	</tr>
	<tr>
		<td><input type = "submit" name = "submit" value = "Upload"></td>
	</tr>
</table>
</form>
</div>
</div>
<div style = "width:100%">
<form method = "post" action = "m_MyProfile.php">
<table style = "padding-left:10px;padding-top:20px;float:left;">
	<tr></br>
		<td>Display Name: </td>
	</tr>
	<tr>
		<td><input class = 'inputs' type = "text" name = "dispName" value = "<?php echo $profile->displayName; ?>"/></td>
	</tr>
	<tr>
		<td>State: </td>
	</tr>
	<tr>
		<td><input class = 'inputs' type = "text" name = "state" value = "<?php echo $profile->state; ?>"/></td>
	</tr>
	<tr>
		<td>Age: </td>
	</tr>
	<tr>
		<td><input class = 'inputs' type = "text" name = "bDate" value = "<?php echo $profile->bDate; ?>"/></td>
	</tr>
	<tr>
		<td>Comment: </td>
	</tr>
	<tr>
		<td><textarea cols = "40" rows = "10" name = "uComm"><?php echo $profile->userComment; ?></textarea>
		</td>
	</tr>
	<tr>
		<td><input style = "float:right;" class = "button" type = "submit" value = "Update"/></td>
	</tr>
	</table>
</div>
</div>

<div id = "following" style = "width:100%;display:none;">
<table style = 'height:40px;width:100%;background-image:url("titleBacks.png");'>
	<tr><td align = 'center'>Following</td></tr>
</table>
<?php $friends->getYourFollowingMobile($_SESSION['user_ID']);?>
</div>

<div id = "followers" style = "width:100%;display:none;">
<table style = 'height:40px;width:100%;background-image:url("titleBacks.png");'>
	<tr><td align = 'center'>Followers</td></tr>
</table>
<?php $friends->getFollowersMobile($_SESSION['user_ID']);?>
</div>

<div id = "myPosts" style = "width:100%;display:none;">
<table style = 'height:40px;width:100%;background-image:url("titleBacks.png");'>
	<tr><td align = 'center'>My Posts</td></tr>
</table>
<?php echo $post->getAllPostsByUserMobile($_SESSION['user_ID']);?>
</div>

<div id = "myReplies" style = "width:100%;display:none;">
<table style = 'height:40px;width:100%;background-image:url("titleBacks.png");'>
	<tr><td align = 'center'>My Replies</td></tr>
</table>
<?php echo $reply->getMyRepliesMobile($_SESSION['user_ID']);?>
</div>

<div id = "friendsPosts" style = "width:100%;display:none;">
<table style = 'height:40px;width:100%;background-image:url("titleBacks.png");'>
	<tr><td align = 'center'>Friends Posts</td></tr>
</table>
<?php echo $post->getFriendsPostMobile($_SESSION['user_ID']);?>
</div>

<div id = "friendsReplies" style = "width:100%;display:none;">
<table style = 'height:40px;width:100%;background-image:url("titleBacks.png");'>
	<tr><td align = 'center'>Friends Replies</td></tr>
</table>
<?php echo $reply->getFriendsRepliesMobile($_SESSION['user_ID']);?>
</div>

</body>
</html>