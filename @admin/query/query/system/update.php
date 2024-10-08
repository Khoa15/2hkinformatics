<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<5){
        echo "The request not found";
        return false;
    }
}
$arr['sts'] = 0;
$arr['msg'] = 'The request not found';
$name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : false;
$description = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : false;
$email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : false;
$nbp = (isset($_POST['nbp']) && !empty($_POST['nbp'])) ? $_POST['nbp'] : false;
$favicon = (isset($_POST['favicon']) && !empty($_POST['favicon'])) ? $_POST['favicon'] : false;
$poster = (isset($_POST['poster']) && !empty($_POST['poster'])) ? $_POST['poster'] : false;
$ship = (isset($_POST['ship']) && !empty($_POST['ship'])) ? intval($_POST['ship']) : false;
if( $name && $description ){
	if($db->update('system', array(
		'name' => $name,
		'description' => $description,
		'email' => $email,
		'nbp' => $nbp,
		'favicon' => $favicon,
		'poster' => $poster,
		'ship' => $ship,
		'updated_at' => 'now()'
	), 'id=1')){
		$arr['sts'] = 1;
		$arr['msg'] = 'Cập nhật thành công';
	}
}

echo json_encode($arr);