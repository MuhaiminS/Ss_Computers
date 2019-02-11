<?php 
session_start();
include("../functions.php");
include_once("../config.php");
chkAdminLoggedIn();
connect_dre_db();
$server_url = getServerURL();

function getUserName($user_id)
{
	$where = "WHERE id = '$user_id'";
	$service = getnamewhere('users', 'user_name', $where);
	return $service;
}

function getShopsList()
{
	$service = array();
	$query="SELECT * FROM locations_shops ORDER BY id ASC";
	$run = mysql_query($query);
	while($row = mysql_fetch_array($run)) {
		$shop_id = $row['id'];
		$service[$shop_id]['shop_id'] = $row['id'];
		$service[$shop_id]['shop_name'] = $row['shop_name'];
	}
	return $service;	

}

function getShopName($shop_id)
{
	$where = "WHERE id = '$shop_id'";
	$service = getnamewhere('locations_shops', 'shop_name', $where);
	return $service;
}


if(isset($_GET["page"])) {
	$page = (int)$_GET["page"];
} else {
	$page = 1;
}
$setLimit = 50;
$pageLimit = ($page * $setLimit) - $setLimit;

function getSettleSales($from_date ='', $to_date='', $shop='', $pageLimit='', $setLimit='', $export="")
{
	$date = date('Y-m-d');
	$qry="SELECT *, DATE_FORMAT(settle_date,'%Y-%m-%d') as settle_dat FROM settle_sale WHERE id != ''"; 
	
	if($shop != ''){
		$qry .=" AND shop_id = '$shop'";
	}
	
	if($from_date != '' && $to_date != '' ) {
		
		$qry .= " AND settle_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' ";		
	} 
	if($from_date != '' && $to_date == '' ) {
		$qry .= " AND settle_date BETWEEN '$from_date 00:00:00' AND '$date 23:59:59' ";
	}

	if($from_date == '' && $to_date != '' ) {
		$qry .= " AND settle_date <= '$to_date 23:59:59'";
	}
	if($export == '') {
		$qry .=" ORDER BY settle_date DESC LIMIT $pageLimit, $setLimit";
	} else {
		$qry .=" ORDER BY settle_date DESC ";
	}
	//echo $qry;
	$result=mysqli_query($GLOBALS['conn'], $qry);
	//$num=mysql_num_rows($result);	//echo "total result ".$num;
	if($result)
	{
		return $result;
	}
	else
	return false;
}

$shops = (isset($_GET['shop']) && $_GET['shop'] !='') ? $_GET['shop'] : '';
$from_date1 = (isset($_GET['from_date']) && $_GET['from_date'] !='') ? $_GET['from_date'] : '';
$to_date1 = (isset($_GET['to_date']) && $_GET['to_date'] !='') ? $_GET['to_date'] : ''; 

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
						Report - Settle Sale
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Settle Sale</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Settle Sale</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div id="form" class="panel panel-warning" style="display: block;">
										<div class="panel-body">
											<form action="reports_settle_sales.php" accept-charset="utf-8">
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
														<a href="reports_settle_sales.php" class="btn btn-default">Reset</a>
													</div>
												</div>
											</form>
										</div>
									</div>									
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right pr0">
											<div class="dt-buttons btn-group">
												<a class="btn btn-default buttons-print buttons-html5 print_me" tabindex="0" aria-controls="SLData" href="#"><span>Print</span></a>
												<!--<a class="btn btn-default buttons-copy buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>Copy</span></a>
												<a class="btn btn-default buttons-excel buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>Excel</span></a>-->
												
											</div>
										</div>
									</div>
									<div id='settle_sale_repots' >
									<table class="show_titles" style="display:none;">
										   <tr><td>Settle Sale Reports</td></tr>										  
										   <!-- <tr><td>From Date: <?php echo $from_date1; ?>  To Date: <?php echo $to_date1; ?></td></tr>				    -->
									</table>
									<table id="example2" class="table table-bordered table-hover" border="1px solid black">
										<thead>
											<tr>
												<th>#</th>
												<th>Settle Date</th>
												<th>User Name</th>													
												<th>Shop</th>
												<th>Cash Sale</th>
												<th>Card Sale</th>
												<th>Delivery Sale</th>
												<th>Total VAT</th>
												<th>Sale Total</th>
												<th>Discount</th>
												<th>Net Total</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody>
											<?php	$grand_total = $total_vat = "0.00";												
													$prs = getSettleSales($from_date1, $to_date1,$shops, $pageLimit, $setLimit, $export="");	
													if($prs != false) {
														$pcount = mysqli_num_rows($prs);
														if($pcount > 0) {
															for($p = 0; $p < $pcount; $p++) {
																$prow = mysqli_fetch_object($prs);
																$id = $prow->id;
																$settle_dat = $prow->settle_dat;
																$cash_sale = ($prow->cash_sale !='') ? $prow->cash_sale :  '0.00' ;
																$card_sale = ($prow->card_sale !='') ? $prow->card_sale :  '0.00' ;
																$delivery_sale = ($prow->delivery_sale !='') ? $prow->delivery_sale : '0.00';
																$discount = ($prow->discount !='') ? $prow->discount :  '0.00' ;
																$user_name = getUserName($prow->user_id);
																$shop_name = getShopName($prow->shop_id);
																$total_without_discount = ($prow->gross_total !='') ? $prow->gross_total :  '0.00' ;
																$total_with_discount = $prow->net_total;
																$vat = $prow->total_vat;
																$total = "0.00";	
																echo "<tr>";
																echo "<td>".$id."</td>";
																echo "<td>".$settle_dat."</td>";
																echo "<td>".$user_name."</td>";	
																echo "<td>".$shop_name."</td>";
																echo "<td>".$cash_sale."</td>";
																echo "<td>".$card_sale."</td>";	
																echo "<td>".$delivery_sale."</td>";
																echo "<td>".$vat."</td>";
																echo "<td>".number_format($total_without_discount, 2)."</td>";
																echo "<td>".$discount."</td>";
																echo "<td>".number_format(($total_without_discount-$discount), 2)."</td>";	
																echo "</tr>";
																$grand_total += $total_without_discount-$discount;
																$total_vat += $vat;
															}
															echo "<tr>";
															echo "<td colspan='7'></td>";
															echo "<td>".number_format($total_vat, 2)."</td>";
															echo "<td colspan='2'></td>";
															echo "<td colspan='1'>".number_format($grand_total, 2)."</td>";
															echo "</tr>";
														}
													}
													else {
														echo "<tr>";
														echo "<td>No Sale found to list.</td>";
														echo "</tr>";
													}
												?>					
										</tbody>
										
									</table>
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
			function deleteIt(id)
			{
			    if(id && confirm('Are you sure you want to delete this category?'))
			    {
			        window.location.href = site_url+'/admin/manage_orders.php?id='+id+'&act=delete';
			    }
			}
			
			$(document).on('click', '.print_me', function(e) {
				$(".show_titles").show();
				var content = document.getElementById('settle_sale_repots').innerHTML;
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
					exportTableToCSV.apply(this, [$('#settle_sale_repots>table'), 'export_settle_reports.csv']);        
			  });

			</script>
	</body>
</html>