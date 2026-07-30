@extends('layouts.default')
@section('content')
<div id="kt_content_container" class="container-xxl">
<div class="d-flex flex-column flex-root">
<div class="card">
	<div class="card-body p-lg-20">
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <a href="{{env('APP_URL')}}" class="">
                <img alt="Logo" src="{{asset('assets/media/not_done.gif')}}" class="h-100px"  />
            </a>
            <div class="fw-bolder fs-2 text-danger">Your Payment Was Not Successfull</div>
            <div class="fw-bold fs-7 text-gray-600">Thank you for your payment, We will be in contact with more details shortly.</div>
            <small class="fs-8 text-danger">{{$resultData['error_description']}}</small>
        </div>
        <div class="separator separator-dashed mb-10 mt-5"></div>
        <!--end::Content-->
        <div class="d-flex flex-column flex-xl-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                <!--begin::Invoice 2 content-->
                <div class="mt-n1">
                <div class="d-flex flex-stack pb-10">
                 <a href="{{env('APP_URL')}}" class="">
                    <img alt="Logo" src="logo.svg" class="h-50px" />
                 </a>
                 <div class="fw-bolder fs-3 text-gray-800 mb-8">Payment Date: {{$resultData['paymentDate']}}
                </div>
                </div>
               
                   
                    <!--end::Top-->
                    <!--begin::Wrapper-->
                    <div class="m-0">
                        <div class="row g-5 mb-12">
                            <!--end::Col-->
                            <div class="col-sm-6">
                                <!--end::Label-->
                                <div class="fw-bolder fs-5 text-gray-600 mb-1">Payment From:</div>
                                <!--end::Label-->
                                <!--end::Text-->
                                <div class="fw-bolder fs-6 text-gray-800">{{$resultData['customer_name']}}</div>
                                <!--end::Text-->
                                <!--end::Description-->
                                <div class="fw-bold fs-7 text-gray-600">Mobile: +91-{{$resultData['customer_mobile']}}
                                <br>Email: {{$resultData['customer_email']}}</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Col-->
                            <!--end::Col-->
                            <div class="col-sm-6">
                                <!--end::Label-->
                                <div class="fw-bolder fs-5 text-gray-600 mb-1">Payment For:</div>
                                <!--end::Label-->
                                <!--end::Text-->
                                <div class="fw-bolder fs-6 text-gray-800">{{$resultData['company_name']}}</div>
                                <!--end::Text-->
                                <!--end::Description-->
                                <div class="fw-bold fs-7 text-gray-600">E:{{env('APP_SUPPORT_EMAIL')}}, M:{{$resultData['company_contact']}}
                                <br>{{$resultData['company_address']}}</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Content-->
                        <div class="flex-grow-1">
                        <div class="row g-5 mb-12">
                            <!--end::Col-->
                            <div class="col-sm-6">
                            <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0">
                                    <!--begin::Row-->
                                    <tbody>
                                    <tr>
                                        <td class="text-gray-600 min-w-175px w-175px">Amount:</td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-600">Payment Status:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Transaction Number:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Payment Referance:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Payment Type:</td>
                                    </tr>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Order Number:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Description:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Payment Method:</td>
                                    </tr>
                                    <!--end::Row-->
                                </tbody></table>
                                
                            </div>
                             <!--end::Col-->
                             <div class="col-sm-6">
                                 <!--begin::Details-->
                                  <!--begin::Details-->
                                  <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0">
                                    <!--begin::Row-->
                                    <tbody>
                                    <tr>
                                        <td class="text-gray-800 min-w-200px">
                                        <span class="fs-1 badge badge-light-danger">Rs. {{$resultData['amount']}}/-</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="">
                                        <span class="fs-4 badge badge-light-danger">{{ucwords(strtolower(str_replace('_', ' ', $resultData['payment_status'])))}}</span>
                                        
                                    </td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800">{{$resultData['transaction_number']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800">{{$resultData['payment_reference']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800">{{$resultData['paymentType']}}</td>
                                    </tr>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800">{{$resultData['order_id']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800">{{$resultData['description']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800">{{ucwords(strtolower(str_replace('_', ' ', $resultData['payment_method'])))}}</td>
                                    </tr>
                                    <!--end::Row-->
                                </tbody></table>
                                <!--end::Details-->
                                <!--end::Details-->
                            </div>
                            </div>
                            <!--end::Table-->
                            <!--begin::Container-->
                            <div class="row g-5 mb-12">
                            <!--end::Col-->
                            <div class="col-sm-8">
                            <div class="justify-content-start">
                            <span class="text-gray-800 fs-5">Amount In Words:</span>&nbsp;{{ucfirst(AmountToWords($resultData['amount']))}}</div>
                            </div>
                            <div class="col-sm-4">
                            <div class="d-flex justify-content-end">
                                <!--begin::Section-->
                               
                                <div class="mw-300px">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-3">
                                        <!--begin::Accountname-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-7">Subtotal:</div>
                                        <!--end::Accountname-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-bolder fs-4 text-gray-800">Rs. {{$resultData['amount']}}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-3">
                                        <!--begin::Accountname-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-7">GST 0%</div>
                                        <!--end::Accountname-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-bolder fs-6 text-gray-800">{{$resultData['gst']}}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-3">
                                        <!--begin::Accountnumber-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-7">Convenience Fee</div>
                                        <!--end::Accountnumber-->
                                        <!--begin::Number-->
                                        <div class="text-end fw-bolder fs-6 text-gray-800">Rs. {{$resultData['convenience_fee']}}</div>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Code-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-7">Total Amount</div>
                                        <!--end::Code-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-bolder fs-6 text-gray-800">Rs. {{$resultData['totalAmount']}}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Section-->
                            </div>
                            </div>
                            </div>

                            
                            <!--end::Container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Invoice 2 content-->
            </div>
            <!--end::Content-->
            <!--begin::Sidebar-->
            <div class="m-0">
                <!--begin::Invoice 2 sidebar-->
                <div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                   <!--begin::Section-->
												
												<!--end::Seperator-->
												<!--begin::Section-->
												<div class="mb-7">
                                                <div class="my-1 mb-5">
													<!-- begin::Pint-->
													<button type="button" class="btn btn-primary my-1 me-1" onclick="window.print();">Print Recipts</button>
													<!-- end::Pint-->
                                                    <button type="button" class="btn btn-primary my-1 me-1" onclick="window.print();">Share Recipts</button>
													
												</div>
                                                <div class="separator separator-dashed mb-7"></div>
													<!--begin::Title-->
													<h5 class="mb-4 fs-2">Payment Related Query</h5>
													<!--end::Title-->
													<!--begin::Details-->
													<div class="mb-0">
                                                        <div class="fs-7">
                                                        If you have any questions or concerns <br/>
                                                        regarding this payment, please don't<br/> hesitate to reach out to us. <br/>
                                                        We are here to assist you and will <br/>get back to you as soon as possible
                                                        </div>
														
														<!--end::Price-->
													</div>
													<!--end::Details-->
												</div>
												<!--end::Section-->
                                                <a href="#" class="btn btn-sm btn-danger mb-5 fs-4">Contact Us</a></br>
                                                <div class="fs-7">You can write email on {{env('APP_SUPPORT_EMAIL')}}</div>
												<!--begin::Seperator-->
												<div class="separator separator-dashed mb-7"></div>
												<!--end::Seperator-->
												<!--begin::Section-->
												
												
												<!--end::Section-->
												<!--begin::Actions-->
												
												<!--end::Actions-->
                </div>
                <!--end::Invoice 2 sidebar-->
            </div>
            <!--end::Sidebar-->
        </div>
    </div>
    <div class="separator separator-dashed mb-10 mt-5"></div>
    <div class="text-mute fs-8 mt-10">
    {{env('APP_NAME')}} is an intermediary payment service provider and is nowhere responsible for any product or service. We facilitate payment collection to merchants whose correspondence has been mentioned above. Please write to us on {{env('APP_SUPPORT_EMAIL')}} in case of any issues or doubts. Our terms of use is mentioned here - <a href="{{env('APP_URL')}}/termsandconditions">{{env('APP_URL')}}/termsandconditions</a>
    </div>
    <div class="text-center mt-5 fs-8">
    {{env('APP_NAME')}}. All Rights Reserved</br/>

This is system generated receipt.Hence no seals or signature is required.
    </div>
</div>
</div>
</div>
</div>

  
@endsection
                        