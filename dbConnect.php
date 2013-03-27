<?php
class dbConnect{
	var $userName = "WomansBF";
	var $password = "Prnikko1!";
	var $host = "WomansBF.db.10682298.hostedresource.com";
	
	function connect(){
		$conn = mysql_connect($this->host, $this->userName, $this->password);
		
		if(!$conn){
			die("Could not connect to db:". mysql_error());
		}
		mysql_select_db("WomansBF", $conn);
	}
}
?>