<?php
define('IN_SITE', true);
require_once('../c0nFig.php');
$keySearch = (isset($_GET['keySearch']))?htmlspecialchars(addslashes($_GET['keySearch'])):false;
$filter = (isset($_GET['filter']))?intval($_GET['filter']):false;
$aprice = (isset($_GET['aprice']))?(int)$_GET['aprice']:false;
$iprice = (isset($_GET['iprice']))?(int)$_GET['iprice']:false;
$uid = (isset($_SESSION['id']))?(int)$_SESSION['id']:0;
$sql = 'select products.* from `products`, `categories` ';
$sql2 = 'select `id` from `categories` ';
$sql3 = 'select `name` from `stores`';
if(!$keySearch){
    $sql .= ' where products.actived = 1 AND categories.actived=1 AND categories.id = products.category_id';
    $sql2 .= ' where actived = 1';
    $sql3 .= ' where actived = 1';
}
if(!empty($keySearch)){
    $sql .=  'where `name` LIKE "%'.$keySearch.'%" and actived = 1';
    $sql2 .= ' where `name` = "'.$keySearch.'" and actived = 1';
    $sql3 .=  ' where `name` LIKE "%'.$keySearch.'%" and actived=1';
}
if(!empty($aprice)){
    $sql .= ' AND price BETWEEN '.$iprice.' and '.$aprice.' ';
}
$sql .= (empty($filter))?' GROUP BY products.id ORDER BY `id` desc':false;
$sql2 .= ' ORDER BY `id` desc limit 1';
$sql3 .= ' ORDER BY `id` desc';
$category = $db->db_get_row($sql2);
$selected1 = false;
$selected2 = false;
$selected3 = false;
$selected4 = false;
if(!empty($category['id']) && !empty($keySearch)){
    $sql = 'select * from `products` where `category_id`='.$category['id'].' and actived = 1';
}
if(!empty($filter)){
    $sql .= ' ORDER BY ';
    switch ($filter) {
        case 2:
            $sql .=' price DESC';
            $selected2 = 'selected';
            break;
        case 3:
            $sql .=' price ASC';
            $selected3 = 'selected';
            break;
        case 4:
            $sql .=' view DESC';
            $selected4 = 'selected';
            break;
        
        default:
            $sql .=' id desc';
            $selected1 = 'selected';
            break;
    }
}
$sql_pagination = $sql;
$sql .= ' limit 0, 24';
//echo $sql;
$list = $db->db_get_list($sql);
    $title = 'Sản Phẩm';
    $html ='<div class="container custom mt-3" style="position:relative;z-index:1">
        <div class="row">
            <div class="col-lg-12">
                <form class="title-main-left text-right" id="boxsearch">
                    <h1 class="title-main text-left text-dark" to="fpage" id="cursor-pointer">2HK - DB</h1>
                    <div class="form-group shadow-sm mb-0">
                        <input type="text" class="form-control" name="q" value="'.$keySearch.'" autocomplete="off" id="searchkey">
                    </div>
                    <button class="btn btn-lg btn-gradient-primary" id="btnsearch"><i class="mdi mdi-magnify"></i></button>
                </form>
                <div class="autocomplete">
                    <ul class="mt-3" id="autocomplete" style="list-style:none">
                       
                    </ul>
                </div>
            </div>
            <div class="col-lg-12 mt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <select class="form-control" id="filter" name="sort">
                                <option value="1" '.$selected1.'>Sắp xếp: Mới Nhất</option>
                                <option value="2" '.$selected2.'>Sắp xếp: Giá Cao - Thấp</option>
                                <option value="3" '.$selected3.'>Sắp xếp: Giá Thấp - Cao</option>
                                <option value="4" '.$selected4.'>Sắp xếp: Mua Nhiều</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <input type="number" class="form-control p-2" placeholder="Giá từ: " id="price-min" value="'.$iprice.'">
                        </div>
                        <div class="col-lg-3">
                            <input type="number" class="form-control p-2" placeholder="Cho đến: " id="price-max" value="'.$aprice.'">
                        </div>
                        <div class="col-lg-2">
                            <input type="button" class="btn btn-primary btn-sm" id="acept" value="Áp Dụng">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row" id="loadingproducts">';
        foreach($list as $item):
            $store = $db->db_get_row('select actived from stores where id = '.$item['store_id']);
            if($store['actived']==1){
        $image = $db->db_get_row('select `link` from `images` where `status`=1 and `product_id`='.$item['id'].' order by `pos` desc limit 1');
        $link = (!empty($image['link']))?$image['link']:"/assets/imgs/defaultImg.png";
        $score = $db->db_get_row('select AVG(`score`) as total from `spcart` where `status`>=5 and `product_id`='.$item['id'].' limit 1');
        $sql = 'select `id` from `lstfollow` where `product_id`='.$item['id'].' and `user_id`='.$uid.' limit 1';
        $type = $db->db_get_row($sql);
        $type = (empty($type['id']))?'text-dark':'text-danger';
        $priceold = (!empty($item['sale']))?'<span class="old text-sm">'.number_format($item['price'],0,',',',').'<sup>đ</sup></span>':false;
        $sale = (!empty($item['sale']))?'<div class="position-absolute fixed-top text-right"><span class="badge badge-primary pl-1 pr-1">GIẢM '.$item['sale'].'%</span></div>':false;
        $price = $item['price']-$item['sale']*$item['price']/100;
        $score = $score['total'];
            $html.='<div class="col-lg-2">
                <div class="product">
                    <a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true">
                        <img src="'.$link.'" alt="">
                        '.$sale.'
                    </a>
                    <div class="product-title"><a href="/product-detail.html?i='.$item['id'].'" id="product" product-id="'.$item['id'].'">'.$item['name'].'</a></div>
                    <div class="product-content">
                        <div class="product-price">
                            '.$priceold.'
                            <span>'.number_format($price,0,',',',').'<sup>đ</sup></span>
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
            }
        endforeach;
        $html .= '</div>
    </div>              
    <div class="container mb-6">
        <div class="row">
            <nav class="col-12" id="paginationimage">
              <ul class="pagination justify-content-center">';
                  $sql = $sql_pagination;
                  $num = $db->num_rows($sql);
                  $cbtn = ceil($num/25);
                  $active = ' active';
                  for ($i=1; $i <= $cbtn; $i++) { 
                    $html .= '<li class="page-item'.$active.'"><button class="page-link">'.$i.'</button></li>';;
                    $active = false;
                  }
              $html.='</ul>
            </nav>
        </div>
    </div>';
    $data = array('title'=>$title, 'html'=>$html);
    echo json_encode($data);
?>