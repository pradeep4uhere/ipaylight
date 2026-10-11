<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

    <title>IPayLight - Digital Payment & Financial Solutions</title>
    <meta name="description" content="IPayLight provides digital payment solutions for businesses, including payment gateway and payout services.">

    <link rel="canonical" href="https://ipaylight.com/">

    <!-- Open Graph: WhatsApp, Facebook, LinkedIn -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="IPayLight">
    <meta property="og:title" content="IPayLight - Digital Payment & Financial Solutions">
    <meta property="og:description" content="Simplify business payments with IPayLight's digital payment and payout solutions.">
    <meta property="og:url" content="https://ipaylight.com/">

    <!-- Replace this with your actual publicly accessible logo/preview image URL -->
    <meta property="og:image" content="https://ipaylight.com/small_black_logo.png">
    <meta property="og:image:secure_url" content="https://ipaylight.com/images/ipaylight-social-preview.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="IPayLight - Digital Payment & Financial Solutions">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="IPayLight - Digital Payment & Financial Solutions">
    <meta name="twitter:description" content="Digital payment and payout solutions for businesses.">
    <meta name="twitter:image" content="https://ipaylight.com/small_black_logo.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="keywords" content="iPaylight, Ipaylight Technologies Pvt Ltd, payment gateway India, digital payment solutions, online payment collection, bulk payouts, UPI payments, bank transfers, payment APIs, payment reconciliation">

    <meta name="description" content="iPaylight, operated by Ipaylight Technologies Pvt. Ltd., provides payment infrastructure solutions to help businesses manage online payment collection, payouts, UPI transfers and payment operations.">

    <meta name="author" content="Ipaylight Technologies Pvt. Ltd.">

    <meta name="robots" content="index, follow">

    <!-- Open Graph / Social Media -->
    <meta property="og:site_name" content="iPaylight">
    <meta property="og:url" content="https://ipaylight.com/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="iPaylight | Payment Infrastructure & Digital Payment Solutions">
    <meta property="og:description" content="Simplify business payments with iPaylight. Explore payment collection, bulk payouts, UPI transfers and payment technology solutions.">
    <meta property="og:image" content="https://ipaylight.com/small_black_logo.png">
    <meta property="og:image:alt" content="iPaylight - Payment Infrastructure Solutions">


    <!-- Browser Compatibility -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Responsive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- For Resposive Device -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- For Window Tab Color -->
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#1A4137">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#1A4137">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#1A4137">
	<title>Babun - Business & Finance HTML5 Template</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="56x56" href="images/fav-icon/icon.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('ipaylight/css/bootstrap.min.css') }}" media="all">
	<!-- Main style sheet -->
	<link rel="stylesheet" type="text/css" href="{{ asset('ipaylight/css/style.min.css') }}" media="all">
	<!-- responsive style sheet -->
	<link rel="stylesheet" type="text/css" href="{{ asset('ipaylight/css/responsive.css') }}" media="all">

	<!-- Fix Internet Explorer ______________________________________-->
	<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->
</head>

