<?php
	include("connection.php");

	if(isset($_POST['save'])){

			

		if($_POST['id']){

			$itemName=$_POST['itemName'];
			$description=$_POST['description'];

			if(empty($itemName) || empty($description)){

				header("location:add_item.php?error=Please fill all required fields.");
				exit;
			}

			$update ="update item set itemName='".strtoupper($itemName)."',description='".$description."' where id='".$_POST['id']."'";

			mysql_query($update);

			header("location:add_item.php?success=Record updated successfully.");

		}
		else
		{
			$itemName=$_POST['itemName'];
			$description=$_POST['description'];

			if(empty($itemName) || empty($description)){

				header("location:add_item.php?error=Please fill all required fields.");
				exit;
			}
			  $sql="insert into item(description,itemName,createdby,createddate) 
					values('".$description."','".strtoupper($itemName)."','','')";

			mysql_query($sql);

			header("location:add_item.php?success=Record inserted successfully.");

		}


		
	}else if($_GET['delete']){

		if($_GET['id']){

			$delete = "delete from item where id='".$_GET['id']."'";
			mysql_query($delete);

			header("location:add_item.php?success=Record deleted successfully.");
		}else{
			header("location:add_item.php?error=Something went wrong.");
		}


	}

?>

	
