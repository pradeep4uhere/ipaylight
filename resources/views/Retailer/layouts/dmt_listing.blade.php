<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head><base href="../../">
@include('elements.metadata')
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
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
        @if(getAuthValue('role')=='Distributor')
            @include('Distributor.elements.Distributor.ds_aside')
        @else
            @include('Retailer.elements.retailer_aside')
        @endif
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        @if(getAuthValue('role')=='Distributor')
        @include('Distributor.elements.Retailer.header')
        @else
        @include('Retailer.elements.header')
        @endif
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
        <!--begin::Toolbar-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl" style="min-height:630px">
            @include('Retailer.elements.breadcrum')
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/apps/ecommerce/reports/returns/returns.js"></script>

		<!--end::Page Vendors Javascript-->
        <script src="assets/js/custom/web-utils.js"></script>
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
        
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
        <script>
            $(document).ready(function() {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $(document).on('keyup', '#mobileNumber', function() {
                    var inputVal = $(this).val();
                    // Check if the input length is 10 digits
                    if (inputVal.length === 10) {
                        // Make sure it's a number
                        if (/^\d+$/.test(inputVal)) {
                            // Perform AJAX call
                            $.ajax({
                                url: "{{route('dmt.get_beneficiary_list')}}", // Replace with your server endpoint
                                type: 'POST', // or 'POST'
                                data: {
                                    mobile: inputVal,
                                    _token: csrfToken // Include the CSRF token
                                },
                                success: function(response) {
                                    // Handle the response
                                    if(response.status){
                                        $('#bodyContent').html(response.html);
                                    }else{
                                        $('#bodyContent').html(response.html);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Handle the error
                                    console.error(error);
                                }
                            });
                        } else {
                            alert('Please enter a valid 10 digit mobile number.');
                        }
                    }
                });
            });
        </script>

	</body>
	<!--end::Body-->
</html>
