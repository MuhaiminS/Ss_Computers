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

          <img src="dist/img/avatar04.png" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p><?php echo (isset($_SESSION['admin_user_name'])) ? $_SESSION['admin_user_name'] : ''; ?></p>

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

        
		
		<!-- Manage Ingredient -->

        <li class="treeview <?php  if($page == 'product' || $page == 'product_add'  || $page == 'stock_product'  ) { echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa fa-plus"></i> <span>Products</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

			 <li class="<?php if($page == 'product'){ echo "active"; } ?>"><a href="product.php"><i class="fa fa-circle-o"></i> List Products</a></li>
            
            <li class="<?php if($page == 'product_add'){ echo "active"; } ?>"><a href="product_add.php"><i class="fa fa-circle-o"></i> Add Product</a></li> 
              <li class="<?php if($page == 'stock_product'){ echo "active"; } ?>"><a href="stock_product.php"><i class="fa fa-circle-o"></i> Stock Product</a></li> 

		 <li class="Ingredient Purchase Order"></li>
			
			            <!-- <li class="<?php if($page == 'ingredient_purchase'){ echo "active"; } ?>"><a href="purchases.php"><i class="fa fa-circle-o"></i> List Purchase Order</a></li>
			            			
			            <li class="<?php if($page == 'ingredient_purchase_add'){ echo "active"; } ?>"><a href="purchases_add.php"><i class="fa fa-circle-o"></i> Add Purchase Order</a></li> -->

          </ul>

        </li>



		<!-- Categories -->

        <li class="treeview <?php  if($page == 'categories' || $page == 'categories_add' ) { echo 'active menu-open'; } ?> ">

          <a href="#"><i class="fa fa-folder"></i> <span>Categories</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'categories'){ echo "active"; } ?>"><a href="categories.php"><i class="fa fa-circle-o"></i> List Categories</a></li>

            <li class="<?php if($page == 'categories_add'){ echo "active"; } ?>"><a href="categories_add.php"><i class="fa fa-circle-o"></i> Add Categories</a></li>

          </ul>


        </li>

<!-- Notes -->

        <!--- offers -->
        <!--  <li class="treeview <?php if($page == 'offers' || $page == 'offer_add'){ echo "active menu-open"; } ?>">-->

        <!--  <a href="#"><i class="fa fa-credit-card"></i> <span>Offers</span>-->

        <!--    <span class="pull-right-container">-->

        <!--        <i class="fa fa-angle-left pull-right"></i>-->

        <!--      </span>-->

        <!--  </a>-->

        <!--  <ul class="treeview-menu">-->

        <!--    <li class="<?php if($page == 'offer_add'){ echo "active"; } ?>"><a href="offer_add.php"><i class="fa fa-circle-o"></i> Add Offer</a></li>-->

        <!--    <li class="<?php if($page == 'offers'){ echo "active"; } ?>"><a href="offers.php"><i class="fa fa-circle-o"></i> All Offers</a></li>-->

            

        <!--  </ul>-->

        <!--</li>-->

		<!-- Sales -->

		<li class="treeview <?php if($page == 'purchases' || $page == 'purchases_add' ){ echo "active menu-open"; } ?>">

          <a href="#"><i class="fa fa fa-shopping-cart"></i> <span>Sales</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">
            <li class="<?php if($page == 'purchases'){ echo "active"; } ?>"><a href="purchases.php"><i class="fa fa-circle-o"></i> Sale Orders List</a></li>

            <li class="<?php if($page == 'purchases_add'){ echo "active"; } ?>"><a href="purchases_add.php"><i class="fa fa-circle-o"></i> Add Sale Orders</a></li>
          </ul>

        </li>

		<!-- <li class="<?php if($page == 'credit_sales'){ echo "active"; } ?>"><a href="credit_sales.php"><i class="fa fa-shopping-cart"></i> <span>Credit Sales</span></a></li> -->



		<!-- Purchases -->

        <li class="treeview <?php  if($page == 'expenses_categories_add' ||  $page == 'expenses_categories'||  $page == 'expenses'||  $page == 'expenses_add') { echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa fa-plus"></i> <span>Expenses</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">
             <li class="<?php if($page == 'expenses_categories'){ echo "active"; } ?>"><a href="expenses_categories.php"><i class="fa fa-circle-o"></i> Expenses Category</a></li>

            <li class="<?php if($page == 'expenses_categories_add'){ echo "active"; } ?>"><a href="expenses_categories_add.php"><i class="fa fa-circle-o"></i> Add Expenses Category</a></li>
            <li class="expenses"></li>

            <li class="<?php if($page == 'expenses'){ echo "active"; } ?>"><a href="expenses.php"><i class="fa fa-circle-o"></i> List Expenses</a></li>
            

			

          </ul>

        </li>



		<!-- People -->

        <li class="treeview <?php if($page == 'drivers' || $page == 'drivers_add' || $page == 'users' || $page == 'users_add' || $page == 'suppliers' || $page == 'suppliers_add' || $page == 'customers' || $page == 'customers_add') { echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa-users"></i> <span>People</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">
			<li class="customers"></li>

            <li class="<?php if($page == 'customers'){ echo "active"; } ?>"><a href="customers.php"><i class="fa fa-circle-o"></i> List Customer</a></li>
            <li class="<?php if($page == 'customers_add'){ echo "active"; } ?>"><a href="customers_add.php"><i class="fa fa-circle-o"></i> Add Customer</a></li>

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
          </ul>

        </li>



		<!-- Reports -->

<!--         <li class="treeview <?php if($page == 'reports_settle_sales' || $page == 'reports_tax' || $page == 'reports_item_wise' || $page == 'wastage_expired_ingredient' || $page == 'top_ratings' || $page == 'poor_ratings' || $page == 'top_selling_product' || $page == 'reports_driver' ||  $page == 'reports_current_item_wise' ||  $page == 'reports_category_wise' ||  $page == 'reports_current_category_wise'){ echo 'active menu-open'; } ?>">

          <a href="#"><i class="fa fa-bar-chart-o"></i> <span>Reports</span>

            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              </span>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if($page == 'reports_settle_sales'){ echo "active"; } ?>"><a href="reports_settle_sales.php"><i class="fa fa-circle-o"></i>Settle Sales</a></li>

          </ul>

        </li> -->


		
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