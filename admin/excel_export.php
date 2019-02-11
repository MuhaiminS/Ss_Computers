<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//echo "fhgtj";die;
//session_start();
include("../functions.php");
include_once("../config.php");
connect_dre_db();

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

/*function getnamewhere($tabname,$name,$where)     // pass the table name , name of field to return all the values
{

				$qry="SELECT $name FROM $tabname $where";
				//echo $qry;
				$result=mysqli_query($GLOBALS['conn'], $GLOBALS['conn'], $qry);
				$num=mysqli_num_rows($result);
				$i=0;
				$varname = '';
				if($num>0)
				{
					while($row = mysqli_fetch_assoc($result)) {					   
					   $varname = $row[$name]; 
					}
					//$varname=safeTextOut(mysqli_result($result,$i,$name));
					
				}
				return $varname;

}*/


$get_type = (isset($_GET['get_type']) && $_GET['get_type'] !='') ? $_GET['get_type'] : '';
$sale = (isset($_GET['sale']) && $_GET['sale'] !='') ? $_GET['sale'] : '';
$order_type = (isset($_GET['order_type']) && $_GET['order_type'] !='') ? $_GET['order_type'] : '';
$shop = (isset($_GET['shop']) && $_GET['shop'] !='') ? $_GET['shop'] : '';

function getSaleorders($receipt_id = '',$payment_type = '', $from_date ='', $to_date='', $user='', $order_type='', $shop = '')
{
	$date = date('Y-m-d');
	$qry="SELECT * FROM sale_orders WHERE order_type = '$order_type'"; 
	if($receipt_id != ''){
		$qry .=" AND receipt_id = '$receipt_id'";
	}
	if($user != ''){
		$qry .=" AND user_id = '$user'";
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
	
	$qry .=" ORDER BY id DESC";
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

$status_arr =  array(
	'pending' => 'Pending',
	'progressing' => 'Progressing',
	'ready_for_delivery' => 'Ready for delivery',
	'completed' => 'Completed',
	'delivered' => 'Delivered',
	'cancel' => 'canceled',
	'draft' => 'Draft'
);

$user = (isset($_GET['user']) && $_GET['user'] !='') ? $_GET['user'] : '';
$receipt_id = (isset($_GET['receipt_id']) && $_GET['receipt_id'] !='') ? $_GET['receipt_id'] : '';
$payment_type = (isset($_GET['payment_type']) && $_GET['payment_type'] !='') ? $_GET['payment_type'] : '';
$from_date = (isset($_GET['from_date']) && $_GET['from_date'] !='') ? $_GET['from_date'] : '';
$to_date = (isset($_GET['to_date']) && $_GET['to_date'] !='') ? $_GET['to_date'] : '';


$table = '';
$filename = time();

$table .= '<table border="1" cellspacing="0" bordercolor="#222"><tr>'; 
        $table .= '<td style="background-color:#244062; color:#fff;">Id</td>';
        $table .= '<td style="background-color:#244062; color:#fff;">Receipt Id</td>';
        $table .= '<td style="background-color:#244062; color:#fff;">Contact Details</td>';
        $table .= '<td style="background-color:#244062; color:#fff;">User name</td>';
	
		$table .= '<td style="background-color:#244062; color:#fff;">Order Date</td>';		
        $table .= '<td style="background-color:#244062; color:#fff;">Time</td>';
        //$table .= '<td style="background-color:#244062; color:#fff;">Token</td>';
        $table .= '<td style="background-color:#244062; color:#fff;">Payment Type</td>';
		$table .= '<td style="background-color:#244062; color:#fff;">Sub Total</td>';
		$table .= '<td style="background-color:#244062; color:#fff;">Cost Total</td>';
		$table .= '<td style="background-color:#244062; color:#fff;">Profit Total</td>';
		$table .= '<td style="background-color:#244062; color:#fff;">VAT</td>';
		$table .= '<td style="background-color:#244062; color:#fff;">Discount</td>';
		$table .= '<td style="background-color:#244062; color:#fff;">Final Total</td>';
        $table .= '</tr>';

		$grand_final_total = "0.00";
		$grand_cost_price_total = "0.00";
		$grand_profit = "0.00";
		$grand_sub_total = "0.00";
		$grand_discount_total = "0.00";
		$grand_vat_total = "0.00";												
$prs = getSaleorders($receipt_id,$payment_type,$from_date, $to_date,$user,$order_type, $shop);										
if($prs != false) {
	$pcount = mysqli_num_rows($prs);
	if($pcount > 0) {
		for($p = 0; $p < $pcount; $p++) {
			$prow = mysqli_fetch_object($prs);
			$id = $prow->id;
			$receipt_id = $prow->receipt_id;
			$contact_name = $prow->contact_name;
			$contact_number = $prow->contact_number;
			$address = $prow->address;
			$ordered_date = $prow->ordered_date;																
			$payment_status = $prow->payment_status;
			$payment_type = $prow->payment_type;
			$discount = $prow->discount;
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
			//$token = $prow->token;
			//$status = $prow->status;
			$user_name = getUserName($prow->user_id);
			//$name = getManufacturingUnitName($prow->manufacturing_unit_id);
			$shop_name = getShopName($prow->shop_id);
			$ordered_date_only = date('Y-m-d', strtotime($ordered_date));
			$time = date('H:i:s', strtotime($ordered_date));
			
			
			
			

        	$table .= "<tr>";
			$table .=  "<td>".$id."</td>";
			$table .=  "<td>".$receipt_id."</td>";
			$table .=  "<td>Name:".$contact_name.", Address:".$address.", Ph:".$contact_number."</td>";	
			$table .=  "<td>".$user_name."</td>";
		
			$table .=  "<td>".$ordered_date_only."</td>";			
			$table .=  "<td>".$time."</td>";
			//$table .=  "<td style='background-color:#ffff00;'>".$token."</td>";
			$table .=  "<td style='background-color:#ffff00;'>".$payment_type."</td>";
			$table .=  "<td>".number_format($sub_total, 2)."</td>";
			$table .=  "<td>".number_format($cost_price_total, 2)."</td>";
			$table .=  "<td>".number_format($profit, 2)."</td>";
			$table .=  "<td>".number_format($vat_price, 2)."</td>";
			$table .=  "<td>".number_format($discount, 2)."</td>";
			$table .=  "<td style='background-color:#ffff00;'>".number_format($final_total, 2)."</td>";
			$table .=  "</tr>";
		}
		$table .=  "<tr>";
		$table .=  "<td colspan='7'>Final balance</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($grand_sub_total, 2)."</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($grand_cost_price_total, 2)."</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($grand_profit, 2)."</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($grand_vat_total, 2)."</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($grand_discount_total, 2)."</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($grand_final_total, 2)."</td>";
		$table .=  "</tr>";
			
		} }
		$table .= '</table>';
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=$filename.xls "); 
header("Content-Transfer-Encoding: binary ");
echo $table;
///echo "<script>window.close();</script>";
?>