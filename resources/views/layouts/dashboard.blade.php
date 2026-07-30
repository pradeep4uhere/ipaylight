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
		@if(getAuthValue('role')=='Retailer')
			@include('Retailer.elements.retailer_aside')
		@elseif(getAuthValue('role')=='Admin')
			@include('Admin.elements.Admin.admin_aside')
		@elseif(getAuthValue('role')=='Distributor')
			@include('Distributor.elements.Distributor.ds_aside')
		@else
			@include('elements.User.user_aside')
		@endif
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        @include('elements.User.header')
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
        <!--begin::Toolbar-->
		@if(getAuthValue('role') == 'Retailer')
		@include('Admin.elements.Retailer.breadcrum')
		@elseif(getAuthValue('role') == 'Admin')
		@include('Admin.elements.Admin.breadcrum')
		@elseif(getAuthValue('role') == 'Distributor')
		@include('Admin.elements.Admin.breadcrum')
		@else
			@include('elements.breadcrum')
		@endif
		<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
		@if (session('success'))
        @include('utils.successMessage',['message'=> session('success')])
		@endif
		@if (session('error'))
			@include('utils.errorMessage',['message'=> session('error')])
		@endif
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
		
         <!--start::Model Box-->
        @include('elements.modelbox')
        <!--end::Model Box-->
        <!--end::Modal - Invite Friend-->
		<!--end::Modals-->
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

		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/apps/customers/list/export.js"></script>
		<script src="assets/js/custom/apps/customers/list/list.js"></script>
		<script src="assets/js/custom/apps/customers/add.js"></script>
		<script src="assets/js/custom/web-utils.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->

		<script>
		  document.addEventListener('DOMContentLoaded', function () {
					$(".editLink").on('click', function(){
						var enStr = $(this).attr("data-edit-target");
						//alert(enStr);
					});

					$('.copyBtn').on('click',function(){
						var copyButton = $(this).attr("data-clipboard-target");
						var copyButtonId = $(this).attr("id"); 
						//alert(copyButtonId);
						//alert(copyButton);
						var inputField = document.getElementById(copyButton);
						//alert(inputField);
						inputField.select();
						$('#'+copyButton).addClass("bg-success");
						$('#'+copyButton).addClass("text-inverse-success");
						document.execCommand('copy');
						$("#"+copyButtonId).html('Copied!');
						setTimeout(function () {
							$("#"+copyButtonId).html('Copy Link!');
							$('#'+copyButton).removeClass("bg-success");
							$('#'+copyButton).removeClass("text-inverse-success");
						}, 2000); // Reset button text after 2 seconds
					});
		});
	</script>
	
		
	</body>
	<!--end::Body-->
</html>
