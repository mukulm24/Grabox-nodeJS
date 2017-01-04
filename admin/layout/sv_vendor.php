<?php
	include("connection.php");

	if(isset($_POST['save'])){

		if($_POST['id']){

			$vendorName=$_POST['vendorName'];

			if(empty($vendorName)){

				header("location:add_vendor.php?error=Please fill all required fields.");
				exit;
			}

			$update ="update vendor set vendorName='".$vendorName."' where id='".$_POST['id']."'";

			mysql_query($update);

			header("location:add_vendor.php?success=Record updated successfully.");

		}
		else
		{

			$vendorName=$_POST['vendorName'];

			if(empty($vendorName)){

				header("location:add_vendor.php?error=Please fill all required fields.");
				exit;
			}
			 $sql="insert into vendor(vendorName,createdby,createddate) 
					values('".$vendorName."','','')";

			mysql_query($sql);

			header("location:add_vendor.php?success=Record inserted successfully.");

		}


		
	}else if($_GET['delete']){

		if($_GET['id']){

			$delete = "delete from vendor where id='".$_GET['id']."'";
			mysql_query($delete);

			header("location:add_vendor.php?success=Record deleted successfully.");
		}else{
			header("location:add_vendor.php?error=Invalid vendor.");
		}


	}

?>

	
