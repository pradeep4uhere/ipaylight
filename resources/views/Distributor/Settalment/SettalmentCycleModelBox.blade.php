
<!--begin::Modal - Create App-->
<div class="modal fade" id="kt_modal_instant_settalment_cycle" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
                <!--end::Modal header-->
                <div class="modal-body scroll-y px-5 px-lg-15 pt-0 pb-5">
						<!--begin:Form-->
						<form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<!--begin::Title-->
								<h1 class="mb-3 fs-4">Settlement Cycle</h1>
								<!--end::Title-->
								<!--begin::Description-->
								<div class="text-muted fw-bold fs-7">Payments default settlement cycle</div>
								<!--end::Description-->
							</div>
							<!--end::Heading-->
							@if($gatewaySettalment)
							@foreach($gatewaySettalment as $item)
							<?php if($item['domestic_settlement']=='Enable'){
									$dsvgclass = "svg-icon-success";
									$dsvgBgLight = "bg-light-success";
									$dtextClass= "text-success";
									$texthoversuccess = "text-hover-success";
								  }elseif($item['domestic_settlement']=='Hold'){
									$dsvgclass = "svg-icon-warning";
									$dsvgBgLight = "bg-light-warning";
									$dtextClass= "text-warning";
									$texthoversuccess = "text-hover-warning";
								  }else{
									$dsvgclass = "svg-icon-danger";
									$dsvgBgLight = "bg-light-danger";
									$dtextClass= "text-danger";
									$texthoversuccess = "text-hover-danger";
								  }
							?>
							<div class="fs-6 fw-bolder">{{$item['gateway_name']}}</div>
							<!--begin::Input group-->
							<div class="d-flex flex-column mb-1 fv-row fv-plugins-icon-container">
								<div class="d-flex align-items-center {{$dsvgBgLight}} rounded p-5 mb-5">
								<!--begin::Icon-->
									
									<span class="svg-icon svg-icon-1 {{$dsvgclass}} me-5">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"></path>
											<path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"></path>
										</svg>
									</span>
									<!--end::Icon-->
									<!--begin::Title-->
									<div class="flex-grow-1 me-2">
										<a href="#" class="fw-bolder text-gray-800 {{$texthoversuccess}} fs-6">Domestic Payments</a>
										<span class="text-muted fw-bolder d-block fs-6">{{$item['domestic_settlement']}}&nbsp;|&nbsp;{{convertToDays($item['domestic_settlement_cycle'])}}</span>
									</div>
									<!--end::Title-->
									<!--begin::Lable-->
									<span class="fw-bolder fs-6 {{$dtextClass}} py-1">{{getSettalmentTimeFormate($item['domestic_settlement_time'])}}</span>
									<!--end::Lable-->
								</div>
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<?php if($item['international_settlement']=='Enable'){
									$svgclass = "svg-icon-success";
									$svgBgLight = "bg-light-success";
									$textClass= "text-success";
								  }else{
									$svgclass = "svg-icon-danger";
									$svgBgLight = "bg-light-danger";
									$textClass= "text-danger";
								  }
							?>
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<div class="d-flex align-items-center {{$svgBgLight}} rounded p-5 mb-7">
								   <!--begin::Icon-->
								    <span class="symbol-label bg-light-primary me-5">
										<!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
										<span class="svg-icon svg-icon-1 {{$svgclass}}">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="currentColor"></path>
												<path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="currentColor"></path>
											</svg>
										</span>
										<!--end::Svg Icon-->
									</span>
									<!--end::Icon-->
									<!--begin::Title-->
									<div class="flex-grow-1 me-2">
										<a href="#" class="fw-bolder text-gray-800 text-hover-danger fs-6">International Payments</a>
										<span class="text-muted fw-bold d-block fs-6">{{$item['international_settlement']}}&nbsp;|&nbsp;{{convertToDays($item['international_settlement_cycle'])}}</span>
									</div>
									<!--end::Title-->
									<!--begin::Lable-->
									<span class="fw-bolder fs-6 {{$textClass}} py-1">{{getSettalmentTimeFormate($item['international_settlement_time'])}}</span>
									<!--end::Lable-->
								</div>
							</div>
							<!--end::Input group-->
							@endforeach
							@endif
							<!--end::Actions-->
						<div></div></form>
						<!--end:Form-->
					</div>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create App-->