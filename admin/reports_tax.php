<?php 
	session_start();
	include("../functions.php");
	include_once("../config.php");
	chkAdminLoggedIn();
	connect_dre_db();
	$server_url = getServerURL();
	
	function getSettleSales($from_date ='', $to_date='')
	{
		$settle = array();
		if($from_date == '' || $to_date == '' ) {
		    return $settle;
		}
		$date = date('Y-m-d');
		$qry="SELECT *, DATE_FORMAT(settle_date,'%Y-%m-%d') as settle_dat, sum(net_total) as net_total, sum(total_vat) as total_vat FROM settle_sale WHERE id != ''"; 
		
		if($from_date != '' && $to_date != '' ) {
			
			$qry .= " AND settle_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' ";		
		} 
		if($from_date != '' && $to_date == '' ) {
			$qry .= " AND settle_date BETWEEN '$from_date 00:00:00' AND '$date 23:59:59' ";
		}
	
		if($from_date == '' && $to_date != '' ) {
			$qry .= " AND settle_date <= '$to_date 23:59:59'";
		}	
		$qry .=" GROUP BY shop_id ORDER BY settle_date DESC ";
		
		//echo $qry;exit;
		$result=mysqli_query($GLOBALS['conn'], $qry);	
		if($result)
		{
				$settle['settle_dat'] = 0;
				$settle['settle_wit_vat_net_total'] = 0;
				$settle['settle_total_vat'] = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$settle['settle_dat'] = $row['settle_dat'];
				$settle['settle_wit_vat_net_total'] = $row['net_total'];
				$settle['settle_total_vat'] = $row['total_vat'];		
			}
			return $settle;	
		}
		else
		return false;
	}
	
	function getPurchaseOrder($from_date ='', $to_date='')
	{
		$purchase = array();
		if($from_date == '' || $to_date == '' ) {
		    return $purchase;
		}
		$date = date('Y-m-d');
		$qry="SELECT po.purchase_date, sum(tax_amount) as tax_amount, sum(tax) as tax, sum(total_amount) as total_amount FROM purchase_orders po JOIN purchase_order_items as poi ON(po.id = poi.purchase_id) WHERE po.status = 'received'";
		
		if($from_date != '' && $to_date != '' ) {
			
			$qry .= " AND po.purchase_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' ";		
		} 
		if($from_date != '' && $to_date == '' ) {
			$qry .= " AND po.purchase_date >= '$from_date 23:59:59'";
		}
	
		if($from_date == '' && $to_date != '' ) {
			$qry .= " AND po.purchase_date <= '$to_date 23:59:59'";
		}
		$qry .=" ORDER BY po.status DESC";
		//echo $qry;
		$result=mysqli_query($GLOBALS['conn'], $qry);		
		if($result)
		{
			$purchase['purchase_witout_vat_total_amount'] = 0;
			$purchase['purchase_tax_amount'] = 0;
			while($row = mysqli_fetch_assoc($result)) {			
				$purchase['purchase_witout_vat_total_amount'] = $row['total_amount'];
				if($row['tax_amount'] == '' || $row['tax_amount'] == '0') {
					$purchase['purchase_tax_amount'] = ($row['total_amount']/100 * $row['tax']);
				} else {
					$purchase['purchase_tax_amount'] = $row['tax_amount'];
				}
			}
			return $purchase;	
		}
		else
		return false;
	}
	
	function getExpense($from_date ='', $to_date='')
	{
		$expense = array();
		if($from_date == '' || $to_date == '' ) {
		    return $expense;
		}
		$date = date('Y-m-d');
		$qry="SELECT sum(net_total) as net_total, sum(vat_amount) as vat_amount FROM expense WHERE payment_status = 'paid' AND vat_amount != '0'";	
		
		if($from_date != '' && $to_date != '' ) {
			
			$qry .= " AND purchase_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' ";		
		} 
		if($from_date != '' && $to_date == '' ) {
			$qry .= " AND purchase_date >= '$from_date 23:59:59'";
		}
	
		if($from_date == '' && $to_date != '' ) {
			$qry .= " AND purchase_date <= '$to_date 23:59:59'";
		}
		$qry .=" ORDER BY id DESC";
		
		$result=mysqli_query($GLOBALS['conn'], $qry);		
		if($result)
		{
			$expense['expense_with_vat_net_total'] = 0;
			$expense['expense_vat_amount'] = 0;
			while($row = mysqli_fetch_assoc($result)) {			
				$expense['expense_with_vat_net_total'] = $row['net_total'];
				$expense['expense_vat_amount'] = $row['vat_amount'];
			}
			return $expense;	
		}
		else
		return false;
	}
	
	
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
						Report - Tax Report
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Tax Report</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Tax Report</h3>
									<!--<div class="box-tools">
										<div class="input-group input-group-sm" style="width: 150px;">
											<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

											<div class="input-group-btn">
												<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
											</div>
										</div>	
									</div>-->
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div id="form" class="panel panel-warning" style="display: block;">
										<div class="panel-body">
											<form action="reports_tax.php" accept-charset="utf-8">
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
														<a href="reports_tax.php" class="btn btn-default">Reset</a>
													</div>
												</div>
											</form>
										</div>
									</div>
									<?php if($from_date1 != '' && $to_date1 != '' ) { ?>
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right pr0">
											<div class="dt-buttons btn-group">
												<a class="btn btn-default buttons-print buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>Print</span></a>
												<!--<a class="btn btn-default buttons-copy buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>Copy</span></a>
												<a class="btn btn-default buttons-excel buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>Excel</span></a>-->
												<!-- <a class="btn btn-default buttons-csv buttons-html5 export" tabindex="0" aria-controls="SLData" href="#"><span>CSV</span></a> -->
												<!--<a class="btn btn-default buttons-pdf buttons-html5" tabindex="0" aria-controls="SLData" href="#"><span>PDF</span></a>
												<a class="btn btn-default buttons-collection buttons-colvis" tabindex="0" aria-controls="SLData" href="#"><span>Columns</span></a>-->
											</div>
										</div>
									</div>

									<div id="counter_sale_orders">
										
									<table class="show_titles" style="display:none;">
										   <tr><td><?php echo CLIENT_NAME; ?></td></tr>
											<tr><td>Tax Summary</td></tr>
										   <tr><td>For the period from <?php echo $from_date1; ?>  to <?php echo $to_date1; ?></td></tr>
											<tr><td>Cash basis</td></tr>
									</table>
									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Tax</th>
												<th>Net Total</th>
												<th>Tax Collected</th>
												<th>Total Sales</th>
												<th>Net Purchases</th>
												<th>Tax Paid</th>
												<th>Total Purchases</th>
												<th>Tax liability</th>
											</tr>
										</thead>
										<tbody>
											<?php																									
												$settle_det = getSettleSales($from_date1, $to_date1);
												$purchase_det = getPurchaseOrder($from_date1, $to_date1);
												$expense_det = getExpense($from_date1, $to_date1);
												$purchase_expense_without_vat = $purchase_det['purchase_witout_vat_total_amount'] +($expense_det['expense_with_vat_net_total'] - $expense_det['expense_vat_amount']);
												$purchase_expense_tot_vat = ($purchase_det['purchase_tax_amount'] + $expense_det['expense_vat_amount']);
												$purchase_expense_with_vat_tot_amount = ($purchase_det['purchase_witout_vat_total_amount'] + $purchase_det['purchase_tax_amount']) +$expense_det['expense_with_vat_net_total'];
																												
												echo "<tr>";
												echo "<td> VAT 5%</td>";
													echo "<td align='right'>".number_format($settle_det['settle_wit_vat_net_total'] - $settle_det['settle_total_vat'], 2)."</td>";			
													echo "<td align='right'>".number_format($settle_det['settle_total_vat'], 2)."</td>";	
													echo "<td align='right'>".number_format($settle_det['settle_wit_vat_net_total'], 2)."</td>";
													echo "<td align='right'>".number_format(($purchase_expense_without_vat), 2)."</td>";
													echo "<td align='right'>".number_format($purchase_expense_tot_vat, 2)."</td>";
													echo "<td align='right'>".number_format($purchase_expense_with_vat_tot_amount, 2)."</td>";
													echo "<td align='right'>".number_format(($settle_det['settle_total_vat'] - $purchase_expense_tot_vat), 2)."</td>";	
												echo "</tr>";														
												echo "<tr>";
													echo "<td></td>";
													echo "<td align='right'>".number_format($settle_det['settle_wit_vat_net_total'] - $settle_det['settle_total_vat'], 2)."</td>";			
													echo "<td align='right'>".number_format($settle_det['settle_total_vat'], 2)."</td>";	
													echo "<td align='right'>".number_format($settle_det['settle_wit_vat_net_total'], 2)."</td>";
													echo "<td align='right'>".number_format(($purchase_expense_without_vat), 2)."</td>";
													echo "<td align='right'>".number_format($purchase_expense_tot_vat, 2)."</td>";
													echo "<td align='right'>".number_format($purchase_expense_with_vat_tot_amount, 2)."</td>";
													echo "<td align='right'>".number_format(($settle_det['settle_total_vat'] - $purchase_expense_tot_vat), 2)."</td>";	
												echo "</tr>";
												?>                     
										</tbody>
									</table>
									<?php } ?>
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
		<!-- print section start -->
		<div class="box-content no-padding" id="counter_sale_orders_export" style=" display:none;" >
		<div style=" margin: 54px;" >
			<h2 style="text-transform:uppercase;font-size:12px; text-align:center;line-height: 0.5em;$style_print;margin-bottom:20px;"><strong><?php echo CLIENT_NAME; ?></strong></h2>
			<h2 style="text-transform:uppercase;font-weight:700; text-align:center;line-height: 0.5em;$style_print;margin-bottom:20px;"><strong>Tax Summary</strong></h2>
			<h2 style="text-transform:uppercase;font-size:12px; text-align:center;line-height: 0.5em;$style_print;margin-bottom:20px;"><strong>For the period from <?php echo $from_date1; ?>  to <?php echo $to_date1; ?></strong></h2>
			<h2 style="text-transform:uppercase;font-size:12px; text-align:center;line-height: 0.5em;$style_print;margin-bottom:20px;"><strong>Cash basis</strong></h2>
			<table class="table table-striped table-bordered table-hover table-heading no-border-bottom" border="1px solid black" style="margin-bottom:20px;width:100%;border-collapse: collapse;border:unset;">
				<thead>
					<tr style="border-bottom: 2px solid #000;padding:10px;">
						<th style="text-align:center;border:unset !important;padding:10px;"></th>
						<th style="text-align:center;border:unset !important;padding:10px;">Net Total</th>
						<th style="text-align:center;border:unset !important;padding:10px;">Tax Collected</th>													
						<th style="text-align:center;border:unset !important;padding:10px;">Total Sales</th>													
						<th style="text-align:center;border:unset !important;padding:10px;">Net Purchases</th>
						<th style="text-align:center;border:unset !important;padding:10px;">Tax Paid</th>
						<th style="text-align:center;border:unset !important;padding:10px;">Total Purchases</th>
						<th style="text-align:center;border:unset !important;padding:10px;">Tax liability</th>
					</tr>
				</thead>
				<tbody> <?php
					$settle_det = getSettleSales($from_date1, $to_date1);
						$purchase_det = getPurchaseOrder($from_date1, $to_date1);
						$expense_det = getExpense($from_date1, $to_date1);
						$purchase_expense_without_vat = $purchase_det['purchase_witout_vat_total_amount'] +($expense_det['expense_with_vat_net_total'] - $expense_det['expense_vat_amount']);
						$purchase_expense_tot_vat = ($purchase_det['purchase_tax_amount'] + $expense_det['expense_vat_amount']);
						$purchase_expense_with_vat_tot_amount = ($purchase_det['purchase_witout_vat_total_amount'] + $purchase_det['purchase_tax_amount']) +$expense_det['expense_with_vat_net_total'];
																						
						echo "<tr style='border-bottom: 2px solid #000;padding:10px;'>";
						echo "<td style='border:unset !important;padding:10px;'>VAT 5%</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($settle_det['settle_wit_vat_net_total'] - $settle_det['settle_total_vat'], 2)."</td>";			
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($settle_det['settle_total_vat'], 2)."</td>";	
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($settle_det['settle_wit_vat_net_total'], 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format(($purchase_expense_without_vat), 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($purchase_expense_tot_vat, 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($purchase_expense_with_vat_tot_amount, 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format(($settle_det['settle_total_vat'] - $purchase_expense_tot_vat), 2)."</td>";	
						echo "</tr>";														
						echo "<tr style='border-bottom: 2px solid #000;'>";
						echo "<td style='border:unset !important;padding:10px;'></td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($settle_det['settle_wit_vat_net_total'] - $settle_det['settle_total_vat'], 2)."</td>";			
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($settle_det['settle_total_vat'], 2)."</td>";	
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($settle_det['settle_wit_vat_net_total'], 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format(($purchase_expense_without_vat), 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($purchase_expense_tot_vat, 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format($purchase_expense_with_vat_tot_amount, 2)."</td>";
						echo "<td style='text-align:center;border:unset !important;padding:10px;'>".number_format(($settle_det['settle_total_vat'] - $purchase_expense_tot_vat), 2)."</td>";	
						echo "</tr>"; "</tr>";
					?>					
				</tbody>
			</table> 
		  <div style="clear:both;"></div> 
		  </div>	
		<!-- Print section end -->
		<script type="text/javascript">
			var site_url = "<?php echo getServerURL(); ?>";
			function deleteIt(id)
			{
			    if(id && confirm('Are you sure you want to delete this category?'))
			    {
			        window.location.href = site_url+'/admin/manage_orders.php?id='+id+'&act=delete';
			    }
			}
			
			$(document).on('click', '.buttons-print', function(e) {
				$(".show_titles").show();
				var content = document.getElementById('counter_sale_orders_export').innerHTML;
				var win = window.open();	
				//win.document.write('<link href="css/style_v1.css" rel="stylesheet">');
				//win.document.write('<link href="core/framework/libs/pj/css/pj-table.css" rel="stylesheet" type="text/css" />');			
				win.document.write(content);	
				win.print();
				$(".show_titles").hide();
				win.window.close();
			});
			
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
			   $(document).on('click', '.export', function(event) {
			    $(".show_titles").show();
			   exportTableToCSV.apply(this, [$('#counter_sale_orders>table'), 'export_tax_reports.csv']);        
			  });

			  $(function () {
				/*$('#example1').DataTable()*/
				$('#example1').DataTable({
				  'paging'      : false,
				  'lengthChange': false,
				  'searching'   : false,
				  'ordering'    : false,
				  'info'        : false,
				  'autoWidth'   : false
				})
			  })
		</script>
	</body>
</html>