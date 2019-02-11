<?php 
   session_start();
   require_once 'db_functions.php';
   $function = New DB_Functions(); 
   $inputs['shop_id'] = $_SESSION['shop_id'];
   $inputs['user_id'] = $_SESSION['user_id'];
   $inputs['discount_type'] = 'amount';
   $inputs['to_date'] = date("Y-m-d H:i:s");
   $settle_sale = $function->getAllSettle($inputs);
   $set = (isset($_GET['set']) && $_GET['set'] !='') ? $_GET['set'] : '';

   $inputs1['from_date'] = date('Y-m-d 00:00:00');
   $inputs1['to_date'] = date('Y-m-d 23:59:59');
   $inputs1['shop_id'] = $_SESSION['shop_id'];
   $inputs1['user_id'] = $_SESSION['user_id'];
   $inputs1['order_type'] = 'delivery';
   $inputs1['payment_type'] = '';
   $inputs1['payment_status'] = 'unpaid';
   $inputs1['status'] = 'pending';
   $sale_orders = $function->getSaleOrderItemDetailsList($inputs1);
$redirect = "settle_sale.php";
////echo '<pre>';print_r($sale_orders);
 ?>
 <?php if((count($sale_orders) > 0) && ($set == 'yes')) { ///echo '123'; die;
	echo "<script>alert('COD items or Hold items still pending. So cant able to settle');</script>";
	$function->redirect($redirect);
	exit;
}
/*
if(($settle_sale['hold_pending'] == 1) && ($set == 'yes')) {
	echo "<script>alert('Hold items still pending. So cant able to settle');</script>";
	$function->redirect($redirect);
	exit;
 }*/


?>
  <style>
@media print {
	body {font-family: Arial;}
	#wrapper_pr {width: 100%; margin:0 auto; text-align:center; color:#000; font-family: Arial; font-size:12px;}
	.bdd{border-top: 1px solid #000;}	
}
</style>
<?php $style_print = "font-family: Arial"; 
?>

<div id="wrapper_pr" style="border: 1px solid #000;padding:1px;">

	<div style="border: 1px solid #000;margin-bottom:1px;padding-bottom:25px;">
    <div style="text-align: center;"><img style="text-align: center;" src="data:image/png;base64,<?php echo CLIENT_LOGO; ?>"></div>
<h2 style="text-transform:uppercase;font-size:13px; text-align:center;line-height: 0.5em;$style_print"><strong><?php echo CLIENT_NAME; ?></strong></h2>
<p style="font-size:12px; text-align:center;line-height: 1em;$style_print"><?php echo CLIENT_ADDRESS; ?></p>
<p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print"><?php echo CLIENT_NUMBER; ?></p>
<p style="font-size:12px; text-align:center;line-height: 0.5em;$style_print"><?php echo CLIENT_WEBSITE; ?></p>
<!--<h1 style="text-align:center; font-size:22px;$style_print">TAX INVOICE</h1>-->



  </div>
  <?php //echo '<pre>';print_r($cus_details); ?>
  <table class="table" cellspacing="0" border="1" style="border-collapse: collapse;width: 100%;">
  <thead>
     
     <tr>
         <th style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Date</th>
         <th style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo date("Y-m-d H:i:s"); ?></th>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Cash Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['cash_sale'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Card Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['card_sale'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Credit Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['credit_sale'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Credit Recovery Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['credit_recover'], 2, '.', ',') ?></td>
      </tr>
	  <!--<tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Delivery Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['delivery_sale'], 2, '.', ',') ?></td>
      </tr>
	  <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Delivery Recovery Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['delivery_recover'], 2, '.', ',') ?></td>
      </tr>-->
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Online order Recovery Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['online_order_recovery'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Pay back Sale</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['pay_back'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Expense</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['expense'], 2, '.', ',') ?></td>
      </tr>
	  <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Local Purchase</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['loacal_purchase'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Total VAt</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['total_vat'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Amount In Cash Drawer</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['cash_drawer'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Gross Total</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['gross_total'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Discount</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['discount'], 2, '.', ',') ?></td>
      </tr>
      <tr>
         <td style="border: 1px solid #000;font-size:12px;text-align:left; width:70%;$style_print;padding-left: 6px;">Net Total</td>
         <td style="border: 1px solid #000;font-size:12px;text-align:right; width:30%;$style_printpadding-right: 6px;"><?php echo number_format((float)$settle_sale['net_total'], 2, '.', ',') ?></td>
      </tr>
      
    </thead>
  </table>
  
  
  
 
  <div style="clear:both;"></div>
 
</div>





<script type="text/javascript">
	/*var content = document.getElementById('wrapper_pr').innerHTML;
	var win = window.open();				
	win.document.write(content);	
	win.print(content);
	win.window.close();*/
	var content = document.getElementById('wrapper_pr').innerHTML;
	window.print(content);
</script>

<?php
$settle_sale['settle_date'] = date("Y-m-d H:i:s");
$settle_sale['shop_id'] = $_SESSION['shop_id'];
$settle_sale['user_id'] = $_SESSION['user_id'];
$settle_sale['discount_type'] = 'amount';
$settle_sale['to_date'] = date("Y-m-d H:i:s");
if($set == 'yes'){//echo '<pre>'; print_r($settle_sale);
	$settle_sale = $function->setSettleSale($settle_sale);	
	if($settle_sale){
		$function->redirect($redirect);
	}
} else {
	$function->redirect($redirect);
}
?>