<?php
session_start();
include("../functions.php");
include_once("../config.php");
include_once('../barcode.php');
connect_dre_db();
//chkAdminLoggedIn();
$server_url = getServerURL();
$pay = '';
$purchase_id = $_GET['id'];
$redirect = $_GET['re'];

	$result = mysqli_query($GLOBALS['conn'], "SELECT * FROM purchase_order WHERE id = '$purchase_id'");  
	$purchase_insert =  mysqli_fetch_assoc($result);
	$purchase_id = $purchase_insert['id'];
	$customer_id = $purchase_insert['customer_id'];
	$customer_name = $purchase_insert['customer_name'];
	$customer_number = $purchase_insert['customer_number'];
	$customer_address = $purchase_insert['customer_address'];
	$company_name = $purchase_insert['company_name'];
	$reference_id = $purchase_insert['reference_id'];
	$status = $purchase_insert['status'];
	$receipt_id = $purchase_insert['payment_status'];
	$purchase_date = date("d-m-Y", strtotime($purchase_insert['purchase_date']));
	$result_arr = array();
	$sql = "SELECT * FROM purchase_order_items WHERE purchase_id = '$purchase_id'";
	$result_val = mysqli_query($GLOBALS['conn'], $sql);
	while ($row = mysqli_fetch_assoc($result_val)) {
		$result_arr[] = $row;			
	}

	//echo "<pre>"; print_r($result_arr);die;
	//Barcode Print
	$img			=	code128BarCode($receipt_id, 1);
	ob_start();
	imagepng($img);	
	//Get the image from the output buffer	
	$output_img		=	ob_get_clean();
