<?php 
session_start();
include("../functions.php");
include_once("../config.php");
chkAdminLoggedIn();
connect_dre_db();

if(isset($_GET['act']) && $_GET['act'] != '' && isset($_GET['id']) && $_GET['id'] > 0) {	
	$action = $_GET['act'];
	$purchase_order_id = $_GET['id'];	
	if($action == 'paid') {
		$qry = "UPDATE purchase_order SET payment_status = 'not_paid' WHERE id = '$purchase_order_id'";
		if(mysqli_query($GLOBALS['conn'], $qry)){
			//UserLogDetails($_SESSION['user_id'], $purchase_order_id, 'purchase_orders', 'paid');
			redirect('manage_purchase_orders.php?resp=succ');
		}
	}
	else if($action == 'not_paid') {
		$qry = "UPDATE purchase_order SET payment_status = 'paid' WHERE id = $purchase_order_id";		
		if(mysqli_query($GLOBALS['conn'], $qry)){
			//UserLogDetails($_SESSION['user_id'], $purchase_order_id, 'purchase_orders', 'not_paid');
			redirect('manage_purchase_orders.php?resp=succ');
		}
	}
	else if($action != '' && $_GET['s'] == 1) { 
		$qry = "UPDATE purchase_order SET status = '$action' WHERE id = $purchase_order_id";		
		if(mysqli_query($GLOBALS['conn'], $qry)){
			//UserLogDetails($_SESSION['user_id'], $purchase_order_id, 'purchase_orders', 'not_paid');
			//ADD Stock
			$purchase_order = $_GET['id'];
			if($action == 'received') {
				$update_order = "SELECT * FROM purchase_order_items WHERE purchase_id = $purchase_order";
				$update_order_edit = mysqli_query($GLOBALS['conn'], $update_order);		
				while ($edit_row = mysqli_fetch_array($update_order_edit)) {					
					$item_id = $edit_row['item_id'];
					$qty = $edit_row['qty'];
					$sql = "SELECT * FROM items WHERE id = $item_id";
					$item_details = mysqli_fetch_assoc(mysqli_query($GLOBALS['conn'], $sql));
					$item_id_i = $item_details['id'];
					$stock = $item_details['stock'];
					$stock_added = $stock + $qty;
					mysqli_query($GLOBALS['conn'], "UPDATE items SET stock = '$stock_added' WHERE id = '$item_id_i'");
				}
				redirect('manage_purchase_orders.php?stat=succ');
			}			
		}
	}
}

