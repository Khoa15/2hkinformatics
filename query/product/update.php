<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');



if(isset($_POST['id']) && isset($_POST['amount'])){
	$uid = (isset($_SESSION['id']))?$_SESSION['id']:false; $mtotal = 0; $coupon_dis = 0;
	$id = intval($_POST['id']);
	$amount = intval($_POST['amount']); $db->update('spcart', array('amount'=>$amount, 'updated_at'=>'now()'), 'id='.$id);
	$product = $db->db_get_row('SELECT coupon_id, price, product_id FROM spcart WHERE id='.$id);
	$total_product = $amount * $product['price'];

	//Ship
	$system = $db->db_get_row('SELECT ship from system where id=1');
	$product['ship'] = $system['ship'];
	//Sale off
	if($amount!=0){
		$coupon = $db->db_get_row('SELECT discount FROM coupon WHERE id='.$product['coupon_id'].' AND actived = 1 AND died_at>'.$daters);
		$coupon_dis = (!empty($coupon['discount'])) ? $coupon['discount'] : 0;
		$product = $db->coupon($product);
		$total_product = $total_product - $total_product*$product['discount']/100;
		$total_product += $product['ship'];
	}
	//Update & Check shopping cart
	$spcart = $db->db_get_list('SELECT coupon_id, amount, price, product_id FROM spcart WHERE user_id='.$uid.' AND status=1 AND id!='.$id);

	foreach($spcart as $item){
		$coupons = ['ship'=>$system['ship'], 'discount'=>0];
		if(!empty($item['coupon_id'])){
			//Apply Coupon
			$coupons = $db->coupon($item);
		}
		// if(!empty($item['typepid'])){
		// 	$typep = $db->db_get_row('select price from types_of_products where id='.$item['typepid']);
		// 	$item['price'] = $typep['price'];
		// }
		$total = $item['amount'] * $item['price'];// price of product
		$mtotal += $total - $coupons['discount']*$total/100;
		$mtotal += $coupons['ship'];
	}
	$mtotal += $total_product;

	$arr['sts'] = 1;
	$arr['msg'] = 'success';
	$arr['total'] = number_format($total_product,0,',',',');
	$arr['ntotal'] = $total_product;
	$arr['mainTotal'] = number_format($mtotal,0,',',',');
	$arr['priceTotal'] = $mtotal;
	$arr['discount'] = $coupon_dis;
	$arr['ship'] = number_format($product['ship'],0,',',',');




	// OLD VERSION
	// $id = intval($_POST['id']);
	// $amount = intval($_POST['amount']);
	// $sql = 'select user_id, price, coupon_id  from spcart where id='.$id.' limit 1';
	// $row = $db->db_get_row($sql);
	// $uid = (isset($_SESSION['id']))?$_SESSION['id']:false;
	// $sql2 = 'select discount from coupon where coupon.id='.$row['coupon_id'].' and actived = 1 and died_at>'.$daters.' limit 1';
	// $coupon = $db->db_get_row($sql2);
	// $discount = (!empty($coupon['discount']))?(int)$coupon['discount']:0;
	// if(!empty($row)){
	// 	$qry = $db->update('spcart', array('amount'=>$amount,'updated_at'=>'now()'), 'id='.$id);

	// }
	// 	$sql = 'select price, coupon_id, amount, product_id from spcart where user_id='.$uid.' and status=1';
	// 	$list = $db->db_get_list($sql);
	// 	$system = $db->db_get_row('select ship from system where id=1');
	// 	$mtotal = 0;
	// 	$ship = (int)$system['ship'];
	// 	foreach ($list as $item) {
	// 		$discount2 = 0;
	// 		if(!empty($item['coupon_id'])){
	// 			$coupon = $db->db_get_row('SELECT id, discount, ship, forall FROM `coupon` WHERE id='.$item['coupon_id']);
	// 			if($coupon['ship']) $ship = $system['ship'] - $system['ship']*$coupon['discount']/100;
	// 			if($coupon['forall']){
	// 				$discount2 = $coupon['discount'];
	// 			}else{
	// 				$product = $db->db_get_row('SELECT category_id FROM products WHERE id='.$item['product_id']);
	// 				$coupon_product = $db->db_get_row('SELECT product_id FROM lstcoupon WHERE product_id='.$item['product_id'].' AND coupon_id='.$item['coupon_id']);
	// 				$coupon_category = $db->db_get_list('SELECT category_id FROM lstcoupon WHERE coupon_id='.$item['coupon_id'].' AND category_id='.$product['category_id']);
	// 				if($coupon_product or $coupon_category){
	// 					$discount2 = $coupon['discount'];
	// 				}
	// 			}

	// 			// $discount2 = (!empty($coupon['discount']) and $coupon['forall'])?(int)$coupon['discount']:0;
	// 			// $shipdis = $ship-$ship*$coupon['discount']/100;
	// 			// $ship = ($coupon['ship'])?$shipdis:$system['ship'];
	// 		}
			
	// 		$mtotal += ($item['price']*$item['amount'])-$discount2*($item['price']*$item['amount'])/100;// total price
	// 		$mtotal += $ship;// total price
	// 	}
	// 	if($qry){
	// 		$total = $amount*$row['price'];
	// 		$total = $total-$total*$discount/100;
	// 		$total += $ship;
			// $arr['sts'] = 1;
			// $arr['msg'] = 'success';
			// $arr['total'] = number_format($total,0,',',',');
			// $arr['mainTotal'] = number_format($mtotal,0,',',',');
			// $arr['priceTotal'] = $mtotal;
			// $arr['discount'] = $discount;
			// $arr['ship'] = number_format($ship,0,',',',');

	// 	}
}
echo json_encode($arr);