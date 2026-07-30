
<!--begin::Modal - Create App-->
<div class="modal fade" id="kt_modal_instant_settal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-420px">
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
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
						<!--begin:Form-->
						<form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<!--begin::Title-->
								<h1 class="mb-3 fs-4">Instant Settalment</h1>
								<!--end::Title-->
								<!--begin::Description-->
								<div class="text-muted fw-bold fs-7">You can settal full or partial amount of ₹ {{$totalAmount}}
								<a href="#" class="fw-bolder link-primary">Read Settalment Guidelines</a>.</div>
								<!--end::Description-->
							</div>
							<!--end::Heading-->
							<!--begin::Input group-->
							<div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Amount Will Settal</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-placement="top"  title="This is the total amount that is  deposited in your bank account after deduction of platform fees and Taxes" ></i>

								</label>
								<!--end::Label-->
								<input type="number" class="form-control form-control-solid" placeholder="e.g 10000" name="settal_amount" value="{{getInstantSettalmentAmount($totalAmount)}}" max="{{getInstantSettalmentAmount($totalAmount)}}" oninput="checkMaxValue(this)">
							<div class="fv-plugins-message-container invalid-feedback"></div></div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<button type="submit" id="kt_modal_new_target_submit" class="btn btn-success">
									<span class="indicator-label">Settal Amount</span>
								</button>
							</div>
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