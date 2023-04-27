<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
$false = false;
$html = 'Không có dữ liệu';
if(!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_POST['action']) || empty($_POST['action']) ){
	$false = true;
}
if(!$false){
	$id = intval($_SESSION['id']);
	$action = addslashes($_POST['action']);
	$sql = 'select * from `users` where `id`='.$id.' limit 1';
	$num = $db->num_rows($sql);
	if($num==0){
		$false = true;
	}
	if(!$false){
		$user = $db->db_get_row($sql);
		$html = '';
		switch ($action) {
			case 'order':
				$sql = 'select `id`,`product_id`, `amount`, `status`, `address_id`, `typepid`, `description`, `coupon_id` from `spcart` where `status`!=1 and `user_id`='.$user['id'].' order by `updated_at` desc';
				$list = $db->db_get_list($sql);
				$html .= '
					<div class="row">';
				foreach($list as $item){
					$sql = 'select `name`, `price`, `sale`, `amount`, `store_id`, `id` from `products` where `id`='.$item['product_id'];
					$product = $db->db_get_row($sql);
					$sql = 'select `link` from `images` where `product_id`='.$item['product_id'].' and `status`=1 order by `pos` desc LIMIT 1';
					$image = $db->db_get_row($sql);
          $store_id= empty($product['store_id'])?0:$product['store_id'];
          $sql = 'select `id`,`name` from `stores` where `id`='.$store_id;
					$shop = $db->db_get_row($sql);
					$link = (!empty($image['link']))?$image['link']:'/assets/imgs/defaultImg.png';
          $versions = (!empty($item['typepid']))?explode(", ", $item['typepid']):false;
          $length = ($versions)?sizeof($versions):false;
          $html2=null;
          if($length){
            $html2 = 'Loại sản phẩm: ';
            foreach ($versions as $key => $typepid) {
                $sql = 'select * from types_of_products where id='.$typepid;
                $version = $db->db_get_row($sql);
                if(!empty($version)){
                $dot = ($length>1)?', ':false;
                $html2 .= $version['name'].': '.$version['type'].$dot;
                }
                $length--;
            }
          }
          $reason = null;
					switch($item['status']){
            case 0:

              $type = "Hủy";
              $reason = '<p>Lý do: <strong>'.$item['description'].'</strong></p>';
              break;

            case 3:

              $type = "Đã xác nhận";
              break;

            case 4:

              $type = "Đang vận chuyển";
              break;

            case 5:

              $type = 'Đã giao thành công';
              break;

            case 6:

              $type = "Hàng lỗi";
              $reason = '<p>Lý do: <strong>'.$item['description'].'</strong></p>';
              break;

            case 7:

              $type = "Đổi trả";
              break;
            case 8:
              $type = 'Không chấp nhận đổi trả';
              $reason = '<p>Lý do: <strong>'.$item['description'].'</strong></p>';
              break;
            case 9:
              $type = 'Đổi trả được chấp thuận';
              break;
            case 10:

              $type = 'Hoàn tất đơn hàng';

              break;
            default:

              $type = "Chưa xác nhận đơn hàng";

          }
          $cancel=($item['status']<3&&$item['status']>0)?'<button class="btn btn-sm btn-danger" cart-id="'.$item['id'].'" id="cancelcart">Hủy Đơn Hàng</button>':false;
          $button=($item['status']>=5)?'<button data-toggle="modal" data-target="#formvote" class="btn btn-sm btn-gradient-primary" cart-id="'.$item['id'].'" id="vote" cart-id="'.$item['id'].'">Đánh Giá</button>':false;
          $callback=($item['status']==5)?'<button data-toggle="modal" data-target="#formcallback" class="btn btn-sm btn-gradient-warning" cart-id="'.$item['id'].'" id="vote" cart-id="'.$item['id'].'">Yêu cầu trả hàng</button>':false;
          $username = (empty($shop['name']))?false:$shop['name'];
          
          $sale = ($product['sale'])?'<span class="badge badge-info badege-sm p-1 mt-1">Giảm '.$product['sale'].'%</span>':false;
					$name = (empty($product['name']))?false:$product['name'];
          $price = (empty($product['price']))?false:$product['price']-$product['sale']*$product['price']/100;
          $address = $db->db_get_row('select `fullname`, `nbp`, `street`, `city` from `address` where `id`='.$item['address_id']);
          $errorShop = false;
          $item['amount'] = (empty($item['amount']))?0:$item['amount'];
          if(empty($address) or empty($item['amount'])){
            $db->delete('spcart', 'id='.$item['id']);
            $errorShop = "Lỗi đơn hàng!! Đơn hàng sẽ bị xóa tự động.";
          }
          $fullname = (!empty($address['fullname'])) ? $address['fullname'] :false;
          $nbp = (!empty($address['nbp'])) ? $address['nbp'] :false;
          $city = (!empty($address['city'])) ? $address['city'] :false;
          $street = (!empty($address['street'])) ? $address['street'] :false;
          $coupon = $db->db_get_row('select code, discount,ship from coupon where id='.$item['coupon_id'].' limit 1');
          $coupon['discount'] = (!empty($coupon['discount'])) ? $coupon['discount'] : 0;

          $discount = (!empty($coupon['code'])) ? '<p class="mb-0">Mã giảm giá: '.$coupon['code'].' <span class="badge badge-primary badge-sm p-1">'.$coupon['discount'].'%</span></p>' : false;
          //$discount .= (!empty($coupon['code']) && $coupon['ship'])?"Áp dụng cho phí vận chuyển":"Áp dụng cho sản phẩm";
          $coupons = $db->coupon($item);
          $total = $item['amount']*$price + $coupons['ship'];
          $type_ship = (!empty($coupons['type']))?'<p>Áp dụng cho: '.$coupons['type'].'</p>':false;
          $status_ship = (!empty($coupons['id_type']) && $coupons['id_type']!=1)?'<span class="p-1 badge badge-primary">đã áp dụng</span>':false;
          $html .= '
						<div class="col-lg-3 mb-3" id="cart" cart-id="'.$item['id'].'">
				            <img src="'.$link.'" alt="">
				          </div>
				          <div class="col-lg-9 mb-3" id="cart" cart-id="'.$item['id'].'">
				            <h4 href="/product-detail.html?i='.$product['id'].'" id="product" product-id="'.$product['id'].'">'.$name.$sale.'</h4>
				            <p class="mb-2" to="/shop.html" store-id="'.$shop['id'].'">'.$username.'</p>
                    <p class="mb-0">'.$html2.'</p>
				            <p class="mb-0">Giá: '.$item['amount'].' x '.number_format($price,0,',',',').'đ</p>
                    <p class="mb-0">Phí vận chuyển: '.number_format($coupons['ship'],0,',',',').$status_ship.'</p>
                    '.$discount.'
                    '.$type_ship.'
				            <p class="mb-1">Tổng tiền: '.number_format($total-$coupons['discount']*$total/100,0,',',',').'đ</p>
                    <p class="mb-0">Người nhận: '.$fullname.'</p>
                    <p class="mb-0">Số điện thoại: '.$nbp.'</p>
                    <p class="mb-2">Giao đến: '.$street.', '.$city.'</p>
				            <p class="mb-0">Tình Trạng: <strong>'.$type.'</strong></p>
                    '.$reason.'
                    <p class="text-danger">'.$errorShop.'</p>
                    '.$cancel.$button.$callback.'
                  </div>
                  <hr class="col-11" id="cart" cart-id="'.$item['id'].'">
					';
          /*if($errorShop){
            $db->delete('spcart', 'id='.$item['id']);
          }*/
				}
				$html .= '</div>';
				break;
			case 'address':
				$sql = 'select * from `address` where `user_id`='.$user['id'].' order by `id` desc';
				$address = $db->db_get_list($sql);
				$phone = (!empty($address[0]['nbp']))?$address[0]['nbp']:false;
				$html .= '
				<div class="col-lg-12">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md_add_address" id="btn_add_address">Thêm địa chỉ <i class="mdi mdi-plus-circle"></i></button>
                  </div>
                  <div class="modal fade" id="md_add_address">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Thêm địa chỉ</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form-row" id="frm_add_address">
                          
                            <div class="col-lg-12">
                                <div class="alert alert-danger" id="error"></div>
                                <div class="alert alert-success" id="success"></div>
                            </div>
                        	<div class="col-lg-12">
                                <div class="form-group">
                                    <label>Họ & tên:<span>*</span></label>
                                    <input required type="text" class="form-control" id="fullname" name="fullname">
                                </div>
                            </div>
                        	<div class="col-lg-12">
                                <div class="form-group">
                                    <label>Số điện thoại:<span>*</span></label>
                                    <input required type="number" class="form-control" id="phone" name="phone" value="'.$phone.'">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Địa chỉ:<span>*</span></label>
                                    <input required type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Tỉnh/ thành:<span>*</span></label>
                                    <select name="city" id="city" class="form-control">
                                        <option>An Giang</option>
                                        <option>Bà Rịa - Vũng Tàu</option>
                                        <option>Bắc Kạn</option>
                                        <option>Bắc Giang</option>
                                        <option>Bạc Liêu</option>
                                        <option>Bắc Ninh</option>
                                        <option>Bến Tre</option>
                                        <option>Bình Dương</option>
                                        <option>Bình Định</option>
                                        <option>Bình Phước</option>
                                        <option>Bình Thuận</option>
                                        <option>Cà Mau</option>
                                        <option>Cần Thơ</option>
                                        <option>Cao Bằng</option>
                                        <option>Đà Nẵng</option>
                                        <option>Đắk Lắk</option>
                                        <option>Đắk Nông</option>
                                        <option>Điện Biên</option>
                                        <option>Đồng Nai</option>
                                        <option>Đồng Tháp</option>
                                        <option>Gia Lai</option>
                                        <option>Hà Giang</option>
                                        <option>Hà Nam</option>
                                        <option>Hà Nội</option>
                                        <option>Hà Tĩnh</option>
                                        <option>Hải Dương</option>
                                        <option>Hải Phòng</option>
                                        <option>Hậu Giang</option>
                                        <option selected>TP. Hồ Chí Minh</option>
                                        <option>Hòa Bình</option>
                                        <option>Hưng Yên</option>
                                        <option>Khánh Hòa</option>
                                        <option>Kiên Giang</option>
                                        <option>Kon Tum</option>
                                        <option>Lai Châu</option>
                                        <option>Lâm Đồng</option>
                                        <option>Lạng Sơn</option>
                                        <option>Lào Cai</option>
                                        <option>Long An</option>
                                        <option>Nam Định</option>
                                        <option>Nghệ An</option>
                                        <option>Ninh Bình</option>
                                        <option>Ninh Thuận</option>
                                        <option>Phú Thọ</option>
                                        <option>Phú Yên</option>
                                        <option>Quảng Bình</option>
                                        <option>Quảng Nam</option>
                                        <option>Quảng Ngãi</option>
                                        <option>Quảng Ninh</option>
                                        <option>Quảng Trị</option>
                                        <option>Sóc Trăng</option>
                                        <option>Sơn La</option>
                                        <option>Tây Ninh</option>
                                        <option>Thái Bình</option>
                                        <option>Thái Nguyên</option>
                                        <option>Thanh Hóa</option>
                                        <option>Thừa Thiên Huế</option>
                                        <option>Tiền Giang</option>
                                        <option>Trà Vinh</option>
                                        <option>Tuyên Quang</option>
                                        <option>Vĩnh Long</option>
                                        <option>Vĩnh Phúc</option>
                                        <option>Yên Bái</option>
                                    </select>
                                </div>	
                            </div>
                            <div class="col-12">
                                <div class="form-group button">
                                    <p id="addresspre"></p>
                                    <button type="submit" class="btn btn-gradient-primary"><i class="mdi mdi-content-save"></i>Lưu</button>
                                </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>';
				foreach($address as $item){
          $default = ($item['first']==1)?'disabled':false;
					$html .= '
					<div class="col-lg-10 col-sm-12">'.$item['fullname'].' - '.$item['nbp'].' - '.$item['street'].', '.$item['city'].'</div>
                  <div class="col-lg-2 col-sm-12 address">
                      <button type="button" class="btn btn-success btn-sm btn-rounded btn-icon" title="Đặt làm mặt định" id="setDefaultAddress" address-id="'.$item['id'].'" '.$default.'>
                          <i class="mdi mdi-arrow-down"></i>
                      </button>
                      <button type="button" aid="'.$item['id'].'" id="del_address" class="btn btn-warning btn-sm btn-rounded btn-icon">
                          <i class="mdi mdi-delete"></i>
                      </button>
                  </div>
                  <hr>';
				}
				break;
			
			default:
				$nam = ($user['gender']==0)?'checked':false;
				$nu = ($user['gender']==1)?'checked':false;
				$other = ($user['gender']==2)?'checked':false;
        $sql = 'select `product_id` from `lstfollow` where `user_id`='.$id.' and `product_id` != "" order by `id` desc';
        $list = $db->db_get_list($sql);
        $sql2 = 'select `store_id` from `lstfollow` where `user_id`='.$id.' and `store_id`!=""';
        $list2 = $db->db_get_list($sql2);
          $border=false;
        foreach($list2 as $store){
          $sid = (empty($store['store_id']))?0:$store['store_id'];
          $shop = $db->db_get_row('select * from `stores` where `id`='.$sid.' limit 1');
          if(!empty($shop)){
            $border = true;
            $image = $db->db_get_row('select `link` from `images` where `id`='.$shop['icon']);
            $link = (!empty($image['link']))?$image['link']:'/assets/imgs/defaultImg.png';
          $html .= '
          <div class="col-lg-3" store-id="'.$sid.'">
            <div class="card mt-4" id="box-shop-info">
              <div class="card-body p-1">
                  <div class="shop-info-sm text-center">
                      <img src="'.$link.'" class="image text-center">
                      <!-- <div class="br-line"></div> -->
                      <p class="text-top title" style="height: 20px"><a href="javascript:;" to="/shop.html" store-id="'.$sid.'">'.$shop['name'].'</a></p>
                      <p>
                          <button class="btn btn-sm btn-dark text-light" id="like_shop" store-id="'.$sid.'" user-id="'.$id.'">Đã Thích</button>
                      </p>
                  </div>
              </div>
            </div>
          </div>';
          }
        }
        if($border){
          $html .= "<hr>";
        }
        foreach($list as $more){
          $item = $db->db_get_row('select * from `products` where `id`='.$more['product_id'].' limit 1');
          $link = $db->db_get_row('select `link` from `images` where `product_id`='.$more['product_id'].' order by pos desc limit 1');
          $link = (empty($link['link']))?'/assets/imgs/defaultImg.png':$link['link'];
          $score = $db->db_get_row('select AVG(score) as sc from `spcart` where `status`>=5 and `product_id`='.$more['product_id']);
          $score = $score['sc'];
          $priceold = ($item['sale'])?'<span class="old">'.number_format($item['price'],0,',',',').'<sup>đ</sup></span>':false;
				$html .= '<div class="col-lg-3" product-id="'.$more['product_id'].'">
                <div class="product">
                    <a href="/product-detail.html?i='.$item['id'].'">
                        <img src="'.$link.'" alt="">
                    </a>
                    <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'">'.$item['name'].'</a></div>
                    <div class="product-content">
                        <div class="product-price">
                            '.$priceold.'
                            <span>'.number_format($item['price']-$item['sale']*$item['price']/100,0,',',',').'<sup>đ</sup></span>
                        </div>
                        <div class="interfere">
                            <i class="mdi mdi-heart text-danger" id="btn_love" info="true" user-id="'.$id.'" product-id="'.$more['product_id'].'"></i>
                            <div class="score text-right">';
                            for($i = 5; $i >= 5-(4-$score); $i--){
                                $html .= '<span class="mdi mdi-star" score="'.$i.'"></span>';
                            }
                            for($i = $score; $i >= 1; $i--){
                                $html .= '<span class="mdi mdi-star checked" score="'.$i.'"></span>';
                            }
                                
                            $html.='</div>
                        </div>
                        <p class="city text-right">TP.Hồ Chí Minh</p>
                    </div>
                </div>
            </div>';
            }
				break;
		}
		
	}

}
echo $html;
?>
<script>
	$(document).ready(function(){
		$('#btn_save_user').on('click', function(e){
			e.preventDefault();
			var frm = $('#boxinfo').serialize();;
			$.post('/user/update/update/', frm, function(o){
				if(o==1){
					$('#user.alert.alert-primary').toggle();
				}
			})
		})
	})
</script>