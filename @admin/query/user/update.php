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
$arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
if(isset($_POST['ho']) && isset($_POST['email']) && isset($_POST['sdt']) && isset($_POST['uid'])){
	$uid = intval($_POST['uid']);
	$fullname = trim($_POST['ho']);
	$name = trim($_POST['ten']);
	$email = htmlspecialchars($_POST['email']);
	$numberPhone = $_POST['sdt'];
	$sex = intval($_POST['sex']);
	$dob = $_POST['dob'];
	$permission = $_POST['permission'];
	if(strlen($numberPhone)!=10){
		$arr = array('sts'=>0, 'msg'=>'Sai số điện thoại');
		$bphone = false;
	}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) && $bphone){
		$arr = array('sts'=>0, 'msg'=>'Email chưa đúng định dạng');
		$bphone = false;
	}
	if(empty($name) || empty($fullname) && $bphone){
		$arr = array('sts'=>0, 'msg'=>'Hãy điền đầy đủ thông tin');
		$bphone = false;
	}

	$sql = 'select `id` from `users` where `id`!='.$uid.' and `nbp`!='.$numberPhone.' or `email`!="'.$email.'"';
	if($db->num_rows($sql)<1){
		$arr = array('msg'=>'Đã tồn tại tài khoản này');
		$bphone = false;
	}
	if($bphone){
		if($db->update('users', array(
			'surname'=>$fullname,
			'name'=>$name,
			'nbp'=>$numberPhone,
			'email'=>$email,
			'gender'=>$sex,
			'dob'=>$dob,
			'permission'=>$permission,
			'updated_at'=>'now()'
		), 'id='.$uid)){
			$arr = array('sts'=>1,'msg'=>'Cập nhật: <b>'.$email.'</b> thành công');
		}
	}
}
echo json_encode($arr);