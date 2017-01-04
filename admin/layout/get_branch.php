<?php
	include("connection.php");

	if(isset($_GET['clientId'])){

		  $sqlBranch ="select * from branch where clientId='".$_GET['clientId']."'";
	      $resultBranch =mysql_query($sqlBranch);
	      $branchOptions='';

	      $branchOptions= '<select name="branchId" id="branchId" class="form-control select2" style="width: 100%;">
	      					<option>Select</option>';

	      while ($rowBranch=mysql_fetch_array($resultBranch)) {

	          $branchOptions .= '<option value='.$rowBranch['id'].'>'.$rowBranch['branchName'].'</option>';                 
	              
	      }

	      $branchOptions .='</select>';

	      echo $branchOptions;
	}
	else if(isset($_GET['itemId'])){

		 $itemId =$_GET['itemId'];

		  $sqlVendor="select stock from item where id='".$itemId."' ";

	      $resultVendors = mysql_query($sqlVendor);
	      $rowVendor=mysql_fetch_array($resultVendors);

	      echo $rowVendor['stock'];
	 }
?>