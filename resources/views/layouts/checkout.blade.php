<!DOCTYPE html>
<!--
Author: Pradeep Kumar 
Website: http://www.pradeeptechnical.com
Contact: pradeep@pradeeptechnical.com
-->
<html lang="en">
	<!--begin::Head-->
	<head>
		<base href="../../../">
		<title>Paygenius - Express Checkout</title>
		@include('elements.metadata')
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--end::Global Stylesheets Bundle-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<!--end::Global Stylesheets Bundle-->
		<style>
			body{
				font-family: 'system-ui';
			}
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body">
	   @if (session('success'))
        @include('utils.successMessage',['message'=> session('success')])
		@endif
		@if(session('error'))
			@include('utils.errorMessage',['message'=> session('error')])
		@endif
		<!--begin::Main-->
		<!--begin::Root-->
        @yield('content')
       <!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/js/custom/authentication/sign-in/general.js"></script>
	</body>
	<!--end::Body-->
</html>