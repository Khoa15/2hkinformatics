<?php
$arr = array('sts'=>0, 'msg'=>'Hãy điền đầy đủ thông tin');
if(isset($_POST['value']) && !empty($_POST['value']) && isset($_POST['damount']) && !empty($_POST['damount']) && isset($_POST['died_at']) && !empty($_POST['died_at'])){
    $value = intval($_POST['value']);
    $infinite = (isset($_POST['infinite']))?1:0;
    $amount = (!$infinite)?intval($_POST['amount']):0;
    $damount = intval($_POST['damount']);
    $died_at = $_POST['died_at'];
    $code = $_POST['code'];
    $actived = (isset($_POST['actived'])&&!empty($_POST['actived']))?1:0;
    $allc = (isset($_POST['allc']))?1:0;
    $feedis = 1;
    if(!$allc){
        $categories = (isset($_POST['ccategory']))?$_POST['category']:0;
        $category = null;
        $products = (isset($_POST['cproduct']))?$_POST['product']:0;
        $product = null;

        $feedis = (isset($_POST['cfee']))?1:0;
    }
    $sql = 'select `id` from `coupon` where `code`="'.$code.'"';
    $row = $db->num_rows($sql);
    $arr = array('sts'=>0, 'msg'=>'Mã giảm giá bị trùng');
    if(empty($row)){
        if($db->insert('coupon', array('code'=>$code,'ship'=>$feedis,'discount'=>$value,'amount'=>$amount, 'damount'=>$damount, 'actived'=>$actived, 'forall'=>$allc,'infinity'=>$infinite,'died_at'=>$died_at))){
            $query1= 1;
            $query2=1;
            $coupon = $db->db_get_row('select `id` from coupon where `code`="'.$code.'" limit 1');
            if(!empty($coupon['id'])){
                if(!$allc){
                    if($categories){
                        $length = sizeof($categories);
                        foreach ($categories as $key => $value) {
                            $query1 = $db->insert('lstcoupon', array('category_id'=>$value,'coupon_id'=>$coupon['id']));
                        }
                    }
                    if($products){
                        $length = sizeof($products);
                        foreach ($products as $key => $value) {
                            $query2 = $db->insert('lstcoupon', array('product_id'=>$value,'coupon_id'=>$coupon['id']));
                        }
                    }
                }
                if($query2 && $query1){
                    $arr = array('sts'=>1, 'msg'=>'Mã giảm giá: '.$code.' đã được lưu');
                }else{
                    $db->delete('lstcoupon', 'coupon_id='.$coupon['id']);
                    $db->delete('coupon', 'id='.$coupon['id']);
                }
            }
        }
    }
}
echo json_encode($arr);
?>