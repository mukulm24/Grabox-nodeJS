<?php
	include("connection.php");


	function getClientName($clientId){

	$sqlClient="select * from client where id='".$clientId."' ";

      $resultClients = mysql_query($sqlClient);
      $rowClient=mysql_fetch_array($resultClients);

      return $rowClient['clientName'];
	}

	function getItemName($itemId){

	$sqlItem="select * from item where id='".$itemId."' ";

      $resultItems = mysql_query($sqlItem);
      $rowItem=mysql_fetch_array($resultItems);

      return $rowItem['itemName'];
	}

	function getVendorName($vendorId){

	$sqlVendor="select * from vendor where id='".$vendorId."' ";

      $resultVendors = mysql_query($sqlVendor);
      $rowVendor=mysql_fetch_array($resultVendors);

      return $rowVendor['vendorName'];
	}

	function getBranchName($branchId){
	  $sqlVendor="select * from branch where id='".$branchId."' ";

	  $resultVendors = mysql_query($sqlVendor);
      $rowVendor=mysql_fetch_array($resultVendors);

      return $rowVendor['branchName'];

	}

	function getDateDDMMYY($date){

		$dateArr = explode('-', $date);

		$yy = $dateArr[0];
		$mm = $dateArr[1];
		$ddArr = $dateArr[2];
		$ddArrVl = explode(' ', $ddArr);
		$dd = $ddArrVl[0];
		
		return $dateVl = $dd.'-'.$mm.'-'.$yy;
	}

	function getDateYYMMDD($date){

		$dateArr = explode('/', $date);

		//print_r($dateArr);exit;

		$mm = $dateArr[0];
		$dd = $dateArr[1];
		$yy = $dateArr[2];
		//$ddArrVl = explode(' ', $ddArr);
		//$dd = $ddArrVl[0];
		
		return $dateVl = $yy.'-'.$mm.'-'.$dd;
	}

	
?>