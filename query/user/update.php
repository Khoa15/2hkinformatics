<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$uid = (isset($_SESSION['id']) && !empty($_SESSION['id']))?$_SESSION['id']:0;
$arr = array('sts'=>0,'msg'=>'The request not found');
if(isset($_POST['fullname']) && !empty($_POST['fullname']) && $uid != 0)
{
	$fullname = htmlspecialchars(addslashes($_POST['fullname']));
	$name = htmlspecialchars(addslashes($_POST['name']));
	$gender = intval($_POST['sex']);
	$dob = $_POST['dob'];
	$nbp = (string)$_POST['nbp']; $nbp = htmlspecialchars(addslashes($nbp));
	$exits_numberphone = $db->num_rows("SELECT `id` FROM users where nbp=".$nbp." and id!=".$uid);
	$arr['msg'] = 'Số điện thoại đã được dùng. Hãy đổi số khác';
	if(empty($exits_numberphone)){
		$query = $db->update('users', array('surname'=>$fullname, 'nbp'=>$nbp, 'name'=>$name, 'gender'=>$gender, 'dob'=>$dob,'updated_at'=>'now()'), 'id='.$uid);
		if($query){
			$arr['sts'] = 1;
			$arr['msg'] = 'Lưu thành công';
		}
	}
}
echo json_encode($arr);