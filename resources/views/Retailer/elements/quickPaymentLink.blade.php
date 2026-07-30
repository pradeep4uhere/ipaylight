<?php //$paymentLinks = $dashboardItem['paymentLinks'];?>
@php
    $paymentLinks = \App\Helpers\CustomHelper::getRetailerPaymentLinks($userProfile->id);
@endphp
<!--begin::Card-->
<div class="card shadow-none rounded-0 w-100">
            <!--begin::Header-->
            <div class="card-header" id="kt_engage_demos_header">
                <h3 class="card-title fw-bolder text-gray-700">{{getLocalText('quick_payment_link')}}</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary h-40px w-40px me-n6" id="kt_engage_demos_close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body" id="kt_engage_demos_body">
                <!--begin::Content-->
                <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_engage_demos_body" data-kt-scroll-dependencies="#kt_engage_demos_header" data-kt-scroll-offset="5px">
                    <!--begin::Wrapper-->
                    <div class="mb-0">
                        @if(count($paymentLinks))
                        @foreach($paymentLinks as $item)
                        <!--begin::License-->
                        <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-5">
                            <div class="d-flex flex-stack">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="fs-6 fw-bold text-gray-800 fw-bold mb-0 me-1">{{getLocalText('Payment Link')}}-{{$item->link_title}}</div>
                                        <i class="text-gray-400 fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="popover" data-bs-custom-class="popover-dark" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="{{$item->link_title}}&nbsp;|&nbsp;Gateway Name: {{$item->Gateway->gateway_name}}&nbsp;{{$item->description}}"></i>
                                    </div>
                                    <div class="fs-7 text-muted"></div>
                                    <div class="fs-7 text-muted">{{getPaymentLinkURL($item->payment_link)}}</div>
                                </div>
                                <div class="text-nowrap">
                                <a href="{{getPaymentLinkURL($item->payment_link)}}" class="btn btn-sm btn-primary" target="_blank">{{getLocalText('Payment Now')}}</a>
                                </div>
                            </div>
                        </div>
                        <!--end::License-->
                        @endforeach
                        @else
                        <div class="alert alert-danger text-danger text-center fs-6">No Payment Link Found</div>
                        <a href="{{route('ro.generate-payment-link')}}" class="btn btn-lg explore-btn-primary w-100">{{getLocalText('generate_payment_link')}}</a>
                        
                        @endif
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
        </div>
    <!--end::Card-->