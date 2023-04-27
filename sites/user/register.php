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
    <title>Đăng Kí - <?=$nameShop?></title>
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
									<h4>Chào mừng bạn tới<i></i></h4>
									<h3>Đăng kí</h3>
								</div>
								<form class="form" id="frm_register" method="post">
									<div class="row">
										<div class="col-12">
											<div class="alert alert-danger" id="error"></div>
											<div class="alert alert-success" id="success"></div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Họ<span>*</span></label>
												<input name="fullname" type="text" placeholder="">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Tên<span>*</span></label>
												<input name="name" type="text" placeholder="">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Email<span>*</span></label>
												<input name="email" type="email" required>
											</div>	
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Số điện thoại<span>*</span></label>
												<input type="number" name="numberPhone" type="text" placeholder="">
											</div>	
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-check">
												<label>Giới tính<span>*</span></label>
												
												<label><input type="radio" value="0" name="sex" checked>Name</label>
												<label><input type="radio" value="1" name="sex">Nữ</label>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Ngày sinh <span>*</span></label>
												<input type="date" name="dob">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Mật khẩu<span>*</span></label>
												<input type="password" name="psw" placeholder="">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group message">
												<label>Nhập lại mật khẩu<span>*</span></label>
												<input type="password" name="repsw" placeholder="">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Địa chỉ:</label>
												<input type="text" id="address" name="address">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Tỉnh/ thành:</label>
												<select name="city" id="city">
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
												<button type="submit" class="btn">Đăng kí</button>
												<a href="/user/login.html">Bạn đã có tài khoản?</a>
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
		var ispsw = false;
		$(document).ready(function(){
			$("input[name='repsw']").on('input', function(){
				var psw = $("input[name='psw']").val(), repsw = $('input[name="repsw"]').val();
				if(psw != repsw){
					$("#error").fadeIn()
					$("#error").text('Mật khẩu không giống nhau!')
					return false
				}
				if(psw == repsw && psw != "")
					$("#error").fadeOut()
					$("#error").text(' ')
					ispsw = true
			})
		})
		$('button[type="submit"]').on('click', function(e){
			e.preventDefault();
			$(this).attr('disabled', true);
			var data = $("#frm_register").serialize();
			if(!ispsw){
				$("#error").fadeIn()
				$("#error").text('Kiểm tra lại mật khẩu')
				return false
			}
			$.post('/user/register/register/', data, function(o){
				if(o.sts==0){
					$('.alert#success').fadeOut()
					$('.alert#error').fadeIn()
					$('.alert#error').text(o.msg)
				}else{
					$('.alert#success').fadeIn()
					$('.alert#error').fadeOut()
					$('.alert#success').text(o.msg)	
					}
			}, 'json');
			$(this).attr('disabled', false);
		})
		$('#address').on('input', function(){
			var text = $('#address').val(), city = $('#city').val();
			$('#addresspre').text(text+((text!="")?', ':'')+city)
		})
	</script>
</body>
</html>