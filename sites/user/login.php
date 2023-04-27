<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Đăng Nhập - <?=$nameShop?></title>
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
	<!-- Preloader -->
	<div class="preloader" style="display: none;">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->

	<section id="contact-us" class="contact-us section">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-8">
							<div class="form-main">
								<div class="title">
									<a href="/"><h4><i class="ti-home"></i> Trang chủ</h4></a>
								</div>
								<form class="form" id="frm_login">
									<div class="row">
										<div class="col-12">
											<div class="alert alert-danger" id="error"></div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Số điện thoại<span>*</span></label>
												<input name="sdt" type="number" placeholder="">
											</div>	
										</div>
										<div class="col-12">
											<div class="form-group message">
												<label>Mật khẩu<span>*</span></label>
												<input type="password" name="psw" placeholder="">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" class="btn">Đăng nhập</button>
												<a href="/user/register.html">Bạn chưa có tài khoản?</a>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-2"></div>
				</div>
			</div>
	</section>

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
		$('button[type="submit"]').on('click', function(){
			$(this).attr('disabled', true);
			var data = $("#frm_login").serialize();
			$.post('/user/login/login/', data, function(o){
				if(o.sts==0){
					$('.alert#error').fadeIn()
					$('.alert#error').text(o.msg)
					return false
				}else{
					window.location.href = "/"
				}
			}, 'json');
			$(this).attr('disabled', false);
			return false
		})
	</script>
</body>
</html>