
<?php include("rept_header.php");

  $fromDate = getDateYYMMDD($_GET['fromDate']);
  $toDate = getDateYYMMDD($_GET['toDate']);

	if(!empty($_GET['issueOrder'])){
		
		$sqlVendor="select d.id, i.issueOrder,i.clientId,i.branchId,i.issueDate,
                      d.itemId,d.quantity,d.returnQuantity from issue_order i 
                      inner join issue_order_details d on i.issueOrder=d.issueOrder 
                      where i.issueOrder='".$_GET['issueOrder']."' and 
                      (i.issueDate between '".$fromDate."' and '".$toDate."') 
                      order by i.issueDate desc";

	}
	else{
		$sqlVendor="select d.id, i.issueOrder,i.clientId,i.branchId,i.issueDate,
                      d.itemId,d.quantity,d.returnQuantity from issue_order i 
                      inner join issue_order_details d on i.issueOrder=d.issueOrder 
                      where  
                      (i.issueDate between '".$fromDate."' and '".$toDate."') 
                      order by i.issueDate,i.issueOrder desc";
	}
		
      	$resultVendors = mysql_query($sqlVendor);
?>
	<div class="container">

		<!--row start-->
        <div class="row">
          <div class="form-group">
            <div class="col-xs-12 col-sm-2 col-md-2">
              <label align="right" class="text-left">
              	<a href='excel_report_issue_order.php?excel=true&
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
            <th>Date</th>
            <th>Issue Order</th>                                               
            <th>Client Name</th>
            <th>Branch</th>
            <th>Item</th>
            <th>Issue Quanity</th>
            <th>Return Quanity</th>
            <th>Total Issue</th>
	      </tr>
	      </thead>
	      <tbody>

	        <?php
	        $i=1;

	          while ($rowVendor=mysql_fetch_array($resultVendors)) {
                  $totalUssueQuantity = $rowVendor['quantity']-$rowVendor['returnQuantity'];
	          echo "<tr>
	                  <td class='text-center'>".$i."</td>
	                  
                      <td class='text-center'>".getDateDDMMYY($rowVendor['issueDate'])."</td>
                      <td>".$rowVendor['issueOrder']."</td>
                      <td>".getClientName($rowVendor['clientId'])."</td>
                      <td>".getBranchName($rowVendor['branchId'])."</td>  
                      <td>".getItemName($rowVendor['itemId'])."</td>                                  
                      <td class='text-right'>".$rowVendor['quantity']."</td>
                      <td class='text-right'>".$rowVendor['returnQuantity']."</td> 
                      <td class='text-right'>".$totalUssueQuantity."</td> 

                      
	                </tr>";

	          $i++;
	        }
	        
	       
	        ?>
	      
	      </tbody>
	     
	    </table>
	</div>
	
	 
	  <!-- /.box-body -->


 <?php include("rept_footer.php");?>
