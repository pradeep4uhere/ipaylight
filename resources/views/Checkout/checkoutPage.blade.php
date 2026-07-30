@extends('layouts.checkout')
@section('title', 'Paygenius - Express Checkout')
@section('content')
<div class="d-flex flex-column flex-root">
@if($paymentMode=='Test')
@include('elements.testModeNotification')
@endif
<!--end::Alert-->

			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-5 pb-lg-5">
					<!--begin::Logo-->
					<a href="{{env('APP_URL')}}" class="mb-5">
                    <img alt="Logo" src="logo.svg" class="h-50px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-5 p-lg-15 mx-auto  border-dashed border-gray-350 active">
						<!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('pay')}}">
                            @csrf
							<!--begin::Heading-->
							<div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3 fs-4">Checkout Page</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-400 fs-7">Enter Amount for Checkout</div>
                                <!--end::Link-->
                            </div>
							<!--begin::Heading-->
							<!--begin::Input group-->
                            <div class="fv-row mb-5">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Amount</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="number" name="amount" required="required" autocomplete="amount" autofocus value="{{old('amount')}}" tabindex="1"/>
                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />  
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-5">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Customer Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid @error('name') @enderror" type="text" name="name" required  autofocus value="{{old('name')}}"  tabindex="2"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />  
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-5">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Customer Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid @error('email') @enderror" type="email" name="email" required  autofocus value="{{old('email')}}"  tabindex="3"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />  
                               
                            </div>
                             <!--begin::Input group-->
                             <div class="fv-row mb-5">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Customer Mobile</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid @error('mobile') @enderror" type="number" name="mobile" required  autofocus value="{{old('mobile')}}"  tabindex="4"/>
                                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />  
                            </div>

                              <!--begin::Input group-->
                              <div class="fv-row mb-5">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Payment Remarks</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid @error('descriptions') @enderror" type="text" name="descriptions" required  autofocus value="{{old('descriptions')}}"  tabindex="5"/>
                                <x-input-error :messages="$errors->get('descriptions')" class="mt-2" />  
                            </div>
							<!--end::Input group-->
                        <div class="fv-row mb-5" style="display:none">
                            <div class="d-flex flex-stack mb-2" >
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Choose Payment Gateway</label>
                        </div>
                            <!--begin::Input-->
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" name="gateway"  tabindex="6" >
                            <option></option>
                            @foreach($gatewayList as $k=>$item)
                            @if(($item[0]['gateway_id']==$gateway_id))
                            <option value="{{$k}}" selected="selected">{{$k}} Gateway</option>
                            @else
                            <option value="{{$k}}" disabled="disabled">{{$k}} Gateway</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-5" style="display:block">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Settalment</label>
                        </div>
                        <select name="payemnt_type" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template2"  tabindex="7">
                        <option></option>
                        <option value="IN" selected="selected">Instant Settalment</option>
                        <option value="ND">Next Day Settalment</option>
                        <option value="NW">Next Week Settalment</option>
                    </select>
                    </div>
							
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center w-100">
								<!--begin::Submit button-->
                                <input type="hidden" name="urlText" value="{{$link}}"/>
                                <input type="hidden" name="user_id" value="{{$agent_user_id}}"/>
                                <input type="hidden" name="gateway_id" value="{{$gateway_id}}"/>
								<button type="submit"  class="btn btn-lg btn-primary w-100 mb-5"  tabindex="7">
                                 <span class="indicator-label">Procced To Payment</span>
                                </button>
								<!--end::Submit button-->
								<!--begin::Separator-->
								<!--end::Separator-->
								<!--begin::Google link-->
                                <div class="d-flex flex-column flex-center mb-3">
        <!--begin::Heading-->
        <div class="mb-3 text-gray-500 fw-semibold fs-6">
            Secured Payment by Checkout with <a href="https://www.paygenius.in/" target="_black" class="fw-bold text-gray-900 explore-link-hover me-1">Paygenius</a>. 
        </div>
        <!--end::Heading-->

        <!--begin::Payment methods-->
        <div class="mb-2">
            <img src="assets/media/svg/mestro.png" alt="" class="h-30px me-3 rounded-1">
            
            <img src="assets/media/svg/card-logos/visa.svg" alt="" class="h-30px me-3 rounded-1">
            
            <img src="assets/media/svg/card-logos/mastercard.svg" alt="" class="h-30px me-3 rounded-1">

            <img src="assets/media/svg/card-logos/american-express.svg" alt="" class="h-30px rounded-1">
        </div>
        <!--end::Payment methods-->
        
        <!--begin::Notice-->
        <div class="text-gray-500 fs-7">
            100% money back guarantee<sup>**</sup>
        </div>
        <!--end::Notice-->
    </div>
								
								
								
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
						<a href="https://paygenius.in/aboutus" class="text-muted text-hover-primary px-2">About</a>
						<a href="https://paygenius.in/contact_us" class="text-muted text-hover-primary px-2">Contact</a>
						<a href="https://paygenius.in/terms-conditions" class="text-muted text-hover-primary px-2">Terms & Conditions</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>

  
@endsection
                        