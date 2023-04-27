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
	$sql = 'select `email` from `users` where `id`='.$id.' limit 1';
	$info = $db->db_get_row($sql);
	if(!empty($info['email'])){
		$arr = array('sts'=>'Không tìm thấy tài khoản');
		$store = $db->db_get_row('select id from stores where user_id='.$id);
		if($db->delete('users', 'id='.$id) && $db->delete('stores', 'user_id='.$id) && $db->delete('products', 'store_id='.$store['id'])){
			$arr = array('sts'=>1,'msg'=>'Đã xóa tài khoản: <b>'.$info['email'].'</b> thành công');
		}	
	}
	
}
echo json_encode($arr);