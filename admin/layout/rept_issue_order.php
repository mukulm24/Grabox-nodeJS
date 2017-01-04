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
        Datewise Issue Order Report
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Datewise Issue Order Report</li>
      </ol>
    </section>

    <?php

    $sqlVendors="select i.issueOrder,i.branchId from issue_order i 
                            inner join issue_order_details d on i.issueOrder = d.issueOrder 
                     group by i.issueOrder order by i.id desc";

    $resultVendors =mysql_query($sqlVendors);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
       
        <form name="myform" id="myform" method="get" action="" class="form-horizontal">

          <!--row start-->
        <div class="row">

          <div class="form-group">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Vendor</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
               <select name="issueOrder" id="issueOrder" class="form-control select2itemId" style="width: 100%;">
                  <option value="">Select</option>
                  <?php 
                                   
                    while ($rowVendors=mysql_fetch_array($resultVendors)) {
                        $searchName = $rowVendors['issueOrder'].'-'.getBranchName($rowVendors['branchId']);

                        echo '<option value='.$rowVendors['id'].'>'.$searchName.'</option>';                    
                            
                    }

                  ?>
                  <!--<option selected="selected">Alabama</option>
                  <option>Alaska</option>-->
               </select>
            </div>
         
            
          </div>


        </div>

        <!--row close-->

        <div class="row">

            <div class="form-group">
              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">From Date :</label>
              </div>

              <div class="col-xs-12 col-sm-3 col-md-3">

                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="fromDate" id="fromDate" class="form-control pull-right">
                  <!-- /.input group -->
                </div>
              </div>

              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">To Date :</label>
              </div>

              <div class="col-xs-12 col-sm-3 col-md-3">

                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="toDate" id="toDate" class="form-control pull-right">
                  <!-- /.input group -->
                </div>
              </div>

            </div>
          </div>

          <div class="row">

            <div class="form-group">

              <div class="col-xs-12 col-sm-5 col-md-5">
                
              </div>

              <div class="col-xs-12 col-sm-2 col-md-2 text-center">
                <button type="button" name="get" id="get" class="btn btn-block btn-primary btn-sm" onclick="getData();">Get Data</button>
              </div>
              
            </div>
          </div>

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
    $("#issueOrder").select2();
  });

   //Date picker
    $('#fromDate').datepicker({
      autoclose: true
    });
    $('#toDate').datepicker({
      autoclose: true
    });

  function getData(){
    if (document.getElementById('fromDate').value=="")
        {
          swal("Please select from date.");
          return false;     
        }
        if (document.getElementById('toDate').value=="")
        {
          swal("Please select to date.");
          return false;     
        }

    var issueOrder=$("#issueOrder").val();
    myform.setAttribute("target", "_blank");

      document.getElementById("myform").action='report_issue_order.php?issueOrder='+issueOrder;
      document.forms['myform'].submit();

  }

  </script>
