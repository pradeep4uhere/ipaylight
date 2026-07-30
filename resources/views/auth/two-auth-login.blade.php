@extends('layouts.otp')
@section('content')
<style>
input[type="number"] {
	width: .86em;
	line-height: 1;
	margin: .1em;
	padding: 8px 0 4px;
	font-size: 2.65em;
	text-align: center;
	appearance: textfield;
	-webkit-appearance: textfield;
	border: 0;
	color: #073A39;
	border-radius: 6px;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* 2 groups of 3 items */
input[type="number"]:nth-child(n+4) {
	order: 2;
}
.otc div::before {
	content: '';
	height: 2px;
	width: 12px;
	margin: 0 .25em;
	order: 1;
	background: #fff;
	border-radius: 2px;
	opacity: .4;
}

/* From: https://gist.github.com/ffoodd/000b59f431e3e64e4ce1a24d5bb36034 */


</style>
<div class="d-flex flex-column flex-root mt-10">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="{{env('APP_URL')}}" class="mb-12">
                <img alt="Logo" src="logo.svg" class="h-60px" />
            </a>
            <!--end::Logo-->
				
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100 mb-10" novalidate="novalidate"method="post"   action="{{route('2fa.verify')}}">
							@csrf
							<!--begin::Icon-->
							<div class="text-center mb-10">
								<!-- <img alt="Logo" class="mh-205px" src="assets/media/svg/misc/smartphone.svg"> -->
								<img alt="Logo" class="mh-150px" src="assets/media/svg/otp.svg">
							</div>
							<!--end::Icon-->
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3 fs-5">Two Step Verification</h1>
								<!--end::Title-->
								<!--begin::Sub-title-->
								<div class="text-muted fw-bold fs-5 mb-5">Enter the verification code we sent to</div>
								<!--end::Sub-title-->
								<!--begin::Mobile no-->
								<div class="fw-bolder text-dark fs-3">*********</div>
								<!--end::Mobile no-->
							</div>
							<!--end::Heading-->
							<!--begin::Section-->
							<div class="mb-10 px-md-10">
								<!--begin::Label-->
								<div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Type your 6 digit security code</div>
								<!--end::Label-->
								<!--begin::Input group-->
								
							
								<div class="d-flex flex-wrap flex-stack">
									<input id="otc-1" required pattern="[0-9]*" min="0" max="9" name="2fa_code_1" type="number" inputtype="numeric" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" inputmode="text" tabindex=1>
									<input id="otc-2" required pattern="[0-9]*" min="0" max="9" name="2fa_code_2" type="number" inputtype="numeric" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" inputmode="text" tabindex=2>
									<input id="otc-3" required pattern="[0-9]*" min="0" max="9" name="2fa_code_3" type="number" inputtype="numeric" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" inputmode="text" tabindex=3>
									<input id="otc-4" required pattern="[0-9]*" min="0" max="9" name="2fa_code_4" type="number" inputtype="numeric" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" inputmode="text" tabindex=4>
									<input id="otc-5" required pattern="[0-9]*" min="0" max="9" name="2fa_code_5" type="number" inputtype="numeric" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" inputmode="text" tabindex=5>
									<input id="otc-6" required pattern="[0-9]*" min="0" max="9" name="2fa_code_6" type="number" inputtype="numeric" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" inputmode="text" tabindex=6>
								</div>
								<!--begin::Input group-->
							</div>
							<!--end::Section-->
							<!--begin::Submit-->
							<div class="d-flex flex-center">
								<button type="submit"  class="btn btn-lg btn-primary fw-bolder">
									<span class="indicator-label">Verify OTP</span>
								</button>
							</div>
							<!--end::Submit-->
						</form>
						<!--end::Form-->
						<!--begin::Notice-->
						@if($errors->any())
							<div class="alert alert-danger" style="color: red;">Invalid OTP !</div>
				@endif
						
						
						<!--end::Notice-->
					</div>
                    </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
            <div class="d-flex align-items-center fw-bold fs-6">
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