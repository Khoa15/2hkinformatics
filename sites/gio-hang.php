<?php
define('IN_SITE', true);
require_once('../c0nFig.php');
$uid = (isset($_SESSION['id']) && is_numeric($_SESSION['id']))?(int)$_SESSION['id']:0;
if($uid!=$_SESSION['id']){
    $data = array('title'=>'Error', 'html'=>'The request not found');
    echo json_encode($data);
    exit();
}
$system=$db->db_get_row('select ship from system where id=1');
$sql = 'select * from `spcart` where `user_id`='.$uid.' and `status`=1 order by `id` desc';
$list = $db->db_get_list($sql);
$price = 0;
$ship = $system['ship'];
foreach ($list as $item) {
    $coupons = ['ship'=>$system['ship'],'discount'=>0];
    // if($item['typepid']){
    //     $typep = $db->db_get_row('select price from types_of_products where id='.$item['typepid']);
    //     $item['price'] = $typep['price'];
    // }
    if(!empty($item['coupon_id'])){
        //Apply coupon
        $coupons = $db->coupon($item);
    }
    $total = $item['price'] * $item['amount'];
    $price += $total - $total*$coupons['discount']/100;
    $price += $coupons['ship'];
}
    $title = 'Giỏ Hàng';
    $html = '<style>
        .bg-light{
            transition: .2s;
        }
        .bg-light:hover{
            box-shadow: 0px 0px 10px 1px #ddd;
        }
        @media(max-width: 990px){
            #hide{
            display:none
        }
        }
    </style>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <form class="title-main-left text-right animate__animated animate__bounceInRight" id="boxsearch">
                    <h1 class="title-main text-left text-dark" to="fpage" id="cursor-pointer">2HK - DB</h1>
                    <div class="form-group shadow-sm mb-0">
                        <input type="text" class="form-control" autocomplete="off" name="q" id="searchkey">
                    </div>
                    <button class="btn btn-lg btn-gradient-primary" id="btnsearch"><i class="mdi mdi-magnify"></i></button>
                </form>
                <div class="autocomplete">
                    <ul class="mt-3" id="autocomplete" style="list-style:none">
                       
                    </ul>
                </div>
            </div>
        </div>
    </div><div class="container mt-2 mb-3">
        <div class="row">
            <div class="col-12">
            <div class="container">
            <div class="row">
                <button class="col-xl-2 col-md-6 col-sm-12 col-md-2 btn btn-sm btn-gradient-primary" id="checkout">Thanh Toán</button>
                <select class="col-xl-2 col-md-6 col-sm-12 col-md-2">
                ';
                $sql = 'select * from `address` where `user_id`='.$uid.' order by `first` desc';
                $address = $db->db_get_list($sql);
                foreach($address as $item){
                    $html .= '<option value="'.$item['id'].'">'.$item['fullname'].' - '.$item['nbp'].' - '.$item['street'].', '.$item['city'].'</option>';
                }

                    $html.='
                </select>
                <div class="col-xl-6 col-md-6 col-sm-12 col-md-6 badge badge-lg badge-danger">Tổng tiền: <strong id="mainTotalPrice" value="'.$price.'">'.number_format($price,0,',',',').'</strong><span class="badge badge-sm badge-info p-0 m-0 hide" id="scoupon">30%</span></div>
                <label class="col-xl-2 col-md-6 col-sm-12 col-md-2 bg-light" style="padding: 3px 7px">
                    <input type="checkbox" value="1" id="choose_all" />
                    Chọn toàn bộ
                </label>
            </div>
            </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="row">
                    
                </div>
            </div>
                    <div class="col-lg-12 mt-3 bg-light" id="hide">
                        <div class="container">
                            <div class="row">
                                <div class="col-2 mt-2"></div>
                                <div class="col-10 mt-2">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4 text-center">Số Lượng</div>
                                            <div class="col-4 text-center">Giá</div>
                                            <div class="col-4 text-center">Thành Tiền</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        ';

        foreach($list as $item){
            $sql = 'select `link` from `images` where `product_id`='.$item['product_id'].' order by `pos` desc limit 1';
            $image = $db->db_get_row($sql);
            $link = (!empty($image['link']))?$image['link']:'/assets/imgs/defaultImg.png';
            $sql = 'select `name`, `amount` from `products` where `id`='.$item['product_id'].' limit 1';
            $product = $db->db_get_row($sql);
            $name = (empty($product['name']))?'Not Found'.$item['product_id']:$product['name'];
            $amount = $product['amount'];
            $system=$db->db_get_row('select ship from system where id=1');
            $sqlc = 'select discount, code, ship,forall from coupon where id='.$item['coupon_id'].' limit 1';
            $coupon = $db->db_get_row($sqlc);
            // if($item['typepid']){
            //     $typep = $db->db_get_row('select price from types_of_products where id='.$item['typepid']);
            //     $item['price'] = $typep['price'];
            // }
            $discount = (!empty($coupon['discount']) and $coupon['forall'])?$coupon['discount']:0;
            $ship_cod = (!empty($coupon['ship']))?$system['ship']-$coupon['discount']*$system['ship']/100:$system['ship'];
            $total_price = $item['price']*$item['amount'];
            $total_price = $total_price-$discount*$total_price/100;
            $total_price += $ship_cod;//*$item['amount']; //SHIP COD 
            $versions = (!empty($item['typepid']))?explode(", ", $item['typepid']):false;
            $code = (!empty($coupon['code']))?$coupon['code']:false;
            $html2=null;
            if(!empty($versions)){
                $length = sizeof($versions);
                foreach ($versions as $key => $typepid) {
                    $sql = 'select * from types_of_products where id='.$typepid;
                    $version = $db->db_get_row($sql);
                    $dot = ($length>1)?', ':false;
                    $html2 .= $version['name'].': '.$version['type'].$dot;
                    $length--;
                }
            }

            $html.='
                    <div class="col-lg-12 mt-3  bg-light" style="border-top-left-radius:  10px;border-bottom-left-radius:  10px;border-top-right-radius:  10px;border-bottom-right-radius:  10px" cart-id="'.$item['id'].'">
                <div class="row">

                    
                    <div class="col-xl-2 col-md-4 col-sm-12 p-3">
                        <img src="'.$link.'" style="max-height: 170px">
                    </div>
                    <div class="col-xl-10 col-md-8 col-sm-12">
                        <div class="mt-3 pr-3 pl-3">
                            <h4>'.$name.'</h4>
                            <p class="mb-2 text-muted">'.$html2.'</p>
                            <div class="container mb-2">
                                <div class="row" style="align-items: flex-end;">
                                    <div class="col-lg-4 col-sm-6">
                                            <input type="number" class="form-control" value="'.$item['amount'].'" min="1" max="'.$amount.'" cart-id="'.$item['id'].'" id="spcart_amount">
                                    </div>
                                    <div class="col-lg-4 col-sm-6 text-center">
                                        <p>x '.number_format($item['price'],0,',',',').'</p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 text-center text-primary" id="totalprice" cart-id="'.$item['id'].'">
                                        <p id="ttpprice" value="'.$total_price.'">'.number_format($total_price,0,',',',').'</p>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="coupon" cart-id="'.$item['id'].'" placeholder="Mã giảm giá" autocomplete="off" value="'.$code.'">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-gradient-primary" id="accept_coupon" cart-id="'.$item['id'].'" type="button">Áp dụng</button>
                                            </div>
                                        </div>
                                        <p id="tcoupon" cart-id="'.$item['id'].'">'.((!empty($coupon['ship']))?$coupon['discount']:$discount).'%</p>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-sm-12" style="line-height: 48px">
                                        <button class="btn btn-sm pr-4 pl-4 btn-danger" id="trashthis" cart-id="'.$item['id'].'">
                                            Xóa
                                        </button>
                                        <button class="btn btn-sm btn-primary p-0 m-0">
                                            <label class="pt-2 pr-5 pl-5"><input type="checkbox" id="choose" cart-id="'.$item['id'].'" /> Chọn</labe>
                                        </button>
                                        <p>Phí vận chuyển: <span id="ship" cart-id="'.$item['id'].'">'.number_format($ship_cod,0,',',',').'</span>vnđ</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>';
            }
        $html.='</div>
    </div>';
    $data = array('title'=>$title, 'html'=>$html);
    echo json_encode($data);
?>