<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//echo "fhgtj";die;
//session_start();
include("../functions.php");
include_once("../config.php");
connect_dre_db();
$shop ='';
function getUserName($user_id)
{
	$where = "WHERE id = '$user_id'";
	$service = getnamewhere('users', 'user_name', $where);
	return $service;
}

function getItemNames($item_id)
{
	$where = "WHERE id = '$item_id'";
	$service = getnamewhere('items', 'name', $where);
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


$reference_id = (isset($_GET['reference_id']) && $_GET['reference_id'] !='') ? $_GET['reference_id'] : '';
$payment_status = (isset($_GET['payment_status']) && $_GET['payment_status'] !='') ? $_GET['payment_status'] : '';
$from_date = (isset($_GET['from_date']) && $_GET['from_date'] !='') ? $_GET['from_date'] : '';
$to_date = (isset($_GET['to_date']) && $_GET['to_date'] !='') ? $_GET['to_date'] : '';

function getSaleorders($reference_id = '',$payment_status = '', $from_date ='', $to_date='', $shop='')
{
	$date = date('Y-m-d');
	$qry="SELECT * FROM purchase_order WHERE 1";
	
	if($reference_id != ''){
		$qry .=" AND reference_id = '$reference_id'";
	}
	if($payment_status != ''){
		$qry .=" AND payment_status = '$payment_status'";
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

$user = (isset($_GET['user']) && $_GET['user'] !='') ? $_GET['user'] : '';
$receipt_id = (isset($_GET['receipt_id']) && $_GET['receipt_id'] !='') ? $_GET['receipt_id'] : '';
$payment_type = (isset($_GET['payment_type']) && $_GET['payment_type'] !='') ? $_GET['payment_type'] : '';
$from_date = (isset($_GET['from_date']) && $_GET['from_date'] !='') ? $_GET['from_date'] : '';
$to_date = (isset($_GET['to_date']) && $_GET['to_date'] !='') ? $_GET['to_date'] : '';


$table = '';
$filename = time();

$table .= '<table border="1" cellspacing="0" bordercolor="#222"><tr>'; 
        $table .= '<td style="background-color:#244062; color:#fff;">Id</td>';
        $table .= '<td style="background-color:#244062; color:#fff;">Invoice No</td>';
        $table .= '<td style="background-color:#244062; color:#fff;">Customer Name & Number</td>';
		$table .= '<td style="background-color:#244062; color:#fff;">Purchase Date</td>';
		  $table .= '<td style="background-color:#244062; color:#fff;">Total</td>';
		 $table .= '<td style="background-color:#244062; color:#fff;">Final amount</td>';
        $table .= '</tr>';

  $grand_total = "0.00";												
	$prs = getSaleorders($reference_id,$payment_status, $from_date, $to_date, $shop);
	if($prs != false) {
		$pcount = mysqli_num_rows($prs);
		if($pcount > 0) {
			$total_vat = $total12 = $total11 ="0.00";
			for($p = 0; $p < $pcount; $p++) {
				$prow = mysqli_fetch_object($prs);
				$id = $prow->id;
				$reference_id = $prow->reference_id;
				$company_name = $prow->company_name;
				$payment_status = $prow->payment_status;
				$purchase_date = $prow->purchase_date;
				$customer_name = $prow->customer_name;
				$customer_number = $prow->customer_number;
				$status = $prow->status;
				$payment_status = ($prow->payment_status == 'paid') ? 'Paid' : 'Not Paid';
				$rev_payment_status = ($prow->payment_status) ? 'not_paid' : 'paid';
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
							$total += $price_qty+ ($price_qty * ($tax/100));
							$tax_val = $total - $total1;
						}
					}
				}
				$total11 += $total1;
				$total12 += $total;
				$total_vat += $total - $total1;

        $table .= "<tr>";
			$table .=  "<td>".$id."</td>";
			$table .=  "<td>".$reference_id."</td>";
			$table .=  "<td>".$customer_name.'-'.$customer_number."</td>";
			$table .=  "<td>".$purchase_date."</td>";;
			$table .=  "<td>".$total1."</td>";
			// $table .=  "<td>".($tax_val)."</td>";
			$table .=  "<td>".$total."</td>";
			/*$table .=  "<td>".$total."</td>";
			$table .=  "<td>".$vat_price."</td>";
			$table .=  "<td style='background-color:#ffff00;'>".$grand_total."</td>";*/
			$table .=  "</tr>";
		} 
		$table .=  "<tr>";
		$table .=  "<td colspan='4'>Final balance</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($total11, 2)."</td>";
		// $table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($total_vat, 2)."</td>";
		$table .=  "<td colspan='1' style='background-color:#ffff00;'>".number_format($total12, 2)."</td>";
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