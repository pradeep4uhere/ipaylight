<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head>
<base href="../../">
@include('elements.metadata')
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
        <!--Show Message Start Here-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
        </div>
            </div>
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
		<!-- Include Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <!-- Initialize Quill editor -->
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow'
            });

            var form = document.getElementById('faq-form');
            form.onsubmit = function() {
                var content = document.querySelector('input[name=content]');
                content.value = quill.root.innerHTML;
            };
        </script>
		<script>
            $(document).ready(function() {

            var Delta = Quill.import('delta');
            var quill = new Quill('#kt_docs_quill_autosave', {
                modules: {
                    toolbar: true
                },
                placeholder: 'Type your text here...',
                theme: 'snow'
            });

            // Store accumulated changes
            var change = new Delta();
            quill.on('text-change', function (delta) {
                change = change.compose(delta);
            });

            // Save periodically
            setInterval(function () {
                if (change.length() > 0) {
                    console.log('Saving changes', change);
                    /*
                    Send partial changes
                    $.post('/your-endpoint', {
                    partial: JSON.stringify(change)
                    });

                    Send entire document
                    $.post('/your-endpoint', {
                    doc: JSON.stringify(quill.getContents())
                    });
                    */
                    change = new Delta();
                }
            }, 5 * 1000);

            // Check for unsaved data
            window.onbeforeunload = function () {
                if (change.length() > 0) {
                    return 'There are unsaved changes. Are you sure you want to leave?';
                }
            }

        });
        </script>
        <script>
            function getSubcategory() {
            var idStr = document.getElementById('pg_category_list').value;
            var urlText = "{{ route('faqs.getsubcategory') }}";
            const apiUrl = urlText;

            // Check if idStr is set
            if (!idStr) {
                console.error('No category selected');
                return;
            }

            console.log('Selected category ID:', idStr); // Debug

            // Make a POST request with data
            const requestData = { cat_id: idStr };

            makeAjaxRequest(apiUrl, 'POST', requestData)
                .then(responseData => {
                    // Handle successful response
                    console.log('Response:', responseData);
                    document.getElementById("pg_sub_category_list").innerHTML = responseData;
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                });
        }

        // Function to make AJAX requests
        function makeAjaxRequest(url, method, data) {
            return $.ajax({
                url: url,
                type: method,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('AJAX success:', response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        }
        </script>
	</body>
	<!--end::Body-->
</html>
