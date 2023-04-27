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
$uid = $_SESSION['id'];
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');

if(isset($_POST['id'])){
	$id = intval($_POST['id']);
	if($db->delete('spcart', 'id='.$id)){
		$price = $db->db_get_row('select sum(amount*price) as total from `spcart` where `status`=1 and `user_id`='.$uid);
		$arr['sts'] = 1;
		$arr['total'] = ($price['total'])?number_format($price['total'],0,',',','):0;
		$arr['priceTotal'] = $price['total'];
	}
}
echo json_encode($arr);