<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
$id = (isset($_POST['id']) && is_numeric($_POST['id']))?$_POST['id']:0;

$uid = (isset($_SESSION['id']) && is_numeric($_SESSION['id']))?$_SESSION['id']:0;

if($id != 0 && $uid != 0){
	$sql = 'select `id` from `lstfollow` where `store_id` = "'.$id.'" and `user_id`="'.$uid.'" limit 1';
	$num = $db->num_rows($sql);
	if($num==0){
		$query = $db->insert('lstfollow',array(
			'store_id'=>$id,
			'user_id'=>$uid
		));
	}else{
		$query = $db->delete('lstfollow', '`store_id`='.$id.' and `user_id`='.$uid);
	}
	if($query){
		$arr['sts'] = 1;
		$arr['msg'] = 'Success';
	}
}
echo json_encode($arr);