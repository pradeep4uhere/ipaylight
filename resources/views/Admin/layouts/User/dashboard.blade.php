<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head><base href="../../">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{config('global.THEME_PATH')}}/images/favicon.png" rel="icon" />
<link rel="apple-touch-icon" sizes="57x57" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="{{config('global.THEME_PATH')}}/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="{{config('global.THEME_PATH')}}/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="{{config('global.THEME_PATH')}}/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{config('global.THEME_PATH')}}/favicon/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="https://payertrust.in/public/themes/siddiventures/favicon//ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<title>{{ isset($pageTitle) ? $pageTitle : 'PayerTrust: Simple Secure and Simple' }}</title>
<meta name="description" content="PayerTrust - Safe Smart Easy Way">
<meta name="author" content="Pradeep Kumar|go4shoponline@gmail.com|www.go4shop.online">
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
        <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        @include('elements.User.user_aside')
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        @include('elements.User.header')
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
        <!--begin::Toolbar-->
        @include('elements.User.breadcrum')
        <!--end::Toolbar-->
        @yield('content')
        </div>
         <!--end::Content-->
         <!--begin::Footer-->
            @include('elements.bodyFooter')
            <!--end::Footer-->
        </div>
        
        </div>
        <!--end::Page-->
        </div>
        <!--end::Root-->
         <!--start::Model Box-->
        @include('elements.modelbox')
        <!--end::Model Box-->
        <!--end::Modal - Invite Friend-->
		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/type.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/details.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/finance.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/complete.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/main.js"></script>
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
		
	</body>
	<!--end::Body-->
</html>
