@extends('layouts.dashboard')
@section('content')
<!--Show Message Start Here-->
@if ($errors->any())
 <div class="alert alert-danger">
    <div>
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
    </div>
</div>
@endif
@if(!$userProfile->is_mobile_verified)
@include('Retailer.elements.NotificationBanner.NotificationBanner',['title'=>__('messages.MOBILE_NOT_VERIFIED_TITLE'),"message"=>__('messages.MOBILE_NOT_VERIFIED_DESCRIPTIONS')])
@endif
@if(!$userProfile->is_email_verified)
@include('Retailer.elements.NotificationBanner.NotificationBanner',['title'=>__('messages.EMAIL_NOT_VERIFIED_TITLE'),"message"=>__('messages.EMAIL_NOT_VERIFIED_DESCRIPTIONS')])
@endif
@if(!$userProfile->is_account_verified)
@include('Retailer.elements.NotificationBanner.NotificationBanner',['title'=>__('messages.ACCOUNT_NOT_VERIFIED_TITLE'),"message"=>__('messages.ACCOUNT_NOT_VERIFIED_DESCRIPTIONS')])
@endif
<!--begin::Navbar-->
@include('User.Profile.ProfileHeader')
<!--end::Navbar-->
<!--begin::details View-->
@include('User.Profile.' .$element)
<!--end::details View-->
@endsection
                        