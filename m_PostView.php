<?php
session_start();
include_once "retrieveClass.php";
include_once "postClass.php";
include_once "replyClass.php";

$retrieve = new Retrieve();
$retrieve->getUser($_SESSION['user_ID']);
$post = new Post();
$reply = new Reply();

$postID = $_GET['id'];
$user = $_SESSION['user_ID'];
$error = "";
$mobile = 'yes';

$retrieve->clearPostNotifier($_SESSION['user_ID'], $postID);

if(isset($_POST['reply'])){
	$reply->replyBack($_POST['postID'], $user, $_POST['reply'], $_POST['cat'], $_POST['anonymousReply'], $mobile);
}else{
	$error .= "Please insert a post.";
}

?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" 
"http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WomansBF (Post View)</title>
<meta http-equiv="content-type" content="application/xhtml+xml" />
<meta http-equiv="cache-control" content="max-age=300" />
<meta name="viewport" content="width=device-width;
 initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> 
<link rel="stylesheet" type="text/css" href="mobileStyle.css" />
<script type = "text/javascript">
function dropReply(){
	var replyDrop = document.getElementById("replyForm");

	if(replyDrop.style.display == "none"){
		replyDrop.style.display = "block";
	}else{
		replyDrop.style.display = "none";
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

</header>
<div id = "menu" style = "width:100%;background-color:black;height:50px;">
<div style = 'float:left;width:50%;background-color:black;'>
<table style = 'margin:0px auto;margin-top:10px;'>
	<tr>
		<td><a href = "m_home.php" style = 'margin:0px auto;color:white;'>Home</a></td>
	</tr>
</table>
</div>
<div style = 'float:right;width:50%;'>
<table style = 'margin:0px auto;margin-top:10px;'>
	<tr>
		<td><label style = 'margin:0px auto;color:white;' onclick = "dropReply();" >Reply</label></td>
	</tr>
</table>
</div>
</div>
<div id = "mobile_container">
<br />
<div id = "replyForm" style = "display:none;">
<form method = "post" action = "m_PostView.php">
<input type = "hidden" name = "cat" value = "<?php echo $post->getCatbyPost($postID);?>">
<input type = "hidden" name = "postID" value = "<?php echo $postID;?>">
	<table>
		<tr>
			<td>Subject: </td>
			<td><?php echo $post->getPostSubject($postID);?></td>
		</tr>
		<tr>
			<td>Anonymous:</td>
		</tr>
		<tr>
			<td><select name = 'anonymousReply'>
				<option value = 'Yes'>No</option>
				<option value = 'No'>Yes</option>
				</select></td>
		</tr>
	<table>
		<tr>
			<td>Reply: </td>
			<td></td>
		</tr>
		<tr>
			<td><textarea cols = '45' rows = '10' name = 'reply'></textarea></td>
		</tr>
		</table>
		<table>
		<tr>
			<td></td>
			<td><input style = 'float:right;' type = 'submit' value = 'Reply'/></td>
		</tr>
		<table>
	</table>
</form>
</div>
<?php $post->getPostByIDMobile($postID);?>
<?php $reply->getReplyByPostMobile($postID);?>
</div>
</body>
</html>