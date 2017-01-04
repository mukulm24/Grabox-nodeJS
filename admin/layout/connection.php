<?php
	//session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = mysql_connect($servername, $username, $password);

	mysql_select_db("testerp",$conn);
?>