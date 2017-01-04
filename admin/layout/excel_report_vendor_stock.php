<?php

//include("connection.php");
include("functions.php");

if(isset($_GET['excel']))
{
  $fromDate = getDateYYMMDD($_GET['fromDate']);
  $toDate = getDateYYMMDD($_GET['toDate']);

    if(!empty($_GET['vendorId'])){
        $sqlVendor="select itemId,vendorId,quantity,stockDate from item_stock 
        where (stockDate between '".$fromDate."' and '".$toDate."') 
        and vendorId='".$_GET['vendorId']."' order by stockDate";

    }
    else{
        $sqlVendor="select itemId,vendorId,quantity,stockDate from item_stock 
        where (stockDate between '".$fromDate."' and '".$toDate."') 
        order by stockDate";
    }
   // echo $_GET['itemId'];exit;
    $date=date("d/m/Y");
    $name='Received_item_stock_From_'.$fromDate.'_To_'.$toDate; //to rename the file
    header('Content-Disposition: attachment; filename='.$name.'.xls'); 
    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
    $msg="";
    $var="";
    //write your query   

    $res = mysql_query($sqlVendor);
    $numcolumn = mysql_num_fields($res); //will fetch number of field in table
    $msg="<table border='1'><tr><td>Sr No.</td><td>Vendor Name</td><td>Date</td><td>Item Name</td><td>quantity</td>";
    $i=0;
    $count=1; //used to print sl.no
    while($row=mysql_fetch_array($res))  //fetch all the row as array
    {
         $msg.="<tr><td>".$count."</td>
                <td>".getVendorName($row['vendorId'])."</td>
                <td>".getDateDDMMYY($row['stockDate'])."</td>
                <td>".getItemName($row['itemId'])."</td>
                <td>".$row['quantity']."</td>  </tr>";
        
        $count=$count+1;
        //$msg.="</tr>";
    }

    $msg.="</table>";
    echo $msg;  //will print the content in the exel page
}

?>