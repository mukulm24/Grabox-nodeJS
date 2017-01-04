<?php
	include("connection.php");

	if(isset($_POST['save'])){

		if($_POST['id']){

			$branchName=$_POST['branchName'];
			$clientId=$_POST['clientId'];

			if(empty($branchName) || empty($clientId)){

				header("location:add_branch.php?error=Please fill all required fields.");
				exit;
			}

			$update ="update branch set branchName='".$branchName."',clientId='".$clientId."' where id='".$_POST['id']."'";

			mysql_query($update);

			header("location:add_branch.php?success=Record updated successfully.");

		}
		else
		{
			$branchName=$_POST['branchName'];
			$clientId=$_POST['clientId'];

			if(empty($branchName) || empty($clientId)){

				header("location:add_branch.php?error=Please fill all required fields.");
				exit;
			}
			  $sql="insert into branch(clientId,branchName,createdby,createddate) 
					values('".$clientId."','".$branchName."','','')";

			mysql_query($sql);

			header("location:add_branch.php?success=Record inserted successfully.");

		}


		
	}else if($_GET['delete']){

		if($_GET['id']){

			$delete = "delete from branch where id='".$_GET['id']."'";
			mysql_query($delete);

			header("location:add_branch.php?success=Record deleted successfully.");
		}else{
			header("location:add_branch.php?error=Invalid id.");
		}


	}

?>

	
