<div class="modal fade" id="kt_modal_transfer_money_{{$data['id']}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <!--begin::Modal content-->
            <div class="modal-content">
				<div class="card-header modal-header justify-content-end ribbon ribbon-start ribbon-clip">
					<div class="ribbon-label fw-bolder">
						<span class="fw-bolder fs-3 ps-3">Transfer Money</span>
						<span class="ribbon-inner bg-danger"></span>
					</div>
					 <!--begin::Close-->
					 <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
				</div>

				
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-lg-5 px-lg-5">
                    <!--begin::Stepper-->
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
                        <!--begin::Content-->
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                            <div class="fs-2 fw-bolder">
                                <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                </span>&nbsp;Beauty Kumari
                            </div>
                        
                        <div class="fs-6 fw-bold text-gray-400 mb-7"><img src="http://127.0.0.1:8000/storage/bank/icici_icon.png" height="25px" width="25px">&nbsp;ICIC Bank &nbsp;|&nbsp;<span class="text-mute fs-8">Saving Account</span></div>
						<div class="fs-6 d-flex justify-content-between mb-4">
							<div class="fw-bold">Account Number</div>
							<div class="d-flex fw-bolder">6570234234</div>
						</div>
						<div class="separator separator-dashed"></div>
						<div class="fs-6 d-flex justify-content-between my-4">
							<div class="fw-bold">IFSC Code</div>
							<div class="d-flex fw-bolder">ICIC000022</div>
						</div>
						<div class="separator separator-dashed"></div>
                 



                        






					
                            <!--begin::Form-->
                            <form class="form mt-10" novalidate="novalidate" id="kt_modal_transfer_money_form_{{$data['id']}}">
                                <!--begin::Step 1-->
                                <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Enter Amount</span>
												<i class="fas fa-exclamation-circle ms-2 fs-7" title="" data-bs-toggle="tooltip"  data-bs-placement="top"   data-bs-custom-class="tooltip-dark" data-bs-trigger="hover"  data-bs-placement="top" data-bs-original-title="Please enter the amount you want to transfer to the above account."></i>
												&nbsp;&nbsp;<span class="fs-8  text-muted">Maximum 199999/- transfer allowed</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
											<input type="number" class="form-control form-control-lg form-control-solid" name="amount" placeholder="Enter Amount" value="0.00" min="1" max="199999" oninput="validity.valid||(value='');">

                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-4">
                                                <span class="required">Transfer Type</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin:Options-->
											<div class="row">
											<!--begin::Col-->
											<div class="col-md-6 px-5">
                                                <!--begin:Option-->
                                                <label class="d-flex flex-stack mb-5 cursor-pointer">
                                                    <!--begin:Label-->
                                                    <span class="d-flex align-items-center me-2">
                                                        <!--begin:Info-->
                                                        <span class="d-flex flex-column">
                                                            <span class="fw-bolder fs-6">IMPS&nbsp;<i class="fas fa-exclamation-circle ms-2 fs-7" title="" data-bs-toggle="tooltip"  data-bs-placement="top"   data-bs-custom-class="tooltip-dark" data-bs-trigger="hover"  data-bs-placement="top" data-bs-original-title="IMPS credit immediately into benificiery account."></i></span>
                                                            <span class="fs-8 text-muted">Immediate Payment Service</span>
                                                        </span>
                                                        <!--end:Info-->
                                                    </span>
                                                    <!--end:Label-->
                                                    <!--begin:Input-->
                                                    <span class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" name="category" value="2" />
                                                    </span>
                                                    <!--end:Input-->
                                                </label>
                                                <!--end::Option-->
                                               
                                            </div>
											<div class="col-md-6">
                                      		<!--begin:Option-->
											  <label class="d-flex flex-stack mb-5 cursor-pointer">
                                                    <!--begin:Label-->
                                                    <span class="d-flex align-items-center me-2">
                                                        
                                                        <!--end:Icon-->
                                                        <!--begin:Info-->
                                                        <span class="d-flex flex-column">
                                                            <span class="fw-bolder fs-6">NEFT&nbsp;<i class="fas fa-exclamation-circle ms-2 fs-7" title="" data-bs-toggle="tooltip"  data-bs-placement="top"   data-bs-custom-class="tooltip-dark" data-bs-trigger="hover"  data-bs-placement="top" data-bs-original-title="NEFT take 2-3 hr. to credit into benificiery account."></i></span>
                                                            <span class="fs-8 text-muted">National Electronic Funds Transfer</span>
                                                        </span>
                                                        <!--end:Info-->
                                                    </span>
                                                    <!--end:Label-->
                                                    <!--begin:Input-->
                                                    <span class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" name="category" value="1" />
                                                    </span>
                                                    <!--end:Input-->
                                                </label>
                                                <!--end::Option-->
                                            <!--end:Options-->
											
											</div>
											</div>

                                        </div>
										<!--begin::Input group-->
                                        <div class="fv-row mt-5">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Enter Your TPIN</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
											<input type="number" class="form-control form-control-lg form-control-solid" name="tpin" placeholder="Enter your PIN">

                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Step 1-->
                               
                                
                                <!--begin::Actions-->
                                <div class="d-flex flex-stack pt-10">
                                  
                                    <!--begin::Wrapper-->
                                    <div>
                                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
                                            <span class="indicator-label">Submit
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon--></span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-3 ms-1 me-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></button>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Stepper-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
    </div>