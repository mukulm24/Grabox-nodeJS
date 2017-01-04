<style>
.tdcellpadding{

  padding:10px;
}
</style>

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
        Issue Return
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Issue Return</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="callout callout-info">


        <?php
          $sqlIssueOptions1="select i.issueOrder,i.branchId from issue_order i 
                            inner join issue_order_details d on i.issueOrder = d.issueOrder 
                      group by i.issueOrder order by i.id desc";

          $resultIssueOptions1 =mysql_query($sqlIssueOptions1);

         ?>

        <form  method="get" action="" class="form-horizontal" id="searchForm" name="searchForm">
         <div class="row">

            <div class="form-group">
              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">Issue Order :</label>
              </div>

               <div class="col-xs-12 col-sm-3 col-md-3" id="">
                  <select name="issueOrder" id="issueOrder" class="form-control select2" style="width: 100%;" onchange="searchSubmit(this)">
                   <?php 
                    echo '<option>Select</option>';
                                     
                      while ($rowIssueOptions=mysql_fetch_array($resultIssueOptions1)) {

                        $searchName = $rowIssueOptions['issueOrder'].'-'.getBranchName($rowIssueOptions['branchId']);
                        if($rowIssueOptions['issueOrder']==$_GET['issueOrder']){
                            echo '<option selected="selected" value='.$rowIssueOptions['issueOrder'].'>'.$searchName.'</option>';                   

                        }else{
                          echo '<option value='.$rowIssueOptions['issueOrder'].'>'.$searchName.'</option>';                   

                        }
                      
                      }

                    ?>
                   
                  </select>
                  
              </div>

              <div class="col-xs-12 col-sm-2 col-md-2 text-center">
                <a href ="return_issue_order.php"><input type="button" name="cancel" id="cancel" class="btn btn-block btn-default btn-sm" value="Cancel"></a>
              </div>

            </div>
          </div>
        </form>

          <hr>


          <?php

          if(isset($_GET['issueOrder'])){


            $sqlIssueOrder="select i.issueOrder,i.branchId,i.clientId,i.issueDate from issue_order i 
                            where i.issueOrder='".$_GET['issueOrder']."' 
                      order by i.id desc";

            $resultIssueOption =mysql_query($sqlIssueOrder);
            $rowIssueOption = mysql_fetch_array($resultIssueOption);

            ?>

        <form  method="post" action="sv_return_issue_order.php" class="form-horizontal" id="form1" name="form11">
          <input type="hidden" id="issueOrder" name="issueOrder"  value="<?php echo $_GET['issueOrder']; ?>">
          <div class="row">

            <div class="form-group">
              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">Issue Date : </label>
              </div>

              <div class="col-xs-12 col-sm-3 col-md-3">

                <lable><?php echo getDateDDMMYY($rowIssueOption['issueDate']);?></lable>
              </div>

              <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Client Name :</label>
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3">

                <lable><?php echo getClientName($rowIssueOption['clientId']);?></lable>
              </div>


            </div>
          </div>      

        <!--row close-->

        <div class="row">

            <div class="form-group">
              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">Branch : </label>
              </div>

               <div class="col-xs-12 col-sm-3 col-md-3" >
                  <lable><?php echo getBranchName($rowIssueOption['branchId']);?></lable>
              </div>

              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">Return Date :</label>
              </div>

              <div class="col-xs-12 col-sm-3 col-md-3">

                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="issueReturnDate" class="form-control pull-right" id="issueReturnDate">
                  <!-- /.input group -->
                </div>
              </div>




            </div>
          </div>

        <div class="row">

          <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding:50px;">

                  <table border='1' width="90%" class="abctable" id="adddataTable">

                    <thead>
                      <tr style="background-color:#00c0ef">                                                
                        <th width="30%" class="tdcellpadding">Item Name</th>
                         <th class="tdcellpadding">Issued Quanity</th>
                         <th class="tdcellpadding">Returned Quanity</th>
                         <th width="25%"  class="tdcellpadding">Quanity</th>
                      </tr>
                  </thead>

                    <?php

                    $sqlIssueOptions="select i.issueOrder,i.branchId,d.itemId,d.quantity,d.returnQuantity 
                            from issue_order i 
                            inner join issue_order_details d on i.issueOrder = d.issueOrder 
                            where i.issueOrder='".$_GET['issueOrder']."' 
                      order by i.id desc";

                    $resultIssueOptions =mysql_query($sqlIssueOptions);

                    $p=0;

                    while($rowIssueOptions = mysql_fetch_array($resultIssueOptions)){

                      $issuedQuantity = $rowIssueOptions['quantity']-$rowIssueOptions['returnQuantity'];

                      ?>

                        <tr>

                            <td class="tdcellpadding" width="30%">
                            <div class="col-xs-12 col-sm-10 col-md-10">

                              <?php echo getItemName($rowIssueOptions['itemId']);?>

                              <input type="hidden" name="itemId[]" id="itemId-<?php echo $p;?>" value="<?php echo $rowIssueOptions['itemId']; ?>"> 
                               
                           </div>
                          </td>

                          <td class="tdcellpadding">
                            <div class="col-xs-12 col-sm-8 col-md-8">
                              <?php echo $rowIssueOptions['quantity'];?>
                            <input type="hidden" class="quantity form-control" id="quantity-<?php echo $p;?>" name="quantity[]"  value="<?php echo $issuedQuantity; ?>" placeholder="Quantity">
                          </div>
                          <td class="tdcellpadding">
                            <div class="col-xs-12 col-sm-8 col-md-8">
                              <?php echo $rowIssueOptions['returnQuantity'];?>
                          </div>
                        </td>

                        <td class="tdcellpadding">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                            <input type="number" class="form-control" id="ret_quantity-<?php echo $p;?>" name="ret_quantity[]" onBlur="checkItemStock(this,<?php echo $p;?>);" value="0" placeholder="Quantity">
                          </div>
                        </td>

                      </tr>


                      <?php
                      $p++;

                    }

                    ?>
                </table>

              <div class="row">

                <div class="form-group">
                </div>
              </div>
             

              <div class="row">

                <div class="form-group">
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <input type="hidden" name="save" id="save" value="1">
                  </div>
                    

                   <div class="col-xs-12 col-sm-2 col-md-2 text-center">
                      <input type="button" name="save" id="save" class="btn btn-block btn-primary btn-sm" value="Submit" onclick="savedata('adddataTable');">
                    </div>
                </div>
              </div>

            

              <!-- row close-->
            </div>
          </div>
        </div>

      </form>


            <?php
          }

          ?>

      </div>

      <?php

      if(isset($_GET['issueOrder'])){

        $sqlIssue="select d.id, i.issueOrder,d.issueReturnDate,
                      d.itemId,d.quantity from return_issue_order i 
                      inner join return_issue_order_details d on i.issueOrder=d.issueOrder 
                      where i.issueOrder='".$_GET['issueOrder']."' 
                      order by i.id desc";
      }
      else{
        $sqlIssue="select d.id, i.issueOrder,d.issueReturnDate,
                      d.itemId,d.quantity from return_issue_order i 
                      inner join return_issue_order_details d on i.issueOrder=d.issueOrder 
                      order by i.id desc";
      }

      $resultIssue = mysql_query($sqlIssue);

      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Issue Return List</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      

           <section class="content">
            <div class="row">
              <div class="col-xs-12">
                
                <!-- /.box -->

                <div class="box">
                  <!--
                  <div class="box-header">
                    <h3 class="box-title"></h3>
                  </div>
                -->
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr style="background-color:#00c0ef">
                        <th>Sr.No.</th> 
                        <th>Issue Order</th>                                               
                        <th>Date</th>
                        <th>Item</th>
                        <th>Quanity</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php
                        $i=1;
                    
                          while ($rowIssue=mysql_fetch_array($resultIssue)) {
                          echo "<tr>
                                  <td>".$i."</td>
                                  <td>".$rowIssue['issueOrder']."</td>
                                  <td>".getDateDDMMYY($rowIssue['issueReturnDate'])."</td> 
                                  <td>".getItemName($rowIssue['itemId'])."</td>                                  
                                  <td>".$rowIssue['quantity']."</td>
                                </tr>";

                          $i++;
                        }
                        
                       
                        ?>
                      
                      </tbody>
                     
                    </table>


                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
      <!-- /.row -->
    </section>
        </div>
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
    //$(".select2").select2();
    $("#select2itemId").select2();
    $("#issueOrder").select2();
  });

   //Date picker
    $('#issueReturnDate').datepicker({
      autoclose: true
    });
    
    

    function savedata(tableID){

      if (document.getElementById('issueReturnDate').value=="")
        {
          swal("Please select issue return date.");
          return false;     
        }


      dml=document.forms['form1'];

      len = dml.elements.length;

      //return 0;

      for( i=0 ; i<len ; i++)
       {              
      
          if (dml.elements[i].name=='ret_quantity[]')
          {                            
           
            if (dml.elements[i].value=="" || dml.elements[i].value=="0")
            {
                  
            }else{
               var chkEnterQuantity=true;

            }

            
          }
          
        }

        if(chkEnterQuantity){

          document.forms['form1'].submit();
         
        }else{

           //swal("Here's a message!", "It's pretty, isn't it?");
           swal("Please enter atleast one item return quantity.");
          return false; 
        }

        //document.getElementById("form1").submit();
        
    }


    function checkItemStock(retQuantity,j){

       var itemId = $("#itemId-"+j).val();
       var quantity = $("#quantity-"+j).val();
       var retQuantity = $("#ret_quantity-"+j).val();

       if(parseFloat(quantity)<parseFloat(retQuantity)){

         $("#ret_quantity-"+j).val('');
              swal("Return quantity is not greater than issued quantity..");

          return;
       }

    }

    function searchSubmit(issueOrder){

      var issueOrder=issueOrder.value;

      document.getElementById("searchForm").action='return_issue_order.php?issueOrder='+issueOrder;

      document.getElementById("searchForm").submit();
    }
   
    </script>
