<?php 
date_default_timezone_set("Asia/Dubai");
define("DB_PRIFIX", "");
//define("DB_PRIFIX_BIZZ", "equipment_");
//define("DB_PRIFIX", "");
function connect_dre_db()
{		
	
	//Local
	/*define("DB_HOSTT", "localhost");
    define("DB_USERR", "id8685619_muhaiminsheik");
    define("DB_PASSWORDD", "dbsss_sscomputes");
    define("DB_DATABASEE", "id8685619_dbsss_sscomputes");
*/    
	
	
	//Local
	define("DB_HOSTT", "localhost");
    define("DB_USERR", "root");
    define("DB_PASSWORDD", "");
    define("DB_DATABASEE", "ss_computers");
    
    
    //dev
	/*define("DB_HOSTT", "localhost");
    define("DB_USERR", "zahratgr_pos");
    define("DB_PASSWORDD", "zahratgr@pos");
    define("DB_DATABASEE", "zahratgr_mobile_demo");*/
    
    
    $conn = mysqli_connect(DB_HOSTT, DB_USERR, DB_PASSWORDD, DB_DATABASEE);
 
    // return database handler
    $GLOBALS['conn'] = $conn;

	//$shop_id = (isset($_SESSION['shop_id']) && $_SESSION['shop_id'] != '') ? $_SESSION['shop_id'] : '1';
	$query = "SELECT * FROM ".DB_PRIFIX."settings ";
	//if($shop_id != '') {
		//$query .= " WHERE shop_id ='".$shop_id."'";
	//}
	$result = mysqli_query($GLOBALS['conn'], $query);
	if ($result) {
		$result_arr = array();
		while ($row = mysqli_fetch_assoc($result)) {
		   $result_arr[] = $row;			
		}
	}		
	//echo '<pre>'; print_r($result_arr);

	//Client details
	/*define("CLIENT_NAME", "CLT WEB POS");
	define("CLIENT_ADDRESS", "Dubai");
	define("CLIENT_NUMBER", "123456790");
	define("CLIENT_WEBSITE", "www.connectivelinkstechnology.com");
	//Recipt pre details
	define("RECIPT_PRE", "CLT-");
	define("CURRENCY", "AED");
	define("BILL_TAX", "no");
	define("BILL_FOOTER", "Thank you for your business!");
	
	 //SMS integration
	define("API_KEY", "2sYDrDoDx9z4");
	define("FROM_NUM", "+971551077843");
	define("OWNER_NUM", "+971551077843");*/
	foreach($result_arr as $res){
		define($res['set_name'], $res['set_value']);
	}
	define("CLIENT_NAME", "SS Computers");
	define("BILL_TAX", "yes");
	define("BILL_COUNTRY", "UAE");
	//define("BILL_TAX_VAL", "5");
	define("FROM_NUM", "");

	return $GLOBALS['conn'];
}
function getServerURL(){
	$dir_path = '/FreeLancing/Ss_Computers';
	
    $url = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$pu = parse_url($url);
    return $pu["scheme"] . "://" . $pu["host"].$dir_path;
}
?>