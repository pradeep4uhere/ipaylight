@extends('Retailer.layouts.dashboard')
@section('content')
<div class="card mb-10">
	<div class="card-body p-lg-10">
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
        <!--begin::Content-->
       
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
                 
                </div>
               
                   
                    <!--end::Top-->
                    <!--begin::Wrapper-->
                    <div class="m-0">
                        <div class="row g-5 mb-12">
                            <!--end::Col-->
                            <div class="col-sm-6">
                                <!--end::Label-->
                                <div class="fw-bolder fs-5 text-gray-600 mb-1">Customer Details:</div>
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
                                <div class="fw-bolder fs-7 text-gray-600 mb-1">Payment Date:</div>
                                <!--end::Label-->
                                <!--end::Text-->
                                <div class="fw-bolder fs-7 text-gray-800">
                                {{$resultData['paymentDate']}}
                                </div>
                                <div class="fw-bolder fs-7 text-gray-600 mb-1">Gateway Name:</div>
                                <!--end::Label-->
                                <!--end::Text-->
                                <div class="fw-bolder fs-7 text-gray-800">
                                {{$resultData['gateway_name']}}
                                </div>
                                

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
                                        <td class="text-gray-600 min-w-175px w-175px">Payment Status:</td>
                                    </tr>
                                  
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600 fs-7">Transaction Number:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600 fs-7">Payment Referance:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600 fs-7">Payment Type:</td>
                                    </tr>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600 fs-7">Order Number:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600 fs-7">Description:</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600 fs-7">Payment Method:</td>
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
                                        @if($resultData['payment_status']=='Success')
                                        <span class="fs-4 fw-bolder badge badge-light-success">Rs. {{$resultData['amount']}}/-</span>
                                        @else
                                        <span class="fs-4 fw-bolder badge badge-light-danger">Rs. {{$resultData['amount']}}/-</span>
                                        @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-gray-800 min-w-200px">
                                        @if($resultData['payment_status']=='Success')
                                        <span class="fs-4 badge badge-light-success">{{$resultData['payment_status']}}</span>
                                        @else
                                        <span class="fs-4 badge badge-light-danger">{{$resultData['payment_status']}}</span>
                                        @endif
                                        </td>
                                    </tr>
                                    
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800 fs-7">{{$resultData['transaction_number']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800 fs-7">{{$resultData['payment_reference']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800 fs-7">{{$resultData['paymentType']}}</td>
                                    </tr>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800 fs-7">{{$resultData['order_id']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800 fs-7">{{$resultData['description']}}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-800 fs-7">{{$resultData['payment_method']}}</td>
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
                           
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                            <div class="d-flex justify-content-end">
                                <!--begin::Section-->
                               
                                <div class="mw-300px">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-3">
                                        <!--begin::Accountname-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-5">Subtotal:</div>
                                        <!--end::Accountname-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-bolder fs-5 text-gray-800">₹ {{$resultData['deposite_amount']}}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-3">
                                        <!--begin::Accountname-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-7">GST 0%</div>
                                        <!--end::Accountname-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-bolder fs-6 text-gray-800">₹ {{$resultData['deductionAmount']}}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-3">
                                        <!--begin::Accountnumber-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-7">Convenience Fee</div>
                                        <!--end::Accountnumber-->
                                        <!--begin::Number-->
                                        <div class="text-end fw-bolder fs-6 text-gray-800">₹ {{$resultData['tax']}}</div>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Code-->
                                        <div class="fw-bold pe-10 text-gray-600 fs-5">Total Amount</div>
                                        <!--end::Code-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-bolder fs-5 text-gray-800">₹ {{$resultData['totalAmount']}}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Section-->
                            </div>
                           
                            </div>
                            <div class="col-sm-12">
                            <div class="justify-content-start">
                            <span class="text-gray-800 fs-6">Amount In Words:</span>&nbsp;<span class="text-gray-800 fs-6 fw-bolder">{{ucfirst(AmountToWords($resultData['amount']))}}</span></div>
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
                        <div class="mb-7">
                        <div class="my-1 mb-10">
                            <!-- begin::Pint-->
                            <button type="button" class="btn btn-primary my-1 me-1" onclick="window.print();">Print Recipts</button>
                            <!-- end::Pint-->
                            <button type="button" class="btn btn-primary my-1 me-1" onclick="window.print();">Share Recipts</button>
                            <button type="button" class="btn btn-danger my-1 me-1" onclick="window.print();">Raise Dispute</button>
                        </div>
                            <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0">
                                    <!--begin::Row-->
                                    <tbody>
                                    <tr>
                                        <td class="text-gray-600 min-w-170px w-170px">Customer:</td>
                                        <td class="text-gray-600 fs-7">
                                            {{$resultData['customer_name']}}</br>
                                            Mobile: +91-{{$resultData['customer_mobile']}}</br>
                                            Email: {{$resultData['customer_email']}}
                                        </td>

                                    </tr>
                                     
                                    <tr>
                                        <td class="text-gray-600">Rate:</td>
                                        <td class="text-gray-800 min-w-200px">
                                        <span class="fs-6">{{$resultData['rate_fee']}}%</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-gray-600 min-w-175px w-175px">Settalment Amount:</td>
                                        <td class="text-gray-800 min-w-200px">
                                        <span class="fs-6 fw-bolder">Rs.{{$resultData['deposite_amount']}}</span><br/>
                                        <span class="fs-8">Tax: {{$resultData['deductionAmount']}}</span><br/>
                                        <span class="fs-8">Gst: {{$resultData['tax']}}</span><br/>
                                        <span class="fs-8">Convenience Fee : {{$resultData['convenience_fee']}}</span>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td class="text-gray-600">Payment Type:</td>
                                        <td class="text-gray-800 fs-7">{{$resultData['paymentType']}}</br>
                                        <span class="text-gray-600 fs-9">Amount Rs.{{$resultData['deposite_amount']}} will settal at {{$resultData['settalmentDate']}}</span>
                                        </td>

                                    </tr>
                                    <!--end::Row-->
                                   
                                    <tr>
                                        <td class="text-gray-600">Card Details:</td>
                                        <td class="text-gray-800">
                                            <span class="fs-7">Name On Card: {{$resultData['card']['nameOnCard']}}</span></br>
                                            <span class="fs-7">Last 4 Digit: {{$resultData['card']['last4digitCard']}}</span></br>
                                            <span class="fs-7">Bank Type: {{$resultData['card']['cardBankType']}}</span></br>
                                            <span class="fs-7">Card Type: {{$resultData['card']['cardType']}}</span></br>
                                            <span class="fs-7">International: {{$resultData['card']['cardInternational']}}</span></br>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-gray-600">Location:</td>
                                        <td class="text-gray-800">
                                            <table class="fs-8" style="padding:0px">
                                            <tr><td class="text-gray-600 min-w-100px p-0"><span class="fs-8">IP Address: </td></span><td class="text-gray-600 p-0">{{$resultData['location']['ip']}}</span></td>
                                            <tr><td class="text-gray-600 p-0"><span class="fs-8">City Name: </td></span><td class="text-gray-600 p-0">{{$resultData['location']['cityName']}}</span></td></tr>
                                            <tr><td class="text-gray-600 p-0"><span class="fs-8">RegionName: </td></span><td class="text-gray-600 p-0">{{$resultData['location']['regionName']}}</span></td></tr>
                                            <tr><td class="text-gray-600 p-0"><span class="fs-8">Country: </td></span><td class="text-gray-600 p-0">{{$resultData['location']['countryName']}}</span></td></tr>
                                            <tr><td class="text-gray-600 p-0"><span class="fs-8">Zipcode: </td></span><td class="text-gray-600 p-0">{{$resultData['location']['zipCode']}}</span></td></tr>
                                            <tr><td class="text-gray-600 p-0"><span class="fs-8">Lat/Lng: </td></span><td class="text-gray-600 p-0">{{$resultData['location']['latitude']}},&nbsp;{{$resultData['location']['longitude']}}</span></td></tr>  
                                         </table> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-600">Device Information:</td>
                                        <td class="text-gray-800">
                                            <table class="fs-8" style="padding:0px">
                                            <tr>
                                                <td class="text-gray-600 min-w-100px p-0 fs-8">Customer Browser: </td>
                                                <td class="p-0 text-gray-600">&nbsp;{{$resultData['user_browser']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-600 p-0 fs-8">Used Device: </td>
                                                <td class="text-gray-600 p-0">{{$resultData['user_device']}}</td>
                                            </tr>
                                         </table> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                                
                                                
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
      
@endsection
                        