 <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Arun Patil</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <!--<li class="header">MAIN NAVIGATION</li>-->

        <!-- Start Menu -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa fa-files-o"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_vendor.php"><i class="fa fa-circle-o"></i> Vendor</a></li>
            <li><a href="add_client.php"><i class="fa fa-circle-o"></i> Client</a></li>
            <li><a href="add_branch.php"><i class="fa fa-circle-o"></i> Branch</a></li>
          </ul>
        </li>

        <!-- End menu-->

         <!-- Start Menu -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Item</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_item.php"><i class="fa fa-circle-o"></i> Item Master</a></li>
            <li><a href="add_stock.php"><i class="fa fa-circle-o"></i> Item Stock</a></li>
          </ul>
        </li>

        <!-- End menu-->

        <!-- Start Menu -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Issue</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_issue_order.php"><i class="fa fa-circle-o"></i> Issue Order</a></li>
            <li><a href="return_issue_order.php"><i class="fa fa-circle-o"></i> Issue Return</a></li>
          </ul>
        </li>

        <!-- End menu-->

         <!-- Start Menu -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="rept_item_stock.php"><i class="fa fa-circle-o"></i> Item Stock</a></li>
            <li><a href="rept_vendor_stock.php"><i class="fa fa-circle-o"></i> Received Item Stock</a></li>
            <li><a href="rept_issue_order.php"><i class="fa fa-circle-o"></i>Issue Order</a></li>
            <li><a href="rept_issue_return.php"><i class="fa fa-circle-o"></i>Issue Return</a></li>
          </ul>
        </li>

        <!-- End menu-->
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>