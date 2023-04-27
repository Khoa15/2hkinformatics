<?php
if(!isset($db)){
    define('IN_SITE', true);
    require_once('../c0nFig.php');
}
$pid = (isset($_GET['pid']))?(int)$_GET['pid']:0;
$sql = 'select * from `products` where `id`='.$pid.' AND actived=1 limit 1';
$product = $db->db_get_row($sql);
if(empty($product)){
    echo json_encode(array('title'=>'404 - Not Found','html'=>'<div class="container mt-3"><center class="bg-light p-3 rounded">The request not found</center></div> '));
    exit();
}
$not_found_product = "<p class='text-muted col-12'>Không tìm thấy sản phẩm.</p>";
$db->db_query('update `products` set view = view+1, updated_at = now() where `id`='.$pid);
$images = $db->db_get_list('select `link` from `images` where `product_id`='.$pid.' and `status`=1 order by `pos` desc');
    $title = $product['name'];
    $shop = $db->db_get_row('select `id`, `name`,`icon` from `stores` where `id`='.$product['store_id']);
    $iconl = $db->db_get_row('select link from images where id='.$shop['icon'].' limit 1');
    $icon = (!empty($iconl['link']))?$iconl['link']:'/assets/imgs/defaultImg.png';
    $uid = (empty($_SESSION['id']))?0:$_SESSION['id'];
    $sql2234 = 'select `name`, `type`, `id`, Max(price) as maxp, Min(price) as minp from types_of_products where `product_id`='.$pid.' GROUP BY name ORDER BY id ASC';
      $typeofproduct = $db->db_get_row($sql2234);
      $selectVersions = null;
      if(!empty($typeofproduct['name'])){
      $selectVersions = '<div class="input-group sm">';
        $hash = $db->filterText($typeofproduct['name']);
        $selectVersions .= '
          <div class="input-group-prepend">
            <span class="input-group-text text-dark">'.$typeofproduct['name'].'</span>
          </div>
          <select name="versions" id="versions" class="form-control text-dark"><option value="0">Hãy chọn 1 mục</option>';
        $selectVersions .= '<option value="'.$typeofproduct['id'].'">'.$typeofproduct['type'].'</option>';
            $sql2234 = 'select `id`,`type`, `price` from types_of_products where `product_id`='.$pid.' and id!='.$typeofproduct['id'].' and name = "'.$typeofproduct['name'].'"';
            $list343 = $db->db_get_list($sql2234);
            foreach ($list343 as $type2) {
        $selectVersions .= '<option value="'.$type2['id'].'">'.$type2['type'].'</option>';
            }
        $selectVersions .= '</select>';
      $selectVersions .= '</div>';
      }
    $type = $db->db_get_row('select `id` from `lstfollow` where `product_id`='.$pid.' and `user_id`='.$uid);
    $type = (empty($type['id']))?'text-dark':'text-danger';
