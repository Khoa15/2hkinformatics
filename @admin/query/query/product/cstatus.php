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
if(isset($_POST['id']) && isset($_POST['sts']))
{
	$id = (int)$_POST['id'];
	$sts = (int)$_POST['sts'];
	if(empty($id)){
		$bphone = false;
	}
	if(!is_numeric($id) || !is_numeric($sts)){
		$bphone = false;
	}
	if($bphone){
		$arr =array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
		if($db->update('products', array('actived'=>$sts,'updated_at'=>'now()'), 'id='.$id)){
			$arr = array('sts'=>1, 'msg'=>'Trạng thái đã được thay đổi');
		}

	}
}
echo json_encode($arr);