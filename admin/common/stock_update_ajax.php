<?php
	session_start();
	include_once("../config.php");
	include("../functions.php");	
	connect_dre_db();
	//print_r($_POST); die;	
	$reduce_stock = $_POST['reduce_stock'];
	$expiry_date = date('Y-m-d H:i:s',strtotime($_POST['expiry_date']));
	$stock_old = $_POST['stock_old'];
	$product_id = $_POST['product_id'];
	$reduce_date = date("Y-m-d H:i:s");	
	if($reduce_stock != '' && $reduce_stock > 0) {
		// $sql = mysqli_query($GLOBALS['conn'],"INSERT INTO ingredient_stock_reduce1(product_id, old_stock, reduce_stock, reduce_date) VALUES ('$product_id','$stock_old','$reduce_stock','$reduce_date')");
		$sql = mysqli_query($GLOBALS['conn'],"INSERT into items_stock_history (product_id,stock_add,stock_add_date,stock_expiry_date) VALUES ('$product_id','$reduce_stock',CURDATE(),'$expiry_date') ");
		$sql = mysqli_query($GLOBALS['conn'],"UPDATE items SET stock = stock + '$reduce_stock' , stock_add_date = '$expiry_date' WHERE id='$product_id' ");
		$reduce_stk = $stock_old - $reduce_stock;
		$sql = "SELECT * FROM ".DB_PRIFIX."receipe_incrediant_manage WHERE receipe_id = '$product_id'";
		$receipe_incrediant_details = mysqli_query($GLOBALS['conn'], $sql);		
		if($receipe_incrediant_details)
		{	
			$num = mysqli_num_rows($receipe_incrediant_details);
			while($row = mysqli_fetch_array($receipe_incrediant_details)) {
				$rim_id  = $row['id'];
				$rim_receipe_id  = $row['receipe_id'];
				$rim_incrediant_id = $row['incrediant_id'];
				$rim_qty  = $row['qty'];
				$rim_incrediant_unit  = $row['incrediant_unit'];
				$rim_weight  = $row['weight'];		
				$rim_unit_cost = $row['unit_cost'];
				$rim_vat  = $row['vat'];
				$rim_total_amount = $row['total_amount'];

				$query="SELECT * FROM products WHERE stock > '0' and id ='$rim_incrediant_id' ORDER BY id ASC";
				$run = mysqli_query($GLOBALS['conn'], $query);
				while($row = mysqli_fetch_array($run)) {
					$cat_id = $row['id'];
					$stock = $row['stock'];
					$net_total = $row['net_total'];
					$unit_price = round($net_total/$stock,2);
					}
					$reduce_qty = number_format($rim_weight*$reduce_stock,2);
						$reduce_net_total = number_format($reduce_qty*$unit_price,2);
				/*===GET OLD STOCK==*/
				$qry = "SELECT stock FROM ".DB_PRIFIX."products WHERE id = $rim_incrediant_id";
				$rim_incrediant = mysqli_fetch_assoc(mysqli_query($GLOBALS['conn'], $qry));
				$incrediant_old_stock = $rim_incrediant['stock'];

				/*===STOCK REDUCE FROM INCREDIANTS TABLE==*/
			//	$incrediants_stock_reaming = $incrediant_old_stock - ($reduce_stock * $rim_weight);
				if($reduce_qty) {
					$update = "UPDATE ".DB_PRIFIX."products SET stock = stock - '$reduce_qty',net_total = net_total - '$reduce_net_total' WHERE id = '$rim_incrediant_id'";
					mysqli_query($GLOBALS['conn'], $update);
				}			
			}
		}
		echo json_encode('success');		
	} else { 
		echo json_encode('error');
	}
?>