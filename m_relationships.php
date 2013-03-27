<?php
session_start();
include_once "retrieveClass.php";
include_once "postClass.php";

$post = new Post();
$retrieve = new Retrieve();
$retrieve->getUser($_SESSION['user_ID']);
$error = "";
$date = date('mdy g:i:s A');

if(isset($_POST['subject']) && isset($_POST['anonymous']) && isset($_POST['post'])){
	
	$image = $_FILES['upload']['name'];
	
	$post->insertPost($_SESSION['user_ID'], "Relationships", $_POST['subject'], $_POST['post'], $date, $_POST['anonymous'], $image);
}else{
	$error.= "All fields must be completed before submission";
}
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" 
"http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WomansBF (Relationships)</title>
<meta http-equiv="content-type" content="application/xhtml+xml" />
<meta http-equiv="cache-control" content="max-age=300" />
<meta name="viewport" content="width=device-width;
 initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> 
<link rel="stylesheet" type="text/css" href="mobileStyle.css" />
<script type = "text/javascript">
function dropPost(){
	var postDrop = document.getElementById("PostForm");

	if(postDrop.style.display == "none"){
		postDrop.style.display = "block";
	}else{
		postDrop.style.display = "none";
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
		<td><label style = 'margin:0px auto;color:white;' onclick = "dropPost();" >Post</label></td>
	</tr>
</table>
</div>
</div>
<div id = "mobile_container">
<br />
<div id = "PostForm" style = 'display:none;'>
<form method = "post" action = "m_relationships.php" enctype = "multipart/form-data">
<table>
	<tr>
		<td>Subject: </td>
		<td><input class = 'inputs' type = "text" name = "subject"></td>
	</tr>
	<tr>
		<td>Image Post:</td>
		<td><input type = "file" name = "upload" id = "upload" Value = "Browse"></td>
	</tr>
	<tr>
		<td>Anonymous:</td>
		<td><select name = "anonymous">
			<option value = "Yes">Yes</option>
			<option value = "No">No</option>
		</select></td>
	</tr>
	<tr>
		<td>Tell It: </td>
	</tr>
	</table>
	<table>
	<tr>
		<td><textarea cols = "45" rows = "10" name = "post"></textarea></td>
	</tr>
	<tr>
		<td><input class = 'button' type = "submit" style = "float:right;" value = "Submit"></td>
	</tr>
</table>
<?php echo $error;?>
</form>
</div>
<?php $post->getPostByCatMobile('Relationships');?>
</div>
</body>
</html>