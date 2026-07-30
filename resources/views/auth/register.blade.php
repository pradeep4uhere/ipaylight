@extends('layouts.default')
@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="{{env('APP_URL')}}" class="mb-10">
                <img alt="Logo" src="logo.svg" class="h-50px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3 fs-4">New User Register</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fs-7">Already Account ?
                        <a href="{{route('login')}}" class="link-primary fs-7">Login Here</a></div>
                        <!--end::Link-->
                    </div>

        <!-- Name -->
        <div class="fv-row mb-1">
            <label class="form-label fs-6 fw-bolder text-dark" for="name">First Name</label>
            <span class="required"></span>
            <input id="name" class="form-control form-control-lg form-control-solid block mt-1 w-full" type="text" name="name" value="{{old('name')}}"  autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        

        <!-- Email Address -->
        <div class="fv-row mb-1">
            <label class="form-label fs-6 fw-bolder text-dark" for="email">{{__('Email')}}</Label>
            <span class="required"></span>
            <input id="email" class="form-control form-control-lg form-control-solid block mt-1 w-full" type="email" name="email" value="{{old('email')}}"  autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />  

        </div>

        <div class="fv-row mb-1">
            <label class="form-label fs-6 fw-bolder text-dark" for="mobile">{{__('Mobile')}}</Label>
            <span class="required"></span>
            <input id="email" class="form-control form-control-lg form-control-solid block mt-1 w-full" type="mobile" name="mobile" value="{{old('mobile')}}"  autocomplete="mobile" />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />  

        </div>

        <!-- Password -->
        <div class="fv-row mb-1">
        <label class="form-label fs-6 fw-bolder text-dark" for="password">{{__('Password')}}</Label>
        <span class="required"></span>
        <input id="password" class="form-control form-control-lg form-control-solid block mt-1 w-full"
                            type="password"
                            name="password"
                             autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" /> 
        </div>

        <!-- Confirm Password -->
        <div class="fv-row mb-1">
            <label class="form-label fs-6 fw-bolder text-dark" for="password">{{__('Confirm Password')}}</Label>
            <span class="required"></span>
            <input id="password_confirmation" class="form-control form-control-lg form-control-solid block mt-1 w-full"
                            type="password"
                            name="password_confirmation"  autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> 
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="btn btn-lg btn-primary w-100 mb-5">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    </div>
        <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-1">
            <!--begin::Links-->
            <div class="d-flex align-items-center  fs-6 pb-1">
                <a href="#" class="text-muted text-hover-primary px-2">About</a>
                <a href="#" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="#" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
@endsection
		
