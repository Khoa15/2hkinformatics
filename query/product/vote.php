<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$arr = array('sts'=>0,'msg'=>'The request not found');
if(isset($_POST['score']) && isset($_POST['id'])){
	$score = (int)$_POST['score'];
	$id = (int)$_POST['id'];
	if($score == $_POST['score'] && $id == $_POST['id']){
		$content = nl2br(htmlentities($_POST['content']));
		$query = $db->update('spcart', array(
			'score'=>$score,
			'evaluate'=>$content,
			'status'=>10
		), 'id='.$id);
		if($query){
			$arr['sts'] = 1;
			$arr['msg'] = 'Đã đăng nhận xét';
		}
	}
}
echo json_encode($arr);