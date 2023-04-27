<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$uid = (isset($_SESSION['id']) && !empty($_SESSION['id']) && is_numeric($_SESSION['id']))?$_SESSION['id']:0;
$arr = array('sts'=>0,'msg'=>'The request not found');
$address = (isset($_POST['address']))?$_POST['address']:0;
$city = (isset($_POST['city']))?$_POST['city']:0;
$fullname = (isset($_POST['fullname']))?$_POST['fullname']:0;
$phone = (isset($_POST['phone']) && !empty($_POST['phone']) && strlen($_POST['phone'])==10)?$_POST['phone']:0;
if(!empty($address) && !empty($fullname) && $uid!=0 && $phone!=0){
	if(!preg_match('/[?><>|=_+]/', $address) && !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+]/', $fullname)){
		$sql = 'select id from `address` where `user_id`!='.$uid.' and `nbp`='.$phone;
		$access = $db->num_rows($sql);
		$arr['msg'] = 'Số điện thoại này đã tồn tại';
		if($access==0){
			$sql = 'select COUNT(`id`) as total from `address` where `user_id`='.$uid;
			$total = $db->db_get_row($sql);
			if($total['total']<21){
				$query = $db->insert('address', array('fullname'=>$fullname, 'nbp'=>$phone, 'street'=>$address, 'city'=>$city,'user_id'=>$uid));
				if($query){
					$arr['msg'] = 'Địa chỉ của bạn đã được lưu';
					$arr['sts'] = 1;
				}
			}
		}
	}
}

echo json_encode($arr);
?>