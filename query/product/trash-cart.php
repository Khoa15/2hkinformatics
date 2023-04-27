<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');

if(isset($_POST['id'])){
	$id = intval($_POST['id']);
	$arr['msg'] = 'Bạn chưa đăng nhập.';
	if(isset($_SESSION['id'])){
		$sql = 'select `status` from `spcart` where `id`='.$id.' limit 1';
		$cart = $db->db_get_row($sql);
		if($cart['status']<3){
			$query = $db->update('spcart', array('status'=>0,'updated_at'=>'now()'),'id='.$id);
			if($query){
				$arr['sts'] = 1;
				$arr['msg'] = 'Xóa thành công';
			}
		}
	}
}
echo json_encode($arr);