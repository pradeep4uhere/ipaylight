
@extends('Retailer.layouts.dashboard')
@section('content')
<div class="row mb-2 ">
@if($errors)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card card-flush  flex-row-fluid overflow-hidden mb-5 mw-650px">
<div class="card-header modal-header justify-content-start ribbon ribbon-start ribbon-clip">
        <div class="ribbon-label fw-bolder">
            <span class="fw-bolder fs-3 ps-3">Transfer Confiramtion</span>
            <span class="ribbon-inner bg-danger"></span>
        </div>
</div>
<div class="separator separator"></div>
<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid">
        <!--begin::Content-->
        <div class="flex-row-fluid py-lg-5 px-lg-10">
            <div class="fs-2 fw-bolder">
                <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                </span>&nbsp;{{$data['beneficiary_name']}}
            </div>
        <?php $imagePath = asset("assets/bank/".$data['masterBank']['icon']); ?>
        <div class="fs-6 fw-bold text-gray-400 mb-7"><img src="{{$imagePath}}" height="25px" width="25px" title="" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="right"  data-bs-toggle="tooltip-dark" data-bs-custom-class="tooltip-dark" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="{{$data['masterBank']['bank_name']}}"/>&nbsp;{{$data['bank_name']}} &nbsp;|&nbsp;<span class="text-mute fs-8">Saving Account</span></div>
        <div class="fs-6 d-flex justify-content-between mb-4">
            <div class="fw-bold">Account Number</div>
            <div class="d-flex fw-bolder">{{$data['account_number']}}</div>
        </div>
        
        <div class="fs-6 d-flex justify-content-between my-2">
            <div class="fw-bold">IFSC Code</div>
            <div class="d-flex fw-bolder">{{$data['ifsc_code']}}</div>
        </div>
        

        <div class="fs-6 d-flex justify-content-between my-2">
            <div class="fw-bold">Transfer Type</div>
            <div class="d-flex fw-bolder">IMPS</div>
        </div>
        <div class="separator separator-dashed"></div>

        <div class="fs-6 d-flex justify-content-between my-4">
            <div class="fw-bold">Transfer Amount</div>
            <div class="d-flex fw-bolder">Rs. {{number_format($amount,2)}}</div>
        </div>
        <div class="fs-6 d-flex justify-content-between my-4">
            <div class="fw-bold">Transfer Fee</div>
            <div class="d-flex fw-bolder">Rs. {{number_format($transferFee,2)}}</div>
        </div>
        <div class="separator separator-dashed"></div>
        <div class="fs-6 d-flex justify-content-between my-2">
            <div class="fw-bold">Total Amount</div>
            <div class="d-flex fw-bolder fs-4">Rs. {{number_format(($amount+$transferFee),2)}}</div>
        </div>
        <div class="separator separator-dashed"></div>
        <!--begin::Form-->
        <form class="form mt-10" novalidate="novalidate" id="kt_modal_transfer_money_form" action="{{$route}}" method="post">
        @csrf
        <input type="hidden" name="payload" value="{{$payload}}"/>
        <input type="hidden" name="indentifier" value="{{$indentifier}}"/>
        <input type="hidden" name="indentifier_type" value="{{$indentifierType}}"/>
        <button type="submit" class="btn btn-lg btn-primary mb-10" data-kt-stepper-action="next">Confirm Transfer 
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
            <span class="svg-icon svg-icon-3 ms-1 me-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                </svg>
            </span>
        </button>
        </form>
        <!--end::Form-->
        </div>
</div>
</div>
</div>
@endsection
               