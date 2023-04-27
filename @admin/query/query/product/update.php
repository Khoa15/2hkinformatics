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
if(isset($_POST['nproduct']) && isset($_POST['price']) && !empty($_POST['nproduct']) && isset($_POST['id'])){
    $pid = intval($_POST['id']);
    $nproduct = $_POST['nproduct'];
    $price = trim($_POST['price']);
    $amount = intval($_POST['amount']);
    $description = nl2br(htmlspecialchars($_POST['description']));
    $categories = htmlspecialchars(addslashes($_POST['category']));
    $actived = (isset($_POST['actived']))?true:false;
    $sale = (isset($_POST['sale']))?intval($_POST['sale']):0;
    $from = $_POST['city'];
    $freeship = (isset($_POST['freeship']) && !empty($_POST['freeship']))?true:false;
    $buymany = intval($_POST['buy']);
    $valsaledown = $_POST['valsaledown'];
    $typesaledown = $_POST['tsaledown'];
    if(empty($nproduct) || empty($price) || empty($amount) || empty($description) || empty($categories)){
        $bphone = false;
    }
    if($bphone){
        $arr = array('sts'=>0,'msg'=>'Có lỗi trong quá trình thực hiện');
        if($db->update('products', array(
            'name'=>$nproduct,
            'description'=>$description,
            'price'=>$price,
            'sale'=>$sale,
            'amount'=>$amount,
            'actived'=>$actived,
            'fcity'=>$from,
            'freeship'=>$freeship,
            'bfrom'=>$buymany,
            'discount'=>$valsaledown.$typesaledown,
            'category_id'=>$categories,
            'updated_at'=>'now()'
        ), 'id='.$pid)){
            if(sizeof($namegroups)!=0){
                $db->delete('types_of_products', 'product_id='.$pid);
                foreach ($namegroups as $key => $type) {
                    /*$db->insert('product_type', array($value2=>))*/
                    foreach ($type as $key => $value2) {
                        $nprice = null;
                        if(!is_array($value2)){
                            $namegroup = (!empty($value2))?$value2:false;
                        }else{
                            if(sizeof($value2)!=0){
                                foreach($value2 as $key => $product){
                                    $nprice = explode('. ', $product);
                                    $price = (!empty($nprice[1]))?$nprice[1]:false;
                                    if($namegroup){
                                    $db->insert('types_of_products', array('name'=>$namegroup, 'type'=>$nprice[0], 'price'=>$price, 'product_id'=>$pid));
                                    }
                                }
                            }
                        }
                        
                    }
                }
            }else{
                $db->delete('product_type', 'product_id='.$pid);
            }
            $arr = array('sts'=>1,'msg'=>'Sản phẩm: <b>'.$nproduct.'</b> đã được lưu');
        }
    }

}
echo json_encode($arr);
?>