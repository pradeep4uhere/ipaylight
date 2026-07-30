<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head>
<base href="../../">
@include('elements.metadata')
<!--end::Fonts-->
<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
<script src="assets/plugins/global/plugins.bundle.js"></script>
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->
		
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
		@if(isSuperDistributor())
			@include('Distributor.elements.Distributor.superds_aside')
		@else
        	@include('Distributor.elements.Distributor.ds_aside')
		@endif
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
		
		@if(!empty($userProfile))
			@if($userProfile->role == 'retailer')
				@include('Distributor.elements.Retailer.header')
			@elseif($userProfile->role == 'user')
				@include('Distributor.elements.user.header')
			@elseif($userProfile->role == 'distributor')
				@include('Distributor.elements.Distributor.header')
			@else
			@include('Distributor.elements.Distributor.header')
			@endif
		@else
			@include('Distributor.elements.Distributor.header')
		@endif
        <!--end::Header-->
		
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
        <!--begin::Toolbar-->
		@if(!empty($userProfile))
			@if($userProfile->role == 'retailer')
			@include('Distributor.elements.Retailer.breadcrum')
			@elseif($userProfile->role == 'user')
			@include('Distributor.elements.Distributor.breadcrum')
			@elseif($userProfile->role == 'distributor')
			@include('Distributor.elements.Distributor.breadcrum')
			@else
			@include('Distributor.elements.Distributor.breadcrum')
			@endif
		@else
		@include('Distributor.elements.Distributor.breadcrum')
		@endif

        <!--end::Toolbar-->
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
		@if (session('success'))
        @include('utils.successMessage',['message'=> session('success')])
		@endif
		@if(session('error'))
			@include('utils.errorMessage',['message'=> session('error')])
		@endif
		<div id="dashboard_contents">
       		@yield('content')
		</div>
		</div>
		<!--end::Container-->
		</div>
		<!--end::Post-->
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
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
		<script>
           
        </script>
	</body>
	<!--end::Body-->
</html>
