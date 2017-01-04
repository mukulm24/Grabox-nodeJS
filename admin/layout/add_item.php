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
        $getItem="select * from item where id='".$_GET['id']."'";

        $resultgetItem = mysql_query($getItem);

        $rowgetItem = mysql_fetch_array($resultgetItem);

      }
    }else{
      $rowgetItem['itemName']='';
      $rowgetItem['description']='';
      $_GET['id']='';
    }

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Item
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Add Item</li>
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
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Name :</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              <input type="text" class="form-control" id="itemName" name="itemName" value="<?php echo $rowgetItem['itemName'];?>" placeholder="Enter Item" onBlur="checkItem(this);">
            </div>

            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Description :</label>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5">
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description"><?php echo $rowgetItem['description'];?></textarea>
            </div>
           
          </div>


        </div>

        <!--row close-->

         <div class="row">

          <div class="form-group">
             <div class="col-xs-12 col-sm-4 col-md-4">
              
            </div>

           <div class="col-xs-12 col-sm-2 col-md-2 text-center">
              <button type="button" name="save" id="save" class="btn btn-block btn-primary btn-sm" onclick="saveData();">Submit</button>
            </div>

            <div class="col-xs-12 col-sm-2 col-md-2 text-center">

            <a href ="add_item.php"><input type="button" name="cancel" id="cancel" class="btn btn-block btn-default btn-sm" value="Cancel"></a>
          </div>
           
          </div>
        </div>

        <!--row close-->

        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">

      </form>


      </div>

      <?php

      $sqlItem="select * from item order by id desc";

      $resultItems = mysql_query($sqlItem);
      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Item List</h3>

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
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php
                        $i=1;
                        while ($rowItem=mysql_fetch_array($resultItems)) {

                          echo "<tr>
                                  <td>".$i."</td>
                                  <td>".$rowItem['itemName']."</td>
                                  <td>".$rowItem['description']."</td>
                                  <td class='text-center'><a href='add_item.php?update=true&id=".$rowItem['id']."' class='btn btn-primary btn-xs'>Update</a></td>
                                  <td class='text-center'><a href='sv_item.php?delete=true&id=".$rowItem['id']."' class='btn btn-danger btn-xs'>Delete</a></td>
                                </tr>";
                          //echo $rowitem['itemName'];

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

    if (document.getElementById('itemName').value=="")
        {
          swal("Please enter item name.");
          return false;     
        }
        if (document.getElementById('description').value=="")
        {
          swal("Please enter item description.");
          return false;     
        }

      document.getElementById("myform").action='sv_item.php';
      document.forms['myform'].submit();
  }

  function checkItem(itemName){

    var itemName = $("#itemName").val();

    $.get('get_check_item.php?itemName='+itemName,function(data){

      if(data){
        $("#itemName").val('');

        swal("Item allready exist.");
      }

      })

  }
  </script>
