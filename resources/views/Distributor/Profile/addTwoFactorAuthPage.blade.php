
<!--begin::Basic info-->
@if (session('status') === 'setup-success')
        @include('utils.successMessage',['message'=> session('message')])
@endif
@if (session('status') === 'setup-error')
        @include('utils.errorMessage',['message'=> session('message')])
@endif

<div>
@include('Distributor.Profile.TwoStepVerificationStatus')

</div>
<div class="card mb-5 mb-xl-10 mt-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
        <h3 class="fw-bolder m-0">
            {{ __($pageTitle) }}
        </h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	
		<div id="kt_account_settings_signin_method" class="collapse show">
										<!--begin::Card body-->
										<div class="card-body border-top p-9">
											<!--begin::Email Address-->
											
											<div class="" data-kt-element="apps">
							<!--begin::Heading-->
							<h3 class="text-dark fw-bolder mb-7">Authenticator Apps</h3>
							<!--end::Heading-->
							<!--begin::Description-->
							<div class="text-gray-500 fw-bold fs-5 mb-10">Using an authenticator app like
							<a href="https://support.google.com/accounts/answer/1066447?hl=en" target="_blank">Google Authenticator</a>
							 scan the QR code. It will generate a 6 digit code for you to enter below.
							<!--begin::QR code image-->
							<div class="pt-5 text-center">
							{!! QrCode::size(200)->generate($qrCodeUrl) !!}
							</div>
							<!--end::QR code image--></div>
							<!--end::Description-->
							<!--begin::Notice-->
							<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-10 p-6">
								<!--begin::Icon-->
								<!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
								<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
										<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
										<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
								<!--end::Icon-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-grow-1">
									<!--begin::Content-->
									<div class="fw-bold">
										<div class="fs-6 text-gray-700">If you having trouble using the QR code, select manual entry on your app, and enter your username and the code:
										<div class="fw-bolder text-dark pt-2">{{$secerteKey}}</div></div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Wrapper-->
								
							</div>
							@if ($errors->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							@if($errors->has('error'))
								<div class="alert alert-danger">
									{{ $errors->first('error') }}
								</div>
							@endif
							<!--end::Notice-->
							<!--begin::Form-->
							<form  method="POST" class="form" action="{{route('ds.add-authenticator')}}">
								@csrf
								<!--begin::Input group-->
								<div class="mb-10 fv-row">
									<input type="text" class="form-control form-control-lg form-control-solid" placeholder="Enter authentication code" name="code" />
									<input type="hidden" class="form-control form-control-lg form-control-solid" name="key" value={{$secerteKey}} />
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="d-flex flex-center">
									<button type="submit" data-kt-element="apps-submit" class="btn btn-primary">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<button type="reset" data-kt-element="apps-cancel" class="btn btn-light me-3">Cancel</button>
									
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
										</div>
										<!--end::Card body-->
									</div>
															
			
				
                
				
			
		
	<!--end::Content-->
</div>