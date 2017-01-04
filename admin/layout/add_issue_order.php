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
        Issue Order
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Issue Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="callout callout-info">


        <?php
          $sqlIssueOptions="select i.issueOrder,i.branchId from issue_order i 
                            inner join issue_order_details d on i.issueOrder = d.issueOrder 
                     group by i.issueOrder order by i.id desc";

          $resultIssueOptions =mysql_query($sqlIssueOptions);

         ?>

        <form  method="get" action="" class="form-horizontal" id="searchForm" name="searchForm">
         <div class="row">

            <div class="form-group">
              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">Issue Order : </label>
              </div>

               <div class="col-xs-12 col-sm-3 col-md-3" id="">
                  <select name="issueOrder" id="issueOrder" class="form-control select2" style="width: 100%;" onchange="searchSubmit(this)">
                   <?php 
                    echo '<option>Select</option>';
                                     
                      while ($rowIssueOptions=mysql_fetch_array($resultIssueOptions)) {

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
                <a href ="add_issue_order.php"><input type="button" name="cancel" id="cancel" class="btn btn-block btn-default btn-sm" value="Cancel"></a>
              </div>

            </div>
          </div>
        </form>

          <hr>

        
       
        <form  method="post" action="sv_issue_order.php" class="form-horizontal" id="form1" name="form11">

          <div class="row">

            <div class="form-group">
              <div class="col-xs-12 col-sm-2 col-md-2" >
                <label align="right" class="text-left">Date :</label>
              </div>

              <div class="col-xs-12 col-sm-3 col-md-3">

                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="issueDate" class="form-control pull-right" id="issueDate">
                  <!-- /.input group -->
                </div>
              </div>

              <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Client Name :</label>
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3">

                <?php 
                      $sqlClient ="select * from client order by id desc";
                      $resultClient =mysql_query($sqlClient);

                      //Item list

                      $sqlItems ="select * from item order by id desc";
                      $resultItems =mysql_query($sqlItems);
                ?>

                  <select name="clientId" id="clientId" class="form-control select2" style="width: 100%;" onchange="getbranch(this);">

                    <?php 
                    echo '<option>Select</option>';
                                     
                      while ($rowClient=mysql_fetch_array($resultClient)) {

                          echo '<option value='.$rowClient['id'].'>'.$rowClient['clientName'].'</option>';                 
                              
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
                <label align="right" class="text-left">Branch :</label>
              </div>

               <div class="col-xs-12 col-sm-3 col-md-3" id="getbranchId">
                  <select name="branchId" id="branchId" class="form-control select2" style="width: 100%;">
                    <option>select</option>
                  </select>
              </div>
            </div>
          </div>


    
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">

        <div class="row">

          <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding:50px;">

              <table border='0' width="70%" id="adddataTable12" cellpadding="100" cellspacing="100">
                <tr>
                  <thead>
                      <tr style="background-color:#00c0ef">
                        <th  style="padding: 1px;" width="6.2%">#</th>                                                
                        <th width="50%" class="tdcellpadding">Item Name</th>
                         <th class="tdcellpadding">Quanity</th>
                      </tr>
                  </thead>

                  <table border='1' width="70%" class="abctable" id="adddataTable">

                    <tr>

                      <td width="6.2%" style="padding: 10px;"><input type="checkbox" name="chk"/></td>
                        <td class="tdcellpadding" width="50%">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <select name="itemId[]" id="itemId-0" class="itemId form-control select2itemId" onchange="checkItemStock(this);" style="width: 100%;">

                              <?php 
                                               
                                while ($rowItems=mysql_fetch_array($resultItems)) {

                                    echo '<option value='.$rowItems['id'].'>'.$rowItems['itemName'].'</option>';                    
                                        
                                }

                              ?>
                           </select>
                       </div>
                      </td>

                      <td class="tdcellpadding">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <input type="number" class="quantity form-control" id="quantity-0" name="quantity[]" onBlur="checkItemStock(this);" value="" placeholder="Quantity">
                      </div>
                      </td>
                    </tr>

                </table>
              </tr>
               <tr><td colspan="2">&nbsp;</td>
                  </tr>
              <tr>
                <table border='0' width="70%" id="adddataTable111" cellpadding="10" cellspacing="10">
                 
                  <tr>
                    <td colspan="2">
                      <input type="button" value="Delete" class="btn btn-danger btn-xs" onClick="deleteRow('adddataTable');"style="float:right;" />
                      <input type="hidden" value="" id="rowCount" name="rowCount">
                      <input type="button" name="add" value="Add" id="add" class="btn btn-success btn-xs" onClick="addRow('adddataTable')" style="float:right;" >&nbsp;&nbsp;
                    </td>
                  </tr>
                </table>
              </tr>
            </table>

              <div class="row">

                <div class="form-group">
                  <div class="col-xs-12 col-sm-3 col-md-3 text-center">
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
      


      </div>

      <?php

      if(isset($_GET['issueOrder'])){

        $sqlIssue="select d.id, i.issueOrder,i.clientId,i.branchId,i.issueDate,
                      d.itemId,d.quantity from issue_order i 
                      inner join issue_order_details d on i.issueOrder=d.issueOrder 
                      where i.issueOrder='".$_GET['issueOrder']."' 
                      order by i.id desc";
      }
      else{
        $sqlIssue="select d.id, i.issueOrder,i.clientId,i.branchId,i.issueDate,
                      d.itemId,d.quantity from issue_order i 
                      inner join issue_order_details d on i.issueOrder=d.issueOrder 
                      order by i.id desc";
      }

      $resultIssue = mysql_query($sqlIssue);

      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Item Stock List</h3>

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
                        <th>Client Name</th>
                        <th>Branch</th>
                        <th>Item</th>
                        <th>Quanity</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php
                        $i=1;
                    
                          while ($rowIssue=mysql_fetch_array($resultIssue)) {
                          echo "<tr>
                                  <td>".$i."</td>
                                  <td>".$rowIssue['issueOrder']."</td>
                                  <td>".getDateDDMMYY($rowIssue['issueDate'])."</td>
                                  <td>".getClientName($rowIssue['clientId'])."</td>
                                  <td>".getBranchName($rowIssue['branchId'])."</td>  
                                  <td>".getItemName($rowIssue['itemId'])."</td>                                  
                                  <td>".$rowIssue['quantity']."</td>
                                  <td class='text-center'><a href='sv_issue_order.php?delete=true&id=".$rowIssue['id']."&issueOrder=".$rowIssue['issueOrder']."' class='btn btn-danger btn-xs'>Delete</a></td>
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
    //$("#select2itemId").select2();
    $("#clientId").select2();
    $("#branchId").select2();
    $("#issueOrder").select2();
  });

   //Date picker
    $('#issueDate').datepicker({
      autoclose: true
    });
    
      var textCount = 0;

      var quantityElements = "";
      var itemIdElements = "";

    function addRow(tableID) {


      //debugger;
      
      //assing_id(tableID);
      
      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);
      
      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {
        
        
        var newcell = row.insertCell(i);
        
        newcell.innerHTML = table.rows[0].cells[i].innerHTML;

        //alert(table.rows[0].cells[i].innerHTML)
        switch(newcell.childNodes[0].type) {

          case "text":

              newcell.childNodes[0].value = "";
              break;
          
          case "select-one":

              newcell.childNodes[0].selectedIndex=0;
              break;
        }
      }
     // assing_id();


     quantityElements = document.querySelectorAll('.quantity');
     itemIdElements = document.querySelectorAll('.itemId');

    // Set their ids
    for (var i = 0; i < itemIdElements.length; i++){
      
      itemIdElements[i].id = 'itemId-' + i;  
    }
     for (var i = 0; i < quantityElements.length; i++){        
          quantityElements[i].id = 'quantity-' + i;  
     
    }

     $('table.abctable').find('tr td').css({'padding':'10px'});

    }

    function deleteRow(tableID) {
      //assing_id();
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          if(rowCount <= 1) {
            swal("Cannot delete all the rows.");
            break;
          }
          
          table.deleteRow(i);
          rowCount--;
          i--;
        }

      }
      }catch(e) {
        swal(e);
      }
    }

    function savedata(tableID){




      if (document.getElementById('issueDate').value=="")
        {
          swal("Please select date.");
          return false;     
        }

         if (document.getElementById('clientId').value=="")
        {
          swal("Please select client name.");
          return false;     
        }

        if (document.getElementById('branchId').value=="")
        {
          swal("Please select branch.");
          return false;     
        }

        

      dml=document.forms['form1'];

      len = dml.elements.length;

      //return 0;

      for( i=0 ; i<len ; i++)
       {              
        
          if (dml.elements[i].name=='itemId[]')
          {                            
             if (dml.elements[i].value=="")
            {
              swal("Please select items.");
              dml.elements[i].focus();
              return false;     
            }
            
          }

          if (dml.elements[i].name=='quantity[]')
          {                            
             if (dml.elements[i].value=="" || dml.elements[i].value==0)
            {
              swal("Please enter quantity.");
              dml.elements[i].focus();
              return false;     
            }
            
          }
          
        }

        //document.getElementById("form1").submit();
        document.forms['form1'].submit();
    }


    function getbranch(clientId){

      var clientId = clientId.value;

      $.get('get_branch.php?clientId='+clientId,function(branchOptions){

        $("#getbranchId").html(branchOptions);

      })


    }

    function checkItemStock(itemId){

      if((itemId).getAttribute('id')){

       var chkIidArr = (itemId).getAttribute('id').split('-');

       var chkId = chkIidArr[1];

       var itemId = $("#itemId-"+chkId).val();
       var quantity = $("#quantity-"+chkId).val();

       $.get('get_branch.php?itemId='+itemId+'&quantity'+quantity,function(stockQuantity){
        
            if(parseFloat(stockQuantity)<parseFloat(quantity)){
              $("#quantity-"+chkId).val('');
              swal("Issue quantity is not greater than stock quantity..");

              return;
              
            }

        })

      }

    }

    function searchSubmit(issueOrder){

      var issueOrder=issueOrder.value;

      document.getElementById("searchForm").action='add_issue_order.php?issueOrder='+issueOrder;

      document.getElementById("searchForm").submit();
    }
   
    </script>
