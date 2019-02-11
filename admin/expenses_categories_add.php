<?php 
session_start();
include("../functions.php");
include_once("../config.php");
chkAdminLoggedIn();
connect_dre_db();

$cat_id = '';
$parent_id = 0;
$expense_name = '';
$category_slug = '';
//$category_details = '';
//$category_img = '';
$action = 'add';
$update_img_tbl = false;
//$category_img_dir = "../category_images/";

if(isset($_POST['category_post'])) {
	//$parent_id = $_POST['parent_id'];
	$expense_name = $_POST['expense_name'];
	//$category_slug = seoUrl($expense_name);
    //$category_details = $_POST['category_details'];
	//$category_img = $_FILES['category_img']['name'];

	//$category_details=str_replace('\r\n', '', $category_details);
	//$category_details =stripslashes($category_details);
	
	//print_r($_POST);die;
	
	/*if (file_exists($_FILES['category_img']['tmp_name'])) {		
		$userfile_name = "_category";//$_FILES["category_image"]["name"];
		$objectname = "category_img";
		if (isset($_FILES[$objectname]['name'])) {
			$path = $category_img_dir;			
			$new_width = 340;
			$new_height = 330;
			$userfile_name = saveCategoryImages($userfile_name,$objectname,$path,$new_height,$new_width);
			if(!$userfile_name) {
				redirect('add_category.php?sts=invalid');
				exit;
			}
			$update_img_tbl = true;
		}
	}*/
	if(isset($_POST['cat_id']) && $_POST['cat_id'] > 0) {
		$cat_id = $_POST['cat_id'];
		$qry = "UPDATE expense_category SET expense_name = '".safeTextIn($expense_name)."' WHERE id = '$cat_id'";
		if(mysqli_query($GLOBALS['conn'], $qry)){
		}
		redirect('expenses_categories.php?resp=updatesucc');
	}
	else {
		$qry = "INSERT INTO expense_category (expense_name) VALUES ('".safeTextIn($expense_name)."')";
		//echo $qry;
		if(mysqli_query($GLOBALS['conn'], $qry)){		
			$cat_id = mysqli_insert_id($GLOBALS['conn']);
}
	}

	/*if (file_exists($_FILES['category_img']['tmp_name'])) {		
		$userfile_name = "_category";
		$objectname = "category_img";
		if (isset($_FILES[$objectname]['name'])) {
			$path = $category_img_dir;
			$new_width = 340;
			$new_height = 330;
			$userfile_name = saveCategoryImages($userfile_name, $objectname, $path, $new_height, $new_width);
			$qry = "UPDATE category SET category_img = '$userfile_name' WHERE id = '$cat_id'";
			if(mysqli_query($GLOBALS['conn'], $qry)){
			}			
		}
	}*///die;
		
	redirect('expenses_categories.php?resp=addsucc');
}

if(isset($_GET['act']) && $_GET['act'] != '' && isset($_GET['id']) && $_GET['id'] > 0) {	
	$action = $_GET['act'];
	$cat_id = $_GET['id'];
	if($action == 'edit') {
		$edit_query = "SELECT * FROM expense_category WHERE id = '$cat_id'";
		$run_edit = mysqli_query($GLOBALS['conn'], $edit_query);		
		while ($edit_row = mysqli_fetch_array($run_edit)) {
			$cat_id = $edit_row['id'];
			//$parent_id = $edit_row['parent_id'];
			$expense_name = $edit_row['expense_name'];
			//$category_slug = $edit_row['category_slug'];
			//$category_img = $edit_row['category_img'];
			//$category_details = $edit_row['category_details'];
		}
	}
}

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <?php include("common/header.php"); ?>     
  <?php include("common/header-scripts.php"); ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include("common/topbar.php"); ?>
  
  <?php include("common/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Expense Categories
        <!--<small>Optional description</small>-->
      </h1>      
	  <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="expenses_categories.php">Expense Categories</a></li>
        <li class="active">Add Expense Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Please fill in the details below</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">              
			  <form action="expenses_categories_add.php" method="post" id="categoryForm">
					<input type="hidden" name="category_post" value="1" />
					<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id ?>" />			
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" name="expense_name" id="expense_name" value="<?php echo safeTextOut(htmlspecialchars($expense_name)); ?>" placeholder="Enter ...">
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<?php 
							if(isset($action) && $action == 'edit') { 
							?>
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="expenses_categories.php" class="btn btn-primary">Cancel</a>
						<?php } 
							else { 
							?>
						<button type="submit" class="btn btn-primary">Add Expense category</button>
						<?php 
							} 
							?>
					</div>
				</form>
            </div>
            <!-- /.col -->
		  <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <!--Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
          the plugin.-->
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("common/footer.php"); ?>

  <?php include("common/sidebar-right.php"); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<?php include("common/footer-scripts.php"); ?>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
	 
 <script type="text/javascript">
$('#categoryForm').bootstrapValidator({
message: 'This value is not valid',
fields: {
	
	expense_name: {
validators: {
	notEmpty: {
		message: 'This title is required'
	}
}
	},
				
	}
});
	</script>
</body>
</html>