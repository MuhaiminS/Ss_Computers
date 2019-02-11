<?php 
	session_start();
	include("../functions.php");
	include_once("../config.php");
	chkAdminLoggedIn();
	connect_dre_db();
	if(isset($_GET['act']) && $_GET['act'] != '' && isset($_GET['id']) && $_GET['id'] > 0) {	
		$action = $_GET['act'];
		$id = $_GET['id'];
		if($action == 'delete') {
			$qry = "UPDATE items SET active = '0' WHERE id = $id";
			if(mysqli_query($GLOBALS['conn'], $qry)){
				redirect('product.php?resp=deletesucc');
			}
		}
	}
	$items_img_dir = "../item_images/";
	function getcategoryName($category_id)
	{
		$where = "WHERE id = '$category_id'";
		$category = getnamewhere('category', 'category_title', $where);
		return $category;
	}
	function getCategoryList()
	{
		$service = array();
		$query="SELECT * FROM item_category WHERE active != '0' ORDER BY category_title ASC";
		$run = mysqli_query($GLOBALS['conn'], $query);
		while($row = mysqli_fetch_array($run)) {
			$cat_id = $row['id'];
			$service[$cat_id]['cat_id'] = $row['id'];
			$service[$cat_id]['category_title'] = $row['category_title'];
		}
		return $service;	
	
	}
	$name = (isset($_GET['name']) && $_GET['name'] !='') ? $_GET['name'] : '';
	$category = (isset($_GET['category']) && $_GET['category'] !='') ? $_GET['category'] : '';
	function getItemsPost($name, $category)
	{	
		$qry="SELECT i.id,i.price,i.cost_price,i.active,i.name,i.other_name,i.image,i.cat_id,c.category_title, i.stock FROM items AS i LEFT JOIN item_category AS c ON c.id = i.cat_id WHERE i.active = '1' AND c.active = '1'";
		if($category != ''){
			$qry .=" AND c.id = $category";
		}
		if($name != ''){
			$qry .=" AND i.name LIKE '%$name%'";
		}
		//$qry .=" ORDER BY i.id DESC LIMIT $pageLimit, $setLimit";
		//echo $qry;
		$result=mysqli_query($GLOBALS['conn'], $qry);
		if($result)
		{
			return $result;
		}
		else
		return false;
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
						Products
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Products</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<a href="#" class="btn btn-default btn-sm toggle_form pull-right">Show/Hide Form</a>
									<h3 class="box-title">Manage Products</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<?php include("common/info.php"); ?>
									<div id="form" class="panel panel-warning" style="display: block;">
										<div class="panel-body">
											<form action="product.php" accept-charset="utf-8">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label for="name">Product name</label> <input type="text" name="name" value="<?php echo $name; ?>" class="form-control tip" id="name" placeholder="Product Name">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label>Category</label>
															<select name="category" id="category" class="form-control select2" style="width: 100%;">
																<option value="">  --Select category--  </option>
																<?php $cat_list = getCategoryList();
																	foreach ($cat_list as $cat)
																	{ 
																		?>
																<option value="<?php echo $cat['cat_id']; ?>" <?php echo ($category == $cat['cat_id']) ? ' selected="selected"' : Null; ?> ><?php echo $cat['category_title']; ?></option>
																<?php
																	}
																	?>
															</select>
														</div>
													</div>
													<div class="col-sm-12">
														<button type="submit" class="btn btn-primary">Submit</button>
														<a href="product.php" class="btn btn-default">Reset</a>
													</div>
												</div>
											</form>
										</div>
									</div>
									<table id="example2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Category</th>
												<th>Product Name</th>
												<th>Image</th>
												<th>Price</th>
												<th>Cost Price</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$prs = getItemsPost($name, $category);										
												if($prs != false) {
													$pcount = mysqli_num_rows($prs);
													if($pcount > 0) {
														for($p = 0; $p < $pcount; $p++) {
															$prow = mysqli_fetch_object($prs);
															$id = $prow->id;
															$category_title = $prow->category_title;
															$name = $prow->name;
															$price = $prow->price;
															$price = $prow->price;
															$stock = $prow->stock;
															$image = $prow->image; 
															$cost_price = $prow->cost_price;?>
											<tr>
												<td><?php echo $id; ?></td>
												<td><?php echo $category_title; ?></td>
												<td><?php echo $name; ?></td>
												<td><img src="<?php echo $items_img_dir.$image; ?>" width="50" height="50"  alt="<?php echo $name ?>" /></td>
												<td align="right"><?php echo $price; ?></td>
												<td align="right"><?php echo $cost_price; ?></td>
												<td>
													<div class="text-center">
														<div class="btn-group">
															<!--<a href="#" title="View" class="tip btn btn-primary btn-xs" data-toggle="ajax"><i class="fa fa-file-text-o"></i></a>
																<a href="#" title="Print Bill" class="tip btn btn-default btn-xs" data-toggle="ajax-modal"><i class="fa fa-print"></i></a>
																<a class="tip image btn btn-primary btn-xs" id="Milkshajr (123456789)" href="#" title="View Image"><i class="fa fa-picture-o"></i></a>-->
															<a href="product_add.php?id=<?php echo $id ?>&act=edit" title="Edit Product" class="tip btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
															<a href="javascript:void(0)" data-toggle="modal" data-target="#delete<?php echo $prow->id; ?>" title="Delete Product" class="tip btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
														</div>
													</div>
												</td>
											</tr>
											<div class="modal fade in" id="delete<?php echo $prow->id; ?>" >
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span></button>
															<h4 class="modal-title">Product Delete</h4>
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
												echo "<td>No items found to list.</td>";
												echo "</tr>";
												}?>									
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
			var site_url = "<?php echo getServerURL(); ?>";
			function deleteIt(id)
			{
			    if(id && confirm('Are you sure you want to delete this Item?'))
			    {
			        window.location.href = site_url+'/admin/products.php?id='+id+'&act=delete';
			    }
			}
		</script>
		<script>
			$('.stock_update').on('click', function() {
			var product_id = $(this).attr('id')
			var form_data = $('#stock_update_'+product_id).serialize();
			$.ajax({
			url: 'stock_update.php',
			type: 'post',
			dataType: 'json',
			data: form_data,
			success: function(json) {
				alert("updated!");
				location.reload();			
			}
			});
			//}
			}); 
		</script>
	</body>
</html>