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
if(isset($_POST['id'])){
	$id = intval($_POST['id']);
	$sql = 'select `id` from `spcart` where `id`='.$id;
	$query = $db->db_get_row($sql);
	if(!empty($query['id'])){
		$query = $db->delete('spcart', 'id='.$id);
		if($query){
			$arr['sts'] = 1;
			$arr['msg'] = 'Xóa thành công';
		}
	}
}
echo json_encode($arr);