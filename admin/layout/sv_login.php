<?php
	include("connection.php");
	 session_start();

	if(isset($_POST['save'])){

		$userName=$_POST['userName'];
		$password=$_POST['password'];

		if(empty($userName) || empty($password)){

			header("location:index.php?error=Please fill all required fields.");
			exit;
		}

		$sqlUser ="select * from user 
				where userName='".$userName."'  
				and password='".$password."'";

			$resultUser = mysql_query($sqlUser);
			$rowUser = mysql_fetch_array($resultUser);

			if($rowUser['userName']){

				//echo $rowUser['userName'];exit;

				$_SESSION['userName']=$rowUser['userName'];

				header("location:chart.php?success=Successfully login.");
			exit;
			}
			else{
				header("location:index.php?error=Invalid user name and password.");
			}
	}