<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : false;
$arr['sts'] = 0;
$arr['msg'] = 'The request not found';
if($id){
	$query = $db->delete('categories', 'id='.$id);
	if($query){
		$arr['sts'] = 1;
		$arr['msg'] = 'Đã xóa!';
	}
}
echo json_encode($arr);