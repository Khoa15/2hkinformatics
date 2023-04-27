<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$query = false;
$arr = array('sts'=>0,'msg'=>'The request not found');
if(isset($_POST['city']) && isset($_POST['street']) && isset($_POST['nbp'])){
	$city = (!empty($_POST['city'])) ? $_POST['city'] : false;

	$street = (!empty($_POST['street'])) ? $_POST['street'] : false;

	$nbp = (!empty($_POST['nbp'])) ? $_POST['nbp'] : false;

	if($city && $street  && $nbp){
		$sql = 'select `id` from `address` where `user_id`='.$user_id.' and `store`=true limit 1';
		$store = $db->db_get_row($sql);
		if(!empty($store['id'])){
			$sql = 'select `id` from `address` where `user_id`!='.$user_id.' and `nbp`='.$nbp;
			$access = $db->num_rows($sql);
			$arr['msg'] = 'Số điện thoại đã bị trùng';
			if($access==0){
				$query = $db->update('address', array('city'=>$city, 'street'=>$street,'nbp'=>$nbp,'updated_at'=>'now()'), 'user_id='.$user_id.' and store=true');
			}
		}else{
			$sql = 'select `id` from `address` where `user_id`!='.$user_id.' and `nbp`='.$nbp;
			$access = $db->num_rows($sql);
			$arr['msg'] = 'Số điện thoại đã bị trùng';
			if($access==0){
				$sql = 'select `surname`, `name` from `users` where `id`='.$user_id.' limit 1';
				$user = $db->db_get_row($sql);
				$query = $db->insert('address', array('fullname'=>$user['surname'].' '.$user['name'],'city'=>$city, 'street'=>$street,'nbp'=>$nbp,'user_id'=>$user_id,'store'=>true));
				if($query){
					$query = $db->db_get_row('select `id` from `address` where `user_id`='.$user_id.' and `store`=true');
					$db->update('stores', array('address_id'=>$query['id'],'updated_at'=>'now()'), 'user_id='.$user_id);
				}
			}
		}
		if($query){
			$arr['sts'] = 1;
			$arr['msg'] = 'Đã cập nhật thông tin thành công';
		}
	}
}
echo json_encode($arr);
?>