<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
if(isset($_POST['email']) && isset($_POST['psw'])){
	$bphone = true;
	$email = addslashes($_POST['email']);
	$psw = addslashes($_POST['psw']);

	if(empty($email) || empty($psw)){
		$arr = array('sts'=>0, 'msg'=>'Vui lòng nhập đầy đủ!');
		$bphone = false;
	}
	if($bphone){
		$sql = 'SELECT `id` FROM `users` WHERE `email`="'.$email.'"';
		$num = $db->num_rows($sql);
		if($num==0){
			$arr = array('sts'=>0, 'msg'=>'Email hoặc mật khẩu chưa chính xác');
			$bphone = false;
		}
	}
	if($bphone){
		$sql = 'SELECT `id`, `email`, `permission` FROM `users` WHERE `email`="'.$email.'" AND `password`="'.md5($psw).'" LIMIT 1';
		$row = $db->num_rows($sql);
		$user = $db->db_query($sql);
		$arr = array('sts'=>0, 'msg'=>'Email hoặc mật khẩu chưa chính xác');
		if($user && !empty($row)){
			foreach($user as $list){
				$_SESSION['id'] = $list['id'];
				$_SESSION['email'] = $list['email'];
				$_SESSION['permission'] = $list['permission'];
				$_SESSION['store'] = false;
			}
			$store = $db->db_get_row('select id from stores where user_id='.$_SESSION['id'].' limit 1');
			if($store){
				$_SESSION['store'] = $store['id'];
			}
			$db->update('users', array('updated_at'=>$db->getCurrentTimeDB()), 'id='.$_SESSION['id']);
			$arr = array('sts'=>1,'msg'=>'Đăng nhập thành công');
		}
	}
}
echo json_encode($arr);
?>