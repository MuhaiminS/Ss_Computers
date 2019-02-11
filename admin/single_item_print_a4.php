<?php
session_start();
include("../functions.php");
include_once("../config.php");
// include_once('../barcode.php');
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
  /*$img      = code128BarCode($receipt_id, 1);
  ob_start();
  imagepng($img); 
  //Get the image from the output buffer  
  $output_img   = ob_get_clean();*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tax Invoice</title>
    <style type="text/css">
      .header_title {
      margin: 0;text-align: center;font-size: 25px;padding: 9px;color: #000;background: #ccc;font-weight:  bold;
      }
      th {
      border:  1px solid #ccc;
      border-collapse: collapse;
      }
      th {
      border:  1px solid #ccc;
      border-collapse: collapse;
      }
      td {
      border-collapse: collapse;
      border-right: unset;
      border-left: unset;
      }
      .taxinvoilce_table td {
      border:  1px solid #ccc;
      border-collapse: collapse;
      border-right: unset;
      padding: 5px;
      }
      .taxinvoilce_table th {
      font-size: 15px;
      text-align: left;
      padding: 5px;
      }
      main {
      border: 1px solid #ccc;
      }
      table.logo_table tr td {
      text-align:  left;
      padding: 0;
      }
      table.logo_table {
      background:  #fff !important;
      }
      table.logo_table tr td {
      background: #fff;
      }
      table.logo_table tr td img {
      width: 100px;
      }
      table.logo_table tr td h3 {
      text-transform: uppercase;
      padding-top: 3px;
      text-align: center;
      font-size: 25px;
      color:#000;
      }
      table.taxinvoilce_table p {
      margin: 0;
      padding: 5px;
      font-family:  roboto;
      color:  #000;
      font-weight: 500;
      }
      .clearfix:after {
      content: "";
      display: table;
      clear: both;
      }
      a {
      color: #0087C3;
      text-decoration: none;
      }
      body {
      position: relative;
      width: 21cm;  
      height: auto; 
      margin: 0 auto; 
      color: #555555;
      background: #FFFFFF; 
      font-family:roboto; 
      font-size: 14px; 
      }
      footer {
    color: #777777;
    width: 100%;
    height: 30px;
    position: absolute;
    top: 120px;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding: 10px 0px;
    text-align: center;
}
      h5.headertop_taxno {
      text-align: right;
      padding: 12px 15px;
      margin: 0;
      font-size: 15px;
      }
      h5.headertop_taxno span {
      padding-left: 5px;
      }
      @media print {
      .header_title {
      margin: 0;text-align: center;font-size: 25px;padding: 9px;color: #000;background: #ccc !important;font-weight:  bold;
      }
      }
      @media print and (color) {
      * {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
      }
      .header_title {
      margin: 0;text-align: center;font-size: 25px;padding: 9px;color: #000;background: #ccc !important;font-weight:  bold;
      }
      th {
      border:  1px solid #ccc;
      border-collapse: collapse;
      }
      th {
      border:  1px solid #ccc;
      border-collapse: collapse;
      }
      td {
      border-collapse: collapse;
      border-right: unset;
      border-left: unset;
      }
      .taxinvoilce_table td {
      border:  1px solid #ccc;
      border-collapse: collapse;
      border-right: unset;
      padding: 5px;
      }
      .taxinvoilce_table th {
      font-size: 15px;
      text-align: left;
      padding: 5px;
      }
      main {
      border: 1px solid #ccc;
      }
      table.logo_table tr td {
      text-align:  left;
      padding: 0;
      }
      table.logo_table {
      background:  #fff !important;
      }
      table.logo_table tr td {
      background: #fff;
      }
      table.logo_table tr td img {
      width: 100px;
      }
      table.logo_table tr td h3 {
      text-transform: uppercase;
      padding-top: 3px;
      text-align: center;
      font-size: 25px;
      color:#000;
      }
      table.taxinvoilce_table p {
      margin: 0;
      padding: 5px;
      font-family:  roboto;
      color:  #000;
      font-weight: 500;
      }
      .clearfix:after {
      content: "";
      display: table;
      clear: both;
      }
      a {
      color: #0087C3;
      text-decoration: none;
      }
      body {
      position: relative;
      width: 21cm;  
      height: auto; 
      margin: 0 auto; 
      color: #555555;
      background: #FFFFFF; 
      font-family:roboto; 
      font-size: 14px; 
      }
      footer {
    color: #777777;
    width: 100%;
    height: 30px;
    position: absolute;
   top: 120px;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding: 10px 0px;
    text-align: center;
}
      h5.headertop_taxno {
      text-align: right;
      padding: 12px 15px;
      margin: 0;
      font-size: 15px;
      }
      h5.headertop_taxno span {
      padding-left: 5px;
      }
      tbody.toptabel_tbody tr td {
    border: unset;
}
td.borderbottom_toptabel {
    border-bottom: 1px solid #ccc !important;
}
tbody.toptabel_tbody tr td:nth-child(1) {
    text-align: right;
}
      }



      /**/
