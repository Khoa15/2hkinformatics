<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$bphone = true;
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
if(isset($_POST['id']) && !empty($_POST['id']) && $_POST['id']!=$user_id){
	$id = intval($_POST['id']);
	$sql = 'select `email`, `permission` from `users` where `id`='.$id.' limit 1';
	$info = $db->db_get_row($sql);
	$arr = array('sts'=>'Không tìm thấy tài khoản');
	if(!empty($info['email'])){
		if($info['permission']>2){
			$store = $db->db_get_row('select id from stores where user_id='.$id);

			$db->delete('types_of_products', 'stores_id='.$store['id']);
			$db->delete('product','store_id='.$store['id']);
			$imgs = $db->db_get_list('select link from images where user_id='.$id);
			foreach($imgs as $img) unlink($img['link']);

			$db->delete('images','user_id='.$id);
			$db->delete('lstfollow','store_id='.$store['id']);
			$db->delete('spcart','store_id='.$store['id']);
			$db->delete('stores','user_id='.$id);
		}

		$db->delete('lstfollow','user_id='.$id);
		$db->delete('address','user_id='.$id);
		$db->delete('spcart','user_id='.$id);
		if($db->delete('users', 'id='.$id)){
			$arr = array('sts'=>1,'msg'=>'Đã xóa tài khoản: <b>'.$info['email'].'</b> thành công');
		}	
	}
	
}
echo json_encode($arr);