//    if($lsel)
    $priceold = (!empty($product['sale']))?'<span class="old">'.number_format($product['price'],0,',',',').'<sup>đ</sup></span>':false;
    $price = '<span id="sprice">'.number_format($product['price']-$product['sale']*$product['price']/100,0,',',',').'<sup>đ</sup></span>';
    if(!empty($typeofproduct['minp']) && $typeofproduct['minp'] != $typeofproduct['maxp']){
        $priceold = (!empty($product['sale']))?'<span class="old">'.number_format($typeofproduct['minp'],0,',',',').' - '.number_format($typeofproduct['maxp'],0,',',',').'<sup>đ</sup></span>':false;
        $price = '<span id="sprice">'.number_format($typeofproduct['minp']-$product['sale']*$typeofproduct['minp']/100,0,',',',').' - '.number_format($typeofproduct['maxp']-$product['sale']*$typeofproduct['maxp']/100,0,',',',').'<sup>đ</sup></span>';
    }
    $sale = (!empty($product['sale']))?'<span class="sale bg-gradient-warning">'.$product['sale'].'%<i class="fas fa-arrow-down"></i></span>':false;
    $sold = $db->num_rows('select `id` from spcart where status>=5 and product_id='.$pid);
    $score = $db->db_get_row('select  AVG(score) as score, COUNT(`score`) as sc from `spcart` where `status`>=5 and score>0 and `product_id`='.$pid);
    $scores = ($score['score']==0)?0:number_format($score['score'], 1,'.','.');
    $sql = 'select `id` from `lstfollow` where `store_id`='.$product['store_id'].' and `user_id`='.$uid. ' limit 1';
    $follow = $db->db_get_row($sql);
    $text = (empty($follow['id']))?'Thích':'Đã Thích';
    $freeship = ($product['freeship'])?'<label class="badge badge-dark">Miễn Phí Vận Chuyển</label>':false;
    $buyfrom = ($product['bfrom'])?'<span>Mua nhiều:</span>
                            <div class="badge badge-secondary text-dark">Mua từ >= '.$product['bfrom'].' giảm giá '.$product['discount'].'</div>':false;
      
    $html = '
    
    <div class="card mt-4 box-shop flex-box-shop" id="box-shop-info">
        <div class="card-body p-1">
            <div class="shop-info-sm text-center">
                <img src="'.$icon.'" class="image text-center">
                <!-- <div class="br-line"></div> -->
                <p class="text-top title" style="height: 20px"><a href="javascript:;" to="/shop.html" store-id="'.$shop['id'].'">'.$shop['name'].'</a></p>
                <p>
                    <button class="btn btn-sm btn-dark text-light" id="like_shop" store-id="'.$product['store_id'].'" user-id="'.$uid.'">'.$text.'</button>
                </p>
            </div>
        </div>
    </div>
        <div class="box-shop" id="toggle">
            <button id="oflex-box-shop">SHOW</button>
        </div>
    <div class="container mb-6 mt-3">
        <div class="row">
            <div class="col-lg-4" style="z-index:1">
                <div class="block bg-light text-center" id="loading_images">

                </div>
            </div>
            <div class="col-lg-8">
                <div class="block bg-light">
                    <h3>'.$product['name'].'</h3>
                    <small class="interfere">
                        <span class="br">'.$sold.' Đã Bán</span>
                        <span class="br">'.$score['sc'].' Đánh Giá</span>
                        <div class="score md text-right">
                            <span class="mscore">'.$scores.'</span> ';
                            for($i = 5; $i >= 5-(4-$scores); $i--){
                                $html .= '<span class="mdi mdi-star" score="'.$i.'"></span>';
                            }
                            for($i = $scores; $i >= 1; $i--){
                                $html .= '<span class="mdi mdi-star checked" score="'.$i.'"></span>';
                            }
                                
                            $html.='</div>
                    </small>
                    <div class="block-content mt-3">
                        <div class="price">
                            '.$priceold.'
                            '.$price.'
                            '.$sale.'
                        </div>
                        <div class="moving-truck mt-3">
                            <label>Giao từ:</label>
                            <i class="fas fa-truck"></i>
                            <label>'.$product['fcity'].'</label>
                            '.$freeship.'
                        </div>
                        <div class="mt-3">
                            '.$buyfrom.'
                        </div>
                        <div class="mt-1">
                            '.$selectVersions.'
                        </div>
                    </div>
                    <div class="block-foot">
                        <div class="left">
                            <button class="btn '.$type.' btn-rounded btn-icon" id="btn_love" user-id="'.$uid.'" product-id="'.$pid.'"><i class="mdi mdi-heart"></i></button>
                            
                        </div>
                        <div class="right mt-3">
                            <div class="input-group" style="width:150px;display:inline-flex">
                              <input type="number" id="sqty" min="1" value="1" max="'.$product['amount'].'" class="form-control" style="padding:7px">
                              <div class="input-group-append">
                                <button class="btn btn-sm mt-0 btn-gradient-primary" type="button">/'.number_format($product['amount'],0,',',',').'</button>
                              </div>
                            </div>
                            <button class="btn btn-outline-primary" id="btn_add_spcart" product-id="'.$pid.'">Thêm Vào Giỏ Hàng</button>
                            <button class="btn btn-dark" id="btn_add_spcart" product-id="'.$pid.'" buy-now="true">Mua Ngay</button>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-12 mt-3 block bg-light">
                <div class="row mt-3">
                    <div class="col-lg-6 col-sm-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-dark">Các Sản Phẩm Khác Trong Shop</h4>
                                </div>
                                ';
                                $sql = 'select * from `products` where `store_id` = '.$product['store_id'].' and id!='.$pid.' order by rand() limit 4';
                                $list = $db->db_get_list($sql);
                                if(empty($list)){ $html.= $not_found_product;}
                                foreach ($list as $item) {
                                $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
                                $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
                                $html .='<div class="col-3">
                                    <div class="product mini">
                                        <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
                                            <img class="owl-lazy" src="'.$link.'" data-src="'.$link.'" data-src-retina="'.$link.'" alt="image"/>
                                        </a>
                                        <div class="product-content">
                                            <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">'.$item['name'].'</a></div>
                                            <div class="product-price mini">
                                                <span>'.number_format($item['price']-$item['sale']*$item['price']/100,0,',',',').'<sup>đ</sup></span>
                                                <span class="city float-right">'.$item['fcity'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                                $html.='
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-dark">Sản Phẩm Tương Tự</h4>
                                </div>';
                                $sql = 'select * from `products` where `category_id` = '.$product['category_id'].' and `store_id`!='.$product['store_id'].' and id!='.$pid.' order by rand() limit 4';
                                
                                $list = $db->db_get_list($sql);
                                if(empty($list)) {$html .= $not_found_product;}
                                foreach ($list as $item) {
                                $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
                                $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
                                $html .='<div class="col-3">
                                    <div class="product mini">
                                        <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
                                            <img class="owl-lazy" src="'.$link.'" data-src="'.$link.'" data-src-retina="'.$link.'" alt="image"/>
                                        </a>
                                        <div class="product-content">
                                            <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">'.$item['name'].'</a></div>
                                            <div class="product-price mini">
                                                <span>'.number_format($item['price']-$item['sale']*$item['price']/100,0,',',',').'<sup>đ</sup></span>
                                                <span class="city float-right">'.$item['fcity'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                                $html.='
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <h4>Mô Tả</h4>
                        <div class="description">
                            '.$product['description'].'
                        </div>
                    </div>
                </div>
            </div>';

            $sql = 'select `score`, `evaluate`, `user_id` from `spcart` where `product_id`='.$product['id'].' and `status`>=5 and `score`!=0 order by `id` desc';
            $list = $db->db_get_list($sql);
            $hide = (empty($list))?'hide':false;
            $html.='<div class="col-lg-12 mt-3 block sm bg-light '.$hide.'">
                <div class="container">
                    <div class="row">';
                    foreach($list as $item){
                        $sql ='select `name` from `users` where `id`='.$item['user_id'].' limit 1';
                        $user = $db->db_get_row($sql);
                        $score = $item['score'];
                        $html.='
                        <div class="col-12">
                            <div class="card rounded mb-2">
                                <div class="card-body p-3">
                                  <div class="media">
                                    <img src="/assets/imgs/avatar.jpg" alt="image" class="img-sm mr-3 rounded-circle">
                                    <div class="media-body">
                                      <h6 class="mb-1">'.$user['name'].'</h6>
                                        <div class="interfere">
                                            <div class="score md float-left">';
                                            for($i = 5; $i >= 5-(4-$score); $i--){
                                                $html .= '<span class="mdi mdi-star" score="'.$i.'"></span>';
                                            }
                                            for($i = $score; $i >= 1; $i--){
                                                $html .= '<span class="mdi mdi-star checked" score="'.$i.'"></span>';
                                            }
                                                
                                            $html.='</div>
                                        </div>
                                      <p class="mt-4 pt-2 text-muted">
                                      '.$item['evaluate'].'
                                      </p>
                                    </div> 
                                    </div>                             
                                </div>
                            </div>
                        </div>';
                              }
                        $html.='</div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    $data = array('title'=>$title,'html'=>$html);
    echo json_encode($data);
?>
