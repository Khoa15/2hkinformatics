<?php
if(isset($_POST['uid']) && !empty($_POST['uid']) && isset($_POST['status'])){
    $uid = intval($_POST['uid']);
    $id = intval($_SESSION['id']);
    $sel = (isset($_POST['sel']))?intval($_POST['sel']):false;
    $status = intval($_POST['status']);

    $store = $db->db_get_row('SELECT id FROM stores WHERE user_id='.$id);

    $sql = 'SELECT `product_id`, `id`, `amount`, `price`, `status` FROM spcart WHERE user_id = '.$uid;

    if(!$sel) $sql .= ' AND store_id='.$store['id'];
    else $sql .= ' AND store_id!='.$store['id'];
    switch($status){
        case 1:
            $sql .= ' AND status=2';
            break;
        case 2:
            $sql .= ' AND status=4';
            break;
        case 3:
            $sql .= ' AND status BETWEEN 6 AND 9';
            break;
        default:
    }
    $sql .= ' ORDER BY created_at DESC';
    

    $list = $db->db_get_list($sql);

    foreach($list as $item){
        $product = $db->db_get_row('SELECT `name` FROM products WHERE id='.$item['product_id']);
        $img = $db->db_get_row('SELECT link FROM images WHERE product_id='.$item['product_id']);
?>
<tr>
    <td><img src="<?=$img['link']?>" height="100"></td>
    <td><?=$product['name']?></td>
    <td><?=number_format($item['price'],0,',',',').' x '.$item['amount']?></td>
    <td><?=$db->detectStatus($item['status'])?></td>
    <td>
        <button class="btn btn-sm btn-info" onclick="view(<?=$item['id']?>)">Xem</button>
        <button class="btn btn-sm pr-2 pl-2" onclick="expfile(<?=$item['id']?>)"><i class="material-icons">file_download</i></button>
    </td>
</tr>
<?php
    }
}else{
    header("Location:/");
}

// OLD VERSION
// $sql = 'select * from spcart where `user_id`='.$item['user_id'].' ';
// if($_SESSION['permission']<5){
//     $sql .=' and store_id='.$store['id'];
// }
// $sql.=' order by CASE WHEN updated_at THEN updated_at END DESC, CASE WHEN status THEN status END ASC';
// $list = $db->db_get_list($sql);
//     foreach($list as $spcart){
//         $sql = 'select `name`, `store_id` from `products` where `id`='.$spcart['product_id'].'';
//         if($_SESSION['permission']<5){
//         $sql .=' and `store_id`='.$spcart['store_id'];
//         }
//         $sql .= ' limit 1';
//         $product = $db->db_get_row($sql);
//         $store_id = (empty($product['store_id']))?0:$product['store_id'];
//         $namep = (empty($product['name']))?'<strong class="text-danger">Không tồn tại</strong>':$product['name'];
        
//         if(empty($product)){
//         //echo '<div class="col-lg-3"><h3 class="text-danger">Sản Phẩm Không Tồn Tại</h3></div>';
//         }

//         $image = $db->db_get_row('select `link` from `images` where `product_id`='.$spcart['product_id'].' order by `pos` desc limit 1');
//         $sql = 'select `name` from `stores` where `id`='.$store_id.' limit 1';
//         $shop = $db->db_get_row($sql);
//         $store_name = (empty($shop['name']))?'<strong>Không tìm thấy người bán</strong>':$shop['name'];
//         /*$shop['name'] = (empty($shop['name']))?$product['added_by']:$shop['name'];*/
//         $address = $db->db_get_row('select `fullname`, `nbp`, `street`, `city` from `address` where `id`='.$spcart['address_id'].' limit 1');

//         $versions = (!empty($spcart['typepid']))?explode(", ", $spcart['typepid']):false;
//         $html2=null;
//         if(!empty($versions)){
//         $length = ($versions)?sizeof($versions):false;
//         if($length){
//             $html2 = 'Loại sản phẩm <span class="text-info">';
//             foreach ($versions as $key => $typepid) {
//                 $sql = 'select * from types_of_products where id='.$typepid;
//                 $version = $db->db_get_row($sql);
//                 $dot = ($length>1)?', ':false;
//                 if(!empty($version['name'])){
//                 $html2 .= $version['name'].': '.$version['type'].$dot;
//                 }else{
//                 $html2 .= '<p class="text-warning">Không tìm thấy loại sản phẩm có mã: '.$typepid.'</p>';
//                 }
//                 $length--;
//             }
//             $html2.='</span>';
//         }
//         }
//         $reason = null;
//     switch($spcart['status']){

//     case 0:

//         $type = "Hủy";
//         $reason = '<p>Lý do: <strong>'.$spcart['description'].'</strong></p>';
//         break;
//     case 1:
//         $type = 'Giỏ Hàng';

//         break;

//     case 3:

//         $type = "Đã xác nhận";
//         break;

//     case 4:

