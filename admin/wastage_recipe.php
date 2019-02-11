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
				redirect('products.php?resp=succ');
			}
		}
	}
		
	function getSettleSale(){
		$shop_id = $_SESSION['admin_shop_id'];
		$user_id = $_SESSION['admin_user_id'];
		$result_arr = array();
		$result=mysqli_query($GLOBALS['conn'], "SELECT * from ".DB_PRIFIX."settle_sale where user_id='$user_id' && shop_id='$shop_id' ORDER BY id desc limit 1");
		if($result){
		
				while ($row = mysqli_fetch_assoc($result)) {
					   $result_arr[] = $row;			
					}
					return $result_arr;	
		}else{
		 return $result_arr;
		}
	}

	$last_settle_sale=getSettleSale();
	//print_r($last_settle_sale);exit;
	//$inputs['from_date']=;
	

	function getSaleOrderItemTotalQty($from_date ='', $to_date=''){					

		$qry="SELECT SUM(soi.qty) as sale_count FROM sale_order_items as soi LEFT JOIN sale_orders as so ON (so.id = soi.sale_order_id) WHERE 1"; 
	
		if($from_date != '' && $to_date != '') {
			$qry .= " AND so.ordered_date BETWEEN '$from_date' AND '$to_date' ";
		}		
		//echo $qry; 
		$sale_count = 0;
		$result=mysqli_query($GLOBALS['conn'], $qry);
		  if ($result) {
			
			while ($row = mysqli_fetch_assoc($result)) {
				$sale_count = $row['sale_count'];			
			}
		  }
		return $sale_count;
	}

	$total_no_of_sale = (isset($_GET['total_no_of_sale']) && $_GET['total_no_of_sale'] !='') ? $_GET['total_no_of_sale'] : '';
	$from_date1 = (isset($last_settle_sale[0]['settle_date']) && $last_settle_sale[0]['settle_date'] !='') ? $last_settle_sale[0]['settle_date'] : '';
	$to_date1 = (isset($_GET['to_date']) && $_GET['to_date'] !='') ? $_GET['to_date'] : date('Y-m-d 23:59:59');

	$sale_count = getSaleOrderItemTotalQty($from_date1, $to_date1);

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
						Wastage Recipe
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Wastage Recipe</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<!-- <a href="#" class="btn btn-default btn-sm toggle_form pull-right">Show/Hide Form</a> -->
									<h3 class="box-title">Wastage Recipe</h3>
								</div>
								<!-- /.box-header -->
								<!-- <div class="box-body">
									<div id="form" class="panel panel-warning" style="display: block;">
										<div class="panel-body">
											<form action="wastage_recipe.php" accept-charset="utf-8">
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label>Start date</label>
															<div class="input-group date">
																<div class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</div>
																<input type="text" name="from_date" class="form-control datepicker pull-right" id="from_date" value="<?php echo $from_date1; ?>">
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>End date</label>
															<div class="input-group date">
																<div class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</div>
																<input type="text" name="to_date" class="form-control datepicker pull-right" id="to_date" value="<?php echo $to_date1; ?>">
															</div>
														</div>
													</div>
													<div class="col-sm-12">
														<button type="submit" class="btn btn-primary">Submit</button>
														<a href="wastage_recipe.php" class="btn btn-default">Reset</a>
													</div>
												</div>
											</form>
										</div>
									</div> -->
									<div class="row" style="margin-bottom: 5px;display: none;" >
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right pr0">
											<div class="dt-buttons btn-group">
												<a class="btn btn-default buttons-print buttons-html5 print_me" tabindex="0" aria-controls="SLData" href="#"><span>Print</span></a>
												<!--<a class="btn btn-default buttons-copy buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>Copy</span></a>
												<a class="btn btn-default buttons-excel buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>Excel</span></a>-->
												<a target="_blank"  href="export_settle_sale.php?sale=Counter Sale&order_type=counter_sale&get_type=excel&from_date=<?php echo $from_date1; ?>&to_date=<?php echo $to_date1; ?>" class="btn btn-default buttons-csv buttons-html5 export" tabindex="0" aria-controls="SLData" href="#"><span>CSV</span></a>
												<!--<a class="btn btn-default buttons-pdf buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>PDF</span></a>
												<a class="btn btn-default buttons-collection buttons-colvis" tabindex="0" aria-controls="SLData" href="#"><span>Columns</span></a>-->
											</div>
										</div>
									</div>
									<div id='item_wise_repots'>									
									<div class="row">
										<div class="col-md-6">
											<form action="customers_add.php" method="post" id="customerForm">
												<input type="hidden" name="customer_post" value="1" />												
												<input type="hidden" name="from_date" class="form-control pull-right" id="from_date" value="<?php echo $from_date1; ?>">
												<input type="hidden" name="to_date" class="form-control pull-right" id="to_date" value="<?php echo $to_date1; ?>">
												<div class="form-group">
													<label>Total No Of Items Prepared</label>
													<input type="text" class="form-control" name="total_no_items_prepared" id="total_no_items_prepared" value="">
												</div>
												<div class="form-group">
													<label>Total No of Sales</label>
													<input type="text" class="form-control" name="total_no_of_sale" id="total_no_of_sale" value="<?php echo $sale_count; ?>">
												</div>
												<div class="form-group">
													<label>Total No of Wastage</label>
													<input type="text" class="form-control" name="total_no_of_wastage" id="total_no_of_wastage" value="">
												</div>
												Total Wastage: <span id='tot_wastage'></span>
												<!-- Total Extra Sale: <span id='tot_extra_sale'></span> -->
												<div class="form-group">												
													<button type="submit" class="btn btn-primary">Submit</button>												
												</div>
											</form>
										</div>
									</div>
								</div>
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
		<script type="text/javascript">			
			
			$(document).on('click', '.print_me', function(e) {
				$(".show_titles").show();
				var content = document.getElementById('item_wise_repots').innerHTML;
				var win = window.open();	
				//win.document.write('<link href="css/style_v1.css" rel="stylesheet">');
				//win.document.write('<link href="core/framework/libs/pj/css/pj-table.css" rel="stylesheet" type="text/css" />');			
				win.document.write(content);	
				win.print();
				$(".show_titles").hide();
				win.window.close();
			});
			
			//export
			$(".show_titles").hide();
			function exportTableToCSV($table, filename) {
			   var $rows = $table.find('tr:has(th),tr:has(td)'),
				// Temporary delimiter characters unlikely to be typed by keyboard
				// This is to avoid accidentally splitting the actual contents
				tmpColDelim = String.fromCharCode(11), // vertical tab character
				tmpRowDelim = String.fromCharCode(0), // null character
				// actual delimiter characters for CSV format
				colDelim = '","',
				rowDelim = '"\r\n"',

				// Grab text from table into CSV formatted string
				csv = '"' + $rows.map(function (i, row) {
				 var $row = $(row),
				  $cols = $row.find('th,td');

				 return $cols.map(function (j, col) {
				  var $col = $(col),
				   text = $col.text();

				  return text.replace(/"/g, '""'); // escape double quotes

				 }).get().join(tmpColDelim);

				}).get().join(tmpRowDelim)
				 .split(tmpRowDelim).join(rowDelim)
				 .split(tmpColDelim).join(colDelim) + '"',

				// Data URI
				csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

			   $(this)
				.attr({
				'download': filename,
				 'href': csvData,
				 'target': '_blank'
			   });
				$(".show_titles").hide();
		  }

		  // This must be a hyperlink  
			// $(".export").on('click', function (event) {
		   $(document).on('click', '.excel_me', function(event) {
				$(".show_titles").show();
				exportTableToCSV.apply(this, [$('#item_wise_repots>table'), 'export_settle_reports.csv']);        
		  });

		  $(document).on('click', '#total_no_of_wastage', function(event) {
				var tot_wastage = $(this).val();
				var tot_sale = <?php echo $sale_count; ?>;
				var grand_tot = tot_sale - 
				$('#tot_wastage').html();
		  });

		</script>
	</body>
</html>