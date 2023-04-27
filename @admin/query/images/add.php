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
if (isset($_FILES['img_file']['name']) && isset($_POST['id']) && isset($_POST['typeImages'])) {
	$id_product = intval($_POST['id']);
	$typeGame = intval($_POST['typeGame']);
	$type = ($typeGame==1)?$_POST['typeImages']:0;
	$status = intval($_POST['status']);
	if($typeGame==2){
		$type=2;
	}
	if(count($_FILES['img_file']['name'])>10){
		$arr = array('sts'=>0,'msg'=>'Bạn không thể upload quá 10 ảnh cùng lúc');
		$bphone = false;
	}
	if($bphone){
		foreach($_FILES['img_file']['name'] as $name => $value)
		{

			$name_img = stripslashes($_FILES['img_file']['name'][$name]);
			$source_img = $_FILES['img_file']['tmp_name'][$name];
			$url_img = "/assets/imgs/uploads/".$name_img;
			$path_img = "assets/imgs/uploads/" . $name_img;
			$total = $db->total('SELECT * FROM `images` WHERE `link`="'.$url_img.'"');
			if ($total>0)
			{
				$arr = array('sts'=>0,'msg'=>'Bạn hãy đặt một cái tên khác cho hình ảnh để tiếng hành upload.');
			}else{
				move_uploaded_file($source_img, $path_img);

				if($db->insert('images', array(
					'link'=>$url_img,
					'product_id'=>$id_product,
					'user_id'=>$user_id,
					'type'=>$typeGame,
					'pos'=>$type,
					'status'=>$status
				)))
				{
					$arr = array('sts'=>1,'msg'=>'Uploads thành công.');
				}else
				{
					$arr = array('sts'=>0,'msg'=>'Uploads thất bại.');
				}
			}
		}
	}
	echo json_encode($arr);
}