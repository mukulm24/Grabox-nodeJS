<?php

include("connection.php");

if(isset($_GET['excel']))
{
    if(!empty($_GET['itemId'])){
         $sql="select itemName,description,stock from item 
        where id='".$_GET['itemId']."'";
    }
    else{
         $sql="select itemName,description,stock from item";
    }
   // echo $_GET['itemId'];exit;
    $date=date("d/m/Y");
    $name='Item_stock_'.$date; //to rename the file

    header('Content-Disposition: attachment; filename='.$name.'.xls'); 
    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
    $msg="";
    $var="";
    //write your query   


    $res = mysql_query($sql);
    $numcolumn = mysql_num_fields($res); //will fetch number of field in table
    $msg="<table border='1'><tr><td>Sr No.</td><td>Item Name</td><td>Description</td><td>Stock</td>";

    /*
    for ( $i = 0; $i < $numcolumn; $i++ ) {
        $msg.="<td>";
        $msg.= mysql_field_name($res, $i);;  //will store column name of the table to msg variable
        $msg.="</td>";

    }
    */
   
    $msg.="</tr>";
    $i=0;
    $count=1; //used to print sl.no
    while($row=mysql_fetch_array($res))  //fetch all the row as array
    {

        $msg.="<tr><td>".$count."</td>";
        for($i=0;$i< $numcolumn;$i++)
        {
            $var=$row[$i]; //will store all the values of row 
            $msg.="<td>".$var."</td>";
        }
        $count=$count+1;
        $msg.="</tr>";
    }

    $msg.="</table>";
    echo $msg;  //will print the content in the exel page
}

?>