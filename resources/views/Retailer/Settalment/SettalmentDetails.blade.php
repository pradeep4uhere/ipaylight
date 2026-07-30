@extends('Retailer.layouts.listing')
@section('content')




            <div class="row gy-5 g-xl-10">
            <div class="col-xl-8 mb-5 mb-xl-12">
            <div class="card card-flush py-4 flex-row-fluid overflow-hidden mb-5">
            <!--begin::Background-->
            <div class="position-absolute top-0 end-0 opacity-1 pe-none text-end">
                <img src="assets/media/svg/ok.svg" class="w-175px">
            </div>
            <!--end::Background-->
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <div class="d-flex align-items-center mb-1">
                    <div class="symbol symbol-70px symbol-circle me-5">
                    <span class="symbol-label bg-light-success">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
                        <span class="svg-icon svg-icon-3x svg-icon-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M16.925 3.90078V8.00077L12.025 10.8008V5.10078L15.525 3.10078C16.125 2.80078 16.925 3.20078 16.925 3.90078ZM2.525 13.5008L6.025 15.5008L10.925 12.7008L6.025 9.90078L2.525 11.9008C1.825 12.3008 1.825 13.2008 2.525 13.5008ZM18.025 19.7008V15.6008L13.125 12.8008V18.5008L16.625 20.5008C17.225 20.8008 18.025 20.4008 18.025 19.7008Z" fill="currentColor"></path>
                                <path opacity="0.3" d="M8.52499 3.10078L12.025 5.10078V10.8008L7.125 8.00077V3.90078C7.125 3.20078 7.92499 2.80078 8.52499 3.10078ZM7.42499 20.5008L10.925 18.5008V12.8008L6.02499 15.6008V19.7008C6.02499 20.4008 6.82499 20.8008 7.42499 20.5008ZM21.525 11.9008L18.025 9.90078L13.125 12.7008L18.025 15.5008L21.525 13.5008C22.225 13.2008 22.225 12.3008 21.525 11.9008Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    </div>
                    <div class="m-0">
				    <h4 class="fw-bolder text-gray-800 mb-1 fs-1">₹ {{$details->amount}}</h4>
                    <div class="fs-5">Created on {{getFormatDate($details->created_at)}}</div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="card card-flush py-4 flex-row-fluid mb-5">
        <div class="table-responsive">
        <div class="d-flex align-items-center flex-row-fluid flex-wrap bg-lighten p-4">
            <div class="flex-grow-1 me-2">
                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Gross Settlement</a>
                <span class="text-bold fw-bold d-block fs-7 text-hover-primary">Payment
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-html="true" title="Amount collected from customers for products or services purchased or availed on your website or app" data-bs-original-title="" title=""></i>
                </span>
            </div>
           
            <span class="fw-bolder my-2 fs-4 text-success">₹ {{$details->amount}}</span>
            </div>
      

        <div class="d-flex align-items-center flex-row-fluid flex-wrap bg-lighten ps-4  px-4">
            <div class="flex-grow-1 me-2">
                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Deduction</a>
            </div>
            <span class="fw-bolder my-2 fs-6 text-danger">₹ {{$deductionAmount}}</span>
        </div>
        <div class="d-flex align-items-center flex-row-fluid flex-wrap  px-4">
            <div class="flex-grow-1 me-2 ps-4">
                <a href="#" class="text-gray-800 text-hover-danger fs-6 fw-bolder ">Tax
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-html="true" title="Good and Service Tax (GST)" data-bs-original-title="" title=""></i>
                </a>
            </div>
            <span class="fw-bolder my-2 fs-6 text-gray-800 fw-bolder text-end">₹ {{$tax}}</span>
        </div>
        <div class="d-flex align-items-center flex-row-fluid flex-wrap   px-4">
            <div class="flex-grow-1 me-2 ps-4">
                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Fee
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-html="true" title="Service Free Or Platefrom Fee" data-bs-original-title="" title=""></i>
                </a>
            </div>
            <span class="fw-bolder my-2 fs-6 text-gray-800">₹ {{$Fee}}</span>
        </div>
        <div class="separator separator-dashed my-3"></div>
        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
            <div class="flex-grow-1 me-2 ps-4">
                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Net Settalment
                </a>
            </div>
            <span class="fw-bolder my-2 fs-6 text-gray-800 px-4">₹ {{$details->net_amount}}</span>
        </div>


       
        </div>
        </div>

        <div class="card card-flush flex-row-fluid">
        <!--begin::Card header-->
        <div class="card-header   p-0">
            <div class="card-title p-0 ps-4">
                <span class="fs-3">Details</span>
            </div>
        </div>
        <div class="separator separator-dashed"></div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6  mb-0">
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <!--begin::Date-->
                            <td>Settlement ID</td>
                            <!--begin::Status-->
                            <td class="fw-bolder">{{$details->settlement_id}}</td>
                            <td>&nbsp;</td>
                            <td class="min-w-225px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Reference Number</td>
                            <td class="fw-bolder">{{$details->reference_number}}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>UTR Number</td>
                            <td class="fw-bolder">{{$details->utr_number}}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Transaction Number</td>
                            <td class="fw-bolder">{{$details->transaction_id}}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                    <!--end::Table head-->
                </table>
                <!--end::Table-->
            </div>
        </div>
                    <!--end::Card body-->
                </div>
            </div>
            <div class="col-xl-4 mb-5 mb-xl-12">
                
            <div class="card card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Timeline</h2>
                        
                    </div>
                </div>
                <div class="separator separator-dashed mb-5"></div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                <div class="timeline">
													<!--begin::Timeline item-->
													<div class="timeline-item">
														<!--begin::Timeline line-->
														<div class="timeline-line w-40px"></div>
														<!--end::Timeline line-->
														<!--begin::Timeline icon-->
														<div class="timeline-icon symbol symbol-circle symbol-40px">
															<div class="symbol-label bg-light-danger">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<span class="svg-icon svg-icon-2 svg-icon-gray-500">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ef1f52">
																		<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="#ef1f52"></path>
																		<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="#ef1f52"></path>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</div>
														</div>
														<!--end::Timeline icon-->
														<!--begin::Timeline content-->
														<div class="timeline-content mb-5 mt-n1">
															<!--begin::Timeline heading-->
															<div class="pe-3 mb-5">
																<!--begin::Title-->
																<div class="fs-5 fw-bold mb-2">Settlement Created</div>
																<!--end::Title-->
																<!--begin::Description-->
																<div class="d-flex align-items-center mt-1 fs-6">
																	<!--begin::Info-->
																	<div class="text-muted me-2 fs-7 text-gray-700">Created at {{getFormatDate($details->created_at)}}</div>
																	
																	
																</div>
																<!--end::Description-->
															</div>
															
														</div>
														<!--end::Timeline content-->
													</div>
													<!--end::Timeline item-->
													<!--begin::Timeline item-->
													<div class="timeline-item">
														<!--begin::Timeline line-->
														<div class="timeline-line w-40px"></div>
														<!--end::Timeline line-->
														<!--begin::Timeline icon-->
														<div class="timeline-icon symbol symbol-circle symbol-40px">
															<div class="symbol-label bg-light-warning">
																<!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
																<span class="svg-icon svg-icon-2 svg-icon-gray-500">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fee63c">
																		<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="#fee63c"></path>
																		<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="#fee63c"></path>
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</div>
														</div>
														<!--end::Timeline icon-->
														<!--begin::Timeline content-->
														<div class="timeline-content mb-5 mt-n1">
															<!--begin::Timeline heading-->
															<div class="pe-3">
																<!--begin::Title-->
																<div class="fs-5 fw-bold mb-2">Settlement Initiated</div>
																<!--end::Title-->
																<!--begin::Description-->
																<div class="overflow-auto pb-5">
																	<!--begin::Wrapper-->
																	<div class="d-flex align-items-center mt-1 fs-6">
																		<!--begin::Info-->
																		<div class="text-muted me-2 fs-7">Added in Queue {{getFormatDate($details->scheduled_at)}}</div>
																	</div>
																	<!--end::Wrapper-->
																</div>
																<!--end::Description-->
															</div>
															<!--end::Timeline heading-->
														</div>
														<!--end::Timeline content-->
													</div>
													<!--end::Timeline item-->
													<!--begin::Timeline item-->
													<div class="timeline-item">
														<!--begin::Timeline line-->
														<div class="timeline-line w-40px"></div>
														<!--end::Timeline line-->
														<!--begin::Timeline icon-->
														<div class="timeline-icon symbol symbol-circle symbol-40px">
															<div class="symbol-label bg-light-success">
																@if($details->is_settled==1)
																<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
																<span class="svg-icon svg-icon-2 svg-icon-gray-500">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#069346">
																		<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="#069346"></path>
																		<path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="#069346"></path>
																		<path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="#069346"></path>
																	</svg>
																</span>
																<!--end::Svg Icon-->
																@else
																<span class="symbol-label bg-light-danger">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
																	<span class="svg-icon svg-icon-1 svg-icon-danger">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"></path>
																			<path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"></path>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
																@endif
															</div>
														</div>
														<!--end::Timeline icon-->
														<!--begin::Timeline content-->
														<div class="timeline-content mb-5 mt-n1">
															<!--begin::Timeline heading-->
															<div class="pe-3 mb-5">
																<!--begin::Title-->
																<div class="fs-5 fw-bold mb-2">Settlement processed</div>
																@if($details->is_settled==1)
																<div class="d-flex align-items-center mt-1 fs-6">
																	<!--begin::Info-->
																	<div class="text-muted me-2 fs-7">Placed at {{getFormatDate($details->scheduled_at)}} by</div>
																	<!--end::Info-->
																</div>
                                                                <div class="fs-8">We have successfully processed the settlement. It may take 2-3 hours for the funds to reflect in your bank account. If the money has still not been deposited after this time, please contact your bank using the UTR number (AXISCN0590239095).</div>
																@else
																<div class="fs-8 text-danger">Waiting for settalment to be processed</div>
																@endif
																<!--end::Title-->
															</div>
															<!--end::Timeline heading-->
														</div>
														<!--end::Timeline content-->
													</div>
													<!--end::Timeline item-->
													<!--begin::Timeline item-->
													<div class="timeline-item">
														<!--begin::Timeline line-->
														<div class="timeline-line w-40px"></div>
														<!--end::Timeline line-->
														<!--begin::Timeline icon-->
														<div class="timeline-icon symbol symbol-circle symbol-40px">
															@if($details->is_settled==1)
															<div class="symbol-label bg-light-success">
																<!--begin::Svg Icon | path: icons/duotune/communication/com009.svg-->
																<span class="svg-icon svg-icon-2 svg-icon-gray-500">
                                                                <svg aria-hidden="true" data-blade-component="icon" height="12px" viewBox="0 0 24 24" width="12px" fill="none" class="Svgweb__StyledSvg-vcmjs8-0 fFewDO"><path d="M20.7071 5.29289C21.0976 5.68342 21.0976 6.31658 20.7071 6.70711L9.70711 17.7071C9.31658 18.0976 8.68342 18.0976 8.29289 17.7071L3.29289 12.7071C2.90237 12.3166 2.90237 11.6834 3.29289 11.2929C3.68342 10.9024 4.31658 10.9024 4.70711 11.2929L9 15.5858L19.2929 5.29289C19.6834 4.90237 20.3166 4.90237 20.7071 5.29289Z" clip-rule="evenodd" fill="hsla(150, 100%, 27%, 1)" fill-rule="evenodd" data-blade-component="svg-path"></path></svg>
																</span>
																<!--end::Svg Icon-->
															</div>
															@else
															<span class="symbol-label bg-light-danger">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
																	<span class="svg-icon svg-icon-1 svg-icon-danger">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="currentColor"></path>
																			<path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="currentColor"></path>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															@endif

														</div>
														<!--end::Timeline icon-->
														<!--begin::Timeline content-->
														<div class="timeline-content mb-10 mt-n2">
															<!--begin::Timeline heading-->
															<div class="overflow-auto pe-3">
																<!--begin::Title-->
																<div class="fs-5 fw-bold mb-2">Money deposited in bank account</div>
																<!--end::Title-->
																@if($details->is_settled==1)
																<!--begin::Description-->
																<div class="d-flex align-items-center mt-1 fs-6">
																<!--begin::Info-->
																<div class="text-muted me-2 fs-7">Sent at {{getFormatDate($details->scheduled_at)}} by</div>
																<!--end::Info-->
																</div>
                                                                <div class="fs-8 text-gray-700 fw-bolder">Net amount: ₹{{$details->net_amount}}</div>
                                                                <div class="fs-8 text-gray-700 fw-bolder">UTR: {{($details->utr_number!='')?$details->utr_number:"-NA-"}}</div>
																<!--end::Description-->
																@else
																<div class="fs-8 text-danger">Waiting for settalment to be processed</div>
																@endif
															</div>
															<!--end::Timeline heading-->
														</div>
														<!--end::Timeline content-->
													</div>
													<!--end::Timeline item-->
													
													
												</div>
                </div>
                <!--end::Card body-->
            </div>
            </div>
            <!--end::Col-->
        </div>
@endsection
                        