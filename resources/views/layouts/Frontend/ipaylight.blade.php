<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO --}}
    <meta name="keywords" content="Digital marketing agency, Digital marketing company, Digital marketing services">
    <meta name="description" content="IPayLight provides innovative digital payment and financial technology solutions.">

    {{-- Open Graph --}}
    <meta property="og:site_name" content="IPayLight">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="IPayLight - Digital Payment & Financial Solutions">
    <meta property="og:description" content="IPayLight provides innovative digital payment and financial technology solutions.">
    <meta property="og:image" content="{{ asset('logo.png') }}">

    {{-- Theme Colors --}}
    <meta name="theme-color" content="#1A4137">
    <meta name="msapplication-navbutton-color" content="#1A4137">
    <meta name="apple-mobile-web-app-status-bar-style" content="#1A4137">

    {{-- Title --}}
    <title>@yield('title', 'IPayLight - Digital Payment & Financial Solutions')</title>

    {{-- Favicon --}}
    <link rel="icon"
          type="image/png"
          sizes="56x56"
          href="{{ asset('ipaylight/images/fav-icon/icon.png') }}">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet"
          type="text/css"
          href="{{ asset('ipaylight/css/bootstrap.min.css') }}"
          media="all">

    {{-- Main CSS --}}
    <link rel="stylesheet"
          type="text/css"
          href="{{ asset('ipaylight/css/style.min.css') }}"
          media="all">

    {{-- Responsive CSS --}}
    <link rel="stylesheet"
          type="text/css"
          href="{{ asset('ipaylight/css/responsive.css') }}"
          media="all">

    {{-- Internet Explorer Support --}}
    <!--[if lt IE 9]>
        <script src="{{ asset('ipaylight/vendor/html5shiv.js') }}"></script>
        <script src="{{ asset('ipaylight/vendor/respond.js') }}"></script>
    <![endif]-->

    @stack('styles')
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

         @include('layouts.Frontend.ipaylight.footer')

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


