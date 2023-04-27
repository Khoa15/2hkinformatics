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
$arr =array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
if(isset($_POST['cid']))
{
	$id = (int)$_POST['cid'];
	if(empty($id)){
		$bphone = false;
	}
	if($bphone){
		$coupon = $db->db_get_row('select `code` from `coupon` where `id`='.$id);
		if(!empty($coupon)){
			$arr =array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
			if($db->delete('coupon', 'id='.$id) && $db->delete('lstcoupon', 'coupon_id='.$id)){
				$arr = array('sts'=>1, 'msg'=>'Đã xóa: '.$coupon['code'].' thành công');
			}
		}
	}
}
echo json_encode($arr);