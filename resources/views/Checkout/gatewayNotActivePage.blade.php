@extends('layouts.default')
@section('content')
<!--begin::Wrapper-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
            <div class="row gy-5 g-xl-10">
            
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-12 mb-5 mb-xl-12">
                <!--begin::Engage widget 1-->
                <div class="card h-md-100">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column flex-center">
                        <!--begin::Heading-->
                        <div class="mb-2 text-center">
                                <a href="{{env('APP_URL')}}" class="mb-12 text-center">
                                    <img alt="Logo" src="logo.svg" class="h-50px" />
                                </a>
                            <!--begin::Title-->
                            <div class="pt-lg-10 mb-10 text-center">
                               
                                <!--begin::Logo-->
                                <h1 class="fw-bolder fs-1qx text-danger-800 mb-5 text-center text-danger">{{($gatewayName)}} {{$pageTitle}}</h1>
                                <!--end::Logo-->
                                <!--begin::Message-->
                                <div class="fw-bold fs-5 text-muted mb-15 text-center">Payment Gateway is currently unavailable.
                                <br>Please contact system administrator. You can call us {{env('APP_CONTACT')}}</div>
                                <!--end::Action-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Illustration-->
                            <div class="">
                            <img src="assets/media/svg/403New.svg" height="450px"/>
                            </div>
                            <!--end::Illustration-->
                            <div class="fw-bold">Apologies, the payment gateway is currently unavailable, and we are unable to process payments at this time. We appreciate your patience and understanding. Rest assured, we are working diligently to resolve this issue and will notify you as soon as the payment gateway is operational again. Thank you for your cooperation.</div>
                            <div class="text-center text-muted mt-20 fs-7">
                             {{env('APP_NAME')}}. <span class="text-muted fw-bold me-1">{{date('Y')}}©</span> All Rights Reserved<br>
                                Address: {{env('APP_ADDRESS')}}, Support: {{env('APP_SUPPORT_EMAIL')}}
                            </div>
                           
                        </div>
                        <!--end::Heading-->
                        <div class="text-center">
                            <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                                <li class="menu-item">
                                    <a href="#" target="_blank" class="menu-link px-2">About</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" target="_blank" class="menu-link px-2">{{getLocalText('terms_conditions')}}</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" target="_blank" class="menu-link px-2">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                        <!--begin::Links-->
                        <!--end::Links-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col-->
        </div>
        </div>
        </div>
        </div>
        </div>
<!--end::Wrapper-->
@endsection
                        