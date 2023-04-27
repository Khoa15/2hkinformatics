<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
$uid = 0;
if(isset($_SESSION['id'])){
	$uid = (is_numeric($_SESSION['id']))?$_SESSION['id']:0;
}
if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) && $uid != 0){
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = (!empty($_POST['address']))?$_POST['address']:false;
	$city = htmlspecialchars(addslashes($_POST['city']));
	if (preg_match('/[\^£$%&*()}{@#~?><>,|=_+]/', $name) || preg_match('/[\?><>|=_+]/', $address))
	{
	    $arr['msg']="Không đặt tên shop có ký tự đặc biệt please";
	}else{
		$sql = 'select `id` from `stores` where `name`="'.$name.'" limit 1';
		$sql2 = 'select id from address where nbp = "'.$phone.'" and store=1 limit 1';
		$shop = $db->num_rows($sql);
		$nbp = $db->num_rows($sql2);
		if($shop>0||$nbp>0){
			$arr['msg'] = 'Tên cửa hàng hoặc số điện thoại đã bị trùng với một cửa hàng khác';
		}else{
			if($db->insert('address', array('fullname'=>$name, 'nbp'=>$phone, 'street'=>$address, 'city'=>$city, 'user_id'=>$uid,'store'=>true))){
				
				$arr['msg'] = 'Lỗi trong quá trình đăng ký. Mã: R30';
				$address = $db->db_get_row('select `id` from `address` where `user_id`='.$uid.' and store = true');
				if(!empty($address)){
					$arr['msg'] = 'Lỗi trong quá trình đăng ký. Mã: R33';
					if($db->insert('stores',array(
						'name'=>$name,
						'address_id'=>$address['id'],
						'user_id'=>$uid
					))){
						$query = $db->db_query('update `users` set `permission`=3, `updated_at`=now() where permission < 3 and `id`='.$uid);
						$store = $db->db_get_row('select id from stores where user_id='.$uid);
						if($query){
							$arr['msg'] = 'Mở cửa hàng thành công';
							$arr['sts'] = 1;

							$_SESSION['permission'] = 3;
							$_SESSION['store'] = $store['id'];
						}
					}
						
				}
			}
		}
	}
}
echo json_encode($arr);
?>