function getUserName($user_id)
{
	$where = "WHERE id = '$user_id'";
	$service = getnamewhere('users', 'user_name', $where);
	return $service;
}
function getShopName($shop_id)
{
	$where = "WHERE id = '$shop_id'";
	$service = getnamewhere('locations_shops', 'shop_name', $where);
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

function getItemNames($item_id)
{
	$where = "WHERE id = '$item_id'";
	$service = getnamewhere('items', 'name', $where);
	return $service;
}

if(isset($_GET["page"])) {
	$page = (int)$_GET["page"];
} else {
	$page = 1;
}
$setLimit = 25;
$pageLimit = ($page * $setLimit) - $setLimit;

function getSaleorders($reference_id = '',$customer_id = '', $from_date ='', $to_date='', $shop='', $pageLimit='', $setLimit='')
{
	$date = date('Y-m-d');
	$qry="SELECT * FROM purchase_order WHERE 1";
	
	if($reference_id != ''){
		$qry .=" AND reference_id = '$reference_id'";
	}
	if($customer_id != ''){
		$qry .=" AND customer_id = '$customer_id'";
	}
	if($from_date != '' && $to_date != '' ) {
		
		$qry .= " AND purchase_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' ";		
	} 
	if($from_date != '' && $to_date == '' ) {
		$qry .= " AND purchase_date >= '$from_date 23:59:59'";
	}

	if($from_date == '' && $to_date != '' ) {
		$qry .= " AND purchase_date <= '$to_date 23:59:59'";
	}
	$qry .=" ORDER BY id DESC LIMIT $pageLimit, $setLimit";
	// echo $qry;
	$result=mysqli_query($GLOBALS['conn'], $qry);
	//$num=mysql_num_rows($result);
	//echo "total result ".$num;
	if($result)
	{
		return $result;
	}
	else
	return false;
}

function displayPaginationBelows($per_page,$page,$reference_id = '',$customer_id = '', $from_date ='', $to_date='', $shop='') {
    $page_url="?";
	$date = date('Y-m-d');
	$query = "SELECT COUNT(*) as totalCount FROM purchase_order WHERE 1 ";
	if($reference_id != ''){
		$query .=" AND reference_id = '$reference_id'";
	}
	//if($shop != ''){
		//$query .=" AND shop_id = '$shop'";
	//}
	if($customer_id != ''){
		$query .=" AND customer_id = '$customer_id'";
	}
	if($from_date != '' && $to_date != '' ) {
		
		$query .= " AND purchase_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' ";		
	} 
	if($from_date != '' && $to_date == '' ) {
		$query .= " AND purchase_date >= '$from_date 23:59:59'";
	}
	if($from_date == '' && $to_date != '' ) {
		$query .= " AND purchase_date <= '$to_date 23:59:59'";
	}	
	//print_r($query);exit;
	$rec = mysqli_fetch_array(mysqli_query($GLOBALS['conn'], $query));
	$total = $rec['totalCount'];
	$adjacents = "2";
	$page = ($page == 0 ? 1 : $page); 
	$start = ($page - 1) * $per_page; 
	$prev = $page - 1; 
	$next = $page + 1;
	$setLastpage = ceil($total/$per_page);
	$lpm1 = $setLastpage - 1;
	$setPaginate = "";
	if($setLastpage > 1)
	{  
		$setPaginate .= "<ul class='setPaginate'>";
				$setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
		if ($setLastpage < 7 + ($adjacents * 2))
		{  
			for ($counter = 1; $counter <= $setLastpage; $counter++)
			{
				if ($counter == $page)
					$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
				else
					$setPaginate.= "<li><a href='{$page_url}page=$counter&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$counter</a></li>";
			}
		}
		elseif($setLastpage > 5 + ($adjacents * 2))
		{
			if($page < 1 + ($adjacents * 2)) 
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
					else
						$setPaginate.= "<li><a href='{$page_url}page=$counter&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$counter</a></li>";
				}
				$setPaginate.= "<li class='dot'>...</li>";
				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$lpm1</a></li>";
				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$setLastpage</a></li>"; 
			}
			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$setPaginate.= "<li><a href='{$page_url}page=1&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>1</a></li>";
				$setPaginate.= "<li><a href='{$page_url}page=2&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>2</a></li>";
				$setPaginate.= "<li class='dot'>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
					else
						$setPaginate.= "<li><a href='{$page_url}page=$counter&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$counter</a></li>";
				}
				$setPaginate.= "<li class='dot'>..</li>";
				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$lpm1</a></li>";
				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$setLastpage</a></li>"; 
			}
			else
			{
				$setPaginate.= "<li><a href='{$page_url}page=1&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>1</a></li>";
				$setPaginate.= "<li><a href='{$page_url}page=2&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>2</a></li>";
				$setPaginate.= "<li class='dot'>..</li>";
				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
				{
					if ($counter == $page)
						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
					else
						$setPaginate.= "<li><a href='{$page_url}page=$counter&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>$counter</a></li>";
				}
			}
		}
		if ($page < $counter - 1){
			$setPaginate.= "<li><a href='{$page_url}page=$next&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>Next</a></li>";
			$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&reference_id=$reference_id&shop=$shop&customer_id=$customer_id&from_date=$from_date&to_date=$to_date'>Last</a></li>";
		}else{
			$setPaginate.= "<li><a class='current_page'>Next</a></li>";
			$setPaginate.= "<li><a class='current_page'>Last</a></li>";
		}
		$setPaginate.= "</ul>\n"; 
	}
	return $setPaginate;
}


function getcategoryName($category_id)
{
	$where = "WHERE id = '$category_id'";
	$category = getnamewhere('category', 'category_title', $where);
	return $category;
}

