<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'Yêu cầu không được thực hiện');
if(isset($_SESSION['id']) && isset($_POST['address']) && isset($_POST['spcart'])){
	$spcart = $_POST['spcart'];
	$num = count($spcart);
	$id = (int)$_SESSION['id'];
	if($id != $_SESSION['id']){
		$id = 0;
	}
	$aid = intval($_POST['address']);
	$pid = false;
	$query =false;
	foreach ($spcart as $spcartid) {
		$pid .= $spcartid;
		if($num>=2){
			$pid.=', ';
		}
		$query = $db->update('spcart', array('address_id'=>$aid,'status'=>2,'created_at'=>'now()','updated_at'=>'now()'),'id='.$spcartid);

		$num--;
	}
	$time = $db->getCurrentTime();
	$row = $db->db_get_row('select `fullname` from `address` where `id`='.$aid);
	if($query){
		$arr['sts']=1;
		$arr['msg']='Thành công!';
	}
}
echo json_encode($arr);