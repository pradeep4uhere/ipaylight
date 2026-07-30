@if(!empty($resultData))
<div class="card w-100 rounded-0 border-0" >
            <!--begin::Card header-->
            <div class="card-header pe-5"   >
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Transaction Details</a>
                        <!--begin::Info-->
                        <div class="mb-0 lh-1">
                            <span class="fs-7">Payment Status - </span>
                            @if($resultData['status']=='Success')
                            <span class="fs-7 badge badge-light-success">
                            @else
                            <span class="fs-7 badge badge-light-danger">
                            @endif
                            <span class="fs-7 fw-bold">{{$resultData['status']}}</span>
                            </span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                   
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body" id="kt_drawer_chat_messenger_body">
                <!--begin::Messages-->
                <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px" style="height:720px;">
                    <!--begin::Message(in)-->
                    <div class="d-flex justify-content-start mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column align-items-start">
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-2">
                                
                           
                            <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0">
                                    <!--begin::Row-->
                                    <tbody>
                                    <tr>
                                        <td class="text-gray-600 min-w-175px w-175px">Customer:</td>
                                        <td class="text-gray-600 fs-7">
                                            {{$resultData['customer_name']}}</br>
                                            Mobile: +91-{{$resultData['customer_mobile']}}</br>
                                            Email: {{$resultData['customer_email']}}
                                        </td>

                                    </tr>
                                     <tr>
                                        <td class="text-gray-600 min-w-175px w-175px">Amount:</td>
                                        <td class="text-gray-800 min-w-200px">
                                        @if($resultData['status']=='Success')
                                        <span class="fs-6 badge badge-light-success">
                                        @else
                                        <span class="fs-6 badge badge-light-danger">
                                        @endif
                                        <span class="fw-bolder fs-5">
                                        Rs. {{$resultData['amount']}}/-</span>
                                        </span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="text-gray-600 min-w-175px w-175px">Rate:</td>
                                        <td class="text-gray-800 min-w-200px">
                                        <span class="fs-6">{{$resultData['rate_fee']}}%</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-gray-600 min-w-175px w-175px">Settalment Amount:</td>
                                        <td class="text-gray-800 min-w-200px">
                                        <span class="fs-6 fw-bolder">Rs.{{$resultData['deposite_amount']}}</span><br/>
                                        <span class="fs-8">Tax: {{$resultData['tax_amount']}}</span><br/>
                                        <span class="fs-8">Gst: {{$resultData['gst_amount']}}</span><br/>
                                        <span class="fs-8">Convenience Fee : {{$resultData['convenience_fee']}}
                                        </td>
                                    </tr>
                                  
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Transaction Number:</td>
                                        <td class="text-gray-800 fs-7">{{$resultData['transaction_number']}}</td>

                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Payment Referance:</td>
                                        <td class="text-gray-800 fs-7">{{$resultData['payment_reference']}}</td>

                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Payment Type:</td>
                                        <td class="text-gray-800 fs-7">{{$resultData['paymentType']}}</br>
                                        <span class="text-gray-600 fs-9">Amount Rs.{{$resultData['deposite_amount']}} will settal at {{$resultData['settalmentDate']}}</span>
                                        </td>

                                    </tr>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Order Number:</td>
                                        <td class="text-gray-800 fs-7">{{$resultData['order_id']}}</td>

                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Description:</td>
                                        <td class="text-gray-600 fs-7">{{$resultData['description']}}</td>

                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-600">Payment Method:</td>
                                        <td class="text-gray-800">{{$resultData['payment_method']}}</td>
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
                            <!--end::User-->
                            <div class="separator separator-dashed mb-7"></div>
                        </div>
                        <!--end::Wrapper-->
                        
                    </div>
                    <!--end::Message(in)-->
              
                </div>
                <!--end::Messages-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
                <!--begin::Input-->
                <div class="fs-8">If you have have any query about this transaction, Please raise the ticket to our support system. <a href="#">Click Here Raise Ticket </a></div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card footer-->
        </div>
@else
<div class="card w-100 rounded-0 border-0" >
            <!--begin::Card header-->
            <div class="card-header pe-5"   >
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Transaction Details</a>
                        <!--begin::Info-->
                        <div class="mb-0 lh-1">
                            
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                   
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body" id="kt_drawer_chat_messenger_body">
                <div class="text-center alert alert-danger">No Details Found</div>
            </div>
</div>
<!--end::User-->
@endif
