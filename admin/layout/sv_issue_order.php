<?php
	include("connection.php");
	include("functions.php");



	if(isset($_POST['save'])){

		//print_r($_POST);exit;

		$clientId=$_POST['clientId'];
		$issueDate=$_POST['issueDate'];

		$branchId=$_POST['branchId'];

		if(empty($clientId) || empty($issueDate) || empty($branchId)){

			header("location:add_issue_order.php?error=Please fill all required fields.");
			exit;
		}

		$issueDateArr = explode('/', $issueDate);

		$yy = $issueDateArr[2];
		$dd = $issueDateArr[1];
		$mm = $issueDateArr[0];

		$issueDateVl = $yy.'-'.$mm.'-'.$dd;

		$sqlissueOrder ="select  issueOrder from issue_order order by id desc";
        $resultissueOrder =mysql_query($sqlissueOrder);

        $rowissueOrder = mysql_fetch_array($resultissueOrder);

        $lastIssueOrder = $rowissueOrder['issueOrder'];

        $issueOrder='100000';

        if($lastIssueOrder){

        	$issueOrder=$lastIssueOrder+1;
        }

		$clientName = getClientName($clientId);

		$clientNameArr = explode(' ', $clientName);
		$clientNameVl = $clientNameArr[0];

		$sql="insert into issue_order(issueOrder,clientId,branchId,issueDate,createdby,createddate) 
					values('".$issueOrder."','".$clientId."','".$branchId."','".$issueDateVl."','','')";
		mysql_query($sql);


		for ($i=0;$i<count($_POST['itemId']);$i++) {

			//echo $_POST['itemId'][$i].'-'.$_POST['quantity'][$i];exit;;

			if($_POST['quantity'][$i]>0){

				 $sqlDetails="insert into issue_order_details(issueOrder,itemId,quantity,issueDate) 
					values('".$issueOrder."','".$_POST['itemId'][$i]."','".$_POST['quantity'][$i]."','".$issueDateVl."')";

			mysql_query($sqlDetails);

			$quantityupdate ="update item set stock=stock-'".$_POST['quantity'][$i]."' where id='".$_POST['itemId'][$i]."'";

				mysql_query($quantityupdate);

			}

			
		}



			  

	header("location:add_issue_order.php?success=Record inserted successfully.&issueOrder=".$issueOrder);

		
	}
	else if($_GET['delete']){

		if($_GET['id']){

			$sqlItemStock ="select * from issue_order_details where id='".$_GET['id']."'";

			$resultItemStock = mysql_query($sqlItemStock);
			$rowItemStock = mysql_fetch_array($resultItemStock);

			$delete = "delete from issue_order_details where id='".$_GET['id']."'";
			mysql_query($delete);
                    
			$quantityupdate ="update item set stock=stock+'".$rowItemStock['quantity']."'
			  where id='".$rowItemStock['itemId']."'";

			mysql_query($quantityupdate);

			header("location:add_issue_order.php?success=Record deleted successfully.&issueOrder=".$_GET['issueOrder']);
		}else{
			header("location:add_stock.php?error=Issue id not found.&issueOrder=".$_GET['issueOrder']);

		}                              

	}

?>

	
