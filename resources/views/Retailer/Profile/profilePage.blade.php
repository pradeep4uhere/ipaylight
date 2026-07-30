@extends('Retailer.layouts.dashboard')
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
@if(($userProfile->status_reason!='') && ($userProfile->status=='inactive'))
@include('Retailer.elements.NotificationBanner.NotificationBanner',['title'=>__('messages.PROFILE_IN_REVIEW_TITLE'),"message"=>__($userProfile->status_reason)])
@endif
<!--Show Message Ends Here-->
<!--begin::Navbar-->
@include('Retailer.Profile.ProfileHeader')
<!--end::Navbar-->

<!--begin::details View-->
@include('Retailer.Profile.' .$element)
<!--end::details View-->
@endsection
                        