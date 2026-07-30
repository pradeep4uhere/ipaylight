@if(getAuthValue('google2fa_secret')!='')
<form  class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" method="post" action="{{route('ro.update_two_step_auth')}}">
@csrf
<div class="card">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">Two Factor Authentication Status</h3>
		</div>
	</div>
	<!--end::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_deactivate" class="collapse show">
		<!--begin::Form-->
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Icon-->
				<?php if(getAuthValue('uses_two_factor_auth')==1){ 
						$class="success"; 
						$title="Your Account is enabled with Two Factor Authentication";
						$enabled = 'Enabled';
						$ischecked = true;
					}else{ 
						$class="danger"; 
						$title="Your Account is not enabled with Two Factor Authentication";
						$enabled = 'Disabled';
						$ischecked = false;
					}
				?>
				<!--begin::Notice-->
				<div class="notice d-flex bg-light-{{$class}} rounded border-{{$class}} border border-dashed mb-9 p-6">
					<!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
					<span class="svg-icon svg-icon-2hx svg-icon-{{$class}} me-4">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
							<path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
						</svg>
					</span>
					<!--end::Svg Icon-->
					<!--end::Icon-->
					<!--begin::Wrapper-->
					<div class="d-flex flex-stack flex-grow-1">
						<!--begin::Content-->
						<div class="fw-bold">
							<h4 class="text-gray-900 fw-bolder">{{$title}}</h4>
							<div class="fs-6 text-gray-700">For extra security, this requires you to confirm your account is not able to accessible without Google Authenticaor OTP.
							<br>
							<a class="fw-bolder" href="#">Learn more</a></div>
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Notice-->
				<!--begin::Form input row-->
				<div class="form-check form-check-solid fv-row fv-plugins-icon-container">
				<div class="d-flex flex-stack w-lg-50">
					<!--begin::Label-->
					<div class="me-5">
						<label class="fs-6 fw-bold form-label">Two Step Login Enabled</label>
						<div class="fs-7 fw-bold text-muted">Remove 2-step verification from account.</div>
					</div>
					<!--end::Label-->

					<!--begin::Switch-->
					<label class="form-check form-switch form-check-custom form-check-solid">
						<input class="form-check-input" type="checkbox" name="uses_two_factor_auth" value="1" @if($ischecked) checked="checked" @endif/>
						<span class="form-check-label fw-bold text-muted">
							<span class="badge badge-{{$class}}">{{$enabled}}</span>
						</span>
					</label>
					<!--end::Switch-->
				</div>
			</div>
			<!--end::Card body-->
			
			
		
		
		<!--end::Form-->
	</div>
	<!--end::Content-->
	<div class="card-footer">
		<!--begin::Card footer-->
		<div class=" d-flex justify-content-end">
				<button id="kt_account_deactivate_account_submit" type="submit" class="btn btn-danger fw-bold">Update Setting</button>
			</div>
			<!--end::Card footer-->
	</div>
</div>
</form>
@endif
