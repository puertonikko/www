<?php
include_once "dbConnect.php";
include_once "getProfile.php";

$connect = new dbConnect();
$connect->connect();

class Search{

var $keyword;
	
	function sendKeyword($keyword){
		$this->keyword = $keyword;
	}
	function getResults(){
		$sql = mysql_query("SELECT p.displayName, p.userID FROM user u INNER JOIN profile p ON p.userID = u.user_ID WHERE email = '$this->keyword'");
		
		$profile = new Profile();
		
		while($rows = mysql_fetch_array($sql)){
			echo "<div id = 'friendList'><table style = 'float:left;height:60px;width:50%;'>
		<tr><td>
			<img src = '".$profile->getProfileImage($rows['userID'])."' class = 'image' height = '50px' width = '50px'/>
		</td>
		<td>
			<a class = 'displayLink' style = 'padding-left:40px;'
			href = 'Profile.php?pID=".$rows['userID']."'>".$rows['displayName']."</a>
		</td>
		</tr>
		</table>
		<table style = 'float:right;height:60px;width:50%;'>
			<tr>
				<td align = 'right'><a href = 'unfollowSubmit.php?pID=".$rows['userID']."'><input class = 'button' type = 'Submit' value = 'Unfollow'></a></td>
			</tr>
		</table></div>";
		}
	}
}
?>