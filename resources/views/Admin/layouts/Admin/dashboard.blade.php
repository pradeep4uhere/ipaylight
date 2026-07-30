<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head>
<base href="../../">
@include('elements.metadata')
<!--end::Fonts-->
<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
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
        @include('Admin.elements.Admin.admin_aside')
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        @if(!empty($userProfile))
			@if($userProfile->role == 'retailer')
				@include('Admin.elements.Retailer.header')
			@elseif($userProfile->role == 'user')
				@include('Admin.elements.User.header')
			@elseif($userProfile->role == 'distributor')
				@include('Admin.elements.Distributor.header')
			@else
			@include('Admin.elements.Admin.header')
			@endif
		@else
			@include('Admin.elements.Admin.header')
		@endif
        
     
		
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
        <!--begin::Toolbar-->
		@if(!empty($userProfile))
			@if($userProfile->role == 'retailer')
			@include('Admin.elements.Retailer.breadcrum')
			@elseif($userProfile->role == 'user')
			@include('Admin.elements.Admin.breadcrum')
			@elseif($userProfile->role == 'distributor')
			@include('Admin.elements.Admin.breadcrum')
			@else
			@include('Admin.elements.Admin.breadcrum')
			@endif
		@else
		@include('Admin.elements.Admin.breadcrum')
		@endif

        <!--end::Toolbar-->
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
		@if (session('success'))
        @include('utils.successMessage',['message'=> session('success')])
		@endif
		@if (session('error'))
			@include('utils.errorMessage',['message'=> session('error')])
		@endif
		<div id="dashboard_content">
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
		<script src="assets/js/custom/apps/support-center/tickets/create.js"></script>
		
		<script>
            $(document).ready(function() {

			/**
			 * Functions Used when user select status of the User
			 * If Stauts  is In Active, then this function has to be enable
			 * List of all other Reason for User Why user has been updated to Inactive.
			 */
			function getInActiveReasonProfile(val){
				//alert(val);
				if(val=='inactive'){
					$("#in-active-status-list").show();
					$("#in-active-status-list1").show();
				}else{
					$("#in-active-status-list").hide();
					$("#in-active-status-list1").hide();
				}
			}

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
		
		
	</body>
	<!--end::Body-->
</html>
