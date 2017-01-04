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
        $getVendor="select * from vendor where id='".$_GET['id']."'";

        $resultgetVendor = mysql_query($getVendor);

        $rowgetVendor = mysql_fetch_array($resultgetVendor);

      }
    }else{
      $rowgetVendor['vendorName']='';
      $_GET['id']='';
    }

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Vendor
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Add Vendor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
       
        <form name="myform" id="myform" method="post" action="" class="form-horizontal">
          <input type="hidden" name="save" id="save" value="1">
          <!--row start-->
        <div class="row">

          <div class="form-group">
            <div class="col-xs-12 col-sm-3 col-md-3">
              <label align="right" class="text-left">Name :</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              <input type="text" class="form-control" id="vendorName" name="vendorName" value="<?php echo $rowgetVendor['vendorName'];?>" placeholder="Enter Name" onBlur="checkvendor(this);">
            </div>
         
            <div class="col-xs-12 col-sm-2 col-md-2">
              <button type="button" name="save" id="save" class="btn btn-block btn-primary btn-sm" onclick="saveData();">Submit</button>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              
            </div>
          </div>


        </div>

        <!--row close-->

        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">

      </form>


      </div>

      <?php

      $sqlVendor="select * from vendor order by id desc";

      $resultVendors = mysql_query($sqlVendor);

      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Vendor List</h3>

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
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php
                        $i=1;

                          while ($rowVendor=mysql_fetch_array($resultVendors)) {
                          echo "<tr>
                                  <td>".$i."</td>
                                  <td>".$rowVendor['vendorName']."</td>
                                  <td class='text-center'><a href='add_vendor.php?update=true&id=".$rowVendor['id']."' class='btn btn-primary btn-xs'>Update</a></td>
                                  <td class='text-center'><a href='sv_vendor.php?delete=true&id=".$rowVendor['id']."' class='btn btn-danger btn-xs'>Delete</a></td>
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
    function saveData(){

    if (document.getElementById('vendorName').value=="")
        {
          swal("Please enter vendor name.");
          return false;     
        }
       
      document.getElementById("myform").action='sv_vendor.php';
      document.forms['myform'].submit();
  }

  function checkvendor(){

    var vendorName = $("#vendorName").val();

    $.get('get_check_item.php?vendorName='+vendorName,function(data){
      console.log(data)
      if(data){
        $("#vendorName").val('');

        swal("Vendor name allready exist.");
      }

      })

  }

  

</script>
