@extends('layouts.dashboard')
@section('content')
@include('elements.announcement')
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body p-0">
            <!--begin::Wrapper-->
            <div class="card-px text-center py-10  my-10">
                <!--begin::Title-->
                <h2 class="fs-2x fw-bolder mb-10">Welcome Customer to {{env('APP_NAME')}}</h2>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-500 fs-4 fw-bold mb-1">Welcome to {{env('APP_NAME')}} We're thrilled to have you join us on your journey towards convenient and efficient payment solutions.</p>
                <P class="text-gray-500 fs-6 fw-bold mb-5">At {{env('APP_NAME')}}, we pride ourselves on offering the best payment service solutions all in one place.<BR/> Whether you're looking to Digital Product Sales.</P>
                <!--end::Description-->
                <!--begin::Action-->
                <a href="{{route('profile.profile')}}" class="btn btn-primary">Complete Profile</a>
                <!--end::Action-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Illustration-->
            <div class="text-center px-1 mb-10">
                <img  class="mw-100 mh-300px" alt=""  src="{{asset('assets/media/svg/welcome.svg')}}"/>
            </div>
            <!--end::Illustration-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <!--begin::Modals-->
@endsection