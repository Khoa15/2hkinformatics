<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$arr = array('sts'=>0, 'msg'=>'Hãy điền đầy đủ thông tin');
if(isset($_POST['id']) && isset($_POST['status'])){
	$id = intval($_POST['id']);
	$status = intval($_POST['status']);
	$reason = (isset($_POST['reason']))?htmlspecialchars(addslashes($_POST['reason'])):false;
	$sql = 'update `spcart` set `status`='.$status.', `description`="'.$reason.'", `updated_at`=now() where `id`='.$id;
	$query = $db->db_query($sql);
	if($query){
		$arr['sts'] = 1;
		$arr['msg'] = 'Trạng thái đơn hàng được cập nhật';
	}
}
echo json_encode($arr);