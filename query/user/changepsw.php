<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
$uid = (isset($_SESSION['id'])  && !empty($_SESSION['id'])) ? $_SESSION['id'] : 0;
$oldpsw = (isset($_POST['oldpsw']) && !empty($_POST['oldpsw'])) ? $_POST['oldpsw'] : false;

if($oldpsw && $uid != 0){
	$psw = (isset($_POST['psw']) && !empty($_POST['psw'])) ? trim($_POST['psw']) : false;
	$repsw = (isset($_POST['repsw']) && !empty($_POST['repsw'])) ? trim($_POST['repsw']) : false;
	$sql = 'select `name` from `users` where `id`='.$uid.' and `password`="'.md5($oldpsw).'" limit 1';
	$user = $db->db_get_row($sql);
	if($psw == $repsw && !empty($user['name'])){
		$query = $db->update('users', array(
			'password'=>md5($psw),'updated_at'=>'now()'
		), 'id='.$uid);
		if($query){
			$arr['sts'] = 1;
			$arr['msg'] = 'Đổi mật khẩu thành công';
		}
	}else{
		$arr['msg'] = 'Sai mật khẩu';
	}

}

echo json_encode($arr);