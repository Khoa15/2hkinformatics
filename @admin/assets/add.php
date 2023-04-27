<?php
$arr = array('sts'=>0, 'msg'=>'Hãy điền đầy đủ thông tin');
$bphone = true;
if(isset($_POST['nproduct']) && isset($_POST['price']) && !empty($_POST['nproduct'])){
    $nproduct = htmlspecialchars(addslashes($_POST['nproduct']));
    $price = trim($_POST['price']);
    $amount = intval($_POST['amount']);
    $description = $_POST['description'];
    $categories = htmlspecialchars(addslashes($_POST['categories']));
    $lcategories = explode(', ', $categories);
    foreach ($lcategories as $key) {
        echo $key;
    }
    $actived = (isset($_POST['actived']))?true:false;
    if(empty($nproduct) || empty($price) || empty($amount) || empty($description) || empty($categories)){
        $bphone = false;
    }
    if($bphone){
        $arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
        /*if($db->insert('products', array(
            'name'=>$nproduct,
            'description'=>$description,
            'price'=>$price,
            'amount'=>$amount,
            'actived'=>$actived,
            'category_id'=>$categories
        ))){
            $arr = array('sts'=>1,'msg'=>'Sản phẩm: <b>'.$nproduct.'</b> đã được lưu');
        }*/
    }

}
echo json_encode($arr);
?>