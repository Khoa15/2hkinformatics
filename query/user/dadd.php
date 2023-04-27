<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
$aid = (isset($_POST['id']) && is_numeric($_POST['id']))?$_POST['id']:0;
if($aid && isset($_SESSION['id']) && !empty($_SESSION['id']) && is_numeric($_SESSION['id'])){
	$uid = (int)$_SESSION['id'];
	if($uid == $_SESSION['id']){
		$sql = 'select first from address where id = '.$aid.' and user_id='.$uid.' limit 1';
		$address = $db->db_get_row($sql);
		$arr['msg'] = 'Địa chỉ mặc định không thể xóa';
		if(!$address['first']){
			$sql = 'select id from spcart where address_id='.$aid.' limit 1';
			$address = $db->db_get_row($sql);
			$arr['msg'] = 'Địa chỉ đã được dùng không thể xóa';
			if(!$address['id']){
				if($db->delete('address', 'id='.$aid.' and `user_id`='.$uid)){
					$arr['msg'] = 'Xóa thành công';
					$arr['sts'] = 1;
				}
			}
		}
	}
}
echo json_encode($arr);