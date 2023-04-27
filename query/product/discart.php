<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$uid = (isset($_SESSION['id']) && !empty($_SESSION['id'])) ? $_SESSION['id'] : false;
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
$coupon = (isset($_POST['coupon']) && !empty($_POST['coupon'])) ? htmlspecialchars(addslashes($_POST['coupon'])) :false;

if($coupon && $uid){
	$sql = 'select id,discount, amount, damount from coupon where code="'.$coupon.'" and actived = 1 and died_at>'.$daters.' limit 1';
	$coupon = $db->db_get_row($sql);
	$arr['msg'] = 'Không tìm thấy mã giảm giá hoặc mã giảm giá không còn hoạt động';
	if(!empty($coupon['id'])){
		$arr['msg'] = 'Mã giảm giá đã hết';
		if($coupon['amount']>0){
			$sql = 'select count(id) as total from spcart where user_id='.$uid.' and status = 1 and coupon_id='.$coupon['id'];
			$coupon3 = $db->db_get_row($sql);
			$arr['msg'] = 'Mã giảm giá đã hết';
			if($coupon['damount']>$coupon3['total']){
				
			}
		}
	}
}

echo json_encode($arr);