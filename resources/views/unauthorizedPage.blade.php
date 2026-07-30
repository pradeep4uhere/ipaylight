@extends('layouts.dashboard')
@section('content')
<div class="card h-md-100">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column flex-center">
        <!--begin::Heading-->
        <div class="mb-2">
            <!--begin::Title-->
            <div class="fw-bolder text-center fs-1 text-danger">{{__('messages.NOT_AUTHORIZED')}}</div>
            <div class="text-center text-gray-800 fw-bold text-muted">Please contact system administrator. You can call us {{env('APP_CONTACT')}}</div>
            
            <!--end::Title-->
            <!--begin::Illustration-->
            <div class="">
            <img src="assets/media/svg/403.svg" height="450px"/>
            </div>
            <!--end::Illustration-->
        </div>
        <div class="text-center text-muted mt-20 fs-7">
            {{env('APP_NAME')}}. <span class="text-muted fw-bold me-1">{{date('Y')}}©</span> All Rights Reserved<br>
            Address: {{env('APP_ADDRESS')}}, Support: {{env('APP_SUPPORT_EMAIL')}}
        </div>
        <!--end::Heading-->
        <!--begin::Links-->
        <!--end::Links-->
    </div>
    <!--end::Body-->
</div>
<!--end::Engage widget 1-->
@endsection
                        