<body>
	<div class="main-page-wrapper">
		<!-- ===================================================
				Loading Transition
			==================================================== -->
		<div id="preloader">
			<div id="ctn-preloader" class="ctn-preloader">
				<div class="icon"><img src="images/loader.svg" alt="" class="m-auto d-block" width="60"></div>
				<div class="txt-loading">
					<span data-text-preloader="i" class="letters-loading">
						i
					</span>
					<span data-text-preloader="p" class="letters-loading">
						P
					</span>
					<span data-text-preloader="a" class="letters-loading">
						a
					</span>
					<span data-text-preloader="y" class="letters-loading">
						y
					</span>
					<span data-text-preloader="L" class="letters-loading">
						L
					</span>
                    <span data-text-preloader="i" class="letters-loading">
						i
					</span>
                    <span data-text-preloader="g" class="letters-loading">
						g
					</span>
                    <span data-text-preloader="h" class="letters-loading">
						h
					</span>
                    <span data-text-preloader="t" class="letters-loading">
						t
					</span>
				</div>
			</div>
		</div>

        @include('layouts.Frontend.ipaylight.header')


        @yield('content')

        	<!--
		=====================================================
			Footer Three
		=====================================================
		-->
		<div class="footer-three">
			<div class="container">
				<div class="inner-wrapper position-relative">
					<div class="row justify-content-between">
						<div class="col-lg-4 footer-intro mb-30">
							<div class="round-bg color-two rounded-circle text-center d-flex flex-column align-items-center justify-content-center">
								<div class="logo mb-15">
									<a href="index.html">
										<img src="images/logo/logo_02.svg" alt="">
									</a>
								</div>
								<!-- logo -->
								<p class="lh-sm mb-45 lg-mb-30">Sec-63, Noida  <br>Uttat Pradesh (India)</p>
								<p class="m0"><a href="#">+91-9289026567</a></p>
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 mb-20">
							<h5 class="footer-title">Links</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="{{route('home')}}">Home</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'about-us'])}}">About us</a></li>
                                <li><a href="{{route('page.action', ['page_slug' => 'payment-gateways'])}}">Payment Gateway</a></li>
                                <li><a href="{{route('page.action', ['page_slug' => 'payout-solutions'])}}">Payout Solutions</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-sm-4 mb-20">
							<h5 class="footer-title">Company</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="{{route('page.action', ['page_slug' => 'about-us'])}}">About us</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'contact-us'])}}">Contact</a></li>
                                <li><a href="{{route('page.action', ['page_slug' => 'refund-cancellation'])}}">Refund & Cancellation</a></li>

							</ul>
						</div>
						<div class="col-xxl-2 col-lg-3 col-sm-4 mb-20">
							<h5 class="footer-title">Support</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="{{route('page.action', ['page_slug' => 'terms-conditions'])}}">Terms of use</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'terms-conditions'])}}">Terms & conditions</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'privacy-policy'])}}">Privacy</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'cookie-policy'])}}">Cookie policy</a></li>
							</ul>
						</div>
					</div>
					<img src="images/lazy.svg" data-src="images/shape/shape_38.svg" alt="" class="lazy-img shapes shape_01">
					<img src="images/lazy.svg" data-src="images/shape/shape_39.svg" alt="" class="lazy-img shapes shape_02">
				</div> <!-- /.inner-wrapper -->
			</div>
			<div class="container">
				<div class="bottom-footer">
					<div class="row">
						<div class="col-xl-4 col-lg-3 order-lg-3 mb-15">
							<ul class="style-none d-flex align-items-center justify-content-center justify-content-lg-end social-icon">
								<li><a href="#"><i class="bi bi-facebook"></i></a></li>
								<li><a href="#"><i class="bi bi-dribbble"></i></a></li>
								<li><a href="#"><i class="bi bi-instagram"></i></a></li>
							</ul>
						</div>
						<div class="col-xl-4 col-lg-6 order-lg-2 mb-15">
							<ul class="style-none bottom-nav d-flex flex-wrap justify-content-center order-lg-last">
								<li><a href="{{route('page.action', ['page_slug' => 'privacy-policy'])}}">Privacy & Terms</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'cookie-policy'])}}">Cookies</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'contact-us'])}}">Contact Us</a></li>
							</ul>
						</div>
						<div class="col-xl-4 col-lg-3 order-lg-1 mb-15">
							<div class="copyright text-center text-lg-start order-lg-first">Copyright @2023 babun inc.</div>
						</div>
					</div>
				</div>
				<!-- /.bottom-footer -->
			</div>
		</div> <!-- /.footer-three -->


		<!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                <div class="container">
                    <div class="user-data-form modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<div class="form-wrapper m-auto">
							<ul class="nav nav-tabs border-0 w-100" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#fc1" role="tab">Login</button>
								</li>
								<li class="nav-item" role="presentation">
									<button class="nav-link" data-bs-toggle="tab" data-bs-target="#fc2" role="tab">Signup</button>
								</li>
							</ul>
							<div class="tab-content mt-30">
								<div class="tab-pane show active" role="tabpanel" id="fc1">
									<div class="text-center mb-20">
										<h2>Hi, Welcome Back!</h2>
										<p>Still don't have an account? <a href="#">Sign up</a></p>
									</div>
									<form action="#">
										<div class="row">
											<div class="col-12">
												<div class="input-group-meta position-relative mb-25">
													<label>Email*</label>
													<input type="email" placeholder="Youremail@gmail.com">
												</div>
											</div>
											<div class="col-12">
												<div class="input-group-meta position-relative mb-20">
													<label>Password*</label>
													<input type="password" placeholder="Enter Password" class="pass_log_id">
													<span class="placeholder_icon"><span class="passVicon"><img src="images/icon/icon_13.svg" alt=""></span></span>
												</div>
											</div>
											<div class="col-12">
												<div class="agreement-checkbox d-flex justify-content-between align-items-center">
													<div>
														<input type="checkbox" id="remember">
														<label for="remember">Keep me logged in</label>
													</div>
													<a href="#">Forget Password?</a>
												</div> <!-- /.agreement-checkbox -->
											</div>
											<div class="col-12">
												<button class="btn-four w-100 tran3s d-block mt-20">Login</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" role="tabpanel" id="fc2">
									<div class="text-center mb-20">
										<h2>Register</h2>
										<p>Already have an account? <a href="#">Login</a></p>
									</div>
									<form action="#">
										<div class="row">
											<div class="col-12">
												<div class="input-group-meta position-relative mb-25">
													<label>Name*</label>
													<input type="text" placeholder="Zubayer Hasan">
												</div>
											</div>
											<div class="col-12">
												<div class="input-group-meta position-relative mb-25">
													<label>Email*</label>
													<input type="email" placeholder="zubayerhasan@gmail.com">
												</div>
											</div>
											<div class="col-12">
												<div class="input-group-meta position-relative mb-20">
													<label>Password*</label>
													<input type="password" placeholder="Enter Password" class="pass_log_id">
													<span class="placeholder_icon"><span class="passVicon"><img src="images/icon/icon_13.svg" alt=""></span></span>
												</div>
											</div>
											<div class="col-12">
												<div class="agreement-checkbox d-flex justify-content-between align-items-center">
													<div>
														<input type="checkbox" id="remember2">
														<label for="remember2">By hitting the "Register" button, you agree to the <a href="#">Terms conditions</a> & <a href="#">Privacy Policy</a></label>
													</div>
												</div> <!-- /.agreement-checkbox -->
											</div>
											<div class="col-12">
												<button class="btn-four w-100 tran3s d-block mt-20">Sign up</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>

							<div class="d-flex align-items-center mt-30 mb-10">
								<div class="line"></div>
								<span class="pe-3 ps-3 fs-6">OR</span>
								<div class="line"></div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<a href="#" class="social-use-btn d-flex align-items-center justify-content-center tran3s w-100 mt-10">
										<img src="images/icon/google.png" alt="">
										<span class="ps-3">Signup with Google</span>
									</a>
								</div>
								<div class="col-sm-6">
									<a href="#" class="social-use-btn d-flex align-items-center justify-content-center tran3s w-100 mt-10">
										<img src="images/icon/facebook.png" alt="">
										<span class="ps-3">Signup with Facebook</span>
									</a>
								</div>
							</div>
						</div>
						<!-- /.form-wrapper -->
                    </div>
                    <!-- /.user-data-form -->
                </div>
            </div>
        </div>


		<button class="scroll-top">
			<i class="bi bi-arrow-up-short"></i>
		</button>
        <!-- Optional JavaScript _____________________________ -->

        <!-- jQuery -->
        <script src="{{ asset('ipaylight/vendor/jquery.min.js') }}"></script>

        <!-- Bootstrap JS -->
        <script src="{{ asset('ipaylight/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- WOW JS -->
        <script src="{{ asset('ipaylight/vendor/wow/wow.min.js') }}"></script>

        <!-- Slick Slider -->
        <script src="{{ asset('ipaylight/vendor/slick/slick.min.js') }}"></script>

        <!-- Fancybox -->
        <script src="{{ asset('ipaylight/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>

        <!-- Lazy Load -->
        <script src="{{ asset('ipaylight/vendor/jquery.lazy.min.js') }}"></script>

        <!-- Counter -->
        <script src="{{ asset('ipaylight/vendor/jquery.counterup.min.js') }}"></script>

        <!-- Waypoints -->
        <script src="{{ asset('ipaylight/vendor/jquery.waypoints.min.js') }}"></script>

        <!-- Validator JS -->
        <script src="{{ asset('ipaylight/vendor/validator.js') }}"></script>

        <!-- Theme JS -->
        <script src="{{ asset('ipaylight/js/theme.js') }}"></script>







        @stack('scripts')

    </div> <!-- /.main-page-wrapper -->
</body>
</html>