?>
<style>
@media print {
	body {font-family: Arial;}
	#wrapper_pr {width: 100%; margin:0 auto; text-align:center; color:#000; font-family: Arial; font-size:12px;}
	.bdd{border-top: 1px solid #000;}	
}
</style>
<?php $style_print = "font-family: Arial"; ?>
<div id="wrapper_pr">
<div style="text-align: center;"><img style="text-align: center;" src="data:image/png;base64,<?php echo CLIENT_LOGO; ?>"></div>
<h2 style="text-transform:uppercase;font-size:13px; text-align:center;line-height: 0.5em;$style_print"><strong><?php echo CLIENT_NAME; ?></strong></h2>
<p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print"><?php echo CLIENT_ADDRESS; ?></p>
<p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print"><?php echo CLIENT_NUMBER; ?></p>
<p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print"><?php echo CLIENT_WEBSITE; ?></p>
<!-- <p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Biller name: <span style="float:right;"><?php //echo date(); ?><span></p> -->
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Order type: <strong><?php echo ucfirst(str_replace("_", ' ', $order_type)); ?></strong></p>
<?php if($order_type != 'delivery' && $payment_type != '') { ?>
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Payment menthod: <strong><?php echo $payment_type; ?></strong></p>
<?php } if($remarks1 == 'yes') {?>
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Remarks: <strong><?php echo $remarks; ?></strong></p>
<?php } ?>
<?php if($card_num > 0) {?>
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Card number: <strong><?php echo $card_num; ?></strong></p>
<?php } ?>
<?php if($order_type == 'dine_in') { ?>
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Floor no: <strong><?php echo $floor_no; ?></strong>&nbsp;&nbsp;Table no: <strong><?php echo $table_no; ?></strong></p>
<?php } ?>
<?php if($deliver == 'yes') {?>
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Customer name:<strong><?php echo $customer_name; ?></strong></p>
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Customer number:<strong><?php echo $customer_number; ?></strong></p>
<p style="font-size:12px; text-align:left;line-height: 0.5em;$style_print">Customer address:<strong><?php echo $customer_address; ?></strong></p>
<?php } ?>
<div style="clear:both;"></div>
<table class="table" cellspacing="0" border="0">
   <thead>
      <tr>
         <th style="font-size:12px;text-align:left; width:70%;$style_print">Items</th>
         <th style="font-size:12px;text-align:right; width:15%;$style_print">U.Price*Qty</th>
		 <th style="font-size:12px;text-align:right; width:15%;$style_print">Price</th>
      </tr>
   </thead>
   <tbody id="bg_val">
   <?php
   $total_amount = $tax_pecr = '0';
	$gst_group = array();
	//$sgst_group = array();
	//echo '<pre>';print_r($result_arr);echo '</pre>';
	foreach($result_arr as $key => $res){	
		echo "<tr>";
		echo "<td style='font-size:12px;float:left; width:80%;$style_print'>".$res['item_name']."</td>";
		echo "<td style='font-size:12px;text-align:right; width:12%;$style_print'>".number_format((float)($res['price']), 2, '.', '')." X ".$res['qty']."</td>";
		echo "<td style='font-size:12px;text-align:right; width:8%;$style_print'>".number_format((float)$res['price']*$res['qty'], 2, '.', '')."</td>";
		echo "</tr>";
		$multiplle_val=$res['price']*$res['qty'];
		$total_amount+=$multiplle_val;
		//echo $key.'<br>';
		$item_price_single = $res['tax_without_price'];
		if (!isset($gst_group[$res['CGST']]['cgst'])) {
			$gst_group[$res['CGST']]['cgst'] = ($item_price_single / 100) * ($res['CGST']) * $res['qty'];
			$gst_group[$res['SGST']]['sgst'] = ($item_price_single / 100) * ($res['SGST']) * $res['qty'];
		}
		else {
			$gst_group[$res['CGST']]['cgst'] = $gst_group[$res['CGST']]['cgst'] + ($item_price_single / 100) * ($res['CGST']) * $res['qty'];
			$gst_group[$res['SGST']]['sgst'] = $gst_group[$res['SGST']]['sgst'] + ($item_price_single / 100) * ($res['SGST']) * $res['qty'];
		}
	}

	

	//echo '<pre>';print_r($gst_group);echo '</pre>';
echo "<tr><td colspan='3'><div style='border-top:1px solid #000;padding:5px 0px;'></div></td></tr>";
echo "<tr><td style='font-size:12px;float:left; width:40%;$style_print'>Sub Total :</td><td colspan='2' style='font-size:12px;text-align: right; width:60%;$style_print'> ".number_format((float)$total_amount, 2, '.', '')."</td></tr>";
echo "<tr><td style='font-size:12px;float:left; width:40%;$style_print'>Discount :</td><td colspan='2' style='text-align: right;font-size:12px; width:60%;$style_print'> ".number_format((float)($discount), 2, '.', '')."</td></tr>";

if(BILL_TAX == 'yes') {
	if(BILL_COUNTRY == 'UAE') {
		$tax_pecr = ($total_amount / 100) * (BILL_TAX_VAL);
		echo "<tr><td style='font-size:12px;float:left; width:40%;$style_print'> VAT (".BILL_TAX_VAL."%):</td><td colspan='2' style='text-align: right;font-size:12px; width:60%;$style_print'> ".number_format((float)($tax_pecr), 2, '.', '')."</td></tr>";
	}
}

echo "<tr><td style='font-size:12px;float:left; width:60%;$style_print'>Grand Total :</td><td colspan='2' style='font-size:12px;text-align: right; width:40%;$style_print'> ".number_format((float)($total_amount - $discount + $tax_pecr), 2, '.', '')."</td></tr>";

if($pay == 'given') {
	echo "<tr><td colspan='3'><div style='border-top:1px solid #000;padding:5px 0px;'></div></td></tr>";
	echo "<tr><td style='font-size:12px;float:left; width:50%;$style_print'>Amount given :</td><td colspan='2' style='text-align: right;font-size:12px; width:50%;$style_print';> ".number_format((float)($amount_given), 2, '.', '')."</td></tr>";
	echo "<tr><td style='font-size:12px;float:left; width:40%;$style_print'>Balance :</td><td colspan='2' style='font-size:12px;text-align: right; width:60%;$style_print'> ".number_format((float)($amount_given - ($total_amount - $discount + $tax_pecr)), 2, '.', '')."</td></tr>";
}
if(BILL_TAX == 'yes') {
	if(BILL_COUNTRY != 'UAE') {
		echo "<tr><td colspan='3'><div style='border-top:1px solid #000;padding:5px 0px;'></div></td></tr>";
		foreach($gst_group as $key => $gst) {
		echo "<tr><td colspan='3'style='font-size:12px;text-align: right;width:100% !important;$style_print'> CGST (".$key."%): ".number_format((float)$gst['cgst'], 2, '.', '')."&nbsp;&nbsp;&nbsp; SGST (".$key."%): ".number_format((float)$gst['sgst'], 2, '.', '')."</td></tr>";
		}
	}
}
?>

</tbody>
</table>
<div style="border-top:1px solid #000;">
   <p style="font-size:12px;text-align:center;"><?php echo BILL_FOOTER; ?></p>
   <p style="font-size:12px;text-align:center;"><?php echo '<img src="data:image/png;base64,' . base64_encode($output_img) . '" />'; ?></p>
   <p style="font-size:12px;text-align:center;font-weight:bold;"><?php echo '<span>'.$receipt_id.'</span>'; ?></p>
</div>
</div>
<script type="text/javascript">
	var content = document.getElementById('wrapper_pr').innerHTML;
	var win = window.open();				
	win.document.write(content);	
	win.print(content);
	win.window.close();
</script>
<?php redirect($redirect); ?>