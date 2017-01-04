
<?php include("rept_header.php");

  $fromDate = getDateYYMMDD($_GET['fromDate']);
  $toDate = getDateYYMMDD($_GET['toDate']);

	if(!empty($_GET['vendorId'])){
		$sqlVendor="select * from item_stock 
		where (stockDate between '".$fromDate."' and '".$toDate."') 
		and vendorId='".$_GET['vendorId']."' order by stockDate";

	}
	else{
		$sqlVendor="select * from item_stock 
		where (stockDate between '".$fromDate."' and '".$toDate."') 
		order by stockDate";
	}
		
      	$resultVendors = mysql_query($sqlVendor);
?>
	<div class="container">

		<!--row start-->
        <div class="row">
          <div class="form-group">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">
              	<a href='excel_report_vendor_stock.php?excel=true&
              	fromDate=<?php echo $_GET['fromDate'];?>&toDate=<?php echo $_GET['toDate'];?>&vendorId=<?php echo $_GET['vendorId'];?>'>
              	<img src="images/excel.jpg" width="20%" height="20%">
              </a>
              <img src="images/pdf.jpg" width="20%" height="20%">
          	</label>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              PDF
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
              Received Item Stock Details
            </div>
          </div>
        </div>

        <!--row close-->

	    <table id="example1" class="table table-bordered table-striped">
	      <thead>
	      <tr style="">
	        <th>Sr.No.</th>
	        <th>Vendor Name</th>
	        <th>Date</th>
	        <th>Item</th>
	        <th>Quantity</th>
	      </tr>
	      </thead>
	      <tbody>

	        <?php
	        $i=1;

	          while ($rowVendor=mysql_fetch_array($resultVendors)) {
	          echo "<tr>
	                  <td>".$i."</td>
	                  <td>".getVendorName($rowVendor['vendorId'])."</td>
	                  <td>".getDateDDMMYY($rowVendor['stockDate'])."</td>
	                  <td>".getItemName($rowVendor['itemId'])."</td>
	                  <td>".$rowVendor['quantity']."</td>   
	                </tr>";

	          $i++;
	        }
	        
	       
	        ?>
	      
	      </tbody>
	     
	    </table>
	</div>
	
	 
	  <!-- /.box-body -->


 <?php include("rept_footer.php");?>
