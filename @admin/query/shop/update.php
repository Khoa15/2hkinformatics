<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$bphone = false;
$name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : false;
$icon = (isset($_POST['icon']) && !empty($_POST['icon'])) ? (int)$_POST['icon'] : false;
$cover = (isset($_POST['cover']) && !empty($_POST['cover'])) ? (int)$_POST['cover'] : false;
$arr['sts'] = 0;
$arr['msg'] = '';
$sql = 'update stores set ';
if($name){
	$store = $db->db_get_row('select id from stores where name="'.$name.'"');
	if(empty($store['id'])){
		$sql .= ' name = "'.$name.'"';
		$bphone = true;
	}
}
if($icon){
	$sql2 = 'select `id` from `images` where `id`='.$icon.' and `user_id`='.$user_id;
	$image = $db->db_get_row($sql2);
	$arr['msg'] = 'Ảnh không tồn tại';
	if(!empty($image['id'])){
		$sql .= ' icon = '.$icon;
		$bphone = true;
		$arr['msg'] = '';
	}
}
if($cover){
	$sql2 = 'select `id` from `images` where `id`='.$cover;
	$image = $db->db_get_row($sql2);
	if(!empty($image['id'])){
		$sql .= ' cover = '.$cover;
		$bphone = true;
	}else{
		$arr['msg'] = 'Ảnh không tồn tại';
	}
}
if($bphone){
	$sql .=', updated_at = now() Where `user_id`='.$user_id;
	$query = $db->db_query($sql);
	if($query){
		$arr['sts'] = 1;
		$arr['msg'] = 'Cập nhật thành công';
	}
}else{
	$arr['msg'] = 'The request not found';
}
echo json_encode($arr);