<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr['sts'] = 0;
$arr['msg'] = 'Bạn chưa đăng nhập';
$uid = (isset($_SESSION['id'])) ? (int)$_SESSION['id'] : 0;
if(isset($_SESSION['id']) && $uid == $_SESSION['id']){
	$id = (isset($_POST['id'])) ? (int)$_POST['id'] : 0;
	$type = (isset($_POST['type'])) ? intval($_POST['type']) : 0;
	if(!empty($uid) && !empty($id)){
		$arr['msg'] = 'The request not found';
		$sql = 'select `id` from `products` where `id`='.$id.' limit 1';
		$query = $db->num_rows($sql);
		if($query != 0 || !empty($query)){
			$sql = 'select `id` from `lstfollow` where `product_id`='.$id.' and `user_id`!=0 limit 1';
			$query = $db->db_get_row($sql);
			if(empty($query['id'])){
				$query = $db->insert('lstfollow', array(
					'product_id'=>$id,
					'user_id'=>$uid
				));
				if($query){
					$arr['sts'] = 1;
					$arr['msg'] = 'success';
				}
			}else{
				$query = $db->delete('lstfollow', 'id='.$query['id']);

				if($query){
					$arr['sts'] = 1;
					$arr['msg'] = 'Success';
				}
			}
		}
	}
}
echo json_encode($arr);