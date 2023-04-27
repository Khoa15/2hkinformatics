<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
if(!isset($_SESSION['id']) && empty($_SESSION['id'])){
	echo "The request not found";
	return false;
}
$uid = (isset($_SESSION['id']))?$_SESSION['id']:false;
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
$cartid = (isset($_POST['cartid']))?intval($_POST['cartid']):false;
$coupon = (isset($_POST['coupon']))?$_POST['coupon']:false;

$query = $db->update('spcart', array('coupon_id'=>0), 'id='.$cartid);
if($query){
	$arr['msg'] = 'Đã gỡ mã giảm giá';
}
if($uid && $cartid && $coupon){
	$sql = 'select coupon.id, coupon.ship, coupon.discount, coupon.amount, coupon.damount, coupon.actived, coupon.infinity, coupon.forall, coupon.died_at from coupon where code="'.$coupon.'" and actived=1 and damount>=1 limit 1';
	$coupon = $db->db_get_row($sql);
	$sql = 'select id, product_id from spcart where id='.$cartid.' limit 1';
	$cart = $db->db_get_row($sql);
	$pid = $cart['product_id'];
	$arr['msg'] = 'Không tìm thấy mã giảm giá hoặc mã không còn hoạt động';
	if(!empty($coupon['id']) && !empty($cart['id'])){
		if(strtotime($daters)>=strtotime($coupon['died_at'])){
			$arr['msg'] = 'Mã giảm giá đã hết hạn';
		}else{
			if($coupon['infinity'] || $coupon['amount']>=1){
				$sql = 'select count(coupon_id) as total from spcart where user_id='.$uid.' and status=1 and coupon_id='.$coupon['id'];
				$cart = $db->db_get_row($sql);
				$arr['msg'] = 'Hết lượt dùng';
				if($coupon['damount']>$cart['total']){
					if($coupon['forall']){
						$arr = coupon($db, $coupon['id'], $cartid, " Giảm được ".$coupon['discount']."% cho sản phẩm này và phí vận chuyển");
					}elseif(!$coupon['forall'] and $coupon['ship']){
						// giảm giá ship cod
						$arr = coupon($db, $coupon['id'], $cartid, " Giảm được ".$coupon['discount']."% cho phí vận chuyển");
					}else{
						$category = $db->db_get_row('select category_id from products where id='.$pid);
						$lst = $db->db_get_row('select id from lstcoupon where coupon_id='.$coupon['id'].' and category_id='.$category['category_id'].' or product_id='.$pid.' limit 1');
						if(!empty($lst['id'])){
							$arr = coupon($db, $coupon['id'], $cartid, " Giảm được ".$coupon['discount']."% cho sản phẩm này");

						}

					}
				}
			}
		}
	}
}
function coupon($db, $cid, $cartid, $msg){
	if($db->update('spcart', array('coupon_id'=>$cid,'updated_at'=>'now()'), 'id='.$cartid)) return ['sts'=>1, 'msg'=>'Đã áp dụng mã giảm giá.'.$msg];
	return ['sts'=>0];
}
echo json_encode($arr);