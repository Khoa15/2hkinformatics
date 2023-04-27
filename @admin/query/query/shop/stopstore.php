<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<5){
        echo "The request not found";
        return false;
    }
}
$arr = array('sts'=>0,'msg'=>'The request not found');
if(isset($_POST['id'])){
	$id = (!empty($_POST['id']) && is_numeric($_POST['id']))?intval($_POST['id']):0;
	if($id){
		$sql = 'select id, user_id, `actived` from stores where `id`='.$id;
		$store = $db->db_get_row($sql);
		if(!empty($store['id'])){
			$user_sql = 'select `permission` from users where id='.$store['user_id'];
			$user = $db->db_get_row($user_sql);
			$sts = ($store['actived'])?false:true;
			$arr['msg'] = 'Không thể dừng hoạt động cửa hàng do người sở hữu có quyền quá cao';
			if(!empty($user['permission']) && $user['permission']<5){
				$u = $db->update('stores', array(
						'actived'=>$sts,
						'updated_at'=>'now()'
				), 'id='.$id);
				if($u){
					$arr['sts'] = 1;
					$arr['msg'] = 'Đã dừng hoạt động của cửa hàng';
					$arr['btn'] = $sts;
				}
			}
		}
	}
}
echo json_encode($arr);