<?php 
session_start();
include("../functions.php");
include_once("../config.php");
chkAdminLoggedIn();
connect_dre_db();
//$getUserDetails = getUserDetails($_SESSION['user_id']);
//$getUserDetails = explode(",", $getUserDetails['user_action']);
//if (!in_array('view_stock',$getUserDetails)){
	//redirect('index.php');
//}

$item_id = (isset($_GET['item_id']) && $_GET['item_id'] !='') ? $_GET['item_id'] : '';

if(isset($_GET['act']) && $_GET['act'] != '' && isset($_GET['id']) && $_GET['id'] > 0) {	
	$action = $_GET['act'];
	$cat_id = $_GET['id'];
	if($action == 'delete') {
		$qry="UPDATE item_category SET active = '0' WHERE id = $cat_id";
		if(mysqli_query($GLOBALS['conn'], $qry)){
			redirect('stock_product.php?resp=succ');
		}
	}
}

if(isset($_POST['stock_post'])) {
	foreach($_POST as $key => $stock) {
		if($key != 'stock_post' && $stock != ''){
			$result = mysqli_query($GLOBALS['conn'], "SELECT stock FROM items WHERE id = '$key'");
			while($row = mysqli_fetch_array($result)) {
				$final_stock = $row['stock']+$stock;
			}
			mysqli_query($GLOBALS['conn'], "UPDATE items SET stock = '$final_stock' WHERE id = '$key'");
		}
	}
	redirect('stock_product.php?resp=addsucc');
}

