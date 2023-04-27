<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<5){
        echo "The request not found";
        return false;
    }
}
$psw = (isset($_POST['psw']) && !empty($_POST['psw'])) ? htmlspecialchars(addslashes($_POST['psw'])) : false;
$arr['sts'] = 0;
$arr['msg'] = 'The request not found';
if($psw){
	$sql = 'select * from users where password = md5("'.$psw.'") limit 1';
	$arr['msg'] = 'Sai mật khẩu';
	$user = $db->db_get_row($sql);
	if(!empty($user['id']) && $user['permission']==5){
		$arr['sts'] = 1;
	}
}
echo json_encode($arr);