td.borderbottom_toptabel {
    border-bottom: 1px solid #ccc !important;
}
tbody.toptabel_tbody tr td:nth-child(1) {
    text-align: right;
}
   tbody.toptabel_tbody tr td {
    border: unset;
}
    </style>
  </head>
  <body>
    <main>
      <!-- <img src="img/img.jpg" style="width:100%;"> -->
      <h2 style="text-align: center;text-transform: uppercase;"><?php echo  CLIENT_NAME; ?></h2>
       <p style="font-size:  13px;text-align: center;margin: 0;">Erode, TamilNadu</p>
      <p style="font-size:  13px;text-align: center;margin: 0;"> +91 8870073539</p>
      

      <h5 class="headertop_taxno"> <br></h5>
      <h5 class="header_title">Tax Invoice</h5>
       <table class="taxinvoilce_table" style="width: 100%;border-collapse: collapse;" >
        <tr>
           <td style="width: 50%;">
            <table style="width: 100%;" >
              <tbody class="toptabel_tbody">
                <tr >
                  <td style="width: 30%;text-align: center;" >Invoice TO : </td>
                  <td style="width: 70%;"  class="borderbottom_toptabel"><?php echo $customer_name; ?></td>
                </tr>
                <tr>
                  <td style="width: 30%;text-align: center;" ></td>
                  <td style="width: 70%;"  class="borderbottom_toptabel"><?php echo $customer_number; ?></td>
                </tr>
                <tr>
                  <td style="width: 30%;text-align: center;" ></td>
                  <td style="width: 70%;"  class="borderbottom_toptabel"><?php echo $customer_address; ?></td>
                </tr>
                <!-- <tr>
                  <td style="width: 30%;text-align: center;" ></td>
                  <td style="width: 70%;"  class="borderbottom_toptabel">TRN No:<?php echo $customer_trn_no; ?></td>
                </tr> -->
              </tbody>
            </table>
          </td>
          <td style="width: 50%;">
            <table style="width: 100%;" >
              <tbody class="toptabel_tbody">
                <tr >
                  <td style="width: 50%;" >Invoice No : </td>
                  <td style="width: 50%;"  class="borderbottom_toptabel"><?php echo $reference_id; ?></td>
                </tr>
                <tr>
                  <td style="width: 50%;" >Date & Time : </td>
                  <td style="width: 50%;"  class="borderbottom_toptabel"><?php echo $purchase_date; ?></td>
                </tr>
        

              </tbody>
            </table>
          </td>
        </tr>
</table>
  
  <table class="taxinvoilce_table" style="width: 100%;border-collapse: collapse;" >



        <thead>
          <tr>
            <th colspan="4">Product name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
                          <?php
            
            $total_amount = $tax_pecr = $total_vat = $total_qty = $total_vat_amount = $DiscountTotal= '0';
  $gst_group = array();
  $s_no=1;
  //$sgst_group = array();
  //echo '<pre>';print_r($result_arr);echo '</pre>';
  foreach($result_arr as $key => $res){ 
  
    $multiplle_val=$res['unit_price']*$res['qty'];
  //  $total_amount+=$multiplle_val;
    //echo $key.'<br>';
    // $item_price_single = $res['tax_without_price'];
    /*if (!isset($gst_group[$res['CGST']]['cgst'])) {
      $gst_group[$res['CGST']]['cgst'] = ($multiplle_val / 100) * ($res['CGST']) * $res['qty'];
      $gst_group[$res['SGST']]['sgst'] = ($multiplle_val / 100) * ($res['SGST']) * $res['qty'];
    }
    else {
      $gst_group[$res['CGST']]['cgst'] = $gst_group[$res['CGST']]['cgst'] + ($multiplle_val / 100) * ($res['CGST']) * $res['qty'];
      $gst_group[$res['SGST']]['sgst'] = $gst_group[$res['SGST']]['sgst'] + ($multiplle_val / 100) * ($res['SGST']) * $res['qty'];
    }*/
    $price = $res['unit_price'];
    // $servicefee = $res['unit_price'];
    // $vat = round($res['unit_price']*0.05,2);
     
    $total_amount += $price*$res['qty'];
    $tax_pecr = ($total_amount / 100) * (BILL_TAX_VAL);
  
  ?>
            <tr>
              <!-- <td style="border: 1px solid #000;padding-left: 6px;text-align:center;"><?php echo $s_no; ?></td> -->
              <td colspan="4"><?php echo $res['product_name']; ?></td>
             
              <td ><?php echo number_format((float)$res['unit_price'], 2, '.', ''); ?></td>                          
              <td ><?php echo $res['qty']; ?></td>
              <td ><?php echo number_format((float)$res['unit_price']*$res['qty'], 2, '.', ''); ?></td>             
            </tr>
                        
 <?php
       $s_no+=1;                 
  }
  
  $gross_amount=$total_amount;
  
?>
          <tr style="height: 200px">
            <td colspan="11" >&nbsp;</td>
          </tr>
        
           <tr>
          <td colspan="4" style="height:100px;padding:10px;width: 70%;border:unset !important; ">
            Message to Customer: 
            <br> <p><?php //echo $remarks; ?></p>
          </td>
          <td colspan="3" style="width: 30%;">
            <table style="width: 100%;" >
              <th colspan="2" style="text-align:center;background: #a7a8aa" >INVOICE SUMMARY</th>
              <tbody>
                <tr >
                  <td>Total Amount: </td>
                  <td><?php echo number_format((float)$total_amount, 2, '.', ''); ?></td>
                </tr>
                <!-- <tr>
                  <td>Discount: </td>
                  <td><?php echo number_format((float)$discount, 2, '.', ''); ?></td>
                </tr> 
                <tr>
                  <td>VAT Amount: </td>
                  <td><?php echo number_format((float)$tax_pecr, 2, '.', ''); ?></td>
                </tr>-->
                <tr>
                  <td>Net Total: </td>
                  <td><?php echo number_format((float)$gross_amount, 2, '.', ''); ?></td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!--  -->
      </table>
    </main>
   
     <script type="text/javascript">
      window.onload = function () {
        //window.open();
        window.print();
       window.close();
       window.location.href='purchases.php';
      };
      </script>  


  </body>
</html>
