<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$user_id = (isset($_SESSION['id']) && !empty($_SESSION['id'])) ? (int)$_SESSION['id'] : false;
$arr = array('sts'=>0,'msg'=>'Hãy đảm bảo rằng bạn đã cung cấp đủ thông tin');
if(!$user_id){
	session_destroy();
	echo "The request not found";
	exit();
}
$content = (isset($_POST['content']) && !empty($_POST['content'])) ? nl2br(htmlentities($_POST['content'])) : false;
$id = (isset($_POST['id']) && !empty($_POST['id'])) ? (int)$_POST['id'] : false;
if(isset($_FILES['files']['name']) && $content && $id){
	foreach($_FILES['files']['name'] as $name => $value)
		{
			$name_img = stripslashes($_FILES['files']['name'][$name]);
			$source_img = $_FILES['files']['tmp_name'][$name];
			$url_img = "/assets/imgs/uploads/user/".$name_img;
			$path_img = "../../assets/imgs/uploads/user/" . $name_img;
			$total = $db->total('SELECT * FROM `images` WHERE `link`="'.$url_img.'"');
			if ($total>0)
			{
				$arr = array('sts'=>0,'msg'=>'Bạn hãy đặt một cái tên khác cho hình ảnh để tiếng hành upload.');
			}else{
				move_uploaded_file($source_img, $path_img);
				if($db->insert('images', array(
					'link'=>$url_img,
					'product_id'=>0,
					'user_id'=>$user_id,
					'spcart_id'=>$id,
					'type'=>4,
					'pos'=>1,
					'status'=>1
				)))
				{
					$arr = array('sts'=>1,'msg'=>'Uploads thành công.');
				}else
				{
					$arr = array('sts'=>0,'msg'=>'Uploads thất bại.');
				}
			}
		}
	$query = $db->update('spcart', array(
		'description'=>$content,
		'status'=>6,'updated_at'=>'now()'
	), 'id='.$id);
	if($query){
		$arr['sts'] = 1;
		$arr['msg'] = 'Đã gửi yêu cầu';
	}
}
echo json_encode($arr);