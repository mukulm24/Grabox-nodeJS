<?php
	include("connection.php");
	include("functions.php");

	if(isset($_POST['save'])){

		//print_r($_POST);exit;

		$issueOrder=$_POST['issueOrder'];
		$issueReturnDate=$_POST['issueReturnDate'];

		if(empty($issueOrder) || empty($issueReturnDate)){

			header("location:return_issue_order.php?error=Please fill all required fields.");
			exit;
		}

		$issueDateArr = explode('/', $issueReturnDate);

		$yy = $issueDateArr[2];
		$dd = $issueDateArr[1];
		$mm = $issueDateArr[0];

		$issueReturnDate = $yy.'-'.$mm.'-'.$dd;

		$sqlissueOrder ="select issueOrder from issue_order 
						where issueOrder='".$issueOrder."'";
        $resultissueOrder =mysql_query($sqlissueOrder);

        $rowissueOrder = mysql_fetch_array($resultissueOrder);

        $IssueOrder = $rowissueOrder['issueOrder'];

       	if($IssueOrder){

       	$sqlcheckReturn ="select issueOrder from return_issue_order 
						where issueOrder='".$issueOrder."'";
        $resultcheckReturn =mysql_query($sqlcheckReturn);

        $rowcheckReturn = mysql_fetch_array($resultcheckReturn);

        $chkIssueOrder = $rowcheckReturn['issueOrder'];

        if($chkIssueOrder){

        }else{
        	$sql="insert into return_issue_order(issueOrder,issueReturnDate,createdby,createddate) 
					values('".$issueOrder."','".$issueReturnDate."','','')";
		mysql_query($sql);

        }	

       		for ($i=0;$i<count($_POST['itemId']);$i++) {

			//echo $_POST['itemId'][$i].'-'.$_POST['quantity'][$i];exit;;

			if($_POST['ret_quantity'][$i]>0){

				 $sqlDetails="insert into return_issue_order_details(issueOrder,itemId,quantity,issueReturnDate) 
					values('".$issueOrder."','".$_POST['itemId'][$i]."','".$_POST['ret_quantity'][$i]."','".$issueReturnDate."')";

				mysql_query($sqlDetails);

				//update return quantity

				$retQuantityupdate ="update issue_order_details set returnQuantity=returnQuantity+'".$_POST['ret_quantity'][$i]."' 
					where issueOrder='".$issueOrder."' and itemId='".$_POST['itemId'][$i]."'";

				mysql_query($retQuantityupdate);

				//Item stock update

				$quantityupdate ="update item set stock=stock+'".$_POST['ret_quantity'][$i]."' 
								where id='".$_POST['itemId'][$i]."'";

				mysql_query($quantityupdate);

				}
			
			}
			header("location:return_issue_order.php?success=Record inserted successfully.&issueOrder=".$issueOrder);

       	}else{
       		header("location:return_issue_order.php?error=Issue Order not found.&issueOrder=".$issueOrder);

       	}

		

	
	
	}
	

?>

	
