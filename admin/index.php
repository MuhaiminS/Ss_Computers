<?php 
	session_start();
	include("../functions.php");
	include_once("../config.php");
	connect_dre_db();
	chkAdminLoggedIn();
	$shop_id = (isset($_SESSION['admin_shop_id']) && $_SESSION['admin_shop_id'] !='') ? $_SESSION['admin_shop_id'] : '';
	$user_id =  (isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id'] !='') ? $_SESSION['admin_user_id'] : '';

	//Total Sale Amount
	$sale_result = mysqli_query($GLOBALS['conn'], "SELECT SUM(soi.qty*soi.price) as amount FROM `sale_orders` so LEFT JOIN sale_order_items soi ON (soi.sale_order_id = so.id) WHERE 1 GROUP BY so.id");
	
	$sale_order_count = '0';
	if($sale_result) {
		$sale_count = mysqli_fetch_assoc($sale_result);	
		if(BILL_TAX == 'yes' && BILL_COUNTRY == 'UAE') {
			$sale_order_count = $sale_count['amount'] + ($sale_count['amount'] * 0.05);
		} else {
			$sale_order_count = $sale_count['amount'];
		}
	}

	//Total		
	$item_result = mysqli_query($GLOBALS['conn'], "SELECT count(id) as count FROM items WHERE active = '1'");
	$item_counts = '0';
	if($item_result) {
		$item_count = mysqli_fetch_assoc($item_result);	
		$item_counts = $item_count['count'];
	}

	//Total Customers
	$customer_result = mysqli_query($GLOBALS['conn'], "SELECT count(customer_id) as count FROM customer_details WHERE 1");
	$cust_counts = '0';
	if($customer_result) {
		$customer_count = mysqli_fetch_assoc($customer_result);	
		$cust_counts = $customer_count['count'];
	}

	//Total Profit for settle
	$profit_result = mysqli_query($GLOBALS['conn'], "SELECT SUM(net_total) as total FROM settle_sale WHERE 1 GROUP BY shop_id");
	$profit_counts = '0.00';
	if($profit_result) {
		$profit_count = mysqli_fetch_assoc($profit_result);	
		$profit_counts = $profit_count['total'];
	}

	//Latest Orders
	$latest_result = mysqli_query($GLOBALS['conn'], "SELECT po.*,poi.*,SUM(poi.qty * poi.unit_price) as amount FROM purchase_order as po LEFT JOIN purchase_order_items as poi ON po.id = poi.purchase_id WHERE 1 ORDER BY po.id DESC Limit 8");	 
	$latest_orders = array();
	if($latest_result) {		
		while($latest_ord = mysqli_fetch_assoc($latest_result)) {
			$latest_orders[] = $latest_ord;
		}
	}

	//Latest Customers
	function CustomerDetails($limit) {
		if($limit != '') {
			$latest_cust_result = mysqli_query($GLOBALS['conn'], "SELECT * FROM customer_details ORDER BY customer_id DESC Limit $limit");
		} else {
			$latest_cust_result = mysqli_query($GLOBALS['conn'], "SELECT count(customer_id) as count FROM customer_details");
		}
		$latest_cust = array();
		if($latest_cust_result) {		
			while($latest_cus_row = mysqli_fetch_assoc($latest_cust_result)) {
				$latest_cust[] = $latest_cus_row;
			}
		}
		return $latest_cust;
	}
	$latest_cust = CustomerDetails($limit = '8');
	$latest_cust_count = CustomerDetails($limit = '');
	//print_r($latest_cust_count);exit;

/*	function stockalert()
	{
		$alert = array();
		$query = mysqli_query($GLOBALS['conn'],"SELECT * FROM items WHERE stock <= stock_limit and stock_alert = 'yes'");
		$i=0;
		while($row = mysqli_fetch_assoc($query))
		{
			$alert[$i]['id'] = $row['id'];
			$alert[$i]['name']= $row['name'];
			$alert[$i]['stock']= $row['stock'];
		$i++; }

		return $alert;
	}*/
	
	//Latest 10 Products 
	function latestProductSales() {
		$today_month = Date('Y-m');
		$colors_arr = array(array('color' =>'#4573a7', 'highlight' => '#4573a7'), 
			array('color' =>'#aa4644', 'highlight' => '#aa4644'),
			array('color' =>'#89a54e', 'highlight' => '#89a54e'),
			array('color' =>'#71588f', 'highlight' => '#71588f'),
			array('color' =>'#4298af', 'highlight' => '#4298af'),
			array('color' =>'#db843d', 'highlight' => '#db843d'),
			array('color' =>'#93a9d0', 'highlight' => '#93a9d0'),
			array('color' =>'#d09392', 'highlight' => '#d09392'),
			array('color' =>'#bacd96', 'highlight' => '#bacd96'),
			array('color' =>'#a99bbe', 'highlight' => '#a99bbe'));

		$latest_pro_result = mysqli_query($GLOBALS['conn'], "SELECT sum((soi.price*soi.qty) * 0.05) as tax_value, sum(soi.price*soi.qty) as price, soi.item_name as name FROM sale_order_items soi LEFT JOIN sale_orders so ON (so.id = sale_order_id) WHERE so.ordered_date BETWEEN '$today_month-1 00:00:00' AND '$today_month-30 23:59:59'  GROUP BY soi.item_id ORDER BY price DESC Limit 10");
		$latest_prod = array();
		if($latest_pro_result) {		
			while($latest_pro_row = mysqli_fetch_assoc($latest_pro_result)) {
				$latest_prod[] = $latest_pro_row;
			}
		}
		$pie_json = '';
		if(!empty($latest_prod)) {
			$latest_products = array();
			foreach($latest_prod as $key=>$latest_pr) {
				$vat = 0;
				if(BILL_TAX == 'yes' && BILL_COUNTRY == 'UAE') {
					$vat = $latest_pr['tax_value'];
				}
				$prod['value'] = $latest_pr['price'];				
				$prod['color'] = $colors_arr[$key]['color'];
				$prod['highlight'] = $colors_arr[$key]['highlight'];
				$prod['label'] = $latest_pr['name'];
				$latest_products[] = $prod;

			}
			$pie_json = json_encode($latest_products);
			$pie_json = preg_replace('/["]/', '' ,$pie_json);
			$pie_json = str_replace('color:',"color:'", $pie_json);
			$pie_json = str_replace(',highlight:',"',highlight:'", $pie_json);
			$pie_json = str_replace(',label:',"',label:'", $pie_json);
			$pie_json = str_replace('}',"'}", $pie_json);
		}
		return $pie_json;
	}
	$latest_pro_result = latestProductSales();
	
	// echo"<pre>"; print_r($latest_pro_result);exit;


//Latest 10 Customer 
	function latestCustomerSales($shop_id, $user_id) {
		$today_month = Date('Y-m');
		$colors_arr = array(array('color' =>'#8dc5ae', 'highlight' => '#8dc5ae'), 
			array('color' =>'#ff0c24', 'highlight' => '#ff0c24'),
			array('color' =>'#ff942e', 'highlight' => '#ff942e'),
			array('color' =>'#fffd54', 'highlight' => '#fffd54'),
			array('color' =>'#55af43', 'highlight' => '#55af43'),
			array('color' =>'#0091ca', 'highlight' => '#0091ca'),
			array('color' =>'#3d0f9e', 'highlight' => '#3d0f9e'),
			array('color' =>'#8c00a9', 'highlight' => '#8c00a9'),
			array('color' =>'#b2124c', 'highlight' => '#b2124c'),
			array('color' =>'#cde94b', 'highlight' => '#cde94b'));

		$latest_pro_result = mysqli_query($GLOBALS['conn'], "SELECT sum((soi.price*soi.qty) * 0.05) as tax_value, sum(soi.price*soi.qty) as price, so.contact_name as name FROM sale_order_items soi LEFT JOIN sale_orders so ON (so.id = sale_order_id) WHERE so.ordered_date BETWEEN '$today_month-1 00:00:00' AND '$today_month-30 23:59:59'  GROUP BY so.customer_id ORDER BY so.customer_id, price DESC Limit 10");

		////echo "SELECT sum((soi.price*soi.qty) * 0.05) as tax_value, sum(soi.price*soi.qty) as price, so.contact_name as name FROM sale_order_items soi LEFT JOIN sale_orders so ON (so.id = sale_order_id) WHERE so.ordered_date BETWEEN '$today_month-1 00:00:00' AND '$today_month-30 23:59:59'  GROUP BY so.customer_id ORDER BY so.customer_id, price DESC Limit 10";

		//print_r($latest_pro_result); die;
		$latest_prod = array();
		if($latest_pro_result) {		
			while($latest_pro_row = mysqli_fetch_assoc($latest_pro_result)) {
				$latest_prod[] = $latest_pro_row;
			}
		}
		$pie_json = '';
		if(!empty($latest_prod)) {
			$latest_products = array();
			foreach($latest_prod as $key=>$latest_pr) {
				$vat = 0;
				if(BILL_TAX == 'yes' && BILL_COUNTRY == 'UAE') {
					$vat = $latest_pr['tax_value'];
				}
				$prod['value'] = $latest_pr['price'];				
				$prod['color'] = $colors_arr[$key]['color'];
				$prod['highlight'] = $colors_arr[$key]['highlight'];
				$prod['label'] = $latest_pr['name'];
				$latest_products[] = $prod;

			}
			$pie_json = json_encode($latest_products);
			$pie_json = preg_replace('/["]/', '' ,$pie_json);
			$pie_json = str_replace('color:',"color:'", $pie_json);
			$pie_json = str_replace(',highlight:',"',highlight:'", $pie_json);
			$pie_json = str_replace(',label:',"',label:'", $pie_json);
			$pie_json = str_replace('}',"'}", $pie_json);
		}
		return $pie_json;
	}
	$latest_cus_result = latestCustomerSales($shop_id, $user_id);
	
	//echo"<pre>"; print_r($latest_pro_result);exit;
	//Last seven month report bar chart
	function monthWiseSales($shop_id, $user_id) {	
		
		$colors_arr = array(array('color' =>'#4573a7', 'highlight' => '#4573a7'), 
			array('color' =>'#aa4644', 'highlight' => '#aa4644'),
			array('color' =>'#89a54e', 'highlight' => '#89a54e'),
			array('color' =>'#71588f', 'highlight' => '#71588f'),
			array('color' =>'#4298af', 'highlight' => '#4298af'),
			array('color' =>'#db843d', 'highlight' => '#db843d'),
			array('color' =>'#93a9d0', 'highlight' => '#93a9d0'),
			array('color' =>'#d09392', 'highlight' => '#d09392'),
			array('color' =>'#bacd96', 'highlight' => '#bacd96'),
			array('color' =>'#a99bbe', 'highlight' => '#a99bbe'));
	
		$today_month = Date('Y-m');
		$latest_pro_result = mysqli_query($GLOBALS['conn'], "SELECT sum((soi.price*soi.qty) * 0.05) as tax_value, sum(soi.price*soi.qty) as price, DATE_FORMAT(so.ordered_date,'%m-%Y') as date FROM sale_order_items soi LEFT JOIN sale_orders so ON (so.id = sale_order_id) WHERE 1 GROUP BY date ORDER BY date DESC Limit 7");
		
		$latest_prod = array();
		if($latest_pro_result) {		
			while($latest_pro_row = mysqli_fetch_assoc($latest_pro_result)) {
				$latest_prod[] = $latest_pro_row;
			}
		}
		$bar_json = '';
		if(!empty($latest_prod)) {
			$latest_products = array();
			$prod['label'] = 'Compras';
			$prod['fillColor']           = 'rgba(0,166,90,0.9)';
			$prod['strokeColor']          = 'rgba(0,166,90,0.9)';
			$prod['pointColor']           = '#00a65a';
			$prod['pointStrokeColor']     = 'rgba(0,166,90,0.9)';
			$prod['pointHighlightFill']   = '#fff';
			$prod['pointHighlightStroke'] = 'rgba(0,166,90,1)';
			$prod['data'] = '[';
			foreach($latest_prod as $key=>$latest_pr) {
				$vat = 0;
				if(BILL_TAX == 'yes' && BILL_COUNTRY == 'UAE') {
					$vat = $latest_pr['tax_value'];
				}								
				//$prod['color'] = $colors_arr[$key]['color'];
				//$prod['highlight'] = $colors_arr[$key]['highlight'];				
				$prod['data'] .= ','.$latest_pr['price'];				

			}
			$prod['data'] .= ']';
			$latest_products[] = $prod;
			$bar_json = json_encode($latest_products);
			$bar_json = preg_replace('/["]/', '' ,$bar_json);
			$bar_json = str_replace(',fillColor:',"',fillColor:'", $bar_json);
			$bar_json = str_replace(',strokeColor:',"',strokeColor:'", $bar_json);
			$bar_json = str_replace(',pointColor:',"',pointColor:'", $bar_json);
			$bar_json = str_replace(',pointStrokeColor:',"',pointStrokeColor:'", $bar_json);
			$bar_json = str_replace(',pointHighlightFill:',"',pointHighlightFill:'", $bar_json);
			$bar_json = str_replace(',pointHighlightStroke:',"',pointHighlightStroke:'", $bar_json);
			$bar_json = str_replace('label:',"label:'", $bar_json);
			$bar_json = str_replace(',data:[,',"',data:[", $bar_json);
			//$bar_json = str_replace('}',"'}", $bar_json);
		}
		return $bar_json;
	}
	
	$month_wise_sale = monthWiseSales($shop_id, $user_id);

	$date[] = date('M Y');
	for ($i = 1; $i < 6; $i++) {
		$date[$i] = date('M Y', strtotime("-$i month"));
	}
	/*$sort = array();
	foreach($date as $k=>$v) {
		$sort[][$k] = $v;
	}
	array_multisort($sort, SORT_DESC, $date);*/
	$date_json = json_encode($date);
		
	/*$lable = "['".date('F Y')."'";
	for ($i = 1; $i < 6; $i++) {
		$lable .= date(", 'F Y' ", strtotime("-$i month"));
	}
	$lable .= "]";*/

	
	
	//echo "<pre>";print_r($month_wise_sale);
	
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
						Dashboard
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Dashboard</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<!-- Info boxes -->
					<div class="row">
						<!--<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Sales</span>
									<span class="info-box-number"><?php echo number_format($sale_order_count, 2); ?><small> AED</small></span>
								</div>
							</div>
						</div>-->
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="fa fa-barcode"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Products</span>
									<span class="info-box-number"><?php echo $item_counts; ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Customers</span>
									<span class="info-box-number"><?php echo $cust_counts; ?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<!--<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Profit</span>
									<span class="info-box-number"><?php echo number_format($profit_counts, 2); ?><small> AED</small></span>
								</div>
							</div>
						</div>-->
					</div>
					<!-- /.row -->
					
							<?php //$stockalert = stockalert();
								// $count = count($stockalert);
				 // print_r($stockalert); 
									//if($count > 0) {							 ?>
						<!-- <div class="row">
						<div class="col-md-12">
							<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
									<h4><i class="icon fa fa-warning"></i> Stock Alert!</h4>
									<?php
										$i=0;
										//while($i < $count)
										{
											//echo $stockalert[$i]['name']." - ".$stockalert[$i]['stock']."<br>";

									$i++; }
									 ?>
							</div>
							</div>
					</div> -->
							<?php //} ?>
						
				<!--	<div class="row">
						<div class="col-md-6"> 
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Sales Chart</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="chart">
										<canvas id="areaChart" style="height:250px"></canvas>
									</div>
								</div>
							 </div>
						</div>
						<div class="col-md-6">
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">Purchases Chart</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="chart">
										<canvas id="barChart" style="height:230px"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>-->
					<!-- /.row -->
					<div class="row">
						<div class="col-md-8">
							<!-- TABLE: LATEST ORDERS -->
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Latest Orders</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div class="table-responsive">
										<table class="table no-margin">
											<thead>
												<tr>
													<th>Order ID</th>
													<th>Product Name</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
											<?php if(!empty($latest_orders)) { $total = '0';
												foreach($latest_orders as $latest_ord) { 
													$id = $latest_ord['id'];
													$rec_id = $latest_ord['reference_id'];
													$qty = $latest_ord['qty'];
													$price = $latest_ord['unit_price'];
													if(BILL_TAX == 'yes' && BILL_COUNTRY == 'UAE') {
														$total = ($qty * $price) + ($qty * $price * 0.05);
													} else {
														$total = $qty * $price;
													}
													?>
												<tr>
													<td><a href="purchases.php?id=<?php echo $id; ?>"><?php echo $id; ?></a></td>
													<td><?php echo $latest_ord['product_name']; ?></td>
													<td><?php echo number_format($total, 2); ?></td>
												</tr>
											<?php } } ?>
												<!-- <tr>
													<td><a href="pages/examples/invoice.html">OR1848</a></td>
													<td>Banana - Large Plate</td>
													<td><span class="label label-warning">Credit</span></td>
													<td>80</td>
												</tr>
												<tr>
													<td><a href="pages/examples/invoice.html">OR7429</a></td>
													<td>Mix flavour - Large Plate</td>
													<td><span class="label label-warning">Credit</span></td>
													<td>70</td>
												</tr>
												<tr>
													<td><a href="pages/examples/invoice.html">OR7429</a></td>
													<td>Blueberry - Small Plate</td>
													<td><span class="label label-info">Card</span></td>
													<td>50</td>
												</tr>
												<tr>
													<td><a href="pages/examples/invoice.html">OR1848</a></td>
													<td>Fatayer Big - Small Plate</td>
													<td><span class="label label-warning">Credit</span></td>
													<td>60</td>
												</tr>
												<tr>
													<td><a href="pages/examples/invoice.html">OR7429</a></td>
													<td>Piece Cake - Small Plate</td>
													<td><span class="label label-info">Card</span></td>
													<td>50</td>
												</tr>
												<tr>
													<td><a href="pages/examples/invoice.html">OR9842</a></td>
													<td>Basboosa Kista - Small Plate</td>
													<td><span class="label label-success">Cash</span></td>
													<td>100</td>
												</tr> -->
											</tbody>
										</table>
									</div>
									<!-- /.table-responsive -->
								</div>
								<!-- /.box-body -->
								<div class="box-footer clearfix">
									<a href="sale_orders.php?order_type=counter_sale" class="btn btn-sm btn-info btn-flat pull-left">View All Orders</a>
									<!--<a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
								</div>
								<!-- /.box-footer -->
							</div>
							<!-- /.box -->		  
						</div>
						<!-- /.col (LEFT) -->
						<div class="col-md-4">
							<!-- DONUT CHART -->
							<div class="box box-danger">
								<div class="box-header with-border">
									<h3 class="box-title">Top 10 Products (<?php echo Date('F Y'); ?>)</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<canvas id="pieChart" style="height:250px"></canvas>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->	
							<div class="row">
							
								<!-- DONUT CHART -->
								<div class="box box-danger">
									<div class="box-header with-border">
										<h3 class="box-title">Top 10 Customers (<?php echo Date('F Y'); ?>)</h3>
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<div class="box-body">
										<canvas id="pieChart_customer" style="height:250px"></canvas>
									</div>
									<div class="box-footer text-center">
										<a href="customers.php" class="uppercase">View All Customers</a>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
							<!-- USERS LIST -->
							<div class="box box-danger">
								<div class="box-header with-border">
									<h3 class="box-title">Latest Customers</h3>
									<div class="box-tools pull-right">
										<span class="label label-danger"><?php echo $latest_cust_count[0]['count']; ?> New Customers</span>
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
										</button>
									</div>
								</div>
								<!-- /.col (LEFT) -->						
							<!-- /.box -->	
								<!-- /.box-header -->
								<div class="box-body no-padding">
									<ul class="users-list clearfix">
									<?php if(!empty($latest_cust)) {
										foreach($latest_cust as $latest_cu) { ?>
										<li>
											<img src="dist/img/user-male-icon.png" alt="User Image">
											<a class="users-list-name" href="#"><?php echo $latest_cu['customer_name']; ?></a>
											<span class="users-list-date"><?php echo $latest_cu['customer_number']; ?></span>
										</li>
										<?php } } ?>
										<!-- <li>
											<img src="dist/img/user8-128x128.jpg" alt="User Image">
											<a class="users-list-name" href="#">Norman</a>
											<span class="users-list-date">Yesterday</span>
										</li>
										<li>
											<img src="dist/img/user7-128x128.jpg" alt="User Image">
											<a class="users-list-name" href="#">Jane</a>
											<span class="users-list-date">12 Jan</span>
										</li>
										<li>
											<img src="dist/img/user6-128x128.jpg" alt="User Image">
											<a class="users-list-name" href="#">John</a>
											<span class="users-list-date">12 Jan</span>
										</li>
										<li>
											<img src="dist/img/user2-160x160.jpg" alt="User Image">
											<a class="users-list-name" href="#">Alexander</a>
											<span class="users-list-date">13 Jan</span>
										</li>
										<li>
											<img src="dist/img/user5-128x128.jpg" alt="User Image">
											<a class="users-list-name" href="#">Sarah</a>
											<span class="users-list-date">14 Jan</span>
										</li>
										<li>
											<img src="dist/img/user4-128x128.jpg" alt="User Image">
											<a class="users-list-name" href="#">Nora</a>
											<span class="users-list-date">15 Jan</span>
										</li>
										<li>
											<img src="dist/img/user3-128x128.jpg" alt="User Image">
											<a class="users-list-name" href="#">Nadia</a>
											<span class="users-list-date">15 Jan</span>
										</li> -->
									</ul>
									<!-- /.users-list -->
								</div>
								<!-- /.box-body -->
								<div class="box-footer text-center">
									<a href="customers.php" class="uppercase">View All Customers</a>
								</div>
								<!-- /.box-footer -->
							</div>
							<!--/.box -->
						</div>
						<!-- /.col (RIGHT) -->
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
			<script src="bower_components/chart.js/Chart.js"></script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<!-- page script dashboard page only -->
		<!-- ChartJS dashboard page only -->
	
		<script>
			$(function () {
			  /* ChartJS
			   * -------
			   * Here we will create a few charts using ChartJS
			   */
			
			  //--------------
			  //- AREA CHART -
			  //--------------
			
			  // Get context with jQuery - using jQuery's .get() method.
			 var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
			  // This will get the first returned node in the jQuery collection.
			  var areaChart       = new Chart(areaChartCanvas)
			
			  var areaChartData = {
			    labels  : <?php echo $date_json; ?>, //['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			    datasets: <?php echo $month_wise_sale; ?>/*[			      
			     {
			        label               : 'Digital Goods',
			        fillColor           : 'rgba(60,141,188,0.9)',
			        strokeColor         : 'rgba(60,141,188,0.8)',
			        pointColor          : '#3b8bba',
			        pointStrokeColor    : 'rgba(60,141,188,1)',
			        pointHighlightFill  : '#fff',
			        pointHighlightStroke: 'rgba(60,141,188,1)',
			        data                : [28, 48, 40, 19, 86, 27, 90]
			      }				
			    ]*/
			  }
			
			  var areaChartOptions = {
			    //Boolean - If we should show the scale at all
			    showScale               : true,
			    //Boolean - Whether grid lines are shown across the chart
			    scaleShowGridLines      : false,
			    //String - Colour of the grid lines
			    scaleGridLineColor      : 'rgba(0,0,0,.05)',
			    //Number - Width of the grid lines
			    scaleGridLineWidth      : 1,
			    //Boolean - Whether to show horizontal lines (except X axis)
			    scaleShowHorizontalLines: true,
			    //Boolean - Whether to show vertical lines (except Y axis)
			    scaleShowVerticalLines  : true,
			    //Boolean - Whether the line is curved between points
			    bezierCurve             : true,
			    //Number - Tension of the bezier curve between points
			    bezierCurveTension      : 0.3,
			    //Boolean - Whether to show a dot for each point
			    pointDot                : false,
			    //Number - Radius of each point dot in pixels
			    pointDotRadius          : 4,
			    //Number - Pixel width of point dot stroke
			    pointDotStrokeWidth     : 1,
			    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			    pointHitDetectionRadius : 20,
			    //Boolean - Whether to show a stroke for datasets
			    datasetStroke           : true,
			    //Number - Pixel width of dataset stroke
			    datasetStrokeWidth      : 2,
			    //Boolean - Whether to fill the dataset with a color
			    datasetFill             : true,
			    //String - A legend template
			    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
			    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			    maintainAspectRatio     : true,
			    //Boolean - whether to make the chart responsive to window resizing
			    responsive              : true
			  }
			
			  //Create the line chart
			  areaChart.Line(areaChartData, areaChartOptions)
			
			  //-------------
			  //- LINE CHART -
			  //--------------
			  /*var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
			  var lineChart                = new Chart(lineChartCanvas)
			  var lineChartOptions         = areaChartOptions
			  lineChartOptions.datasetFill = false
			  lineChart.Line(areaChartData, lineChartOptions)*/
			
			  //-------------
			  //- PIE CHART -
			  //-------------
			  // Get context with jQuery - using jQuery's .get() method.
			  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
			  var pieChart       = new Chart(pieChartCanvas)
			  var PieData        = <?php echo $latest_pro_result; ?>/*[
			    {
			      value    : 7000,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
					{
			      value    : 6000,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
					{
			      value    : 900,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
					{
			      value    : 1000,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
			    {
			      value    : 500,
			      color    : '#00a65a',
			      highlight: '#00a65a',
			      label    : 'Mini Fatayer'
			    },
			    {
			      value    : 400,
			      color    : '#f39c12',
			      highlight: '#f39c12',
			      label    : 'Tamar Tuffi '
			    },
			    {
			      value    : 600,
			      color    : '#00c0ef',
			      highlight: '#00c0ef',
			      label    : 'Basboosa Kista'
			    },
			    {
			      value    : 300,
			      color    : '#3c8dbc',
			      highlight: '#3c8dbc',
			      label    : 'Donut Mix'
			    },
			    {
			      value    : 100,
			      color    : '#d2d6de',
			      highlight: '#d2d6de',
			      label    : 'kitkat'
			    }
			  ]*/
			  var pieOptions     = {
			    //Boolean - Whether we should show a stroke on each segment
			    segmentShowStroke    : true,
			    //String - The colour of each segment stroke
			    segmentStrokeColor   : '#fff',
			    //Number - The width of each segment stroke
			    segmentStrokeWidth   : 2,
			    //Number - The percentage of the chart that we cut out of the middle
			    percentageInnerCutout: 50, // This is 0 for Pie charts
			    //Number - Amount of animation steps
			    animationSteps       : 100,
			    //String - Animation easing effect
			    animationEasing      : 'easeOutBounce',
			    //Boolean - Whether we animate the rotation of the Doughnut
			    animateRotate        : true,
			    //Boolean - Whether we animate scaling the Doughnut from the centre
			    animateScale         : false,
			    //Boolean - whether to make the chart responsive to window resizing
			    responsive           : true,
			    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			    maintainAspectRatio  : true,
			    //String - A legend template
			    legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
			  }
			  //Create pie or douhnut chart
			  // You can switch between pie and douhnut using the method below.
			  pieChart.Doughnut(PieData, pieOptions)

			
				 //-------------
			  //- PIE CHART Customer-
			  //-------------
			  // Get context with jQuery - using jQuery's .get() method.
			  var pieChartCanvas = $('#pieChart_customer').get(0).getContext('2d')
			  var pieChart       = new Chart(pieChartCanvas)
			  var PieData        = <?php echo $latest_cus_result; ?>/*[
			    {
			      value    : 7000,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
					{
			      value    : 6000,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
					{
			      value    : 900,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
					{
			      value    : 1000,
			      color    : '#f56954',
			      highlight: '#f56954',
			      label    : 'Oreo'
			    },
			    {
			      value    : 500,
			      color    : '#00a65a',
			      highlight: '#00a65a',
			      label    : 'Mini Fatayer'
			    },
			    {
			      value    : 400,
			      color    : '#f39c12',
			      highlight: '#f39c12',
			      label    : 'Tamar Tuffi '
			    },
			    {
			      value    : 600,
			      color    : '#00c0ef',
			      highlight: '#00c0ef',
			      label    : 'Basboosa Kista'
			    },
			    {
			      value    : 300,
			      color    : '#3c8dbc',
			      highlight: '#3c8dbc',
			      label    : 'Donut Mix'
			    },
			    {
			      value    : 100,
			      color    : '#d2d6de',
			      highlight: '#d2d6de',
			      label    : 'kitkat'
			    }
			  ]*/
			  var pieOptions     = {
			    //Boolean - Whether we should show a stroke on each segment
			    segmentShowStroke    : true,
			    //String - The colour of each segment stroke
			    segmentStrokeColor   : '#fff',
			    //Number - The width of each segment stroke
			    segmentStrokeWidth   : 2,
			    //Number - The percentage of the chart that we cut out of the middle
			    percentageInnerCutout: 50, // This is 0 for Pie charts
			    //Number - Amount of animation steps
			    animationSteps       : 100,
			    //String - Animation easing effect
			    animationEasing      : 'easeOutBounce',
			    //Boolean - Whether we animate the rotation of the Doughnut
			    animateRotate        : true,
			    //Boolean - Whether we animate scaling the Doughnut from the centre
			    animateScale         : false,
			    //Boolean - whether to make the chart responsive to window resizing
			    responsive           : true,
			    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			    maintainAspectRatio  : true,
			    //String - A legend template
			    legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
			  }
			  //Create pie or douhnut chart
			  // You can switch between pie and douhnut using the method below.
			  pieChart.Doughnut(PieData, pieOptions)
			
			  //-------------
			  //- BAR CHART -
			  //-------------
			  var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
			  var barChart                         = new Chart(barChartCanvas)
			  var barChartData                     = {
			    labels  :<?php echo $date_json; ?>,
			   datasets: [			      
			    {
			       label               : 'Electronics',
			        fillColor           : 'rgba(210, 214, 222, 1)',
			        strokeColor         : 'rgba(210, 214, 222, 1)',
			        pointColor          : 'rgba(210, 214, 222, 1)',
			        pointStrokeColor    : '#c1c7d1',
			        pointHighlightFill  : '#fff',
			        pointHighlightStroke: 'rgba(220,220,220,1)',
			        data                : []
			      },
					{
			        label               : 'Digital Goods',
			        fillColor           : 'rgba(60,141,188,0.9)',
			        strokeColor         : 'rgba(60,141,188,0.8)',
			        pointColor          : '#3b8bba',
			        pointStrokeColor    : 'rgba(60,141,188,1)',
			        pointHighlightFill  : '#fff',
			        pointHighlightStroke: 'rgba(60,141,188,1)',
			        data                : [28, 48, 40, 19, 86, 27, 90]
			      }				  
			    ]
			  }
			  barChartData.datasets[1].fillColor   = '#00a65a'
			  barChartData.datasets[1].strokeColor = '#00a65a'
			  barChartData.datasets[1].pointColor  = '#00a65a'
			  var barChartOptions                  = {
			    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			    scaleBeginAtZero        : true,
			    //Boolean - Whether grid lines are shown across the chart
			    scaleShowGridLines      : true,
			    //String - Colour of the grid lines
			    scaleGridLineColor      : 'rgba(0,0,0,.05)',
			    //Number - Width of the grid lines
			    scaleGridLineWidth      : 1,
			    //Boolean - Whether to show horizontal lines (except X axis)
			    scaleShowHorizontalLines: true,
			    //Boolean - Whether to show vertical lines (except Y axis)
			    scaleShowVerticalLines  : true,
			    //Boolean - If there is a stroke on each bar
			    barShowStroke           : true,
			    //Number - Pixel width of the bar stroke
			    barStrokeWidth          : 2,
			    //Number - Spacing between each of the X value sets
			    barValueSpacing         : 5,
			    //Number - Spacing between data sets within X values
			    barDatasetSpacing       : 1,
			    //String - A legend template
			    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
			    //Boolean - whether to make the chart responsive
			    responsive              : true,
			    maintainAspectRatio     : true
			  }
			
			  barChartOptions.datasetFill = false
			  barChart.Bar(barChartData, barChartOptions)
			})
		</script>
	</body>
</html>