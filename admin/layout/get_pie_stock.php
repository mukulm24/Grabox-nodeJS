<?php 
  include("connection.php");
  include("functions.php");
 // Start pie chart code

    $sqlStock="select sum(quantity) qty,vendorId from item_stock group by vendorId desc";

    $resultStocks = mysql_query($sqlStock);

    $pieArr=[];
    $i=0;

    $colorArr=['#f56954','#00a65a','#f39c12','#00c0ef','#3c8dbc','#d2d6de'];
    while ($rowStocks=mysql_fetch_array($resultStocks)) {

      $pieArr['value']=$rowStocks['qty'];
      $pieArr['color']=$colorArr[$i];
      $pieArr['highlight']=$colorArr[$i];
      $pieArr['label']=getVendorName($rowStocks['vendorId']);

      $arr[]=$pieArr;
      $i++;

    }

    echo json_encode($arr);

    //echo json_decode($arr);

    
/*

 {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },

      */

 //

?>