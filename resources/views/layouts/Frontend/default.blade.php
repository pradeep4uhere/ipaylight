<!DOCTYPE html>
<html lang="zxx" class="theme-light">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @include('elements.Frontend.meta')
        <!-- All CSS Link -->
		<link rel="stylesheet" href="frontend/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="frontend/assets/css/animate.min.css">
        <link rel="stylesheet" href="frontend/assets/css/meanmenu.css">
        <link rel="stylesheet" href="frontend/assets/css/boxicons.min.css">
		<link rel="stylesheet" href="frontend/assets/css/magnific-popup.min.css">
        <link rel="stylesheet" href="frontend/assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="frontend/assets/css/flaticon.css">
		<link rel="stylesheet" href="frontend/assets/css/odometer.min.css">
		<link rel="stylesheet" href="frontend/assets/css/slick.min.css">
		<link rel="stylesheet" href="frontend/assets/css/style.css">
		<link rel="stylesheet" href="frontend/assets/css/color/pink-style.css">
		<link rel="stylesheet" href="frontend/assets/css/responsive.css">
		<link rel="stylesheet" href="frontend/assets/css/dark-color/pink-dark-style.css">
		
		
		<link rel="icon" type="image/png" href="favicon.ico">
		<style>
			.bar {
    height: 5px;
    width: 90px;
    background: #cdf1d8;
    margin: 20px 0;
    position: relative;
    border-radius: 30px;
}</style>
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-DPPYDR2LSC"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-DPPYDR2LSC');
	</script>
	</head>
	<body>
		
		<!-- Start Preloader Area -->
        <div class="preloader">
			<div class="spinner"></div>
		</div>
        <!-- End Preloader Area -->

        @yield('content')
		<!-- Start Footer Area -->
		@include('elements.Frontend.footer')

		<div class="go-top"><i data-feather="arrow-up"></i></div>
		<!-- All JS Link -->
		<script src="frontend/assets/js/jquery.min.js"></script>
		<script src="frontend/assets/js/bootstrap.bundle.min.js"></script>
		<script src="frontend/assets/js/jquery.meanmenu.js"></script>
		<script src="frontend/assets/js/wow.min.js"></script>
		<script src="frontend/assets/js/magnific-popup.min.js"></script>
		<script src="frontend/assets/js/appear.min.js"></script>
		<script src="frontend/assets/js/odometer.min.js"></script>
        <script src="frontend/assets/js/slick.min.js"></script>
        <script src="frontend/assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="frontend/assets/js/isotope.pkgd.min.js"></script>
        <script src="frontend/assets/js/owl.carousel.min.js"></script>
		<script src="frontend/assets/js/feather.min.js"></script>
        <script src="frontend/assets/js/form-validator.min.js"></script>
        <script src="frontend/assets/js/contact-form-script.js"></script>
		<script src="frontend/assets/js/main.js"></script>
		<script>
			$(document).ready(function() {
				$('.black-logo').show();
				$('.white-logo').hide();
				$("#header").removeClass('navbar-color-white');
			});
			</script>

	</body>
</html>