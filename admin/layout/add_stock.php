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

  <?php
    
    if(isset($_GET['update'])){

      if(isset($_GET['id'])){
        echo $getBranch="select * from branch where id='".$_GET['id']."'";

        $resultgetBranch = mysql_query($getBranch);

        $rowgetBranch = mysql_fetch_array($resultgetBranch);

      }
    }else{
      $rowgetBranch['branchName']='';
      $rowgetBranch['clientId']='';

      $rowgetBranch['quantity']='';
      $_GET['id']='';
    }


  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Stock
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Add Stock</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="callout callout-info">

        
       
        <form  method="post" action="sv_stock.php" class="form-horizontal" id="form1" name="form11">


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
                    <input type="text" name="stockDate" class="form-control pull-right" id="stockDate">
                  <!-- /.input group -->
                </div>
              </div>

              <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Vendor Name :</label>
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3">

                <?php 
                      $sqlVendor ="select * from vendor order by id desc";
                      $resultVendor =mysql_query($sqlVendor);

                      //Item list

                      $sqlItems ="select * from item order by id desc";
                      $resultItems =mysql_query($sqlItems);
                ?>
                  <select name="vendorId" id="vendorId" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                    <?php 
                                     
                      while ($rowVendor=mysql_fetch_array($resultVendor)) {

                          echo '<option value='.$rowVendor['id'].'>'.$rowVendor['vendorName'].'</option>';                 
                              
                      }

                    ?>
                    <!--<option selected="selected">Alabama</option>
                    <option>Alaska</option>-->
                  </select>
              </div>


            </div>
          </div>      

        <!--row close-->
    
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">

        <div class="row">

          <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding:50px;">

              <table border='1' width="70%" id="adddataTable12" cellpadding="100" cellspacing="100">
                <tr>
                  <thead>
                      <tr style="background-color:#00c0ef">
                        <th width="6.1%" style="padding: 1px;">#</th>                                                
                        <th width="50%" class="tdcellpadding">Item Name</th>
                         <th class="tdcellpadding">Quanity</th>
                      </tr>
                  </thead>

                  <table border='1' width="70%" class="abctable" id="adddataTable">

                    <tr>

                      <td style="padding: 10px;"><input type="checkbox" name="chk"/></td>
                        <td class="tdcellpadding" width="50%">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <select name="itemId[]" id="itemId" class="form-control select2itemId" style="width: 100%;">

                              <?php 
                                               
                                while ($rowItems=mysql_fetch_array($resultItems)) {

                                    echo '<option value='.$rowItems['id'].'>'.$rowItems['itemName'].'</option>';                    
                                        
                                }

                              ?>
                              <!--<option selected="selected">Alabama</option>
                              <option>Alaska</option>-->
                           </select>
                       </div>
                      </td>

                      <td class="tdcellpadding">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <input type="number" class="form-control" id="quantity" name="quantity[]" value="<?php echo $rowgetBranch['quantity'];?>" placeholder="Quantity">
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
                     
                      <span >
                      <input type="button" name="add" value="Add" id="add" class="btn btn-success btn-xs" onClick="addRow('adddataTable')" >
                      </span>
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

      $sqlStock="select * from item_stock order by id desc";

      $resultStocks = mysql_query($sqlStock);

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
                        <th>Date</th>
                        <th>Item</th>
                        <th>Quanity</th>
                        <th>Vendor Name</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php
                        $i=1;
                    
                          while ($rowStocks=mysql_fetch_array($resultStocks)) {
                          echo "<tr>
                                  <td>".$i."</td>
                                  <td>".getDateDDMMYY($rowStocks['stockDate'])."</td>
                                  <td>".getItemName($rowStocks['itemId'])."</td>                                
                                  <td>".$rowStocks['quantity']."</td>
                                  <td>".getVendorName($rowStocks['vendorId'])."</td>
                                  <td class='text-center'><a href='sv_stock.php?delete=true&id=".$rowStocks['id']."' class='btn btn-danger btn-xs'>Delete</a></td>
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
    $("#vendorId").select2();
    //$(".select2itemId").select2();


  });

   //Date picker
    $('#stockDate').datepicker({
      autoclose: true
    });


     //assign_id();
    function assing_id()
      {
        
        
        dml=document.forms['form1'];
      
        len = dml.elements.length;
        
         for( i=0 ; i<len ; i++)
        {   
            
          if (dml.elements[i].name=='itemId[]')
            {
              dml.elements[i].id=i;
              
            }
            if (dml.elements[i].name=='quantity[]')
            {
              
              dml.elements[i].id=i;
              
            }
                    
        }
      
      }

    


    function addRow(tableID) {


      
      
      assing_id();
      
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

     $('table.abctable').find('tr td').css({'padding':'10px'});

    }

    function deleteRow(tableID) {
      assing_id();
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

      if (document.getElementById('stockDate').value=="")
        {
          swal("Please select date.");
          return false;     
        }

         if (document.getElementById('vendorId').value=="")
        {
          swal("Please select vendor.");
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
             if (dml.elements[i].value=="")
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

   
    </script>
