<?php
	include("connection.php");



	if(isset($_POST['save'])){

		$vendorId=$_POST['vendorId'];
		$stockDate=$_POST['stockDate'];

		if(empty($vendorId) || empty($stockDate)){

			header("location:add_stock.php?error=Please fill all required fields.");
			exit;
		}

		$stockDateArr = explode('/', $stockDate);

		$yy = $stockDateArr[2];
		$mm = $stockDateArr[0];
		$dd = $stockDateArr[1];

		$stockDateVl = $yy.'-'.$mm.'-'.$dd;

		//echo $stockDateVl;exit;


		for ($i=0;$i<count($_POST['itemId']);$i++) {
			echo $_POST['itemId'][$i].'-'.$_POST['quantity'][$i];

			$sql="insert into item_stock(vendorId,itemId,quantity,stockDate,createdby,createddate) 
					values('".$vendorId."','".$_POST['itemId'][$i]."','".$_POST['quantity'][$i]."','".$stockDateVl."','','')";

			mysql_query($sql);

		$quantityupdate ="update item set stock=stock+'".$_POST['quantity'][$i]."' where id='".$_POST['itemId'][$i]."'";

			mysql_query($quantityupdate);
		}

	header("location:add_stock.php?success=Record inserted successfully.");

		
	}
	else if($_GET['delete']){

		if($_GET['id']){

			$sqlItemStock ="select * from item_stock where id='".$_GET['id']."'";

			$resultItemStock = mysql_query($sqlItemStock);
			$rowItemStock = mysql_fetch_array($resultItemStock);

			$delete = "delete from item_stock where id='".$_GET['id']."'";
			mysql_query($delete);
                    
			$quantityupdate ="update item set stock=stock-'".$rowItemStock['quantity']."'
			  where id='".$rowItemStock['itemId']."'";

			mysql_query($quantityupdate);

			header("location:add_stock.php?success=Record deleted successfully.");
		}else{
			header("location:add_stock.php?error=Stock id not found.");

		}                              

	}

?>

	
