<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$arr = array('sts'=>0, 'msg'=>'Hãy điền đầy đủ thông tin');
$bphone = true;
$namegroups = (isset($_POST['type_product']) && !empty($_POST['type_product']))?$_POST['type_product']:[];
$namegroup = null;
if(isset($_POST['nproduct']) && isset($_POST['price']) && !empty($_POST['nproduct']) && isset($_POST['category']) && !empty($_POST['category'])){
    $nproduct = $_POST['nproduct'];
    $price = trim($_POST['price']);
    $amount = intval($_POST['amount']);
    $description = nl2br(addslashes($_POST['description']));
    $categories = htmlspecialchars(addslashes($_POST['category']));
    $categories = (empty($categories))?0:$categories;
    $actived = (isset($_POST['actived']))?1:0;
    $sale = (isset($_POST['sale']))?intval($_POST['sale']):0;
    $from = $_POST['city'];
    $freeship = (isset($_POST['freeship']) && !empty($_POST['freeship']))?1:0;
    $buymany = intval($_POST['buy']);
    $valsaledown = $_POST['valsaledown'];
    $typesaledown = $_POST['tsaledown'];
    if(empty($nproduct) || empty($price) || empty($amount) || empty($description) || empty($categories)){
        $bphone = false;
    }
    $sid = $db->db_get_row('select `id`,`actived` from stores where `user_id`='.$id);
    $arr['msg'] = 'Cửa hàng của bạn đã bị dừng hoạt động';
    if($sid['actived']!=0){
    $sid = (!empty($sid))?$sid['id']:0;
        if($bphone){
            $arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
            if($db->insert('products', array(
                'name'=>$nproduct,
                'description'=>$description,
                'price'=>$price,
                'amount'=>$amount,
                'sale'=>$sale,
                'actived'=>$actived,
                'fcity'=>$from,
                'freeship'=>$freeship,
                'bfrom'=>$buymany,
                'discount'=>$valsaledown.$typesaledown,
                'category_id'=>$categories,
                'store_id'=>$sid,
            ))){
                $product = 'select `id` from `products` where `name`="'.$nproduct.'" and `category_id`='.$categories.' and `bfrom`='.$buymany.' and  `store_id`='.$sid.' order by id desc limit 1';
                $product = $db->db_get_row($product);
                $pid = (!empty($product['id']))?$product['id']:0;
                $namegroup = null;
                if(sizeof($namegroups)!=0){
                    foreach ($namegroups as $key => $type) {
                        foreach ($type as $key => $value2) {
                            if(!is_array($value2)){
                                $namegroup = (!empty($value2))?$value2:false;
                            }else{
                                if(sizeof($value2)!=0){
                                    foreach($value2 as $key => $product){
                                        $nprice = explode('. ', $product);
                                        $price = (!empty($nprice[1]))?$nprice[1]:false;
                                        if($namegroup){
                                        $db->insert('types_of_products', array('name'=>$namegroup, 'type'=>$nprice[0], 'price'=>$price, 'product_id'=>$pid, 'store_id'=>$sid));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $arr = array('sts'=>1,'msg'=>'Sản phẩm: <b>'.$nproduct.'</b> đã được lưu');
            }
        }
    }
}
echo json_encode($arr);
?>