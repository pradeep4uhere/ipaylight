<?php //$paymentLinks = $dashboardItem['paymentLinks'];?>
@php
    $paymentLinks = \App\Helpers\CustomHelper::getRetailerPaymentLinks($userProfile->id);
@endphp
<div class="card card-xl-stretch">
<!--begin::Card-->
<div class="card shadow-none rounded-0 w-100">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="fw-bolder mb-2 text-dark">{{getLocalText('quick_payment_link')}}</span>
                <span class="text-muted fw-bold fs-7">{{count($paymentLinks)}} {{getLocalText('links_found')}}</span>
            </h3>
        </div>
        <div class="separator separator-dashed"></div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body" style="padding:10px;">
                <!--begin::Content-->
                    <div class="mb-0">
                        @if(count($paymentLinks))
                        @foreach($paymentLinks as $item)
                        <?php $array = ['warning','success','info','danger']; 
							  $randomKey = array_rand($array);
                        ?>
                        <!--begin::License-->
                        <div class="border border-dashed {{$array[$randomKey]}}-gray-300 py-4 px-2 mb-5 bg-light-{{$array[$randomKey]}}">
                            <div class="d-flex flex-stack">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="fs-6 fw-bold text-gray-800 fw-bold mb-0 me-1">{{getLocalText('Payment Link')}}-{{$item->link_title}}</div>
                                        <i class="text-gray-400 fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="popover" data-bs-custom-class="popover-dark" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="{{$item->link_title}}&nbsp;|&nbsp;Gateway Name: {{$item->Gateway->gateway_name}}&nbsp;{{$item->description}}"></i>
                                    </div>
                                    <div class="text-mute fs-8">{{$item->description}}</div>
                                </div>
                                <div class="text-nowrap mt-2">
                                    <a href="{{getPaymentLinkURL($item->payment_link)}}" class="btn btn-sm btn-{{$array[$randomKey]}}" target="_blank">{{getLocalText('Payment Now')}}</a>
                                </div>
                                
                            </div>
                           
                        </div>
                        

                        <!--end::License-->
                        @endforeach
                        @else
                        <div class="alert alert-danger text-danger text-center fs-6">{{getLocalText('not_payment_link_found')}}</div>
                        <a href="{{route('ro.generate-payment-link')}}" class="btn btn-lg explore-btn-primary w-100">{{getLocalText('generate_payment_link')}}</a>
                        
                        @endif
                    </div>
                    <!--end::Wrapper-->
               
            </div>
            <!--end::Body-->
        </div>
    <!--end::Card-->
    </div>
    <!--end::Card-->