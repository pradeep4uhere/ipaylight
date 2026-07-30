<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head><base href="../../">
@include('elements.metadata')
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
        @if(isSuperDistributor())
			@include('Distributor.elements.Distributor.superds_aside')
		@else
        	@include('Distributor.elements.Distributor.superds_aside')
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
        @include('Distributor.elements.Distributor.breadcrum')
        <div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
        <!--end::Toolbar-->
        <div id="dashboard_contents">
        @yield('content')
        </div>
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
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/apps/customers/list/export.js"></script>
		<script src="assets/js/custom/apps/customers/list/list.js"></script>
		<script src="assets/js/custom/apps/customers/add.js"></script>
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
        <script src="assets/js/custom/apps/ecommerce/sales/listing.js"></script>
        <script src="assets/js/custom/web-utils.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
        <script>
            $(document).ready(function() {
            $(document).on('click', '.kt_drawer_example_basic_button', function() {
                //alert('dasd');
                var idStr = $(this).attr('id');
                var urlText = $(this).attr('data-url');
                var enltid = $(this).attr('data-tid');  // It will return me the data
                KTDrawer.createInstances();
                var drawerElement = document.querySelector("#kt_drawer_example_basic");
                var drawer = KTDrawer.getInstance(drawerElement);
                drawer.show();
                // Example usage:
                const apiUrl = urlText;
                // Make a POST request with data
                const requestData = { ltid: enltid };
                makeAjaxRequest(apiUrl, 'POST', requestData)
                    .then(responseData => {
                        // Handle successful response
                        console.log('Response:', responseData);
                        $("#kt_drawer_example_basic").html(responseData);
                    })
                    .catch(error => {
                        // Handle error
                        console.error('Error:', error);
                    });
             });
        });

        function makeAjaxRequest(url, method, data) {
                return new Promise((resolve, reject) => {
                    fetch(url, {
                        method: method,
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        // Check if response is successful
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.indexOf('text/html') !== -1) {
                                return response.text(); // Parse response body as text
                        }
                        return response.json(); // Parse response body as JSON
                    })
                    .then(data => {
                        // Resolve promise with response data
                        resolve(data);
                    })
                    .catch(error => {
                        // Reject promise with error
                        reject(error);
                    });
                });
        }
        </script>
         <script>
            var start = moment().subtract(29, "days");
            var end = moment();
            function cb(start, end) {
                $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            }

            $("#kt_daterangepicker_4").daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, cb);
            cb(start, end);
            </script>

            <script>
            function checkMaxValue(input) {
                var maxValue = parseFloat(input.getAttribute('max')); // Get the maximum value dynamically
                if (parseFloat(input.value) > maxValue) {
                    input.value = maxValue.toFixed(2); // Set the input value to the maximum value with two decimal places
                }
            }
            </script>

	</body>
	<!--end::Body-->
</html>
