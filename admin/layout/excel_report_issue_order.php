<?php

//include("connection.php");
include("functions.php");

if(isset($_GET['excel']))
{
  $fromDate = getDateYYMMDD($_GET['fromDate']);
  $toDate = getDateYYMMDD($_GET['toDate']);

    if(!empty($_GET['issueOrder'])){
        $sqlVendor="select d.id, i.issueOrder,i.clientId,i.branchId,i.issueDate,
                      d.itemId,d.quantity,d.returnQuantity from issue_order i 
                      inner join issue_order_details d on i.issueOrder=d.issueOrder 
                      where i.issueOrder='".$_GET['issueOrder']."' and 
                      (i.issueDate between '".$fromDate."' and '".$toDate."') 
                      order by i.issueDate desc";

    }
    else{
        $sqlVendor="select d.id, i.issueOrder,i.clientId,i.branchId,i.issueDate,
                      d.itemId,d.quantity,d.returnQuantity from issue_order i 
                      inner join issue_order_details d on i.issueOrder=d.issueOrder 
                      where  
                      (i.issueDate between '".$fromDate."' and '".$toDate."') 
                      order by i.issueDate,i.issueOrder desc";
    }
   // echo $_GET['itemId'];exit;
    $date=date("d/m/Y");
    //$name='issue_order_'.$date; //to rename the file
    $name='Issue_order_From_'.$fromDate.'_To_'.$toDate; //to rename the file

    header('Content-Disposition: attachment; filename='.$name.'.xls'); 
    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
    $msg="";
    $var="";
    //write your query   

    $res = mysql_query($sqlVendor);
    $numcolumn = mysql_num_fields($res); //will fetch number of field in table
    $msg="<table border='1'><tr><td>Sr No.</td><td>Date</td><td>Issue Order</td><td>Client Name</td><td>Branch</td><td>Item</td><td>Issue Quantity</td><td>Return Quanity</td><td>Total Issue</td></tr>";
    $i=0;
    $count=1; //used to print sl.no
    while($row=mysql_fetch_array($res))  //fetch all the row as array
    {
    	$totalUssueQuantity = $row['quantity']-$row['returnQuantity'];
         $msg.="<tr><td>".$count."</td>
                <td class='text-center'>".getDateDDMMYY($row['issueDate'])."</td>
                      <td>".$row['issueOrder']."</td>
                      <td>".getClientName($row['clientId'])."</td>
                      <td>".getBranchName($row['branchId'])."</td>  
                      <td>".getItemName($row['itemId'])."</td>                                  
                      <td class='text-center'>".$row['quantity']."</td>
                      <td class='text-center'>".$row['returnQuantity']."</td> 
                      <td class='text-center'>".$totalUssueQuantity."</td>
                     </tr>";
        
        $count=$count+1;
        //$msg.="</tr>";
    }

    $msg.="</table>";
    echo $msg;  //will print the content in the exel page
}

?>