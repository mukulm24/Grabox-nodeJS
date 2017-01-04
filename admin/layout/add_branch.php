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
      $_GET['id']='';
    }



  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Branch
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Add Branch</li>
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
              <label align="right">Client :</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">

              <?php 
                 //echo 'AAaaaaaaaa'.$rowgetBranch['clientId'];
                     $sqlClient ="select * from client";
                    $resultClient =mysql_query($sqlClient);

                     

              ?>
                <select name="clientId" id="clientId" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                  <?php 
                                   
                    while ($rowClient=mysql_fetch_array($resultClient)) {

                      if($rowgetBranch['clientId']==$rowClient['id']){
                          $selected='selected';
                          echo '<option  selected="'.$selected.'" value='.$rowClient['id'].'>'.$rowClient['clientName'].'</option>';
                        }else{
                           echo '<option value='.$rowClient['id'].'>'.$rowClient['clientName'].'</option>';
                        }                      
                            
                    }

                  ?>
                  <!--<option selected="selected">Alabama</option>
                  <option>Alaska</option>-->
                </select>
            </div>

            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Name :</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              <input type="text" class="form-control" id="branchName" name="branchName" value="<?php echo $rowgetBranch['branchName'];?>" onBlur="checkBranch();" placeholder="Enter Name">
            </div>

            

          </div>
        </div>

        <!--row close-->

         <div class="row">

          <div class="form-group">
             <div class="col-xs-12 col-sm-5 col-md-5">
              
            </div>

           <div class="col-xs-12 col-sm-2 col-md-2 text-center">
              <button type="button" name="save" id="save" class="btn btn-block btn-primary btn-sm" onclick="saveData();">Submit</button>
            </div>
           
          </div>
        </div>

        <!--row close-->

        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">

      </form>


      </div>

      <?php

      $sqlBranch="select * from branch order by clientId";

      $resultBranchs = mysql_query($sqlBranch);

      ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Branch List</h3>

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
                        <th>Client</th>
                        <th>Branch Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php
                        $i=1;
                        //$p=1;
                        $clientId='';

                       // $charArr=['A','B','C'];

                          while ($rowBranch=mysql_fetch_array($resultBranchs)) {

                            /*
                            if($clientId!=$rowBranch['clientId']){

                              echo "<tr>
                                 <td>".$p."</td>
                                  <td><b><font color='red'>".getClientName($rowBranch['clientId'])."</font></b></td>
                                  <td></td>
                                  <td></td>
                                  
                                </tr>";

                                $clientId=$rowBranch['clientId'];
                                $p++;
                                $i++;
                               

                            }

                            */
                          echo "<tr>
                                  <td>".$i."</td>
                                  <td>".getClientName($rowBranch['clientId'])."</td>
                                  <td>".$rowBranch['branchName']."</td>
                                  <td class='text-center'><a href='add_branch.php?update=true&id=".$rowBranch['id']."' class='btn btn-primary btn-xs'>Update</a></td>
                                  <td class='text-center'><a href='sv_branch.php?delete=true&id=".$rowBranch['id']."' class='btn btn-danger btn-xs'>Delete</a></td>
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
    $(".select2").select2();
  });

  
    function saveData(){

    if (document.getElementById('clientId').value=="")
        {
          swal("Please select client name.");
          return false;     
        }
        if (document.getElementById('branchName').value=="")
        {
          swal("Please enter branch name.");
          return false;     
        }
       
      document.getElementById("myform").action='sv_branch.php';
      document.forms['myform'].submit();
  }

  function checkBranch(){

    var branchName = $("#branchName").val();
    var clientId = $("#clientId").val();

    $.get('get_check_item.php?branchName='+branchName+'&clientId='+clientId,function(data){
      console.log(data)
      if(data){
        $("#branchName").val('');

        swal("Branch allready exist.");
      }

      })

  }

    </script>
