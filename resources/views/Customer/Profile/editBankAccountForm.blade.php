

<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">Update Bank Account Details</h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
		<!--begin::Form-->
		<?php if(Auth::user()->role == 'admin') { $route = route('admin.profile-bank-account-save',['user'=>Crypt::encryptString($userProfile->id)]); } ?>
		<?php if(Auth::user()->role == 'distributor') { $route = route('ds.profile-bank-account-save',['user'=>Crypt::encryptString($userProfile->id)]); } ?>
		<?php if(Auth::user()->role == 'retailer') { $route = route('ro.profile-bank-account-save',['user'=>Crypt::encryptString($userProfile->id)]); } ?>
       
		<form id="kt_account_profile_details_form" class="form" method="post" action="{{$route}}" enctype="multipart/form-data">
			@csrf
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Full Name As Per Bank Account</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="As Per Your Pan Card"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="tel" name="full_name_in_bank" class="form-control form-control-lg form-control-solid" placeholder="First Name" value="{{$userProfile->name}}" />
					</div>
					
					<!--end::Col-->
				</div>
				<!--end::Input group-->


				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Account Number</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="12 Digit Valid Aadhar Number"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="number" name="account_number" class="form-control form-control-lg form-control-solid"  value="{{$userProfile->account_number}}" />
					</div>
					<!--end::Col-->
                    <!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="number" name="confirm_account_number" class="form-control form-control-lg form-control-solid"   />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->





				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Bank Name</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Valid Bank Account Number"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="text" name="bank_name" class="form-control form-control-lg form-control-solid" placeholder="Enter Bank Name" value="{{$userProfile->bank_name}}" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->

                <!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Bank IFSC Code</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="IFSC Code must be valided from your branch"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="text" name="bank_ifsc_code" class="form-control form-control-lg form-control-solid" placeholder="Enter Bank IFSC Code" value="{{$userProfile->bank_ifsc_code}}" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->



				<!--begin::Input group For Upload AAdhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Upload Cancle Cheque<span class="required"></span></label>
					
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
                            <?php $imagePath = asset("storage/ekyc/".$userProfile->cancle_cheque); ?>
							<div class="image-input-wrapper w-425px h-225px" style="background-image: url({{$imagePath}})"></div>
							<!--end::Preview existing avatar-->
							<!--begin::Label-->
							<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change cancle cheque pic">
								<i class="bi bi-pencil-fill fs-7"></i>
								<!--begin::Inputs-->
								<input type="file" name="cancle_cheque" accept=".png, .jpg, .jpeg" />
								<input type="hidden" name="cancle_cheque_pic_remove" />
								<!--end::Inputs-->
							</label>
							<!--end::Label-->
							<!--begin::Cancel-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel cancle cheque Pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Cancel-->
							<!--begin::Remove-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove cancle cheque Pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Remove-->
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						<!--end::Hint-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group for upload Aadhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Bank Verification Status</span>
					</label>
					<div class="col-lg-4 fv-row">
						<?php $selected1 = ($userProfile->is_account_verified == 1) ? 'selected' : ''; ?>
						<?php $selected2 = ($userProfile->is_account_verified == 0) ? 'selected' : ''; ?>
						<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
						@if($userProfile->is_account_verified==1)
						<select name="is_account_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder  bg-light-success  form-success">
						@else
						<select name="is_account_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder   bg-light-danger   form-success">
						@endif
							<option value="0" {{$selected2}}>Not Verified</option>
							<option value="1" {{$selected1}}>Verified</option>
						</select>
							<x-input-error :messages="$errors->get('is_account_verified')" class="mt-2" /> 
						</div>
					</div>
	
				


				
				<!--end::Input group-->
			</div>
			<!--end::Card body-->
			<!--begin::Actions-->
			<div class="card-footer d-flex justify-content-end py-6 px-9">
				<input type="hidden" name="role" value="admin">
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


