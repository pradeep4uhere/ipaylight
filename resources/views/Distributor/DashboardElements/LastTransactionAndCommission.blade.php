<!--begin::Col-->
<div class="row g-5 g-xl-10 mb-10">
<div class="col-xl-6">
    <div class="card card-flush border-0 h-xl-100">
        <!--begin::Body-->
        <div class="card-body py-9">
            <!--begin::Row-->
            <div class="row gx-9 h-100">
                <!--begin::Col-->
                <div class="col-sm-5 mb-10 mb-sm-0">
                    <!--begin::Overlay-->
                    <a class="d-block overlay h-100" data-fslightbox="lightbox-hot-sales" href="">
                        <!--begin::Image-->
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-100px h-100" style="background-image:url('assets/media/svg/online_payment.svg')"></div>
                        <!--end::Image-->
                        <!--begin::Action-->
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                        </div>
                        <!--end::Action-->
                    </a>
                    <!--end::Overlay-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-7">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column h-100">
                        <!--begin::Header-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <div class="mb-6">
                                <span class="text-gray-400 fs-7 fw-bolder me-2 d-block lh-1 pb-1">Transaction ID: {{$dashboardItem['lastPayment']['id']}}</span>
                                <a href="#" class="text-gray-800 text-hover-primary fs-1 fw-bolder">Latest Payment</a>
                            </div>
                            <!--end::Title-->
                            <!--begin::Items-->
                            <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <img src="assets/media/avatars/300-3.jpg" class="" alt="">
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-400 d-block fs-8">Agent Details</span>
                                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-7">
                                            
                                            @if(!empty($dashboardItem['lastPayment']))
                                            {{$dashboardItem['lastPayment']['User']['name']}}&nbsp;|&nbsp;Code:{{$dashboardItem['lastPayment']['User']['agent_code']}}
                                            @endif
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label bg-success">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                                            <span class="svg-icon svg-icon-5 svg-icon-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="currentColor"></path>
                                                    <path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-400 d-block fs-8">Customer Details</span>
                                        @if(!empty($dashboardItem['lastPayment']))
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary fs-7">{{$dashboardItem['lastPayment']['customer_name']}}&nbsp;|&nbsp;M:&nbsp;{{$dashboardItem['lastPayment']['customer_mobile']}}</a>
                                        @endif
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="d-flex flex-column border border-1 border-gray-300 text-center pt-5 pb-7 mb-8 card-rounded">
                            <span class="fw-bold text-gray-600 fs-7 pb-1">Payment Details</span>
                            <span class="fw-bolder text-gray-800 fs-1 lh-1 pb-1">Rs. {{$dashboardItem['lastPayment']['amount']}}</span>
                            <span class="fw-bold text-gray-600 fs-7 pb-1">Txn No:</span>
                            <span class="fw-bold text-gray fs-8 lh-1 pb-1 mt-1">{{$dashboardItem['lastPayment']['txn_id']}}</span>
                            <span class="text-success fw-bolder fs-4 mt-2 pb-2">{{$dashboardItem['lastPayment']['status']}}</span>
                            <span class="fw-bold text-gray-600 fs-7 pb-1">Payment Date</span>
                            <span class="fw-bolder text-gray-800 fs-6">{{getFormatDate($dashboardItem['lastPayment']['created_at'],'d M, Y | H:i A')}}</span>
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="d-flex flex-stack mt-auto bd-highlight">
                            <!--begin::Actions-->
                            <a href="{{route('ds.ro_transaction_view',['tid'=>encryptString($dashboardItem['lastPayment']['id'])])}}" class="btn btn-primary btn-sm flex-shrink-0 me-3">View Details</a>
                            <a href="{{route('pdf.generate',['transactionId'=>encryptString($dashboardItem['lastPayment']['id'])])}}" target="_blank" class="btn btn-light btn-sm flex-shrink-0">Download Invoice</a>
                            <!--end::Actions-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->
    </div>
</div>
<div class="col-xl-6">
    <div class="card card-flush border-0 h-xl-100">
        <!--begin::Body-->
        <div class="card-body py-9">
            <!--begin::Row-->
            <div class="row gx-9 h-100">
                <!--begin::Col-->
                <div class="col-sm-5 mb-10 mb-sm-0">
                    
                    <!--begin::Overlay-->
                    <a class="d-block overlay h-100" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x600/img-42.jpg">
                        <!--begin::Image-->
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px h-100" style="background-image:url('assets/media/svg/savings.svg')"></div>
                        <!--end::Image-->
                        <!--begin::Action-->
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                        </div>
                        <!--end::Action-->
                    </a>
                    <!--end::Overlay-->
                </div>
                
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-7">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column h-100">
                        <!--begin::Header-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <div class="mb-6">
                                <span class="text-gray-400 fs-7 fw-bolder me-2 d-block lh-1 pb-1">Last Update at: {{date('d M,Y | H:i A')}}</span>
                                <a href="#" class="text-gray-800 text-hover-primary fs-1 fw-bolder">Today Commission</a>
                            </div>
                            <!--end::Title-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center me-5 me-xl-13 mb-10">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <img src="assets/media/avatars/300-3.jpg" class="" alt="">
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-400 d-block fs-8">Distributor Details</span>
                                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-7">
                                           {{getauthValue('name')}}&nbsp;{{getauthValue('last_name')}}&nbsp;|&nbsp;Code:{{getauthValue('agent_code')}}
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                           <div class="d-flex flex-column border border-1 border-gray-300 text-center pt-5 pb-7 mb-8 card-rounded">
                            <span class="fw-bold text-gray-600 fs-7 pb-1">Last Comission Amount</span>
                            <span class="fw-bolder text-gray-800 fs-2 lh-1 pb-1">Rs. {{$dashboardItem['lastWalletTransactions']['amount']}}</span>
                            <span class="fw-bold text-gray-600 fs-7 pb-1 py-5">Reference No:</span>
                            <span class="fw-bold text-gray fs-8 lh-1 pb-1 mt-1">{{$dashboardItem['lastWalletTransactions']['reference_number']}}</span>

                            
                        </div>
                        <!--end::Body-->
                        <!--begin::Body-->
                        <div class="d-flex flex-column border border-1 border-gray-300 text-center pt-5 pb-7 mb-8 card-rounded">
                            <span class="fw-bold text-gray-600 fs-7 pb-1">Total Comission Amount</span>
                            <span class="fw-bolder text-success fs-2x lh-1 pb-1">Rs. {{$dashboardItem['todayCommission']}}</span>
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="d-flex flex-stack mt-auto bd-highlight">
                            <!--begin::Actions-->
                            <a href="{{route('ds.wallettransaction')}}" class="btn btn-primary btn-sm flex-shrink-0 me-3" >View Wallet Transaction</a>
                            <!--end::Actions-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->
    </div>
</div>
<!--end::Col-->
</div>
