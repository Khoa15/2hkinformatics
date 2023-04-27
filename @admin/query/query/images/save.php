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
if(isset($_POST['id']) && isset($_POST['status']))
{
	$id = intval($_POST['id']);
	$pid = (int)$_POST['pid'];
	$pos = intval($_POST['pos']);
	$type = intval($_POST['type']);
	$sts = (int)$_POST['status'];
	$p = $db->num_rows('select `id` from `products` where `id`='.$pid);
	if($type!=1){
		$pos = 0;
		$pid = 0;
	}
	if($p==0 && $type == 1){
		$arr['msg'] = 'Không tìm thấy ID sản phẩm';
		$bphone = false;
	}
	if(empty($id)){
		$bphone = false;
	}
	if(!is_numeric($id) || !is_numeric($sts)){
		$bphone = false;
	}
	if($bphone){
		$arr =array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
		if($db->update('images', array('product_id'=>$pid, 'pos'=>$pos, 'type'=>$type,'status'=>$sts,'updated_at'=>'now()'), 'id='.$id)){
			$arr = array('sts'=>1, 'msg'=>'Đã lưu thành công');
		}

	}
}
echo json_encode($arr);