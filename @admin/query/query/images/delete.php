<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
$bphone = true;
if(isset($_POST['id']) && !empty($_POST['id'])){
	$id = intval($_POST['id']);
	if(!is_numeric($id)){
		$bphone = flase;
	}
	if($bphone){
		$row = $db->db_get_row('select `link` from `images` where `id`='.$id);
		$link = substr($row['link'], 1);
		if(file_exists($link)){
			$bphone = (!unlink($link))?false:true;
		}
		if($bphone){
			if($db->delete('images', 'id='.$id)){
				$arr = array('sts'=>1, 'msg'=>'Xóa thành công');
			}
		}
	}
}
echo json_encode($arr);