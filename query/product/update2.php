<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
$uid = (isset($_SESSION['id']))?$_SESSION['id']:false;
if($uid){
	$list = $db->db_get_list('select price, amount, coupon_id from spcart where user_id='.$uid);
	$total = 0;
	foreach ($list as $item) {
		$coupon = $db->db_get_row('select discount from coupon where id='.$item['coupon_id'].' limit 1');
		$system = $db->db_get_row('select ship from system where id=1');
		$discount = (!empty($coupon['discount']))?$coupon['discount']:false;
		$price = $item['price']*$item['amount'];
		$price += $item['amount']*$system['ship'];
		$total += $price - $discount*$price/100;

	}
	if($qry){
		$total = $amount*$row['price'];
		$total = $total-$total*$discount/100;
		$arr['sts'] = 1;
		$arr['msg'] = 'success';
		$arr['total'] = number_format(floor($total),0,',',',');
		$arr['mainTotal'] = number_format(floor($mtotal),0,',',',');
		$arr['priceTotal'] = $mtotal;
		$arr['discount'] = $discount;

	}
}
echo json_encode($arr);