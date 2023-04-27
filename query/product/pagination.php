<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$uid = (isset($_SESSION['id']))?(int)$_SESSION['id']:0;
$page = 0;
$sql = 'select products.* from `products`, categories where products.actived = 1 AND categories.actived=1 AND categories.id = products.category_id ';
if(isset($_POST['search']) && !empty($_POST['search'])){
  $search = htmlspecialchars($_POST['search']);
  $sql .= ' and `id`="'.$search.'" OR `name` LIKE "%'.$search.'%" OR `description` LIKE "%'.$search.'%" OR `price`="'.$search.'" ';
}
     $sql .=' GROUP BY products.id order by `id` desc';
     if(isset($_POST['rowcount'])){
      $page = intval($_POST['rowcount']);
     }
     $sql .= ' LIMIT '.$page.', 24';
     $list = $db->db_get_list($sql);
$html = '';
     foreach($list as $item):
      $sql = 'select `actived` from stores where id='.$item['store_id'];
      $store = $db->db_get_row($sql);
      if($item['actived'] && $store['actived']){
        $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
        $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
        $score = $db->db_get_row('select AVG(`score`) as total from `spcart` where `status`>=5 and `product_id`='.$item['id'].' limit 1');
        $sql = 'select `id` from `lstfollow` where `product_id`='.$item['id'].' and `user_id`='.$uid.' limit 1';
        $type = $db->db_get_row($sql);
        $sale = (!empty($item['sale']))?'<div class="position-absolute fixed-top text-right"><span class="badge badge-primary pl-1 pr-1">GIẢM '.$item['sale'].'%</span></div>':false;
        $type = (empty($type['id']))?'text-dark':'text-danger';
        $score = $score['total'];
        $oldprice = (!empty($item['sale'])) ? '<span class="old text-sm">'.number_format($item['price'],0,',',',').'<sup>đ</sup></span>' : false;
  $html.='<div class="col-lg-2">
                <div class="product">
                    <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
                        <img src="'.$link.'" alt="">
                        '.$sale.'
                    </a>
                    <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="'.$item['id'].'">'.$item['name'].'</a></div>
                    <div class="product-content">
                        <div class="product-price">
                            '.$oldprice.'
                            <span>'.number_format($item['price']-$item['price']*$item['sale']/100,0,',',',').'<sup>đ</sup></span>
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
                        <p class="city text-right">TP.Hồ Chí Minh</p>
                    </div>
                </div>
            </div>';
}
endforeach; 
echo $html;
?>