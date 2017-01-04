<?php include("connection.php");?>
<!-- Site wrapper -->

<?php
  if(isset($_POST['submit'])){

    if($_POST['password']=='patil123#'){



      $getItem="truncate table item";
      $resultgetItem = mysql_query($getItem);

      $getClient="truncate table client";
      mysql_query($getClient);

      $getBranch="truncate table branch";
      mysql_query($getBranch);


/*
      $getItem="update item set stock=0";
      $resultgetItem = mysql_query($getItem);
*/
      $getStock="truncate table item_stock";
      mysql_query($getStock);

      $getIssue="truncate table issue_order";
      mysql_query($getIssue);

      $getIssueDet="truncate table issue_order_details";
      mysql_query($getIssueDet);

      $getRetIssue="truncate table return_issue_order";
      mysql_query($getRetIssue);

      $getRetIssueDet="truncate table return_issue_order_details";
      mysql_query($getRetIssueDet);

      
      header("location:flush.php?message=success.");
    }else{
      header("location:flush.php?message=failed.");
    }

  }
?>

<form name="myForm" id="myForm" action="" method="post">
<input type="password" name="password" id="password"> 
<input type="submit" name="submit" id="submit" value="Submit">
</form>