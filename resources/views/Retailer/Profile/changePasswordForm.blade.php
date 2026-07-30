
<!--begin::Basic info-->
@if (session('status') === 'password-updated')
        @include('utils.successMessage',['message'=>'Password Changed Successfully!'])
@endif
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
        <h3 class="fw-bolder m-0">
            {{ __('Update Password') }}
        </h3>
        

		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
        
        <!--begin::Form-->
        <form method="post" action="{{ route('password.update') }}" id="kt_account_profile_details_form" class="form">
        @csrf
        @method('put')
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				
				
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('Current Password')}}</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input id="update_password_current_password" name="current_password" type="password" class="form-control form-control-lg form-control-solid" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('New Password')}}</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input id="update_password_password" name="password" type="password" class="form-control form-control-lg form-control-solid" autocomplete="password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 alert" />
                    </div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label required fw-bold fs-6">{{__('Confirm Password')}}</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input id="update_password_password" name="password_confirmation" type="password" class="form-control form-control-lg form-control-solid" autocomplete="password_confirmation" />
                         <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				
                
				
				
			</div>
			<!--end::Card body-->
			<!--begin::Actions-->
			<div class="card-footer d-flex justify-content-end py-6 px-9">
				<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
				<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
			</div>
			<!--end::Actions-->
		</form>
		<!--end::Form-->
	</div>
	<!--end::Content-->
</div>
<!--end::Basic info-->
<!--end::Wrapper-->