//         $type = "Đang vận chuyển";
//         break;

//     case 5:

//         $type = 'Đã giao thành công';
//         break;

//     case 6:

//         $type = "Hàng lỗi";
//         $reason = '<p>Lý do: <strong id="view-reason" rel="tooltip" data-placement="bottom" title="Click xem ảnh/video"  spcart-id="'.$spcart['id'].'">'.$spcart['description'].'</strong></p>';
//         break;

//     case 7:

//         $type = "Đổi trả";
//         break;
//     case 8:
//         $type = 'Không chấp nhận đổi trả';
//         $reason = '<p>Lý do: <strong>'.$spcart['description'].'</strong></p>';
//         break;
//     case 9:
//         $type = 'Đổi trả được chấp thuận';
//         break;
//     case 10:

//         $type = 'Hoàn tất đơn hàng';

//         break;
//     default:

//         $type = "Chưa xác nhận đơn hàng";

//     }
//     $sql= 'select code from coupon where id = '.$spcart['coupon_id'];
//     $coupon = $db->db_get_row($sql);
//     $coupon['code'] = (!empty($coupon['code'])) ? $coupon['code'] : false;
//     if(empty($address['fullname'])){
//     $db->delete('spcart', 'id='.$spcart['id']);
//     }
//     $fullname = (!empty($address['fullname']))?$address['fullname']:'Đơn hàng bị lỗi! Sẽ được xóa tự động.';
//     $street = (!empty($address['street']))?$address['street'].', '.$address['city']:'Đơn hàng bị lỗi! Sẽ được xóa tự động.';
?>
<!-- <div class="col-lg-3">
    <div class="card">
        <div class="input-group text-center disabled">
            <select id="status" class="btn btn-sm btn-info text-light" cart-id="<?=$spcart['id']?>" id="" <?=($spcart['status']==1||$spcart['status']==10)?'disabled':false?>>
                <option value="0" <?=($spcart['status']==0)?'selected':false?> >Hủy</option>
                <option value="1" <?=($spcart['status']==1)?'selected':false?> disabled>Giỏ Hàng</option>
                <option value="2" title="Click để xác nhận" <?=($spcart['status']==2)?'selected':false?> disabled>Chờ Xác Nhận Đơn Hàng</option>
                <option value="3" <?=($spcart['status']==3)?'selected':false?> >Đã Xác Nhận</option>
                <option value="4" <?=($spcart['status']==4)?'selected':false?> >Đang Vận Chuyển</option>
                <option value="5" <?=($spcart['status']==5)?'selected':false?> >Đã Giao Hàng Thành Công</option>
                <option value="6" disabled <?=($spcart['status']==6)?'selected':false?> >Hàng Lỗi</option>
                <option value="7" disabled <?=($spcart['status']==7)?'selected':false?> >Yêu Cầu Đổi Trả</option>
                <option value="8" <?=($spcart['status']==7)?false:'disabled'?> <?=($spcart['status']==8)?'selected':false?> >Không Chấp Thuận Đổi Trả</option>
                <option value="9" <?=($spcart['status']==7)?false:'disabled'?> <?=($spcart['status']==9)?'selected':false?> >Chấp Thuận Đổi Trả</option>
                <option value="10" <?=($spcart['status']==10)?'selected':false?>  disabled>Hoàn Tất Đơn Hàng</option>
            </select>
            <div class="input-group-append">
                <button class="btn btn-sm btn-gradient-primary" cart-id="<?=$spcart['id']?>" id="nextstep" type="button" <?=($spcart['status']==1||$spcart['status']==10)?'disabled':false?>>Xác Nhận</button>
            </div>
        </div>

    <img src="<?=(!empty($image['link']))?$image['link']:'/assets/imgs/defaultImg.png'?>" class="card-img-top">
    <div class="card-body">
        <p class="card-title"><?=$namep?></p>
        <p class="card-text">
        <p>Giá: <?=number_format($spcart['price'],0,',',',')?> x <?=$spcart['amount']?></p>
        <p><?=$html2?></p>
        <p>Mã giảm giá: <?=$coupon['code']?></p>
        <p>Người đặt: <strong><?=$fullname?></strong></p>
        <p>Địa chỉ giao hàng: <strong><?=$street?></strong></p>
        <p>Người bán: <strong><?=$store_name?></strong></p>
        <p>Thời gian mua: <strong class="text-info"><?=$spcart['created_at']?></strong></p>
        <p>Trạng Thái: <?php echo "<strong class='text-info'>".$type.'</strong>';?></p>
        <p><?=$reason?></p>
        <button class="btn btn-sm col-12" id="expfile" cart-id="<?=$spcart['id']?>">Xuất Đơn Vận Hàng</button>
        </p>
    </div>
    
</div> -->
<?php
//    }
// else:
// echo '<p class="text-danger">Sản phẩm không tồn tại</p>';
//     endif;

// }
?>