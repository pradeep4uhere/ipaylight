
<!--begin::Basic info-->
@if (session('status') === 'verification-link-sent')
        @include('utils.successMessage',['message'=>'A new verification link has been sent to the email address you provided during registration.'])
@endif
<div class="card mb-5 mb-xl-10">
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
	<div id="kt_account_settings_profile_details" class="collapse show">
        
        <!--begin::Form-->
		<form method="POST" action="{{ route('verification.send') }}">
        @csrf
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
			<div class="d-flex flex-wrap align-items-center">
												<!--begin::Label-->
												<div id="kt_signin_email" class="">
													<div class="fs-6 fw-bolder mb-1">Email Address</div>
													<div class="fw-bold text-gray-600">{{getAuthValue('email')}}</div>
												</div>
												<!--end::Label-->
												<!--begin::Action-->
												<div id="kt_signin_email_button" class="ms-auto">
												@if(getAuthValue('is_email_verified')==1)
													<span class="badge badge-success p-3 fs-7">Verified</span>
												@else
												<button class="btn btn-primary btn-active-light-primary">
													{{ __('Resend Verification Email') }}
												</button>
												@endif
												</div>
												<!--end::Action-->
											</div>
				
                
				
				
			</div>
			<!--end::Card body-->
			<!--begin::Actions-->
			
			<!--end::Actions-->
		</form>
		<!--end::Form-->
	</div>
	<!--end::Content-->
</div>
<!--end::Basic info-->
<!--end::Wrapper-->
