<?php
define('IN_SITE', true);
require_once('../c0nFig.php');
$id = (isset($_GET['id']))?intval($_GET['id']):0;
if(!$id){
    exit();
}
$sql = 'select * from `stores` where `id`='.$id.' and actived = 1 limit 1';
$sql2 = 'select AVG(CASE WHEN `score`!=0 THEN score END) as score, COUNT(CASE WHEN `score`!=0 THEN score END) as people,COUNT(`status`) as total, COUNT(CASE WHEN `status`=10 OR status=5 THEN status END) as success from `spcart` where `store_id`='.$id;
$shop = $db->db_get_row($sql);
$spcart = $db->db_get_row($sql2);
$succescharge = ($spcart['total']==0)?"<p class='text-muted text-center'>chưa đủ dữ liệu</p>":$spcart['success']*100/$spcart['total'];
$succescharge = ($succescharge==0)?"<p class='text-muted text-center'>chưa đủ dữ liệu</p>":(int)$succescharge."%";
$sql = 'select `link` from `images` where `id`='.$shop['cover'].' limit 1';
$cover = $db->db_get_row($sql);
$sql = 'select `link` from `images` where `id`='.$shop['icon'].' limit 1';
$icon = $db->db_get_row($sql);
$cover = (!empty($cover['link'])) ? $cover['link'] : '/assets/imgs/banner.jpg';
$icon = (!empty($icon['link'])) ? $icon['link'] : '/assets/imgs/avatar.jpg';
$sql = 'select `id`, `name`, `price`, `sale`, `category_id` from `products` where `store_id`='.$shop['id'].' and `actived`=1 order by rand() limit 6';
$list = $db->db_get_list($sql);
$lcateg = 'select `id`, `name`, `price`, `sale`, `category_id` from `products` where `store_id`='.$shop['id'].' and `actived`=1 GROUP BY `category_id`';
$lcateg = $db->db_get_list($lcateg);
$user = $db->db_get_row('select permission from users where id='.$shop['user_id']);
$span = ($user['permission']>3)?'<span class="badge badge-danger p-1 m-0">Tốt</span>':false;
$categories = null;
if(!empty($lcateg)){
foreach($lcateg as $idc){
    $lcate = $db->db_get_row('select `id`,`name` from categories where `id`='.$idc['category_id']);
    $categories .= '<li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="javascript:;" store-id="'.$id.'" aria-controls="'.$lcate['id'].'" role="tab">'.$lcate['name'].'</a>
                    </li>';
    }
}
    $html = '<div class="container mt-3">
        <div class="row">
            <div class="shop col-12">
                <div class="shop-content">
                    <img src="'.$cover.'" alt="">
                    <div class="shop-header">
                        <img src="'.$icon.'" alt="">
                        <div class="shop-description">
                            <div class="name-shop">'.$shop['name'].$span.' </div>
                            <div class="info-shop">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="text-center">Thời gian bắt đầu hoạt động</p>
                                            <p class="text-center">'.($db->backtime(time()-strtotime($shop['created_at']))).' trước</p>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-center">Đánh giá</p>
                                            <p class="text-center">'.number_format($spcart['score'],1,'.','.').'</p>
                                            <p class="text-center"><sub>'.$spcart['people'].' người đánh giá</sub></p>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-center">Tỉ lệ đơn hàng thành công</p>
                                            <p class="text-center">'.$succescharge.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="scroll-x">
                <ul class="ml-2 mt-1 nav nav-tabs custom col-12" id="shop" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="javascript:;" store-id="'.$shop['id'].'" aria-controls="shop" role="tab">Tổng</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="javascript:;" store-id="'.$shop['id'].'" aria-controls="all-shop-products" role="tab">Tất Cả Sản Phẩm</a>
                    </li>
                    '.$categories.'
                </ul>
            </div>
            <div class="container mt-3 mb-7">
                <div class="row" id="view-products-shop">
                <div class="col-lg-12">
                    <h3 class="text-dark-outline text-light">Gợi ý: <button class="btn btn-sm btn-primary" single-page="true" to="shop-recommend.html">Xem tất cả</button></h3>
                </div>';
                foreach ($list as $item) {
		        $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
		        $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
		        $sale = (!empty($item['sale']))?'<span class="old">'.number_format($item['price'],0,',',',').'<sup>đ</sup></span>':false;
		        $sql = 'select `city` from `address` where `user_id`='.$shop['user_id'].' and `store` = true limit 1';
		        $address = $db->db_get_row($sql);
                $city = (empty($address['city']))?false:$address['city'];
                    $html.='<div class="col-lg-2">
                        <div class="product">
                            <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
                                <img src="'.$link.'" alt="">
                            </a>
                            <div class="product-content">
                                <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">'.$item['name'].'</a></div>
                                <div class="product-price">
                                    '.$sale.'
                                    <span>'.number_format($item['price']-$item['sale']*$item['price']/100,0,',',',').'<sup>đ</sup></span>
                                </div>
                                <div class="interfere">
                                    <i class="fa fa-heart"></i>
                                    <div class="score text-right">
                                        <span class="fa fa-star" score="5"></span>
                                        <span class="fa fa-star" score="4"></span>
                                        <span class="fa fa-star checked" score="3"></span>
                                        <span class="fa fa-star checked" score="2"></span>
                                        <span class="fa fa-star checked" score="1"></span>
                                    </div>
                                </div>
                                <p class="city text-right">'.$city.'</p>
                            </div>
                        </div>
                    </div>';
                }
                $html .= '<div class="col-lg-12">
                    <h3 class="text-dark-outline text-light">Hot Sale: <button class="btn btn-sm btn-primary" single-page="true" to="shop-hot-sale.html">Xem tất cả</button></h3>
                </div>';
                $sql = 'select `id`, `name`, `price`, `sale` from `products` where `store_id`='.$shop['id'].' and `sale`!=0 order by `sale` desc limit 6';
                $list = $db->db_get_list($sql);
                foreach ($list as $item) {
		        $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc');
		        $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
                $sale = (!empty($item['sale']))?'<span class="old">'.number_format($item['price'],0,',',',').'<sup>đ</sup></span>':false;
		        $sql = 'select `city` from `address` where `user_id`='.$shop['user_id'].' and `store` = true limit 1';
		        $address = $db->db_get_row($sql);
                    $html.='<div class="col-lg-2">
                        <div class="product">
                            <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
                                <img src="'.$link.'" alt="">
                            </a>
                            <div class="product-content">
                                <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">'.$item['name'].'</a></div>
                                <div class="product-price">
                                    '.$sale.'
                                    <span>'.number_format($item['price']-$item['sale']*$item['price']/100,0,',',',').'<sup>đ</sup></span>
                                </div>
                                <div class="interfere">
                                    <i class="fa fa-heart"></i>
                                    <div class="score text-right">
                                        <span class="fa fa-star" score="5"></span>
                                        <span class="fa fa-star" score="4"></span>
                                        <span class="fa fa-star checked" score="3"></span>
                                        <span class="fa fa-star checked" score="2"></span>
                                        <span class="fa fa-star checked" score="1"></span>
                                    </div>
                                </div>
                                <p class="city text-right">TP.Hồ Chí Minh</p>
                            </div>
                        </div>
                    </div>';
                }
                $html.='</div>
            </div>
        </div>
    </div>';
    $title = 'Shop';
    $data = array('title'=>$title, 'html'=>$html);
    echo json_encode($data);
?>
