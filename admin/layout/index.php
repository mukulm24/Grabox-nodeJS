<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>

 <script src="../bootstrap/js/sweetalert.min.js">
 </script> <link rel="stylesheet" type="text/css" href="../bootstrap/css/sweetalert.css">
</head>
<body>

  <?php if(isset($_GET['error'])){ ?>
    <div class="alert alert-danger fade in" id="message">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>Error!</strong> <?php echo $_GET['error'];?>
    </div>
    <?php

    } else if(isset($_GET['success'])){ ?>

    <div class="alert alert-success fade in" id="message">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>Success!</strong> <?php echo $_GET['success'];?>
    </div>


    <?php

    }?>

<div class="container">
  <h2>Login form</h2>


  <form method="post" name="myform" id="myform" class="form-horizontal">
     <input type="hidden" name="save" id="save" value="1">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">UserName:</label>
      <div class="col-sm-4">
        <input type="userName" name="userName" class="form-control" id="userName" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-4">
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" name="save" id="save" class="btn btn-default" onclick="saveData();">Login</button>
      </div>
    </div>

  </form>
</div>

</body>
</html>

<script>
    function saveData(){

    if (document.getElementById('userName').value=="")
        {
          swal("Please enter user name.");
          return false;     
        }
       
      document.getElementById("myform").action='sv_login.php';
      document.forms['myform'].submit();
  }

   $(document).ready( function() {
        $('#message').delay(3000).fadeOut();
      });
  </script>

