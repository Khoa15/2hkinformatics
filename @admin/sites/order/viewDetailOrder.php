<?php
if(isset($_POST['id'])){
    $id = intval($_POST['id']);
    $spcart = $db->db_get_row('select * from spcart where id = '.$id.' limit 1');
    if(empty($spcart)) echo "Không tìm thấy sản phẩm";
    else{
        $img = $db->db_get_row('select link from images where product_id='.$spcart['product_id']);
        $product = $db->db_get_row('select name, amount from products where id='.$spcart['product_id']);
        $coupon = $db->db_get_row('select code from coupon where id='.$spcart['coupon_id']);
        $store = $db->db_get_row('select name from stores where id='.$spcart['store_id']);
        $user = $db->db_get_row('select surname, name from users where id='.$spcart['user_id']);
        $address = $db->db_get_row('select street, city, nbp from address where id='.$spcart['address_id']);
        $system = $db->db_get_row('select ship from system where id = 1 limit 1');
        $media = null;
        if($spcart['status'] >= 6 and $spcart['status'] <= 9) $media = $db->db_get_list('select link from images where spcart_id='.$id);


        $total = $spcart['amount']*$spcart['price'];
        $coup = $db->coupon($spcart);
        $type_coupon = 'Giảm: '.$coup['for_ship'].'% '.$coup['type'];
        $ship = $system['ship'] - $system['ship']*$coup['for_ship']/100;
?>  
<div class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
                <td>Hình ảnh</td>
                <td>
                    <img src="<?=$img['link']?>" height="120">
                </td>
            </tr>
            <tr>
                <td>Tên sản phẩm</td>
                <td><?=$product['name']?></td>
            </tr>
            <tr>
                <td>Giá</td>
                <td><?=number_format($spcart['price'],0,',',',')?></td>
            </tr>
            <tr>
                <td>Số lượng</td>
                <td><?=$spcart['amount']?></td>
            </tr>
            <tr>
                <td>Phí vận chuyển:</td>
                <td><?=number_format($ship,0,',',',')?>đ</td>
            </tr>
            <tr>
                <td>Mã giảm giá</td>
                <td><?=(!empty($coupon))?$coupon['code']:"Không có mã"?> - <?=$type_coupon?></td>
            </tr>
            <tr>
                <td>Tổng giá trị đơn hàng</td>
                <td><?=number_format($total-$total*$coup['discount']/100 + $ship,0,',',',')?>đ</td>
            </tr>
            <tr>
                <td>Trạng thái</td>
                <td>    
                    <div class="input-group disabled">
                        <select id="status" class="btn btn-sm btn-outline-secondary bg-info text-light" cart-id="<?=$spcart['id']?>" id="" <?=($spcart['status']==1||$spcart['status']==10)?'disabled':false?>>
                            <option value="0" <?=($spcart['status']==0)?'selected':false?>>Hủy</option>
                            <option value="1" <?=($spcart['status']==1)?'selected':false?> disabled>Giỏ Hàng</option>
                            <option value="2" title="Click để xác nhận" <?=($spcart['status']==2)?'selected':false?> disabled>Chờ Xác Nhận Đơn Hàng</option>
                            <option value="3" <?=($spcart['status']==3)?'selected':false?> <?=($spcart['status']>=6)?'disabled':false?>>Đã Xác Nhận</option>
                            <option value="4" <?=($spcart['status']==4)?'selected':false?> <?=($spcart['status']>=6)?'disabled':false?>>Đang Vận Chuyển</option>
                            <option value="5" <?=($spcart['status']==5)?'selected':false?> <?=($spcart['status']>=6)?'disabled':false?>>Đã Giao Hàng Thành Công</option>
                            <option value="6" <?=($spcart['status']==6)?'selected':false?> disabled>Hàng Lỗi - Yêu cầu đổi trả</option>
                            <!-- <option value="7">Yêu Cầu Đổi Trả</option> -->
                            <option value="8" <?=($spcart['status']==8)?'selected':false?> <?=($spcart['status']!=6)?'disabled':false?> >Không Chấp Thuận Đổi Trả</option>
                            <option value="9" <?=($spcart['status']==9)?'selected':false?> <?=($spcart['status']!=6)?'disabled':false?> >Chấp Thuận Đổi Trả</option>
                            <option value="10" <?=($spcart['status']==10)?'selected':false?>  disabled>Hoàn Tất Đơn Hàng</option>
                        </select>
                        
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-primary" onclick="nextstep(<?=$spcart['id']?>)" type="button" <?=($spcart['status']==1||$spcart['status']==10)?'disabled':false?>>Xác Nhận</button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Ghi chú/ lý do/ phản hồi</td>
                <td><?=$spcart['description']?></td>
            </tr>
            <tr>
                <td>Cửa hàng</td>
                <td><?=$store['name']?></td>
            </tr>
            <tr>
                <td>Thời gian đặt hàng:</td>
                <td class="text-primary"><?=$spcart['created_at']?></td>
            </tr>
            <tr>
                <td colspan="2">Thông tin khách hàng:</td>
            </tr>
            <tr>
                <td>Họ & tên</td>
                <td><?=$user['surname'].' '.$user['name']?></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><?=(!empty($address))?$address['nbp']:'Không có dữ liệu'?></td>
            </tr>
            <tr>
                <td>Địa chỉ cần giao</td>
                <td><?=(!empty($address))?$address['street'].' '.$address['city']:'Không có dữ liệu'?></td>
            </tr>
        </tbody>
    </table>
</div>
    <div class="container-fluid">
        <?php if(!empty($media)):?>
        <h4>Ảnh/video phản hồi:</h4>
        <div class="row">
            <?php foreach($media as $m): $type = explode('.', $m['link']);if($type[1]=='mp4'){ ?>
            <div class="col-4 col-sm-12">
                <video controls width="100%" height="120">
                    <source src="<?=$m['link']?>" type="video/mp4">
                </video>
                <?php
                    }else{
                ?>
                <img src="<?=$m['link']?>" height="120">
            </div>
            <?php } ?>
        </div>
        <?php endforeach; endif; ?>
    </div>

<?php
    }
}
?>