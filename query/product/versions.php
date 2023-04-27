<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
$selid = (isset($_POST['selid']) && !empty($_POST['selid'])) ? intval($_POST['selid']) : false;
if($selid){
	$sql = 'select types_of_products.price - types_of_products.price*products.sale/100 as price from types_of_products, products where types_of_products.product_id=products.id and types_of_products.id='.$selid;
	$tproduct = $db->db_get_row($sql);
	if($tproduct){
		$arr['sts'] = 1;
		$arr['msg'] = 'Success';
		$arr['price'] = number_format($tproduct['price'],0,',',',')."<sup>đ</sup>";
	}
}
echo json_encode($arr);