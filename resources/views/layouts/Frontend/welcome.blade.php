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
		<link rel="icon" type="Frontend/image/png" href="favicon.ico">
		<style>
			.bar {
			height: 5px;
			width: 90px;
			background: #cdf1d8;
			margin: 20px 0;
			position: relative;
			border-radius: 30px;
		}
	</style>
	<style>
	*,
*:after,
*:before {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
  outline: 0 none;
}
.clear:before,
.row:before {
  content: '';
  display: table;
}
.clear:after,
.row:after {
  content: '';
  display: table;
  clear: both;
}
.tlt2, .tlt { font-size: 36px; margin: 0px; }
.demo {
  padding: 50px 10px;
  text-align: center;
  overflow: hidden;
  border-bottom: 5px solid #333;
}
.src-original {
  text-align: center;
  padding: 20px;
}
.animate-classes {
  padding: 20px 20px 10px;
  background: #333;
  color: #eee;
}
h2 {
  display: block;
  padding: 10px 20px;
}
.animate-classes li {
  float: left;
  margin: 0 20px 10px 0;
  font-family: Verdana, Geneva, sans-serif;
  list-style: none;
  font-size: 14px;
  letter-spacing: 0.1rem;
}
</style>
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

		<!-- Dark/Light Toggle -->
		<div class="dark-version">
            <label id="switch" class="switch">
                <input type="checkbox" onchange="toggleTheme()" id="slider">
                <span class="slider round"></span>
            </label>
        </div>
		
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
		<script src="https://textillate.js.org/jquery.textillate.js"></script>
		<script src="https://textillate.js.org/assets/jquery.lettering.js"></script>
		<script src="https://textillate.js.org/assets/jquery.fittext.js"></script>
		
		
		<script>
			$(document).ready(function() {
				$(window).scroll(function() {
					if ($(this).scrollTop() > 50) { // You can change the value '50' to adjust when the logo should change
						$('.black-logo').hide();
						$('.white-logo').show();
					} else {
						$('.black-logo').hide();
						$('.white-logo').show();
					}
				});
				
				// Initial check
				if ($(window).scrollTop() > 50) {
					$('.black-logo').hide();
					$('.white-logo').show();
				} else {
					$('.black-logo').hide();
					$('.white-logo').show();
				}

				$('.tlt').textillate({
						in: {
						effect: 'bounceInDown'
						},
						out: {
						effect: 'fadeOutRight',
						shuffle: true
						},
						loop: true
					});
			});
			</script>
			

	</body>
</html>