function getPurchaseOrderitems($id)
{	
	$id = isset($id) ? $id : '';
	$qry="SELECT * FROM purchase_order_items WHERE purchase_id = '".$id."'";
	
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
function getCustomerList()
{
	$customers = array();
	$query = "SELECT * FROM customer_details WHERE 1 ORDER BY customer_id ASC";
	$run = mysqli_query($GLOBALS['conn'], $query);
	while ($row = mysqli_fetch_array($run)) {			
		$customers[] = $row;
	}
	return $customers;
}
$shops = (isset($_GET['shop']) && $_GET['shop'] !='') ? $_GET['shop'] : '';
$reference_ids = (isset($_GET['reference_id']) && $_GET['reference_id'] !='') ? $_GET['reference_id'] : '';
$customer_id = (isset($_GET['customer_id']) && $_GET['customer_id'] !='') ? $_GET['customer_id'] : '';
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
						Manage Sale Orders
						<!--<small>Optional description</small>-->
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Sale Orders</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Manage Sale Orders</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<?php include("common/info.php"); ?>
									<div id="form" class="panel panel-warning" style="display: block;">
										<div class="panel-body">
											<form action="purchases.php" autocomplete="off" accept-charset="utf-8">
												<div class="row">
													<div class="col-sm-2">
														<div class="form-group">
															<label for="reference_id">Invoice No.</label> <input type="text" name="reference_id" value="<?php echo $reference_ids; ?>" class="form-control tip" id="reference_id">
														</div>
													</div>
												
													<div class="col-sm-3">
														<div class="form-group">
															<label>Select Customer</label>
																<select name="customer_id" id="customer_id" class="form-control select2" style="width: 100%;">
																	<option value="">  --Select Customer--  </option>
																	<?php $cust_list = getCustomerList();
																	foreach ($cust_list as $cust){ ?>
																	<option value="<?php echo $cust['customer_id']; ?>" <?php echo ($customer_id == $cust['customer_id']) ? ' selected="selected"' : Null; ?> ><?php echo $cust['customer_name']; ?></option>
																	<?php } ?>
																</select>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>From date:</label>
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
															<label>To date:</label>
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
														<a href="purchases.php" class="btn btn-default">Reset</a>
													</div>
												</div>
											</form>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right pr0">
											<div class="dt-buttons btn-group">
												<span title="Excel" class="print2" style="font-size: 20px;"><a target="_blank" href="excel_export_purchase.php?reference_id=<?php echo $reference_ids; ?>&customer_id=<?php echo $customer_id; ?>&from_date=<?php echo $from_date1; ?>&to_date=<?php echo $to_date1; ?>" class="btn btn-default buttons-csv buttons-html5 export"><span>Excel</span></a></span>  
											</div>
										</div>
									</div>
									<?php include("purchase_order_items.php"); ?>
																		
									<table id="example2" class="table table-bordered table-hover">
										<thead>
												<tr>
													<th>#</th>
													<th>Invoice No</th>													
													<th>Customer Name&Number</th>													
													<!-- <th>Company Name</th> -->
													<th>Sale Date</th>
													<!-- <th>Status</th>												 -->
													<th>Total</th>
													<!-- <th>VAT</th> -->
													<th>Final amount</th>																					
													<th class="hide_print">Action</th>
												</tr>
											</thead>
										<tbody>
												<?php	$grand_total = "0.00";												
													$prs = getSaleorders($reference_ids,$customer_id,$from_date1, $to_date1,$shops, $pageLimit, $setLimit);	
													if($prs != false) {
														$pcount = mysqli_num_rows($prs);
														if($pcount > 0) {
														        $total_vat = $total12 = $total11 ="0.00";
															for($p = 0; $p < $pcount; $p++) {
																$prow = mysqli_fetch_object($prs);
																$id = $prow->id;
																$reference_id = $prow->reference_id;
																$customer_name = $prow->customer_name;
																$customer_number = $prow->customer_number;
																$company_name = $prow->company_name;
																//$payment_status = $prow->payment_status;
																$purchase_date = $prow->purchase_date;
																$status = $prow->status;
																$total = $net_total = $total1 = "0.00";
																$prs1 = getPurchaseOrderitems($id);											
																if($prs1 != false) {
																	$pcount1 = mysqli_num_rows($prs1);
																	if($pcount1 > 0) {
																		for($p1 = 0; $p1 < $pcount1; $p1++) {
																			$prow1 = mysqli_fetch_object($prs1);
																			$pur_order_item_id = $prow1->id;													
																			$price = $prow1->unit_price;
																			$qty = $prow1->qty;
																			$total_amount = $prow1->total_amount;
																			$tax = $prow1->tax;
																			$payment_type = $prow1->payment_type;
																			$item_name = getItemNames($prow1->item_id);
																			$price_qty = $price * $qty;
																			
																			$total1 += $price_qty;
																			// $total += $price_qty+ ($price_qty * ($tax/100));
																			$total += $price_qty;
																		}
																	}
																}
																$total11 += $total1;
																$total12 += $total;
																$total_vat += $total - $total1;
																echo "<tr>";
																echo "<td>".$id."</td>";
																echo "<td>".$reference_id."</td>";																	
																echo "<td>".$customer_name.'-'.$customer_number."</td>";
																// echo "<td>".$company_name."</td>";
																echo "<td>".$purchase_date."</td>";																 
																//if($prow->status == 'pending') {
																	//echo "<td><a href='javascript:void(0)' onclick='changeStatus(\"$rev_payment_status\", \"$id\");'>".ucfirst($status)."</a></td>";
																if($status != "received") {?>
																	<td><select name="status" id="status" class="form-control" onchange='changeStatus(this, "<?php echo $id ?>");' >					
																		<option value="pending" <?php if($status == "pending") { echo "selected"; } ?> >Pending</option>
																		<option value="ordered" <?php if($status == "ordered") { echo "selected"; } ?> >Ordered</option>
																		<option value="received" <?php if($status == "received") { echo "selected"; } ?> >Received</option>
																	</select></td>
																
															<?php	} else {
																//echo "<td>".ucfirst($status)."</a></td>";
															}														
															
															
															
																echo "<td>".$total1."</td>";
																// echo "<td>".($total - $total1)."</td>";
																echo "<td>".$total."</td>";
																echo " <td class='hide_print'>";
																	?>
																<div class="btn-group">
															<?php
															if($status != "received") {?>
															<?php } ?>
															<a href="purchases_add.php?id=<?php echo $id ?>&act=edit" title="Edit Category" class="tip btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
															<a href="javascript:void(0)" title="View" class="tip btn btn-primary btn-xs" data-toggle="modal" data-target='#myModal<?php echo $id;?>'><i class="fa fa-file-text-o"></i></a>
															<a href="single_item_print_a4.php?id=<?php echo $id; ?>&re=purchases.php" title="Invoice" class="tip btn btn-danger btn-xs"><i class="fa fa-print"></i></a>
															
															<!--<a href="#" title="Print Bill" class="tip btn btn-default btn-xs" data-toggle="ajax-modal"><i class="fa fa-print"></i></a>
																<a class="tip image btn btn-primary btn-xs" id="Milkshajr (123456789)" href="#" title="View Attachment"><i class="fa fa-picture-o"></i></a>
																<a href="#" title="Edit Purchase" class="tip btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
																<a href="#" onclick="return confirm('You are going to delete product, please click ok to delete.')" title="Delete Purchase" class="tip btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>-->
														</div>	
														<?php														
															}
															echo "<tr style='font-size:18px;font-weight:bolder;color:#fff;background:#6e886e;'>";
															echo "<td colspan='4'>Final balance</td>";
															echo "<td colspan='1'>".number_format($total11, 2)."</td>";
															// echo "<td colspan='1'>".number_format($total_vat, 2)."</td>";
															echo "<td colspan='2'>".number_format($total12, 2)."</td>";
															echo "</tr>";
														}
													}
													else {
														echo "<tr>";
														echo "<td>No Purchase Orders found to list.</td>";
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
		<script>
			/*$( "#from_date" ).datepicker({dateFormat: 'yy-mm-dd'});
			$( "#to_date" ).datepicker({dateFormat: 'yy-mm-dd'});*/
			function changePaymentStatus(status, id)
			{
				var msg = 'Are you sure you want to change the status for paid?';
				if(status == 'deactivate')
					msg = 'Are you sure you want to change the status for not paid?';
			    if(id && confirm(msg))
			    {
			        window.location.href = site_url+'/admin/purchases.php?id='+id+'&act='+status;
			    }
			}
			function changeStatus(val, id)
			{
				var status = $(val).val();
				var msg = 'Are you sure you want to change the status for '+status+'?';
			    if(id && confirm(msg))
			    {
			        window.location.href = site_url+'/admin/purchases.php?id='+id+'&act='+status+'&s=1';
			    }
			}
			$(document).on('click', '.print_me', function(e) {
				$(".hide_print").hide();
				var content = document.getElementById('delivery_purchase_order').innerHTML;
				var win = window.open();	
				win.document.write('<link href="css/style_v1.css" rel="stylesheet">');
				//win.document.write('<link href="core/framework/libs/pj/css/pj-table.css" rel="stylesheet" type="text/css" />');			
				win.document.write(content);	
				win.print();			
			});
			$(window).on('resize',function(){
			  var size = $(window).width();//get updated width when window is resized
			  $('.table').toggleClass('table', size > 500);//remove class only in less or equal to 1067
			}).resize();//trigger resize on load
		</script>
	</body>
</html>