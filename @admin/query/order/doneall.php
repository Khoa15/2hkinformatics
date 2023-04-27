<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$arr = array('sts'=>0, 'msg'=>'The request not found');
if(isset($_POST['uid'])){
	$uid = intval($_POST['uid']);
	$sql = 'select `id` from `spcart` where `user_id`='.$uid.' and status!=0 and status < 5';
	$query = $db->db_get_row($sql);
	$arr['msg'] = 'Không có đơn hàng nào được chuyển';
	if(!empty($query['id'])){

		$query = $db->update('spcart',array('status'=>5,'updated_at'=>'now()'), 'user_id='.$uid.' and status!=0 and status < 5');
		if($query){
			$arr['sts'] = 1;
			$arr['msg'] = 'Hoàn tất toàn bộ đơn hàng';
		}
	}
}
echo json_encode($arr);