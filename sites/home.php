<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mua sắm trực tuyến hàng triệu sản phẩm thời trang nam nữ, đồ điện tử, gia dụng...Giá tốt & nhiều ưu đãi. Mua và bán online trong 30 giây." />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <title><?=$nameShop?></title>
    
    <link rel="icon" type="image/png" href="<?=$favicon?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    
    <div class="container mt-1">
        <div class="row">
            <div class="col-6 text-left">
                <button to="search.html" single-page="true" class="btn btn-icon btn-rounded btn-light" data-toggle="tooltip" data-placement="bottom" title="Trang chủ"><i class="mdi mdi-home"></i></button>
                <button to="products.html" single-page="true" class="btn btn-icon btn-rounded btn-light" data-toggle="tooltip" data-placement="bottom" title="Sản phẩm"><i class="mdi mdi-view-module"></i></button>
                <?php 
                    if(isset($_SESSION['id'])):
                        $uid = (int)$_SESSION['id'];
                        $sql = 'select `id` from `stores` where `user_id`='.$uid.' limit 1';
                        $store = $db->db_get_row($sql);
                        if(!empty($store['id'])){
                            echo '<button to="/shop.html" store-id="'.$store['id'].'" class="btn btn-icon btn-rounded btn-light"><i class="mdi mdi-houzz"></i></button>';
                        }else{
                            echo '<button to="mo-shop.html" single-page="true" class="btn btn-icon btn-rounded btn-light"><i class="mdi mdi-houzz"></i></button>';
                        }
                    endif;
                    if(isset($_SESSION['permission']) && $_SESSION['permission']>=3 ):
                        echo '<a href="/admin.html" class="btn btn-icon btn-rounded btn-light">
                        <i class="mdi mdi-desktop-mac"></i></a>';
                    endif;
                ?>
            </div>
            <div class="col-6 text-right">
                <button to="gio-hang.html" single-page="true" class="btn btn-icon btn-rounded btn-light" data-toggle="tooltip" data-placement="bottom" title="Giỏ hàng"><i class="mdi mdi-cart"></i></button>
                <button to="/<?=(isset($_SESSION['id']))?'info':'dang-nhap'?>.html" class="btn btn-icon btn-rounded btn-light" id="signin" single-page="true" data-toggle="tooltip" data-placement="bottom" title="<?=(isset($_SESSION['id']))?"Thông tin":"Đăng nhập"?>"><i class="mdi <?=(isset($_SESSION['id']))?'mdi-account':'mdi-login-variant'?>"></i></button>
                <?php if(isset($_SESSION['id'])){ ?>
                    <a href="/dang-xuat.html" class="btn btn-icon btn-rounded btn-light" id="signout"><i class="mdi mdi-logout"></i></a>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <div id="app"></div>
    
    <div class="container fixed-bottom mb-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-right">
                    <button class="btn btn-gradient-primary btn-rounded btn-icon" id="changebg"><i class="mdi mdi-format-color-fill"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/misc.js"></script>
    <!-- <script src="https://kit.fontawesome.com/52fba46c38.js" crossorigin="anonymous"></script> -->
    <script src="/assets/js/sweetalert.min.js"></script>
    <script src="/assets/js/formpickers.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/vendor.bundle.base.js"></script>
    <script src="/assets/js/vendor.bundle.addons.js"></script>
    
</body>
</html>