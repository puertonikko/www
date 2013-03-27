<?php
include_once "loginVerification.php";
include_once "insertClass.php";

$loginError = "";
$error = "";

	if(isset($_POST['user']) || isset($_POST['pass'])){
		$userName = $_POST['user'];
		$pass = $_POST['pass'];
		
		if($userName == "" || $pass == ""){
			$loginError .= "Empty field during login";
		}else{
			$verify = new VerifyLogin();
	
			$result = $verify::verify($userName, $pass);
			if($result == 0){
				$loginError .= "Incorrect username and password combination";
			}else{
				session_start();
				$_SESSION['user'] = $userName;
				header("Location:m_home.php");
			}
		}
	}
	
	if(isset($_POST['fName']) || isset($_POST['lName']) || isset($_POST['email']) || isset($_POST['pass'])
	|| isset($_POST['verPass']) || isset($_POST['displayName'])){
	
		$fName = $_POST['fName'];
		$lName = $_POST['lName'];
		$email = $_POST['email'];
		$password = $_POST['pass'];
		$verPass = $_POST['verPass'];
		$displayName = $_POST['displayName'];
		
		if($fName == ""){
				$error .= "The First Name field is empty <br />";
			}
		if($lName == ""){
				$error .= "The Last Name field is empty <br />";
			}
		if($email == ""){
				$error .= "The Email field is empty <br />";
			}
		if($displayName == ""){
				$error .= "The Display Name field is empty <br />";
			}
		if($pass == ""){
				$error .= "The Password field is empty <br />";
			}
		if($password != $verPass){
			$error .= "The password combination does not match!";
		}
		if($error == ""){
			$insert = new Insert();
			$mobile = 'yes'; 
			$insert::insertUser($fName, $lName, $email, $password, $displayName, $mobile);
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
function dropReg(num){
var aboutSite = document.getElementById('aboutSite');
var login = document.getElementById('login');
var register = document.getElementById('register');

if(num == 1){
	login.style.display = "none";
	aboutSite.style.display = "none";
	register.style.display = "block";
}
if(num == 2){
	login.style.display = "block";
	aboutSite.style.display = "block";
	register.style.display = "none";
}
}	
</script>
</head>
<body>
<header style = "height:80px;width:100%;background-image:url('mobileImages/headerBackMobile.png');">

</header>
<div id = "mobile_container">
<br />
	<div id = 'login' class = 'forms'>
	<form method = "POST" action = "m_index.php">
	<table style = "margin:0px auto;padding-top:20px;margin-top:20px;">
		<tr>
			<td>Email: </td>
			<td><input class = 'inputs' type = "text" name = "user"/></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input class = 'inputs' type = "password" name = "pass"/></td>
		</tr>
		<tr>
			<td><input class = 'button' type = "button" value = "Register" onclick = "dropReg(1);"/></td>
			<td align = "right"><input class = 'button' type = "submit" value = "Sign In"/></td>
		</tr>
	</table>
	<?php echo $loginError; ?>
	</form>
	</div>
	<div id = "aboutSite">
	<img src = 'aboutSite.png' style = "width:100%;">	
	</div>
	<div id = 'register' class = 'forms' style = 'display:none;'>
	<form method = "POST" action = "m_index.php">
	<table style = 'margin:0px auto;'>
		<tr>
			<td>First Name: </td>
			<td><input class = 'inputs' type = "text" name = "fName"/></td>
		</tr>
		<tr>
			<td>Last Name: </td>
			<td><input class = 'inputs' type = "text" name = "lName"/></td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><input class = 'inputs' type = "email" name = "email"/></td>
		</tr>
		<tr>
			<td>Display Name: </td>
			<td><input class = 'inputs' type = "text" name = "displayName"/></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input class = 'inputs' type = "password" name = "pass"/></td>
		</tr>
		<tr>
			<td>Verify Password: </td>
			<td><input class = 'inputs' type = "password" name = "verPass"/></td>
		</tr>
		<tr>
			<td><input class = 'button' type = "button" value = "Back" onclick = 'dropReg(2);'/></td>
			<td align = "right"><input class = 'button' type = "submit" value = "Register"/></td>
		</tr>
	</table>
	<?php echo $error; ?>
	</form>
	</div>
</div>
</body>
</html>