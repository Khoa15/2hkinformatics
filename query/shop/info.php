<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
$false = false;
$html = 'Không có dữ liệu';
$uid = (isset($_SESSION['id']))?(int)$_SESSION['id']:0;

if(!$false){
	$sid = intval($_POST['sid']);
	$action = addslashes($_POST['action']);
	$sql = 'select * from `stores` where `id`='.$sid.' limit 1';
	$shop = $db->db_get_row($sql);
	$num = $db->num_rows($sql);
	if($num==0){
		$false = true;
	}
	if(!$false){
		$user = $db->db_get_row($sql);
		$html = '';
		switch ($action) {
			case 'all-shop-products':
				$sql = 'select * from products where store_id='.$sid.' and actived=1 order by id desc';
				$list = $db->db_get_list($sql);
				foreach($list as $item):
			        $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
			        $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
			        $score = $db->db_get_row('select AVG(`score`) as total from `spcart` where `status`>=5 and `product_id`='.$item['id'].' limit 1');
			        $sql = 'select `id` from `lstfollow` where `product_id`='.$item['id'].' and `user_id`='.$uid.' limit 1';
			        $type = $db->db_get_row($sql);
			        $type = (empty($type['id']))?'text-dark':'text-danger';
			        $priceold = (!empty($product['sale']))?'<span class="old">'.number_format($product['price'],0,',',',').'<sup>đ</sup></span>':false;
			        $score = $score['total'];
			            $html.='<div class="col-lg-2">
			                <div class="product">
			                    <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
			                        <img src="'.$link.'" alt="">
			                    </a>
			                    <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="'.$item['id'].'">'.$item['name'].'</a></div>
			                    <div class="product-content">
			                        <div class="product-price">
			                            '.$priceold.'
			                            <span>'.number_format($item['price']-$item['sale']*100/$item['price'],0,',',',').'<sup>đ</sup></span>
			                        </div>
			                        <div class="interfere">
			                            <i class="mdi mdi-heart '.$type.'" id="btn_love" user-id="'.$uid.'" product-id="'.$item['id'].'"></i>
			                            <div class="score text-right">';
			                            for($i = 5; $i >= 5-(4-$score); $i--){
			                                $html .= '<span class="mdi mdi-star" score="'.$i.'"></span>';
			                            }
			                            for($i = $score; $i >= 1; $i--){
			                                $html .= '<span class="mdi mdi-star checked" score="'.$i.'"></span>';
			                            }
			                                
			                            $html.='</div>
			                        </div>
			                        <p class="city text-right">'.$item['fcity'].'</p>
			                    </div>
			                </div>
			            </div>';
			        endforeach;
				break;
			case 'shop':
				$html.='<div class="col-lg-12">
                    <h3 class="text-dark-outline text-light">Gợi ý: <button class="btn btn-sm btn-primary" single-page="true" to="shop-recommend.html">Xem tất cả</button></h3>
                </div>';
                $sql = 'select `id`, `name`, `price`, `sale`, `category_id` from `products` where `store_id`='.$sid.' and `actived`=1 order by rand() limit 6';
				$list = $db->db_get_list($sql);
                foreach ($list as $item) {
		        $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
		        $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
		        $sale = (!empty($item['sale']))?'<span class="old">'.number_format($item['price'],0,',',',').'<sup>đ</sup></span>':false;
		        $sql = 'select `city` from `address` where `user_id`='.$sid.' and `store` = true limit 1';
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
                $sql = 'select `id`, `name`, `price`, `sale` from `products` where `store_id`='.$sid.' and `sale`!=0 order by `sale` desc limit 6';
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
				break;
			default:
			$cid = intval($action);
				$sql = 'select * from products where store_id='.$sid.' and actived=1 and category_id='.$cid.' order by id desc';
				$list = $db->db_get_list($sql);
				foreach($list as $item):
			        $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
			        $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
			        $score = $db->db_get_row('select AVG(`score`) as total from `spcart` where `status`>=5 and `product_id`='.$item['id'].' limit 1');
			        $sql = 'select `id` from `lstfollow` where `product_id`='.$item['id'].' and `user_id`='.$uid.' limit 1';
			        $type = $db->db_get_row($sql);
			        $type = (empty($type['id']))?'text-dark':'text-danger';
			        $priceold = (!empty($product['sale']))?'<span class="old">'.number_format($product['price'],0,',',',').'<sup>đ</sup></span>':false;
			        $score = $score['total'];
			            $html.='<div class="col-lg-2">
			                <div class="product">
			                    <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
			                        <img src="'.$link.'" alt="">
			                    </a>
			                    <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="'.$item['id'].'">'.$item['name'].'</a></div>
			                    <div class="product-content">
			                        <div class="product-price">
			                            '.$priceold.'
			                            <span>'.number_format($item['price']-$item['sale']*100/$item['price'],0,',',',').'<sup>đ</sup></span>
			                        </div>
			                        <div class="interfere">
			                            <i class="mdi mdi-heart '.$type.'" id="btn_love" user-id="'.$uid.'" product-id="'.$item['id'].'"></i>
			                            <div class="score text-right">';
			                            for($i = 5; $i >= 5-(4-$score); $i--){
			                                $html .= '<span class="mdi mdi-star" score="'.$i.'"></span>';
			                            }
			                            for($i = $score; $i >= 1; $i--){
			                                $html .= '<span class="mdi mdi-star checked" score="'.$i.'"></span>';
			                            }
			                                
			                            $html.='</div>
			                        </div>
			                        <p class="city text-right">'.$item['fcity'].'</p>
			                    </div>
			                </div>
			            </div>';
			        endforeach;

		}
	}
}
echo $html;
?>