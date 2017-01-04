
<?php include("rept_header.php");

  $fromDate = getDateYYMMDD($_GET['fromDate']);
  $toDate = getDateYYMMDD($_GET['toDate']);

	if(!empty($_GET['issueOrder'])){
		
    $sqlVendors="select d.id, i.issueOrder,d.issueReturnDate,
                      d.itemId,d.quantity,issue.branchId,issue.clientId from return_issue_order i 
                      inner join return_issue_order_details d on i.issueOrder=d.issueOrder 
                      inner join issue_order issue on i.issueOrder=issue.issueOrder 
                       where i.issueOrder='".$_GET['issueOrder']."' and 
                      (d.issueReturnDate between '".$fromDate."' and '".$toDate."') 
                      order by i.id desc";

	}
	else{
		  $sqlVendors="select d.id, i.issueOrder,d.issueReturnDate,
                      d.itemId,d.quantity,issue.branchId,issue.clientId from return_issue_order i 
                      inner join return_issue_order_details d on i.issueOrder=d.issueOrder 
                      inner join issue_order issue on i.issueOrder=issue.issueOrder 
                       where 
                      (d.issueReturnDate between '".$fromDate."' and '".$toDate."') 
                      order by i.id desc";
	}
		
      	$resultVendors = mysql_query($sqlVendors);
?>
	<div class="container">

		<!--row start fa-file-pdf-o-->
        <div class="row">
          <div class="form-group">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">
              	<a href='excel_report_issue_return.php?excel=true&
              	 fromDate=<?php echo $_GET['fromDate'];?>&toDate=<?php echo $_GET['toDate'];?>&issueOrder=<?php echo $_GET['issueOrder'];?>'>
                  <img src="images/excel.jpg" width="20%" height="20%">
                </a>
                <img src="images/pdf.jpg" width="20%" height="20%">
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
              Item Issue Order
            </div>
          </div>
        </div>

        <!--row close-->

	    <table id="example1" class="table table-bordered table-striped">
	      <thead>
	      <tr style="">
	        <th>Sr.No.</th> 
            <th>Issue Order</th>                                               
            <th>Date</th>
            <th>Client Name</th>
            <th>Branch</th>
            <th>Item</th>
            <th>Quanity</th>
	      </tr>
	      </thead>
	      <tbody>

	        <?php
	        $i=1;

	          while ($rowVendor=mysql_fetch_array($resultVendors)) {
                  
	          echo "<tr>
	                  <td class='text-center'>".$i."</td>
                      <td>".$rowVendor['issueOrder']."</td>
                        <td>".getDateDDMMYY($rowVendor['issueReturnDate'])."</td> 
                        <td>".getClientName($rowVendor['clientId'])."</td>
                        <td>".getBranchName($rowVendor['branchId'])."</td>
                        <td>".getItemName($rowVendor['itemId'])."</td>                                  
                        <td class='text-right'>".$rowVendor['quantity']."</td>
	                </tr>";

	          $i++;
	        }
	        
	       
	        ?>
	      
	      </tbody>
	     
	    </table>
	</div>
	
	 
	  <!-- /.box-body -->


 <?php include("rept_footer.php");?>
