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
	$run = mysqli_query($GLOBALS['conn'], $query);
	while($row = mysqli_fetch_array($run)) {
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

function getItemName($item_id)
{
	$where = "WHERE id = '$item_id'";
	$service = getnamewhere('items', 'name', $where);
	return $service;
}



function getSaleorders($receipt_id = '',$payment_type = '', $from_date ='', $to_date='', $shop='',  $export="")
{
	$date = date('Y-m-d');
	$qry="SELECT * FROM sale_orders WHERE order_type = 'counter_sale'"; 
	if($receipt_id != ''){
		$qry .=" AND receipt_id = '$receipt_id'";
	}
	if($shop != ''){
		$qry .=" AND shop_id = '$shop'";
	}
	if($payment_type != ''){
		$qry .=" AND payment_type = '$payment_type'";
	}
	if($from_date != '' && $to_date != '' ) {
		
		$qry .= " AND ordered_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' ";		
	} 
	if($from_date != '' && $to_date == '' ) {
		$qry .= " AND ordered_date BETWEEN '$from_date 00:00:00' AND '$date 23:59:59' ";
	}

	if($from_date == '' && $to_date != '' ) {
		$qry .= " AND ordered_date <= '$to_date 23:59:59'";
	}
	

		$qry .=" ORDER BY ordered_date DESC ";
	
	//echo $qry; die;
	$result=mysqli_query($GLOBALS['conn'], $qry);
	//$num=mysqli_num_rows($result);
	//echo "total result ".$num;
	if($result)
	{
		return $result;
	}
	else
	return false;
}



function getFillingName($filling_id)
{
	$where = "WHERE id = '$filling_id'";
	$service = getnamewhere('cake_filling', 'filling_name', $where);
	return $service;
}
function getFlavourName($flavour_id)
{
	$where = "WHERE id = '$flavour_id'";
	$flavour = getnamewhere('cake_flavours', 'flavour_name', $where);
	return $flavour;
}
function getcategoryName($category_id)
{
	$where = "WHERE id = '$category_id'";
	$category = getnamewhere('category', 'category_title', $where);
	return $category;
}

function getSaleOrderitems($id)
{	
	$id = isset($id) ? $id : '';
	$qry="SELECT * FROM sale_order_items WHERE  sale_order_id = '".$id."'";
	
	//echo $qry;
	$result=mysqli_query($GLOBALS['conn'], $qry);
	$num=mysqli_num_rows($result);
	
	if($num>0)
	{
		return $result;
	}
	else
	return false;
}


$status_arr =  array(
	'pending' => 'Pending',
	'progressing' => 'Progressing',
	'ready_for_delivery' => 'Ready for delivery',
	'completed' => 'Completed',
	'delivered' => 'Delivered',
	'cancel' => 'canceled',
	'draft' => 'Draft'
);
$shops = (isset($_GET['shop']) && $_GET['shop'] !='') ? $_GET['shop'] : '';
$receipt_ids = (isset($_GET['receipt_id']) && $_GET['receipt_id'] !='') ? $_GET['receipt_id'] : '';
$payment_types = (isset($_GET['payment_type']) && $_GET['payment_type'] !='') ? $_GET['payment_type'] : '';
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
						Sale Order
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Sale Order</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Sale Order</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div id="form" class="panel panel-warning" style="display: block;">
										<div class="panel-body">
											<form action="sale_orders.php" accept-charset="utf-8">
												
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label for="receipt_id">Receipt id.</label> <input type="text" name="receipt_id" value="<?php echo $receipt_ids; ?>" class="form-control tip" id="receipt_id">
														</div>
													</div>
												
													<div class="col-sm-3">
														<div class="form-group">
															<label>Payment Status</label>
															<select name="payment_type" id="payment_type" class="form-control select2" style="width: 100%;">
																<option value=''>--Select Payment Type--</option>
																<option value="cash" <?php if($payment_types == 'cash') { echo "Selected"; } ?>>Cash</option>
																<option value="card" <?php if($payment_types == 'card') { echo "Selected"; } ?>>Card</option>
																<option value="credit" <?php if($payment_types == 'credit') { echo "Selected"; } ?>>Credit</option>
															</select>
														</div>
													</div>
													
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
														<a href="sale_orders.php" class="btn btn-default">Reset</a>
													</div>
												</div>
											</form>
										</div>
									</div>
									<?php include("sale_order_items.php"); ?>

									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right pr0">
											<div class="dt-buttons btn-group">												
												<?php if($receipt_ids != '' || $shops != '' || $payment_types != '' || $from_date1 != '' || $to_date1 != '') { ?>
												
												 <span title="Excel" class="print2" style="font-size: 20px;"><a target="_blank" href="excel_export.php?sale=Counter Sale&order_type=counter_sale&get_type=excel&receipt_id=<?php echo $receipt_ids; ?>&shop=<?php echo $shops; ?>&payment_type=<?php echo $payment_types; ?>&from_date=<?php echo $from_date1; ?>&to_date=<?php echo $to_date1; ?>" class="btn btn-default buttons-csv buttons-html5 export"><span>Excel</span></a></span>
												 <?php } else { ?>
												<span title="Excel" class="print2" style="font-size: 20px;"><a target="_blank" href="excel_export.php?sale=Counter Sale&order_type=counter_sale&get_type=excel" class="btn btn-default buttons-csv buttons-html5 export"><span>Excel</span></a></span>

												<?php } ?>

											</div>
										</div>
									</div>
									<table id="example2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Receipt Id</th>													
												<th>Contact Details</th>	
												<th>Shop</th>
												<th>Date&Time</th>
												<th>Payment Type</th>
												<th>Sub Total</th>
                                                <th>Cost Total</th>
                                                <th>Profit Total</th>
												<th>VAT</th>
                                                <th>Discount</th>
												<th>Final Total</th>													
												<th class="hide_print">Action</th>
											</tr>
										</thead>
										<tbody>
												<?php	
												$grand_final_total = "0.00";
												$grand_cost_price_total = "0.00";
												$grand_profit = "0.00";
												$grand_sub_total = "0.00";
												$grand_discount_total = "0.00";
												$grand_vat_total = "0.00";												
													$prs = getSaleorders($receipt_ids,$payment_types,$from_date1, $to_date1,$shops, $export="");	

													//echo "<pre>"; print_r($prs); die;
													if($prs != false) {
														$pcount = mysqli_num_rows($prs);
														if($pcount > 0) {
															for($p = 0; $p < $pcount; $p++) {
																$prow = mysqli_fetch_object($prs);
															//	echo '<pre>';print_r($prow);
																$id = $prow->id;
																$receipt_id = $prow->receipt_id;
																$contact_name = $prow->contact_name;
																$contact_number = $prow->contact_number;
																$address = $prow->address;
																$ordered_date = $prow->ordered_date;																
																$payment_status = $prow->payment_status;
																$payment_type = $prow->payment_type;
																$discount = $prow->discount;
																$status = $prow->status;
																$vat = $prow->vat;
																
																$cost_price_total = $prow->without_tax_cost;																
																$sub_total = $prow->without_tax;
																$profit=$sub_total - $cost_price_total;
																$vat_price = $prow->tax_amount;
																$with_vat_price = $prow->with_tax;
																$final_total = 	$with_vat_price - $discount;
																
																$grand_cost_price_total += $cost_price_total;
																$grand_sub_total += $sub_total;
																$grand_profit += $profit;
																$grand_vat_total += $vat_price;
																$grand_discount_total += $discount;
																$grand_final_total += $final_total;													
																
																$user_name = getUserName($prow->user_id);
																//$name = getManufacturingUnitName($prow->manufacturing_unit_id);
																$shop_name = getShopName($prow->shop_id);													
																
																echo "<tr>";
																echo "<td>".$id."</td>";
																echo "<td>".$receipt_id."</td>";
																echo "<td>Name:".$contact_name."<br>
																		Address:".$address."<br>
																		Ph:".$contact_number."</td>";	
																echo "<td>".$shop_name."</td>";
																echo "<td>".$ordered_date."</td>";
																echo "<td>".$payment_type."</td>";	
																//echo "<td>".$payment_status."</td>";
																//echo "<td>".$status_arr[$status]."</td>";
																echo "<td align='right'>".number_format($sub_total, 2)."</td>";
																echo "<td align='right'>".number_format($cost_price_total, 2)."</td>";
																
																echo "<td align='right'>".number_format($profit, 2)."</td>";
																echo "<td align='right'>".number_format($vat_price, 2)."</td>";
																echo "<td align='right'>".number_format($discount, 2)."</td>";
																echo "<td align='right'>".number_format($final_total, 2)."</td>";												
																if($status == 'deleted'){
																echo "<td></td>";/*"<td><a href='javascript:void(0)' onclick='deleteIt($id);'>Delete</a></td>";*/
																}else{
																echo "<td class='hide_print'>";
																	echo "<div class=\"text-center\">";
																		echo "<div class=\"btn-group\">";
																			echo "<a href=\"javascript:void(0)\" data-toggle=\"modal\" data-target=\"#myModal".$id."\" title=\"View Items\" class=\"tip btn btn-warning btn-xs\"><i class=\"fa fa-eye\"></i></a><a href='single_item_print_a4.php?id=$id&re=sale_orders.php?order_type=counter_sale' class='btn btn-primary btn-xs'><i class='fa fa-print'></i></a>";
																			//echo "<a href=\"javascript:void(0)\" onclick=\"deleteIt($id);\" title=\"Delete Expense\" class=\"tip btn btn-danger btn-xs\"><i class=\"fa fa-trash-o\"></i></a>";
																		echo "</div>";
																	echo "</div>";
																echo "</td>";

																}
																echo "</tr>";
																
															}
														
														}
															echo "</tbody><tfoot><tr>";
															echo "<td colspan='6'>Grand Total</td>";
															echo "<td align='right'>".number_format($grand_sub_total, 2)."</td>";
															echo "<td align='right'>".number_format($grand_cost_price_total, 2)."</td>";
															
															echo "<td align='right'>".number_format($grand_profit, 2)."</td>";
															echo "<td align='right'>".number_format($grand_vat_total, 2)."</td>";
															echo "<td align='right'>
																	".number_format($grand_discount_total, 2)."</td>";
															echo "<td align='right'>
																	".number_format($grand_final_total, 2)."</td>";
															echo "<td align='right'></td>";
															echo "</tr></tfoot>";

													}
													
												?>					
										
										
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
			    if(id && confirm('Are you sure you want to delete this category?'))
			    {
			        window.location.href = site_url+'/admin/manage_orders.php?id='+id+'&act=delete';
			    }
			}
			
			$(document).on('click', '.print_me', function(e) {
				$(".hide_print").hide();
				var content = document.getElementById('counter_sale_orders_export').innerHTML;
				var win = window.open();	
				//win.document.write('<link href="css/style_v1.css" rel="stylesheet">');
				//win.document.write('<link href="core/framework/libs/pj/css/pj-table.css" rel="stylesheet" type="text/css" />');			
				win.document.write(content);	
				win.print();
				win.window.close();
			});
		</script>
	</body>
</html>