<?php
	include("connection.php");

	if(isset($_POST['save'])){

		if($_POST['id']){

			$clientName=$_POST['clientName'];

			if(empty($clientName)){

				header("location:add_client.php?error=Please fill all required fields.");
				exit;
			}

			$update ="update client set clientName='".$clientName."' where id='".$_POST['id']."'";

			mysql_query($update);

			header("location:add_client.php?success=Record updated successfully.");

		}
		else
		{
			$clientName=$_POST['clientName'];

			if(empty($clientName)){

				header("location:add_client.php?error=Please fill all required fields.");
				exit;
			}
			 $sql="insert into client(clientName,createdby,createddate) 
					values('".$clientName."','','')";

			mysql_query($sql);

			header("location:add_client.php?success=Record inserted successfully.");

		}


		
	}else if($_GET['delete']){

		if($_GET['id']){

			$delete = "delete from client where id='".$_GET['id']."'";
			mysql_query($delete);

			header("location:add_client.php?success=Record deleted successfully.");
		}else{
			header("location:add_client.php?error=Invalid id.");
		}


	}

?>

	
