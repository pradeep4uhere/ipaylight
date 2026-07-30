<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head>
<base href="../../">
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
        @include('Retailer.elements.breadcrum')
		<div class="post d-flex flex-column-fluid" id="kt_post">
		
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			
		@if (session('success'))
        @include('utils.successMessage',['message'=> session('success')])
		@endif
		@if(session('error'))
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

		<script src="assets/js/custom/account/referrals/referral-program.js"></script>
		<script src="assets/js/custom/apps/projects/settings/settings.js"></script>
		<script src="assets/js/custom/apps/customers/list/list.js"></script>
		<script src="assets/js/custom/apps/customers/add.js"></script>
		<script src="assets/js/custom/web-utils.js"></script>
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
	<script>
		function captureSection() {
			const section = document.getElementById('capture-section');
			html2canvas(section).then(canvas => {
				canvas.toBlob(blob => {
					const formData = new FormData();
					formData.append('screenshot', blob, 'section-screenshot.png');
					var url = "{{ route('payout.screenshot') }}";
					fetch(url, {
						method: 'POST',
						body: formData,
						headers: {
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						}
					})
					.then(response => response.json())
					.then(data => {
						if (data.status === 'success') {
							const url = URL.createObjectURL(blob);
							//const a = document.createElement('a');
							//a.href = url;
							//a.download = 'section-screenshot.png';
							//a.click();
							URL.revokeObjectURL(url); // Clean up after download
							var imageUrl = data.imagepath;
							shareOnWhatsApp(imageUrl);
						} else {
							console.error('Error saving screenshot:', data);
						}
					})
					.catch(error => console.error('Upload failed:', error));
				});
			});
		}

		function shareOnWhatsApp(imageUrl) {
			const message = `Check out this: ${imageUrl}`;
			const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
			window.open(whatsappUrl, '_blank');
		}


    </script>
	<script>
        function captureAndDownloadSection() {
            const section = document.getElementById('capture-section');
            html2canvas(section).then(canvas => {
                canvas.toBlob(blob => {
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'paymentstatus-screenshot.png';
                    a.click();
                    URL.revokeObjectURL(url); // Clean up after download
                });
            });
        }
    </script>

	<script>
		$(document).ready(function() {
    $('#capture-button').on('click', function() {
        captureSectionAndConvertToPDF();
    });

    function captureSectionAndConvertToPDF() {
        const section = document.getElementById('capture-section');
        html2canvas(section).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            // Add the screenshot to the PDF
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);

            // Save the PDF
            pdf.save('section-screenshot.pdf');
        }).catch(function(error) {
            console.error('Error capturing section:', error);
        });
    }
});
	</script>
	</body>
	<!--end::Body-->
</html>
