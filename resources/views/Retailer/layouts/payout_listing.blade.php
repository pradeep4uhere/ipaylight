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
            var $payoutType = $('#payout_type');
            var $mobileNumber = $('#mobileNumber');
            var $errorMessage = $('#errorMessage');
            var $bodyContent = $('#bodyContent');

            function performAjaxRequest(payoutType, mobileNumber) {
                $.ajax({
                    url: "{{route('payout.get_beneficiary_list')}}",
                    type: 'POST',
                    data: {
                        payouttype: payoutType,
                        mobile: mobileNumber,
                        _token: csrfToken
                    },
                    success: function(response) {
                        // Handle the response
                        $bodyContent.html(response.html);
        
                        // Re-select the new element after it's been inserted
                        $payoutType = $('#payout_type');

                        // Re-initialize Select2 on the dynamically added select element
                        $payoutType.select2({
                            placeholder: "Choose Payout",
                            allowClear: true
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        console.error(error);
                    }
                });
            }

            function handleInputChange() {
                var payoutType = $payoutType.val();
                var mobileNumber = $mobileNumber.val();

                if (payoutType === '') {
                    $errorMessage.show().html("Please choose Payout Type First.");
                    return;
                }

                if (mobileNumber.length === 10 && /^\d+$/.test(mobileNumber)) {
                    performAjaxRequest(payoutType, mobileNumber);
                } else {
                    //alert('Please enter a valid 10 digit mobile number.');
                }
            }

            $payoutType.on('change', handleInputChange);

            // Debounce the keyup event handler to limit the number of AJAX requests
            $mobileNumber.on('keyup', debounce(handleInputChange, 300));

            // Debounce function to delay AJAX calls until typing stops
            function debounce(func, delay) {
                let debounceTimer;
                return function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => func.apply(this, arguments), delay);
                };
            }
        });
        </script>

	</body>
	<!--end::Body-->
</html>
