<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
function check_cart($id, $sqty, $uid, $typeid, $db){
	$sel = $db->db_get_row('select `id`, `amount` from `spcart` where `user_id`='.$uid.' and `typepid`="'.$typeid.'" and `status`=1 and `product_id`='.$id);
	$sel['amount'] = (!empty($sel['amount']))?$sel['amount']:0;
	$amount = $sel['amount'] + $sqty;

	
	$product = $db->db_get_row('select `price`, `sale`, `store_id`, `bfrom`, `discount`  from `products` where `id`='.$id);
	if($product['bfrom'] && $amount >= $product['bfrom']){
			$typep = $db->db_get_row('select price from types_of_products where product_id='.$id);
			if(!empty($typep)) $product['price'] = $typep['price'];
		$type = explode("đ", $product['discount']);
		$discount = (int)$product['discount'];
		if(!isset($type[1])) $product['price'] = $product['price'] - $discount * $product['price'] / 100;
		else $product['price'] -= $discount;
	}
	$price = $product['price']-$product['sale']*$product['price']/100;

	if(!empty($sel['id'])){
		$qry = $db->update('spcart', array(
			'price'=>$price,
			'amount'=>$amount,
			'updated_at'=>'now()'
		), '`status`=1 and `id`='.$sel['id']);
		if(!$qry){
			return 123;
		}
		return array('sts'=>1, 'msg'=>'Sản phẩm đã thêm vào giỏ hàng'.$price);
	}
	$sid = (!empty($product['store_id']))?$product['store_id']:0;

	$qry = $db->insert('spcart', array('product_id'=>$id, 'typepid'=>$typeid, 'amount'=>$sqty, 'price'=>$price, 'user_id'=>$uid, 'status'=>1,'store_id'=>$sid));
	if(!$qry){
		return 34;
	}
	return array('sts'=>1, 'msg'=>'Sản phẩm đã thêm vào giỏ hàng');
}
if(isset($_POST['id']) && isset($_POST['sqty'])){
	$id = intval($_POST['id']);
	$sqty = intval($_POST['sqty']);
	$typeid = (isset($_POST['typeid']))?$_POST['typeid']:0;
	if(is_array($typeid)){
		$typeid = implode(", ", $typeid);
	}
	$arr['msg'] = 'Bạn chưa đăng nhập.';
	if(isset($_SESSION['id'])){
		$arr = check_cart($id, $sqty, $_SESSION['id'], $typeid, $db);
	}
}
echo json_encode($arr);