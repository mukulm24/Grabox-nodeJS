
<?php include("rept_header.php");
	//include("connection.php");

	if(!empty($_GET['itemId']))
		$sqlVendor="select * from item where id='".$_GET['itemId']."'";
	else
		$sqlVendor="select * from item";

      $resultVendors = mysql_query($sqlVendor);
?>
	<div class="container">

		<!--row start-->
        <div class="row">
          <div class="form-group">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">
              	<a href='excel_report_item_stock.php?excel=true&itemId=<?php echo $_GET['itemId'];?>'>
              		<img src="images/excel.jpg" width="20%" height="20%">
              	</a>
              	<a target="_blank" href='createpdf.php?excel=true&itemId=<?php echo $_GET['itemId'];?>'>
              		<img src="images/pdf.jpg" width="20%" height="20%">
              	</a>
              </label>
            </div>
            
          </div>
        </div>

        <!--row close-->

		<!--row start-->
        <div class="row">
          <div class="form-group">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">Report Name :</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              Item Stock Details
            </div>
          </div>
        </div>

        <!--row close-->

	    <table id="example1" class="table table-bordered table-striped">
	      <thead>
	      <tr style="">
	        <th>Sr.No.</th>
	        <th>Item</th>
	        <th>Description</th>
	        <th>Stock</th>
	      </tr>
	      </thead>
	      <tbody>

	        <?php
	        $i=1;

	          while ($rowVendor=mysql_fetch_array($resultVendors)) {
	          echo "<tr>
	                  <td>".$i."</td>
	                  <td>".$rowVendor['itemName']."</td>
	                  <td>".$rowVendor['description']."</td>
	                  <td class='text-right'>".$rowVendor['stock']."</td>
	                  
	                </tr>";

	          $i++;
	        }
	        
	       
	        ?>
	      
	      </tbody>
	     
	    </table>
	</div>
	
	 
	  <!-- /.box-body -->


 <?php include("rept_footer.php");?>
