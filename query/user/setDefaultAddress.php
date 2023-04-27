<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
$uid = (isset($_SESSION['id'])  && !empty($_SESSION['id'])) ? $_SESSION['id'] : 0;
$aid = (isset($_POST['aid']) && !empty($_POST['aid'])) ? $_POST['aid'] : 0;

if($aid != 0 && $uid != 0){
	$address = $db->db_get_row('select `id` from `address` where `first`=1 and `user_id`='.$uid.' limit 1');
	if(!empty($address['id'])){
		$query = $db->update('address', array('first'=>0), 'id='.$address['id']);
	}
	$query = $db->update('address', array(
								'first'=>1
							), 'id='.$aid);
	if($query){
		$arr['sts'] = 1;
		$arr['msg'] = 'Success';
	}
}
echo json_encode($arr);