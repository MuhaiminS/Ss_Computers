<?php 
  $page = $_SERVER['PHP_SELF'];
  //$page = str_replace("/pos/res/admin/", "", $page);
  //$page = str_replace("/projects/admin_new_res_demo/1/site/admin/", "", $page);
  //$page = explode(".",$page);
  //$page = $page[0];

  $page = basename($page,".php");
 ?>
<style type="text/css">
  .menu-open ul {display: block !important;}
</style>
<!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">



    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">



      <!-- Sidebar user panel (optional) -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="dist/img/oversee_logo_400x400.jpg" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p><?php echo (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : ''; ?></p>

          <!-- Status -->

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>

      </div>



      <!-- search form (Optional) -->

      <!--<form action="#" method="get" class="sidebar-form">

        <div class="input-group">

          <input type="text" name="q" class="form-control" placeholder="Search...">

          <span class="input-group-btn">

              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>

              </button>

            </span>

        </div>

      </form>-->

      <!-- /.search form -->



      <!-- Sidebar Menu -->

      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>



        <!-- Optionally, you can add icons to the links -->

        <li  class="<?php if($page == 'index'){ echo "active"; } ?>"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        

		<!-- Recipe -->

        <li class="treeview <?php  if($page == 'products' || $page == 'products_add' || $page == 'receipe_incrediant') { echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa-barcode"></i> <span>Recipe</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'products'){ echo "active"; } ?>"><a href="products.php"><i class="fa fa-circle-o"></i> List Recipe</a></li>

            <li class="<?php if($page == 'products_add'){ echo "active"; } ?>"><a href="products_add.php"><i class="fa fa-circle-o"></i> Add Recipe</a></li>

            <!--<li class="<?php if($page == 'receipe_incrediant'){ echo "active"; } ?>"><a href="receipe_incrediant.php"><i class="fa fa-circle-o"></i>Ingredient Added Recipes</a></li>-->

           <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Import Products</a></li>

			<li class="divider"></li>

            <li><a href="#"><i class="fa fa-circle-o"></i> Print Barcodes</a></li>

            <li><a href="#"><i class="fa fa-circle-o"></i> Print Labels</a></li>-->

          </ul>

        </li>
		
		<!-- Manage Ingredient -->

        <li class="treeview <?php  if($page == 'incrediants' || $page == 'incrediants_add'  ) { echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa fa-plus"></i> <span>Products(Ingredients)</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

			 <li class="<?php if($page == 'incrediants'){ echo "active"; } ?>"><a href="incrediants.php"><i class="fa fa-circle-o"></i> List Products(Ingredients)</a></li>
            
            <li class="<?php if($page == 'incrediants_add'){ echo "active"; } ?>"><a href="incrediants_add.php"><i class="fa fa-circle-o"></i> Add Product(Ingredient)</a></li> 

		 <li class="Ingredient Purchase Order"></li>
			
			            <!-- <li class="<?php if($page == 'ingredient_purchase'){ echo "active"; } ?>"><a href="purchases.php"><i class="fa fa-circle-o"></i> List Purchase Order</a></li>
			            			
			            <li class="<?php if($page == 'ingredient_purchase_add'){ echo "active"; } ?>"><a href="purchases_add.php"><i class="fa fa-circle-o"></i> Add Purchase Order</a></li> -->

          </ul>

        </li>



		<!-- Categories -->

        <li class="treeview <?php  if($page == 'categories' || $page == 'categories_add' ||  $page == 'expenses_categories' ||  $page == 'expenses_categories_add') { echo 'active menu-open'; } ?> ">

          <a href="#"><i class="fa fa-folder"></i> <span>Categories</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'categories'){ echo "active"; } ?>"><a href="categories.php"><i class="fa fa-circle-o"></i> List Categories</a></li>

            <li class="<?php if($page == 'categories_add'){ echo "active"; } ?>"><a href="categories_add.php"><i class="fa fa-circle-o"></i> Add Categories</a></li>

            <!--<li><a href="#"><i class="fa fa-circle-o"></i> Import Categories</a></li>-->

			<li class="divider"></li>

			<li class="<?php if($page == 'expenses_categories'){ echo "active"; } ?>"><a href="expenses_categories.php"><i class="fa fa-circle-o"></i> List Expense Categories</a></li>

            <li class="<?php if($page == 'expenses_categories_add'){ echo "active"; } ?>"><a href="expenses_categories_add.php"><i class="fa fa-circle-o"></i> Add Expense Categories</a></li>

          </ul>

        </li>


        <!--- offers -->
          <li class="treeview <?php if($page == 'offers' || $page == 'offer_add'){ echo "active menu-open"; } ?>">

          <a href="#"><i class="fa fa-credit-card"></i> <span>Offers</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'offer_add'){ echo "active"; } ?>"><a href="offer_add.php"><i class="fa fa-circle-o"></i> Add Offer</a></li>

            <li class="<?php if($page == 'offers'){ echo "active"; } ?>"><a href="offers.php"><i class="fa fa-circle-o"></i> All Offers</a></li>

            

          </ul>

        </li>

		<!-- Sales -->

		<li class="treeview <?php if($page == 'sale_orders'){ echo "active menu-open"; } ?>">

          <a href="#"><i class="fa fa fa-shopping-cart"></i> <span>Sales</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'sale_orders'){ echo "active"; } ?>"><a href="sale_orders.php?order_type=counter_sale"><i class="fa fa-circle-o"></i> Counter Sales</a></li>

            <li class="<?php if($page == 'sale_orders'){ echo "active"; } ?>"><a href="sale_orders.php?order_type=delivery"><i class="fa fa-circle-o"></i> Delivery Sales</a></li>

            <li class="<?php if($page == 'sale_orders'){ echo "active"; } ?>"><a href="sale_orders.php?order_type=dine_in"><i class="fa fa-circle-o"></i> Dine In</a></li>

          </ul>

        </li>



		<!--  Feedback -->
		 <li class="treeview <?php if($page == 'feedback' || $page == 'top_ratings' || $page == 'poor_ratings' ){ echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa-star-o"></i> <span>Feedback</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

			</span>

          </a>

          <ul class="treeview-menu">

           
			

			<!--<li class="divider"></li>

            <li><a href="#"><i class="fa fa-circle-o"></i>Item-Wise Report</a></li>

			<li><a href="#"><i class="fa fa-circle-o"></i>Bill-Wise Report</a></li>

            <li><a href="#"><i class="fa fa-circle-o"></i>Staff-Wise Report</a></li>-->

			<li class="divider"></li>

            <li class="<?php if($page == 'feedback'){ echo "active"; } ?>"><a href="feedback.php"><i class="fa fa-circle-o"></i>Feedback</a></li>
			   <li class="<?php if($page == 'top_ratings'){ echo "active"; } ?>"><a href="top_ratings.php"><i class="fa fa-circle-o"></i>Top Ratings</a></li>
			    <li class="<?php if($page == 'poor_ratings'){ echo "active"; } ?>"><a href="poor_ratings.php"><i class="fa fa-circle-o"></i>Poor Ratings</a></li>
			   
           
          </ul>

        </li>
		<!-- Credit sales -->

		<li class="<?php if($page == 'credit_sales'){ echo "active"; } ?>"><a href="credit_sales.php"><i class="fa fa-shopping-cart"></i> <span>Credit Sales</span></a></li>



		<!-- Purchases -->

        <li class="treeview <?php  if($page == 'purchases' || $page == 'purchases_add' ||  $page == 'expenses' ||  $page == 'expenses_add') { echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa fa-plus"></i> <span>Expenses</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'purchases'){ echo "active"; } ?>"><a href="purchases.php"><i class="fa fa-circle-o"></i> List Purchases</a></li>

            <li class="<?php if($page == 'purchases_add'){ echo "active"; } ?>"><a href="purchases_add.php"><i class="fa fa-circle-o"></i> Add Purchases</a></li>

			<li class="divider"></li>

            <li class="<?php if($page == 'expenses'){ echo "active"; } ?>"><a href="expenses.php"><i class="fa fa-circle-o"></i> List Expenses</a></li>

            <li class="<?php if($page == 'expenses_add'){ echo "active"; } ?>"><a href="expenses_add.php"><i class="fa fa-circle-o"></i> Add Expenses</a></li>

          </ul>

        </li>



		<!-- People -->

        <li class="treeview <?php if($page == 'drivers' || $page == 'drivers_add' ) { echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa-users"></i> <span>People</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <!--<li><a href="users.php"><i class="fa fa-circle-o"></i> List Users</a></li>

            <li><a href="users_add.php"><i class="fa fa-circle-o"></i> Add User</a></li>

			<li class="divider"></li>-->

            <li class="<?php if($page == 'customers'){ echo "active"; } ?>"><a href="customers.php"><i class="fa fa-circle-o"></i> List Customers</a></li>

            <li class="<?php if($page == 'customers_add'){ echo "active"; } ?>"><a href="customers_add.php"><i class="fa fa-circle-o"></i> Add Customer</a></li>

			<li class="divider"></li>

            <li class="<?php if($page == 'suppliers'){ echo "active"; } ?>"><a href="suppliers.php"><i class="fa fa-circle-o"></i> List Suppliers</a></li>

            <li class="<?php if($page == 'suppliers_add'){ echo "active"; } ?>"><a href="suppliers_add.php"><i class="fa fa-circle-o"></i> Add Suppliers</a></li>

			<li class="divider"></li>

            <li class="<?php if($page == 'drivers'){ echo "active"; } ?>"><a href="drivers.php"><i class="fa fa-circle-o"></i> List Drivers</a></li>

            <li class="<?php if($page == 'drivers_add'){ echo "active"; } ?>"><a href="drivers_add.php"><i class="fa fa-circle-o"></i> Add Driver</a></li>

          </ul>

        </li>

		

		<!-- Settings -->

        <li class="treeview <?php  if($page == 'settings_add' || $page == 'floors' || $page == 'floors_add' ||  $page == 'tables' ||  $page == 'tables_add') { echo 'active menu-open'; } ?> ">

          <a href="#"><i class="fa fa fa-gears"></i> <span>Settings</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'settings_add'){ echo "active"; } ?>"><a href="settings_add.php"><i class="fa fa-circle-o"></i> Settings</a></li>

			<li class="divider"></li>

            <!--<li><a href="#"><i class="fa fa-circle-o"></i> List Users Roles</a></li>

            <li><a href="#"><i class="fa fa-circle-o"></i> Add Users Role</a></li>

			<li class="divider"></li>

            <li><a href="#"><i class="fa fa-circle-o"></i> List Stores</a></li>

            <li><a href="#"><i class="fa fa-circle-o"></i> Add Store</a></li>

			<li class="divider"></li>

			<li class="divider"></li>

            <li><a href="#"><i class="fa fa-circle-o"></i> List MF Units</a></li>

            <li><a href="#"><i class="fa fa-circle-o"></i> Add MF Unit</a></li>-->

			

			<li class="<?php if($page == 'floors'){ echo "active"; } ?>"><a href="floors.php"><i class="fa fa-circle-o"></i> List Floors</a></li>

            <li class="<?php if($page == 'floors_add'){ echo "active"; } ?>"><a href="floors_add.php"><i class="fa fa-circle-o"></i> Add Floor</a></li>

			<li class="divider"></li>

            <li class="<?php if($page == 'tables'){ echo "active"; } ?>"><a href="tables.php"><i class="fa fa-circle-o"></i> List Tables</a></li>

            <li class="<?php if($page == 'tables_add'){ echo "active"; } ?>"><a href="tables_add.php"><i class="fa fa-circle-o"></i> Add Table</a></li>



			<li class="divider"></li>

			<li class="<?php if($page == 'backup_db'){ echo "active"; } ?>"><a href="backup_db.php"><i class="fa fa-circle-o"></i> Backups</a></li>

          </ul>

        </li>



		<!-- Reports -->

        <li class="treeview <?php if($page == 'reports_settle_sales' || $page == 'reports_tax' || $page == 'reports_item_wise' || $page == 'wastage_expired_ingredient' || $page == 'top_ratings' || $page == 'poor_ratings' || $page == 'top_selling_product'){ echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa-bar-chart-o"></i> <span>Reports</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'reports_settle_sales'){ echo "active"; } ?>"><a href="reports_settle_sales.php"><i class="fa fa-circle-o"></i>Settle Sales</a></li>

			<li class="divider"></li>

            <li class="<?php if($page == 'reports_item_wise'){ echo "active"; } ?>">
              <a href="reports_item_wise.php"><i class="fa fa-circle-o"></i>Item Wise Report</a>
            </li>
			<li class="<?php if($page == 'top_selling_product'){ echo "active"; } ?>">
              <a href="top_selling_product.php"><i class="fa fa-circle-o"></i>Top Selling Recipe Report</a>
            </li>
			<li class="<?php if($page == 'wastage_expired_ingredient'){ echo "active"; } ?>"><a href="wastage_expired_ingredient.php"><i class="fa fa-circle-o"></i> Expired Ingredient</a></li>

			 <li class="<?php if($page == 'top_ratings'){ echo "active"; } ?>"><a href="top_ratings.php"><i class="fa fa-circle-o"></i>Top Rated Recipe</a></li>
			 <li class="<?php if($page == 'poor_ratings'){ echo "active"; } ?>"><a href="poor_ratings.php"><i class="fa fa-circle-o"></i>Poor Rated Recipe</a></li>

			<!--<li><a href="#"><i class="fa fa-circle-o"></i>Bill-Wise Report</a></li>

            <li><a href="#"><i class="fa fa-circle-o"></i>Staff-Wise Report</a></li>-->

			<li class="divider"></li>

            <li class="<?php if($page == 'reports_tax'){ echo "active"; } ?>"><a href="reports_tax.php"><i class="fa fa-circle-o"></i>Tax Report</a></li>

          </ul>

        </li>


		
		<!-- Waste Management -->

        <!-- <li class="treeview <?php  if( $page == 'wastage_expired_ingredient' || $page == 'wastage_recipe' ) { echo 'active menu-open'; } ?>">
        
          <a href="#"><i class="fa fa-barcode"></i> <span>Wastage</span>
        
            <span class="pull-right-container">
        
                <i class="fa fa-angle-left pull-right"></i>
        
              </span>
        
          </a>
        
          <ul class="treeview-menu">
        
            <li class="<?php if($page == 'wastage_expired_ingredient'){ echo "active"; } ?>"><a href="wastage_expired_ingredient.php"><i class="fa fa-circle-o"></i> Expired Ingredient</a></li>
        
            <li class="<?php if($page == 'wastage_recipe'){ echo "active"; } ?>"><a href="wastage_recipe.php"><i class="fa fa-circle-o"></i>Wastage Recipe</a></li>          
        
          </ul>
        
        </li> -->

			

		<!-- Logout -->

        <li class="<?php if($page == 'logout'){ echo "active"; } ?>"><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

      </ul>

      <!-- /.sidebar-menu -->

    </section>

    <!-- /.sidebar -->

  </aside>