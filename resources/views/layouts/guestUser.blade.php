<!DOCTYPE html>
<html lang="en">
@props(['title'])
	<!--begin::Head-->
	<head><base href="../../">
	@include('elements.metadata')
	<!--begin::Fonts-->
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendor Stylesheets(used by this page)-->
	<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<!--end::Page Vendor Stylesheets-->
	@include('elements.google_analytics')
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
		@include('elements.Guest.faq_aside')
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        @include('elements.Guest.header')
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
       
		<div class="post" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container">
		
        <!--end::Toolbar-->
        @yield('content')
		</div>
		</div>
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
		
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";
		var baseUrl = "{{__(env('APP_URL'))}}/";
		var apiUrl = "{{__(env('APP_URL'))}}/v1/api/";
		</script>

		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>

		<script src="assets/js/custom/web-utils.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
	</body>
	<!--end::Body-->
</html>
