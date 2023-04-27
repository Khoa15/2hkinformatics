<?php
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
	header('Location: /user/login.html');
}
$sql = 'select * from `users` where `id`='.intval($_SESSION['id']);
$user = $db->db_get_row($sql);
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="<?=$nameShop?>">
    <meta name="description" content="Mua sắm trực tuyến hàng triệu sản phẩm thời trang nam nữ, đồ điện tử, gia dụng...Giá tốt & nhiều ưu đãi. Mua và bán online trong 30 giây">
	<!-- Title Tag  -->
    <title>Thông Tin Cá Nhân | <?=$nameShop?></title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="/assets/css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="/assets/css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="/assets/css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="/assets/css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="/assets/css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="/assets/css/slicknav.min.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="/assets/css/reset.css">
	<link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">

	
	
</head>
<body class="js">
	
	
	
	<header class="header shop">
		<?php include('sites/templates/tools/toolbar.php') ?>
		<?php include('sites/templates/tools/search.php') ?>
		<?php include('sites/templates/tools/menu.php') ?>
	</header>
	
	<div class="contact-us section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="single-head">
						<p><button class="btn full-width active" disabled id="infou"><?=$user['ten']?></button></p>
						<p><button class="btn full-width" id="address">Địa Chỉ</button></p>
						<p><button class="btn full-width" id="cart">Đơn Hàng</button></p>
					</div>
						
				</div>
				<div class="col-lg-8 form-main" id="datatabs">
					
				</div>
			</div>
		</div>
	</div>
		
	
	<!-- Start Footer Area -->
	<?php include('sites/templates/footer.php') ?>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jquery-migrate-3.0.0.js"></script>
	<script src="/assets/js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="/assets/js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="/assets/js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="/assets/js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="/assets/js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="/assets/js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="/assets/js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="/assets/js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="/assets/js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="/assets/js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="/assets/js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="/assets/js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="/assets/js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="/assets/js/easing.js"></script>
	<!-- Active JS -->
	<script src="/assets/js/active.js"></script>
	<script>
		$(window).load(function(){
			$('button.active').click();
		})
		$(document).ready(function(){
			$('button').on('click', function(){
				$('button.full-width').removeClass('active')
				$('button.full-width').attr('disabled', false)
				$(this).toggleClass('active')
				$(this).attr('disabled', true)
				var action = $(this).attr('id');
				$.post('/user/info/view/', {action:action}, function(o){
					$('#datatabs').html(o)
				})
			})
		})
	</script>
</body>
</html>