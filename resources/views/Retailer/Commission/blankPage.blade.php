@extends('Retailer.layouts.dashboard')
@section('content')

        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
            <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-12 mb-5 mb-xl-12">
                <!--begin::Engage widget 1-->
                <div class="card h-md-100">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column flex-center">
                        <!--begin::Heading-->
                        <div class="mb-2">
                            <!--begin::Title-->
                            <h1 class="fw-bolder text-center lh-lg fs-1">{{$pageTitle}}</h1>
                            
                            <!--end::Title-->
                            <!--begin::Illustration-->
                            <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-300px mh-280px my-5 my-lg-12" style="background-image:url('assets/media/svg/no_data.svg')"></div>
                            <!--end::Illustration-->
                           
                        </div>
                        <!--end::Heading-->
                        <!--begin::Links-->
                        <!--end::Links-->
                        
                    </div>
                    <!--end::Body-->
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-bold">
                                <h4 class="text-gray-900 fw-bolder">Opps, Your Gateway Commission is not configure yet !!!</h4>
                                <div class="fs-6 text-gray-700">Please contact your distributor to configure your gateway commission.
                                <a href="#" class="fw-bolder" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"></path>
                                            <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"></rect>
                                            <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                Click Here For Request</a>. OR Call <a href="javascript:void(0)">{{env('APP_CONTACT')}}</a> OR you can write us <a href="javascript:void(0)">{{env('APP_SUPPORT_EMAIL')}}</a>
                            </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                </div>
                <!--end::Engage widget 1-->
                
            </div>
            <!--end::Col-->
            
        </div>
        </div>
        </div>


        <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true" style="display: none;">
									<!--begin::Modal dialog-->
									<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Modal header-->
											<div class="modal-header">
												<!--begin::Modal title-->
												<h2>Add New Card</h2>
												<!--end::Modal title-->
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
											<!--begin::Modal body-->
											<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
												<!--begin::Form-->
												<form id="kt_modal_new_card_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
													<!--begin::Input group-->
													<div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
															<span class="required">Name On Card</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a card holder's name" aria-label="Specify a card holder's name"></i>
														</label>
														<!--end::Label-->
														<input type="text" class="form-control form-control-solid" placeholder="" name="card_name" value="Max Doe">
													<div class="fv-plugins-message-container invalid-feedback"></div></div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
														<!--begin::Label-->
														<label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
														<!--end::Label-->
														<!--begin::Input wrapper-->
														<div class="position-relative">
															<!--begin::Input-->
															<input type="text" class="form-control form-control-solid" placeholder="Enter card number" name="card_number" value="4111 1111 1111 1111">
															<!--end::Input-->
															<!--begin::Card logos-->
															<div class="position-absolute translate-middle-y top-50 end-0 me-5">
																<img src="assets/media/svg/card-logos/visa.svg" alt="" class="h-25px">
																<img src="assets/media/svg/card-logos/mastercard.svg" alt="" class="h-25px">
																<img src="assets/media/svg/card-logos/american-express.svg" alt="" class="h-25px">
															</div>
															<!--end::Card logos-->
														</div>
														<!--end::Input wrapper-->
													<div class="fv-plugins-message-container invalid-feedback"></div></div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="row mb-10">
														<!--begin::Col-->
														<div class="col-md-8 fv-row">
															<!--begin::Label-->
															<label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
															<!--end::Label-->
															<!--begin::Row-->
															<div class="row fv-row fv-plugins-icon-container">
																<!--begin::Col-->
																<div class="col-6">
																	<select name="card_expiry_month" class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Month" data-select2-id="select2-data-13-nk6u" tabindex="-1" aria-hidden="true">
																		<option data-select2-id="select2-data-15-pmco"></option>
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																		<option value="6">6</option>
																		<option value="7">7</option>
																		<option value="8">8</option>
																		<option value="9">9</option>
																		<option value="10">10</option>
																		<option value="11">11</option>
																		<option value="12">12</option>
																	</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-14-6y33" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-card_expiry_month-hc-container" aria-controls="select2-card_expiry_month-hc-container"><span class="select2-selection__rendered" id="select2-card_expiry_month-hc-container" role="textbox" aria-readonly="true" title="Month"><span class="select2-selection__placeholder">Month</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																<div class="fv-plugins-message-container invalid-feedback"></div></div>
																<!--end::Col-->
																<!--begin::Col-->
																<div class="col-6">
																	<select name="card_expiry_year" class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Year" data-select2-id="select2-data-16-ebcw" tabindex="-1" aria-hidden="true">
																		<option data-select2-id="select2-data-18-h65m"></option>
																		<option value="2022">2022</option>
																		<option value="2023">2023</option>
																		<option value="2024">2024</option>
																		<option value="2025">2025</option>
																		<option value="2026">2026</option>
																		<option value="2027">2027</option>
																		<option value="2028">2028</option>
																		<option value="2029">2029</option>
																		<option value="2030">2030</option>
																		<option value="2031">2031</option>
																		<option value="2032">2032</option>
																	</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-17-w6dc" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-card_expiry_year-lx-container" aria-controls="select2-card_expiry_year-lx-container"><span class="select2-selection__rendered" id="select2-card_expiry_year-lx-container" role="textbox" aria-readonly="true" title="Year"><span class="select2-selection__placeholder">Year</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																<div class="fv-plugins-message-container invalid-feedback"></div></div>
																<!--end::Col-->
															</div>
															<!--end::Row-->
														</div>
														<!--end::Col-->
														<!--begin::Col-->
														<div class="col-md-4 fv-row fv-plugins-icon-container">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
																<span class="required">CVV</span>
																<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Enter a card CVV code" aria-label="Enter a card CVV code"></i>
															</label>
															<!--end::Label-->
															<!--begin::Input wrapper-->
															<div class="position-relative">
																<!--begin::Input-->
																<input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" placeholder="CVV" name="card_cvv">
																<!--end::Input-->
																<!--begin::CVV icon-->
																<div class="position-absolute translate-middle-y top-50 end-0 me-3">
																	<!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
																	<span class="svg-icon svg-icon-2hx">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M22 7H2V11H22V7Z" fill="currentColor"></path>
																			<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="currentColor"></path>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</div>
																<!--end::CVV icon-->
															</div>
															<!--end::Input wrapper-->
														<div class="fv-plugins-message-container invalid-feedback"></div></div>
														<!--end::Col-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="d-flex flex-stack">
														<!--begin::Label-->
														<div class="me-5">
															<label class="fs-6 fw-bold form-label">Save Card for further billing?</label>
															<div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
														</div>
														<!--end::Label-->
														<!--begin::Switch-->
														<label class="form-check form-switch form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="1" checked="checked">
															<span class="form-check-label fw-bold text-muted">Save Card</span>
														</label>
														<!--end::Switch-->
													</div>
													<!--end::Input group-->
													<!--begin::Actions-->
													<div class="text-center pt-15">
														<button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>
														<button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
															<span class="indicator-label">Submit</span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
													</div>
													<!--end::Actions-->
												<div></div></form>
												<!--end::Form-->
											</div>
											<!--end::Modal body-->
										</div>
										<!--end::Modal content-->
									</div>
									<!--end::Modal dialog-->
								</div>
<!--end::Wrapper-->
@endsection
                        