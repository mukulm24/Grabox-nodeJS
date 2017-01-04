<?php
	include("connection.php");

	//echo "sdfdf";
	if(isset($_GET['itemName'])){

		$itemName =$_GET['itemName'];

		$sqlVendor="select itemName from item where itemName='".strtoupper($itemName)."' ";

		$resultVendors = mysql_query($sqlVendor);
		$rowVendor=mysql_fetch_array($resultVendors);

		echo $rowVendor['itemName'];
	 }
	 else if(isset($_GET['clientName'])){

		$clientName =$_GET['clientName'];

		$sqlVendor="select clientName from client where clientName='".$clientName."' ";

		$resultVendors = mysql_query($sqlVendor);
		$rowVendor=mysql_fetch_array($resultVendors);

		echo $rowVendor['clientName'];


	 }
	 else if(isset($_GET['vendorName'])){

		$vendorName =$_GET['vendorName'];

		$sqlVendor="select vendorName from vendor where vendorName='".$vendorName."' ";

		$resultVendors = mysql_query($sqlVendor);
		$rowVendor=mysql_fetch_array($resultVendors);

		echo $rowVendor['vendorName'];

	 }
	 else if(isset($_GET['branchName'])){

		$branchName =$_GET['branchName'];
		$clientId =$_GET['clientId'];

		$sqlVendor="select branchName from branch 
			where branchName='".$branchName."' and clientId='".$clientId."' ";

		$resultVendors = mysql_query($sqlVendor);
		$rowVendor=mysql_fetch_array($resultVendors);

		echo $rowVendor['branchName'];

	 }

	 
?>