function getStockPost($item_id = '')
{
	$qry="SELECT i.id, i.name, i.stock, i.price FROM items AS i LEFT JOIN item_category AS c ON c.id = i.cat_id WHERE 1";
	if($item_id){
	    $qry .= " AND i.id = $item_id";
	}
	$qry .= " AND i.active = '1' AND c.active = '1' ORDER BY i.name ASC";
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

function getitemdet()
{
    $items = array();
	$qry="SELECT i.id, i.name, i.stock, i.price FROM items AS i LEFT JOIN item_category AS c ON c.id = i.cat_id WHERE i.active = '1' AND c.active = '1' ORDER BY i.name ASC";
	//echo $qry;
	$run = mysqli_query($GLOBALS['conn'], $qry);  
     while ($row = mysqli_fetch_array($run)) {
       $items[$row['id']] = $row['name'];
     }
     return $items;
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
	 <style type='text/css'>
		/*@media print
		{
			.print_display {display:none !important;}
		}*/
		
		</style>
		<?php include("common/header.php"); ?>     
		<?php include("common/header-scripts.php"); ?>
		<style>.counter-bottom-box { bottom: 0px; margin-top: 10%; position: fixed; z-index: 99; visibility: visible; margin-left:60em;} </style>
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
						Stock
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Stock</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<!-- <a href="#" class="btn btn-default btn-sm toggle_form pull-right">Show/Hide Form</a> -->
									<h3 class="box-title">Manage Stock</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<?php include("common/info.php"); ?>
									<div id="form" class="panel panel-warning" style="display: block;">
										<div class="panel-body">
											<form action="stock_product.php" accept-charset="utf-8">
													<div class="col-sm-3">
														<div class="row form-group">												
															<select class="select2" name="item_id" id="item_id">
																<?php $itemss = getitemdet();
																 foreach($itemss as $key=>$cus) { 
																	 $selected = ($key == $item_id) ? "selected = selected" : "";?>
																  <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $cus; ?></option>
																 <?php } ?>
															</select>
														</div>
													</div>
														<div class="col-sm-12">
														<button type="submit" class="btn btn-primary">Submit</button>
														<a href="stock_product.php" class="btn btn-default">Reset</a>
													</div>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right pr0">
											<div class="dt-buttons btn-group">
												<?php if($item_id != '') { ?>
													<span title="Excel" class="print2" style="font-size: 20px;"><a target="_blank" href="excel_export_stock.php?sale=Counter Sale&order_type=counter_sale&get_type=excel&item_id=<?php echo $item_id; ?>" class="btn btn-default buttons-csv buttons-html5"><span>Excel</span></a></span>
													<?php } else { ?>
													<span title="Excel" class="print2" style="font-size: 20px;"><a target="_blank" href="excel_export_stock.php?sale=Counter Sale&order_type=counter_sale&get_type=excel" class="btn btn-default buttons-csv buttons-html5"><span>Excel</span></a></span>
													<?php } ?>
												
												<a class="btn btn-default buttons-print buttons-html5 print_me" tabindex="0" aria-controls="SLData" href="#"><span>Print</span></a>
											</div>
										</div>
									</div>
											
									<br>							
									<form action="stock_product.php"  method="post">
									<table id="example2" class="table table-bordered table-hover">
										<thead>
										<tr>
											<th>#</th>
											<th>Item name</th>
											<th>Stock</th>
											<?php //if (in_array('edit_stock',$getUserDetails)){ ?>
											<th>New Stock</th>
											<?php //} ?>
											<th>Unit price</th>
											<th>Price</th>
										</tr>
									</thead>
									
									<input type="hidden" name="stock_post" value="1" >
									
										<tbody>
										<?php
											$prs = getStockPost($item_id);											
											if($prs != false) {
												$pcount = mysqli_num_rows($prs);
												if($pcount > 0) {
													for($p = 0; $p < $pcount; $p++) {
														$prow = mysqli_fetch_object($prs);
														$cat_id = $prow->id;
														$name = $prow->name;
														$stock = $prow->stock;
														$price = $prow->price;
														echo "<tr>";
														echo "<td>".($p+1)."</td>";
														echo "<td>".safeTextOut($name)."</td>";
														echo "<td>".$stock."</td>";
														//if (in_array('edit_stock',$getUserDetails)){
														echo "<td><input name='$cat_id' type='number' value=''></td>";
														//}
														echo "<td>".number_format((float)$price, 2, '.', '')."</td>";
														echo "<td>".number_format((float)$stock*$price, 2, '.', '')."</td>";
														echo "</tr>";
													}
												}
											}
											else {
												echo "<tr>";
												echo "<td>No Item found to list.</td>";
												echo "</tr>";
											}
										?>						
									</tbody>
										
										<tr>											
											<td colspan=7 ><input type="submit" class="btn btn-primary counter-bottom-box" value='Stock Update' /> </td>
										</tr>
										</tfoot>
									</table>
									</form>								
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

<div class="col-sm-1 col-sm-offset-11">

</div>


<!-- /.content-wrapper -->
<?php include("common/footer.php"); ?>
<?php include("common/sidebar-right.php"); ?>
		
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<?php include("common/footer-scripts.php"); ?>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
	Both of these plugins are recommended to enhance the
	user experience. -->

<div id='stock_prodct' style="display:none;">

<table id="example2" class="table" border="1">
	<thead>
		<tr>
			<th>#</th>
			<th>Item name</th>	
			<th>Stock</th>		
			<th>Unit price</th>
			<th>Price</th>
														
		</tr>
	</thead>
	<tbody>
		<?php
		$prs = getStockPost($item_id);											
		if($prs != false) {
		$pcount = mysqli_num_rows($prs);
		if($pcount > 0) {
			for($p = 0; $p < $pcount; $p++) {
				$prow = mysqli_fetch_object($prs);
				$cat_id = $prow->id;
				$name = $prow->name;
				$stock = $prow->stock;
				$price = $prow->price;
		echo "<tr>";
		echo "<td>".($p+1)."</td>";
		echo "<td>".$name."</td>";
		echo "<td>".$stock."</td>";
		echo "<td>".number_format((float)$price, 2, '.', '')."</td>";
		echo "<td>".number_format((float)$stock*$price, 2, '.', '')."</td>";?>
	
		<?php
		}
		}
		}
		else {
		echo "<tr>";
		echo "<td>No Stock fond to list.</td>";
		echo "</tr>";
		} ?>								
	</tbody>
</html>

</div>
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
	 });
	 $(document).on('click', '.print_me', function(e) {
			//alert(123);
		$(".show_titles").show();
		$('.display_print').hide();
		var content = document.getElementById('stock_prodct').innerHTML;		
		var win = window.open();	
		//win.document.write('<link href="css/style_v1.css" rel="stylesheet">');
		//win.document.write('<link href="core/framework/libs/pj/css/pj-table.css" rel="stylesheet" type="text/css" />');			
		win.document.write(content);		
		win.print();		
		win.window.close();
	$('.display_print').hide();
	});

	 $( "#submit_stock" ).click(function() {
	  $( "#pageForm" ).submit();
	});
</script>
	</body>
</html>