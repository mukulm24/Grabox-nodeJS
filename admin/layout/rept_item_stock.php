<?php include("header.php");?>
<!-- Site wrapper -->
<div class="wrapper">

  <?php include("menu.php");?>

  <!-- =============================================== -->

 <?php include("left_sidebar.php");?>

  <!-- =============================================== -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Items Stock Report
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Items Stock Report</li>
      </ol>
    </section>

    <?php

    $sqlItems ="select * from item order by id desc";
    $resultItems =mysql_query($sqlItems);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
       
        <form name="myform" id="myform" method="get" action="" class="form-horizontal">

          <!--row start-->
        <div class="row">

          <div class="form-group">
            <div class="col-xs-12 col-sm-3 col-md-3">
              <label align="right" class="text-left">Item</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
               <select name="itemId" id="itemId" class="form-control select2itemId" style="width: 100%;">
                  <option value="">Select</option>
                  <?php 
                                   
                    while ($rowItems=mysql_fetch_array($resultItems)) {

                        echo '<option value='.$rowItems['id'].'>'.$rowItems['itemName'].'</option>';                    
                            
                    }

                  ?>
                  <!--<option selected="selected">Alabama</option>
                  <option>Alaska</option>-->
               </select>
            </div>
         
            <div class="col-xs-12 col-sm-2 col-md-2">
              <button type="button" name="get" id="get" class="btn btn-block btn-primary btn-sm" onclick="getData();">Get Data</button>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              
            </div>
          </div>


        </div>

        <!--row close-->

      </form>


      </div>

      <?php

      $sqlVendor="select * from vendor";

      $resultVendors = mysql_query($sqlVendor);

      ?>
      <!-- Default box -->
      <div class="box">
      
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("footer.php");?>

  <script>

   $(function () {
    //Initialize Select2 Elements
    $("#itemId").select2();
  });

  function getData(){

    //.php

    var itemId=$("#itemId").val();

    myform.setAttribute("target", "_blank");


      document.getElementById("myform").action='report_item_stock.php?itemId='+itemId;
      document.forms['myform'].submit();

  }

  

  </script>
