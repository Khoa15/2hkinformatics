<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
if(isset($_POST['psw']) && isset($_POST['numberPhone']) && isset($_POST['name']) && isset($_POST['fullname']) && isset($_POST['email'])){
	$bphone = true;
	$psw = trim($_POST['psw']);
	$numberPhone = trim($_POST['numberPhone']);
	$numberPhone = (empty($numberPhone))?0:$numberPhone;
	$name = htmlspecialchars(addslashes($_POST['name']));
	$fullname = htmlspecialchars(addslashes($_POST['fullname']));
	$email = htmlspecialchars(addslashes($_POST['email']));
	$sex = intval($_POST['sex']);
	$dob = htmlspecialchars(addslashes($_POST['dob']));
	$address = htmlspecialchars(addslashes($_POST['address']));
	$city = htmlspecialchars(addslashes($_POST['city']));
	if(strlen($name)>100){
		$arr['msg'] = 'Tên quá dài';
		$bphone = false;
	}
	if(strlen($fullname)>100){
		$arr['msg'] = 'Họ quá dài';
		$bphone = false;
	}
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
	$sql = 'SELECT `id` FROM `users` WHERE `nbp`='.$numberPhone.' OR `email`="'.$email.'"';
	if($db->num_rows($sql)>0 && $bphone){
		$arr = array('sts'=>0, 'msg'=>'Có vẻ số điện thoại hoặc email này đã được đăng kí');
		$bphone = false;
	}
	if($bphone){
		$query = $db->insert('users', array(
			'surname'=>$fullname,
			'name'=>$name,
			'password'=>md5($psw),
			'nbp'=>$numberPhone,
			'email'=>$email,
			'gender'=>$sex,
			'dob'=>$dob
		));
		
		if($query){$info = $db->db_get_row('select `id` from `users` where `email`="'.$email.'" and `nbp`="'.$numberPhone.'" and `password`="'.md5($psw).'"');
		$db->insert('address', array('fullname'=>$fullname.' '.$name, 'nbp'=>$numberPhone, 'street'=>$address,'city'=>$city, 'user_id'=>$info['id']));
	}

		$arr = array('sts'=>0, 'msg'=>'Đã có lỗi trong quá trình đăng kí!');
		if($query){
			$arr = array('sts'=>1, 'msg'=>'Đăng kí thành công! Hãy tiến hành đăng nhập.');
		}
	}

}

echo json_encode($arr);
?>