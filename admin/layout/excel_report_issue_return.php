<?php

//include("connection.php");
include("functions.php");

if(isset($_GET['excel']))
{
  $fromDate = getDateYYMMDD($_GET['fromDate']);
  $toDate = getDateYYMMDD($_GET['toDate']);

    if(!empty($_GET['issueOrder'])){
         $sqlVendor="select d.id, i.issueOrder,d.issueReturnDate,
                      d.itemId,d.quantity,issue.branchId,issue.clientId from return_issue_order i 
                      inner join return_issue_order_details d on i.issueOrder=d.issueOrder 
                      inner join issue_order issue on i.issueOrder=issue.issueOrder 
                       where i.issueOrder='".$_GET['issueOrder']."' and 
                      (d.issueReturnDate between '".$fromDate."' and '".$toDate."') 
                      group by i.issueOrder
                      order by i.id desc";

    }
    else{
          $sqlVendor="select d.id, i.issueOrder,d.issueReturnDate,
                      d.itemId,d.quantity,issue.branchId,issue.clientId from return_issue_order i 
                      inner join return_issue_order_details d on i.issueOrder=d.issueOrder 
                      inner join issue_order issue on i.issueOrder=issue.issueOrder 
                      where 
                      (d.issueReturnDate between '".$fromDate."' and '".$toDate."') 
                      group by i.issueOrder
                      order by i.id desc";
    }
   // echo $_GET['itemId'];exit;
    $date=date("d/m/Y");
    //$name='issue_return_'.$date; //to rename the file

    $name='Issue_return_From_'.$fromDate.'_To_'.$toDate; //to rename the file


    header('Content-Disposition: attachment; filename='.$name.'.xls'); 
    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
    $msg="";
    $var="";
    //write your query   

    $res = mysql_query($sqlVendor);
    $numcolumn = mysql_num_fields($res); //will fetch number of field in table
    $msg="<table border='1'><tr><td>Sr No.</td><td>Date</td><td>Issue Order</td><td>Client Name</td><td>Branch</td><td>Item</td><td>Return Quantity</td></tr>";
    $i=0;
    $count=1; //used to print sl.no
    while($row=mysql_fetch_array($res))  //fetch all the row as array
    {
         $msg.="<tr><td>".$count."</td>
                        
                        <td>".getDateDDMMYY($row['issueReturnDate'])."</td> 
                        <td>".$row['issueOrder']."</td>
                        <td>".getClientName($row['clientId'])."</td>
                        <td>".getBranchName($row['branchId'])."</td>
                        <td>".getItemName($row['itemId'])."</td>                                  
                        <td class='text-right'>".$row['quantity']."</td>
                     </tr>";
        
        $count=$count+1;
        //$msg.="</tr>";
    }

    $msg.="</table>";
    echo $msg;  //will print the content in the exel page
}

?>