<?php 
session_start();
include("../functions.php");
include_once("../config.php");
chkAdminLoggedIn();
connect_dre_db();

if(isset($_GET['act']) && $_GET['act'] != '' && isset($_GET['id']) && $_GET['id'] > 0) {	
	$action = $_GET['act'];
	$cat_id = $_GET['id'];
	if($action == 'delete') {
		$qry="UPDATE expense_category SET active = '0' WHERE id = $cat_id";
		if(mysqli_query($GLOBALS['conn'], $qry)){
			redirect('expenses_categories.php?resp=succ');
		}
	}
}

function getCategoriesPost()
{
	$qry="SELECT * FROM expense_category WHERE 1 ORDER BY id DESC";
	//echo $qry;
	$result=mysqli_query($GLOBALS['conn'], $qry);
	$num=mysqli_num_rows($result);
	//echo "total result ".$num;
	if($num>0)
	{
		return $result;
	}
	else
	return false;
}
//$category_img_dir = "../category_images/";
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
        Expense Categories
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Expense Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Expense Categories</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<?php include("common/info.php"); ?>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
              <tbody>
				<?php
					$prs = getCategoriesPost();											
					if($prs != false) {
						$pcount = mysqli_num_rows($prs);
						if($pcount > 0) {
							for($p = 0; $p < $pcount; $p++) {
								$prow = mysqli_fetch_object($prs);
								$cat_id = $prow->id;
								$expense_name = $prow->expense_name;
								echo "<tr>";
								echo "<td>".($p+1)."</td>";
								echo "<td>".safeTextOut($expense_name)."</td>";
								echo "<td>";									
									echo '<div class="text-center">';
									  echo '<div class="btn-group">';
										echo '<a href="expenses_categories_add.php?id='.$cat_id.'&act=edit" title="Edit Category" class="tip btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>'; ?>
										<!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#delete<?php echo $prow->id; ?>" title="Delete Expense Category" class="tip btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a> -->
										<?php
									  echo "</div>";
									echo "</div>";
								echo "</td>";								
								echo "</tr>"; ?>
								<div class="modal fade in" id="delete<?php echo $prow->id; ?>" >
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span></button>
												<h4 class="modal-title">Expense Category Delete</h4>
											</div>
											<div class="modal-body text-center">
												<h2 class="text-danger">Are You Sure Want to Delete ?</h2>
												<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
													<input type="hidden" name="id" value="<?php echo $prow->id; ?>">
													<input type="hidden" name="act" value="delete">
													<br>
													<button type="submit" class="btn btn-danger ">YES</button>
													<button type="button" class="btn btn-default " data-dismiss="modal">NO</button>
												</form>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
								<?php
							}
						}
					}
					else {
						echo "<tr>";
						echo "<td>No Item Category found to list.</td>";
						echo "</tr>";
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
function deleteIt(id)
{
    if(id && confirm('Are you sure you want to delete this expenses category?'))
    {
        window.location.href = site_url+'/admin/expenses_categories.php?id='+id+'&act=delete';
    }
}
</script>
</body>
</html>